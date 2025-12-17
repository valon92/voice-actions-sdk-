<template>
  <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
    <h2 class="text-2xl font-bold text-gray-900 mb-6">Subscription Management</h2>

    <!-- Loading State -->
    <div v-if="loading" class="text-center py-8">
      <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-gray-900"></div>
    </div>

    <!-- Current Subscription -->
    <div v-else-if="subscription" class="space-y-4">
      <div class="p-4 bg-gray-50 rounded-lg">
        <div class="flex items-center justify-between mb-2">
          <div>
            <h3 class="text-lg font-semibold text-gray-900 capitalize">{{ subscription.plan }} Plan</h3>
            <p class="text-sm text-gray-600">Status: <span class="font-medium capitalize">{{ subscription.status }}</span></p>
          </div>
          <span :class="[
            'px-3 py-1 rounded-full text-xs font-semibold',
            subscription.status === 'active' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800'
          ]">
            {{ subscription.status }}
          </span>
        </div>

        <div class="mt-4 grid grid-cols-2 gap-4 text-sm">
          <div>
            <p class="text-gray-600">Current Period</p>
            <p class="font-medium text-gray-900">{{ formatDate(subscription.current_period_start) }} - {{ formatDate(subscription.current_period_end) }}</p>
          </div>
          <div v-if="subscription.trial_ends_at">
            <p class="text-gray-600">Trial Ends</p>
            <p class="font-medium text-gray-900">{{ formatDate(subscription.trial_ends_at) }}</p>
          </div>
        </div>

        <!-- Cancel at Period End Notice -->
        <div v-if="subscription.cancel_at_period_end" class="mt-4 p-3 bg-yellow-50 border border-yellow-200 rounded-lg">
          <p class="text-sm text-yellow-800">
            ⚠️ Your subscription will be canceled on {{ formatDate(subscription.current_period_end) }}
          </p>
        </div>
      </div>

      <!-- Actions -->
      <div class="flex gap-3">
        <button
          v-if="subscription.status === 'active' && !subscription.cancel_at_period_end"
          @click="cancelSubscription"
          :disabled="canceling"
          class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition disabled:opacity-50"
        >
          {{ canceling ? 'Canceling...' : 'Cancel Subscription' }}
        </button>
        <button
          v-if="subscription.cancel_at_period_end"
          @click="resumeSubscription"
          :disabled="resuming"
          class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition disabled:opacity-50"
        >
          {{ resuming ? 'Resuming...' : 'Resume Subscription' }}
        </button>
        <router-link
          to="/checkout"
          class="px-4 py-2 bg-gray-900 text-white rounded-lg hover:bg-gray-800 transition"
        >
          Upgrade Plan
        </router-link>
      </div>
    </div>

    <!-- No Subscription -->
    <div v-else class="text-center py-8">
      <p class="text-gray-600 mb-4">You don't have an active subscription</p>
      <router-link
        to="/checkout"
        class="inline-block px-6 py-3 bg-gray-900 text-white rounded-lg font-semibold hover:bg-gray-800 transition"
      >
        Subscribe Now
      </router-link>
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

const subscription = ref(null)
const loading = ref(true)
const error = ref(null)
const canceling = ref(false)
const resuming = ref(false)

const getApiKey = () => {
  return localStorage.getItem('platform_api_key')
}

const loadSubscription = async () => {
  loading.value = true
  error.value = null

  try {
    const apiKey = getApiKey()
    if (!apiKey) {
      error.value = 'Please login first'
      loading.value = false
      return
    }

    const response = await axios.get('/api/subscription/current', {
      headers: {
        'X-API-Key': apiKey,
      },
    })

    if (response.data.success) {
      subscription.value = response.data.subscription
    }
  } catch (err) {
    error.value = err.response?.data?.error || 'Failed to load subscription'
    console.error('Subscription load error:', err)
  } finally {
    loading.value = false
  }
}

const cancelSubscription = async () => {
  if (!confirm('Are you sure you want to cancel your subscription? It will remain active until the end of the billing period.')) {
    return
  }

  canceling.value = true
  error.value = null

  try {
    const apiKey = getApiKey()
    const response = await axios.post('/api/subscription/cancel', {}, {
      headers: {
        'X-API-Key': apiKey,
      },
    })

    if (response.data.success) {
      await loadSubscription()
    }
  } catch (err) {
    error.value = err.response?.data?.error || 'Failed to cancel subscription'
    console.error('Cancel subscription error:', err)
  } finally {
    canceling.value = false
  }
}

const resumeSubscription = async () => {
  resuming.value = true
  error.value = null

  try {
    const apiKey = getApiKey()
    const response = await axios.post('/api/subscription/resume', {}, {
      headers: {
        'X-API-Key': apiKey,
      },
    })

    if (response.data.success) {
      await loadSubscription()
    }
  } catch (err) {
    error.value = err.response?.data?.error || 'Failed to resume subscription'
    console.error('Resume subscription error:', err)
  } finally {
    resuming.value = false
  }
}

const formatDate = (dateString) => {
  if (!dateString) return 'N/A'
  return new Date(dateString).toLocaleDateString('en-US', {
    year: 'numeric',
    month: 'short',
    day: 'numeric',
  })
}

onMounted(() => {
  loadSubscription()
})
</script>

