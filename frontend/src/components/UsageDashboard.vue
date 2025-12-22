<template>
  <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
    <h2 class="text-2xl font-bold text-gray-900 mb-6">Usage & Billing</h2>

    <!-- Loading State -->
    <div v-if="loading" class="text-center py-8">
      <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-gray-900"></div>
    </div>

    <!-- Usage Display -->
    <div v-else-if="usage" class="space-y-6">
      <!-- Current Usage -->
      <div class="p-6 bg-gradient-to-r from-blue-50 to-purple-50 rounded-lg">
        <div class="flex items-center justify-between mb-4">
          <div>
            <h3 class="text-lg font-semibold text-gray-900">Current Month Usage</h3>
            <p class="text-sm text-gray-600 mt-1">{{ usage.days_remaining }} days remaining this month</p>
          </div>
          <span class="text-3xl font-bold text-gray-900">{{ usage.current.toLocaleString() }}</span>
        </div>

        <!-- Progress Bar -->
        <div class="mb-4">
          <div class="flex justify-between text-sm text-gray-600 mb-2">
            <span>0</span>
            <span class="font-semibold">{{ usage.percentage }}% used</span>
            <span>{{ usage.limit.toLocaleString() }}</span>
          </div>
          <div class="w-full bg-gray-200 rounded-full h-3">
            <div
              :class="[
                'h-3 rounded-full transition-all duration-300',
                usage.percentage >= 100 ? 'bg-red-500' : usage.percentage >= 80 ? 'bg-yellow-500' : 'bg-green-500'
              ]"
              :style="{ width: Math.min(usage.percentage, 100) + '%' }"
            ></div>
          </div>
        </div>

        <!-- Usage Info -->
        <div class="grid grid-cols-2 gap-4 text-sm">
          <div>
            <p class="text-gray-600">Limit</p>
            <p class="font-semibold text-gray-900">{{ usage.limit.toLocaleString() }} commands</p>
          </div>
          <div>
            <p class="text-gray-600">Overage</p>
            <p class="font-semibold text-gray-900">{{ usage.overage.toLocaleString() }} commands</p>
          </div>
        </div>
      </div>

      <!-- Billing Estimate -->
      <div class="p-6 bg-gray-50 rounded-lg">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Billing Estimate</h3>
        <div class="space-y-3">
          <div class="flex justify-between">
            <span class="text-gray-600">Base Subscription</span>
            <span class="font-semibold text-gray-900">${{ billing.base_subscription.toFixed(2) }}</span>
          </div>
          <div v-if="usage.overage > 0" class="flex justify-between">
            <span class="text-gray-600">
              Overage ({{ usage.overage.toLocaleString() }} × ${{ billing.overage_rate.toFixed(4) }})
            </span>
            <span class="font-semibold text-gray-900">${{ billing.overage_amount.toFixed(2) }}</span>
          </div>
          <div class="flex justify-between pt-3 border-t border-gray-300">
            <span class="font-semibold text-gray-900">Total Estimate</span>
            <span class="font-bold text-lg text-gray-900">${{ billing.total_estimate.toFixed(2) }}</span>
          </div>
        </div>
      </div>

      <!-- Warning if approaching limit -->
      <div v-if="usage.percentage >= 80 && usage.percentage < 100" class="p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
        <p class="text-sm text-yellow-800">
          ⚠️ You're approaching your usage limit. Consider upgrading to avoid service interruption.
        </p>
      </div>

      <!-- Limit exceeded warning -->
      <div v-if="usage.percentage >= 100" class="p-4 bg-red-50 border border-red-200 rounded-lg">
        <p class="text-sm text-red-800 mb-3">
          ⚠️ You've exceeded your usage limit. {{ usage.has_subscription ? 'Overage charges will apply.' : 'Please upgrade to continue.' }}
        </p>
        <router-link
          v-if="!usage.has_subscription"
          to="/checkout?plan=pro"
          class="inline-block px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition text-sm font-semibold"
        >
          Upgrade Now
        </router-link>
      </div>

      <!-- Actions -->
      <div class="flex gap-3">
        <router-link
          to="/checkout?plan=pro"
          class="px-4 py-2 bg-gray-900 text-white rounded-lg hover:bg-gray-800 transition font-semibold"
        >
          Upgrade Plan
        </router-link>
        <button
          @click="loadUsage"
          class="px-4 py-2 bg-gray-100 text-gray-900 rounded-lg hover:bg-gray-200 transition font-semibold"
        >
          Refresh
        </button>
      </div>
    </div>

    <!-- Error Message -->
    <div v-if="error" class="mt-4 p-4 bg-red-50 border border-red-200 rounded-lg">
      <p class="text-red-800 text-sm">{{ error }}</p>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'

const usage = ref(null)
const billing = ref(null)
const loading = ref(true)
const error = ref(null)

const getApiKey = () => {
  return localStorage.getItem('platform_api_key')
}

const loadUsage = async () => {
  loading.value = true
  error.value = null

  try {
    const apiKey = getApiKey()
    if (!apiKey) {
      error.value = 'Please login first'
      loading.value = false
      return
    }

    const response = await axios.get('/usage/current', {
      headers: {
        'X-API-Key': apiKey,
      },
    })

    if (response.data.success) {
      usage.value = response.data.usage
      billing.value = response.data.billing
    }
  } catch (err) {
    error.value = err.response?.data?.error || 'Failed to load usage information'
    console.error('Usage load error:', err)
  } finally {
    loading.value = false
  }
}

onMounted(() => {
  loadUsage()
})
</script>

