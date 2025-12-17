<template>
  <div class="min-h-screen py-12 px-4 bg-gradient-to-br from-slate-50 via-blue-50 to-purple-50">
    <div class="max-w-2xl mx-auto">
      <div class="bg-white rounded-2xl shadow-xl p-8 sm:p-10">
        <h1 class="text-3xl sm:text-4xl font-bold mb-2 text-gray-900">Complete Your Subscription</h1>
        <p class="text-gray-600 mb-8">Choose your plan and complete payment</p>

        <!-- Plan Selection -->
        <div class="mb-8">
          <label class="block text-sm font-medium text-gray-700 mb-4">Select Plan</label>
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <button
              @click="selectedPlan = 'pro'"
              :class="[
                'p-4 rounded-lg border-2 transition-all',
                selectedPlan === 'pro'
                  ? 'border-gray-900 bg-gray-50'
                  : 'border-gray-200 hover:border-gray-300'
              ]"
            >
              <div class="font-semibold text-gray-900">Pro</div>
              <div class="text-2xl font-bold text-gray-900 mt-2">$99<span class="text-sm text-gray-600">/month</span></div>
              <div class="text-sm text-gray-600 mt-1">10K - 999K commands/month</div>
            </button>
            <button
              @click="selectedPlan = 'enterprise'"
              :class="[
                'p-4 rounded-lg border-2 transition-all',
                selectedPlan === 'enterprise'
                  ? 'border-gray-900 bg-gray-50'
                  : 'border-gray-200 hover:border-gray-300'
              ]"
            >
              <div class="font-semibold text-gray-900">Enterprise</div>
              <div class="text-2xl font-bold text-gray-900 mt-2">Custom</div>
              <div class="text-sm text-gray-600 mt-1">1M+ commands/month</div>
            </button>
          </div>
        </div>

        <!-- Loading State -->
        <div v-if="loading" class="text-center py-8">
          <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-gray-900"></div>
          <p class="mt-4 text-gray-600">Processing...</p>
        </div>

        <!-- Error Message -->
        <div v-if="error" class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
          <p class="text-red-800 text-sm">{{ error }}</p>
        </div>

        <!-- Checkout Button -->
        <button
          v-if="!loading && selectedPlan"
          @click="createCheckoutSession"
          class="w-full px-6 py-3 bg-gray-900 text-white rounded-lg font-semibold hover:bg-gray-800 transition"
        >
          Continue to Payment
        </button>

        <!-- Back Link -->
        <div class="mt-6 text-center">
          <router-link to="/pricing" class="text-gray-600 hover:text-gray-900 text-sm">
            ← Back to Pricing
          </router-link>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import axios from 'axios'

const route = useRoute()
const router = useRouter()

const selectedPlan = ref(route.query.plan || 'pro')
const loading = ref(false)
const error = ref(null)
const platformId = ref(null)

onMounted(() => {
  // Get platform ID from localStorage or route
  const platformData = localStorage.getItem('platform_data')
  if (platformData) {
    const data = JSON.parse(platformData)
    platformId.value = data.id
  } else {
    // If no platform data, redirect to registration
    router.push('/register-platform')
  }
})

const createCheckoutSession = async () => {
  if (!selectedPlan.value || !platformId.value) {
    error.value = 'Please select a plan and ensure you are logged in'
    return
  }

  loading.value = true
  error.value = null

  try {
    const response = await axios.post('/api/payment/checkout', {
      plan: selectedPlan.value,
      platform_id: platformId.value,
      success_url: `${window.location.origin}/platform/dashboard?session_id={CHECKOUT_SESSION_ID}`,
      cancel_url: `${window.location.origin}/pricing?canceled=true`,
    })

    if (response.data.success && response.data.url) {
      // Redirect to Stripe Checkout
      window.location.href = response.data.url
    } else {
      error.value = 'Failed to create checkout session'
    }
  } catch (err) {
    error.value = err.response?.data?.error || 'Failed to create checkout session. Please try again.'
    console.error('Checkout error:', err)
  } finally {
    loading.value = false
  }
}
</script>

