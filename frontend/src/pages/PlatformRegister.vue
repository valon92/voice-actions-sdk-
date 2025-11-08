<template>
  <div class="min-h-screen py-12 px-4 bg-gradient-to-br from-slate-50 via-blue-50 to-purple-50">
    <div class="max-w-2xl mx-auto">
      <div class="bg-white rounded-2xl shadow-xl p-8 sm:p-10">
        <h1 class="text-3xl sm:text-4xl font-bold mb-2 text-gray-900">Register Your Platform</h1>
        <p class="text-gray-600 mb-4">Get your API key to start integrating Voice Actions SDK</p>
        <p class="text-sm sm:text-base text-gray-500 mb-8">
          Already have an account? 
          <router-link to="/platform/login" class="text-gray-900 font-semibold hover:underline">
            Login here
          </router-link>
        </p>

        <form @submit.prevent="handleRegister" class="space-y-6">
          <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
              Platform Name <span class="text-red-500">*</span>
            </label>
            <input
              id="name"
              v-model="form.name"
              type="text"
              required
              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-transparent"
              placeholder="e.g., YouTube, Instagram, MyApp"
            />
          </div>

          <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
              Contact Email
            </label>
            <input
              id="email"
              v-model="form.email"
              type="email"
              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-transparent"
              placeholder="contact@yourplatform.com"
            />
          </div>

          <div>
            <label for="website" class="block text-sm font-medium text-gray-700 mb-2">
              Website URL
            </label>
            <input
              id="website"
              v-model="form.website"
              type="url"
              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-transparent"
              placeholder="https://yourplatform.com"
            />
          </div>

          <div>
            <label for="expected_usage" class="block text-sm font-medium text-gray-700 mb-2">
              Expected Monthly Usage
            </label>
            
            <!-- Quick Select Buttons -->
            <div class="flex flex-wrap gap-2 mb-3">
              <button
                type="button"
                @click="form.expected_usage = 1000"
                :class="[
                  'px-4 py-2 rounded-lg text-sm font-medium transition',
                  form.expected_usage === 1000
                    ? 'bg-gray-900 text-white'
                    : 'bg-gray-100 text-gray-700 hover:bg-gray-200'
                ]"
              >
                1K
              </button>
              <button
                type="button"
                @click="form.expected_usage = 10000"
                :class="[
                  'px-4 py-2 rounded-lg text-sm font-medium transition',
                  form.expected_usage === 10000
                    ? 'bg-gray-900 text-white'
                    : 'bg-gray-100 text-gray-700 hover:bg-gray-200'
                ]"
              >
                10K
              </button>
              <button
                type="button"
                @click="form.expected_usage = 100000"
                :class="[
                  'px-4 py-2 rounded-lg text-sm font-medium transition',
                  form.expected_usage === 100000
                    ? 'bg-gray-900 text-white'
                    : 'bg-gray-100 text-gray-700 hover:bg-gray-200'
                ]"
              >
                100K
              </button>
              <button
                type="button"
                @click="form.expected_usage = 1000000"
                :class="[
                  'px-4 py-2 rounded-lg text-sm font-medium transition',
                  form.expected_usage >= 1000000
                    ? 'bg-gray-900 text-white'
                    : 'bg-gray-100 text-gray-700 hover:bg-gray-200'
                ]"
              >
                1M+
              </button>
            </div>
            
            <!-- Input Field -->
            <input
              id="expected_usage"
              v-model.number="form.expected_usage"
              type="number"
              min="0"
              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-transparent"
              placeholder="Enter expected monthly usage"
            />
            
            <!-- Real-time Plan Preview -->
            <div v-if="form.expected_usage > 0" class="mt-3 p-3 rounded-lg border-2" :class="planPreviewClass">
              <div class="flex items-center gap-2 mb-1">
                <span class="text-lg font-bold">{{ selectedPlan }}</span>
                <span class="text-xs px-2 py-1 rounded-full" :class="planBadgeClass">
                  {{ planBadgeText }}
                </span>
              </div>
              <p class="text-sm" :class="planTextClass">{{ planDescription }}</p>
            </div>
            
            <!-- Plan Limits Info -->
            <div class="mt-3 p-3 bg-gray-50 rounded-lg border border-gray-200">
              <p class="text-xs font-semibold text-gray-700 mb-2">Plan Limits:</p>
              <div class="space-y-1 text-xs text-gray-600">
                <div class="flex justify-between">
                  <span>🆓 <strong>Free:</strong></span>
                  <span>Up to 9,999 commands/month</span>
                </div>
                <div class="flex justify-between">
                  <span>⭐ <strong>Pro:</strong></span>
                  <span>10,000 - 999,999 commands/month</span>
                </div>
                <div class="flex justify-between">
                  <span>👑 <strong>Enterprise:</strong></span>
                  <span>1,000,000+ commands/month</span>
                </div>
              </div>
              <router-link to="/pricing" class="text-xs text-gray-900 font-semibold hover:underline mt-2 inline-block">
                View detailed pricing →
              </router-link>
            </div>
            
            <p class="mt-2 text-sm text-gray-500">Estimated number of voice commands per month</p>
          </div>

          <div v-if="error" class="bg-red-50 border border-red-200 rounded-lg p-4">
            <p class="text-red-800 text-sm">{{ error }}</p>
          </div>

          <div v-if="success" class="bg-green-50 border border-green-200 rounded-lg p-4 sm:p-6">
            <p class="text-green-800 font-semibold mb-2 text-base sm:text-lg">✅ Registration Successful!</p>
            <p class="text-green-700 text-sm sm:text-base mb-4">Your API key has been generated. Please save it securely. You will be redirected to your dashboard in a moment...</p>
            <div class="bg-gray-900 text-white p-3 sm:p-4 rounded-lg font-mono text-xs sm:text-sm break-all mb-4">
              {{ apiKey }}
            </div>
            <div class="flex flex-col sm:flex-row gap-3">
              <button
                type="button"
                @click="copyApiKey"
                class="flex-1 px-4 py-2 sm:py-3 bg-gray-900 text-white rounded-lg hover:bg-gray-800 transition text-sm sm:text-base font-semibold"
              >
                📋 Copy API Key
              </button>
              <router-link
                to="/platform/dashboard"
                class="flex-1 px-4 py-2 sm:py-3 bg-gray-900 text-white rounded-lg hover:bg-gray-800 transition text-center text-sm sm:text-base font-semibold"
              >
                Go to Dashboard →
              </router-link>
            </div>
          </div>

          <button
            type="submit"
            :disabled="loading"
            class="w-full px-6 py-3 bg-gray-900 text-white rounded-lg font-semibold hover:bg-gray-800 transition disabled:opacity-50 disabled:cursor-not-allowed"
          >
            <span v-if="loading">⏳ Registering...</span>
            <span v-else>🚀 Register Platform</span>
          </button>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import { useRouter } from 'vue-router'
import axios from 'axios'

const router = useRouter()

const form = ref({
  name: '',
  email: '',
  website: '',
  expected_usage: 0
})

const loading = ref(false)
const error = ref(null)
const success = ref(false)
const apiKey = ref('')

// Computed properties for plan preview
const selectedPlan = computed(() => {
  const usage = form.value.expected_usage || 0
  if (usage >= 1000000) {
    return 'Enterprise'
  } else if (usage >= 10000) {
    return 'Pro'
  } else if (usage > 0) {
    return 'Free'
  }
  return 'Not Selected'
})

const planDescription = computed(() => {
  const usage = form.value.expected_usage || 0
  if (usage >= 1000000) {
    return 'Perfect for large-scale platforms with high traffic. Includes custom support and dedicated resources.'
  } else if (usage >= 10000) {
    return 'Ideal for growing platforms. Includes priority support and advanced features.'
  } else if (usage > 0) {
    return 'Great for small projects and testing. Includes all basic features.'
  }
  return 'Select your expected usage to see your plan'
})

const planBadgeClass = computed(() => {
  const usage = form.value.expected_usage || 0
  if (usage >= 1000000) {
    return 'bg-yellow-100 text-yellow-800'
  } else if (usage >= 10000) {
    return 'bg-blue-100 text-blue-800'
  } else if (usage > 0) {
    return 'bg-green-100 text-green-800'
  }
  return 'bg-gray-100 text-gray-800'
})

const planBadgeText = computed(() => {
  const usage = form.value.expected_usage || 0
  if (usage >= 1000000) {
    return '👑 Enterprise'
  } else if (usage >= 10000) {
    return '⭐ Pro'
  } else if (usage > 0) {
    return '🆓 Free'
  }
  return ''
})

const planPreviewClass = computed(() => {
  const usage = form.value.expected_usage || 0
  if (usage >= 1000000) {
    return 'bg-yellow-50 border-yellow-300'
  } else if (usage >= 10000) {
    return 'bg-blue-50 border-blue-300'
  } else if (usage > 0) {
    return 'bg-green-50 border-green-300'
  }
  return 'bg-gray-50 border-gray-300'
})

const planTextClass = computed(() => {
  const usage = form.value.expected_usage || 0
  if (usage >= 1000000) {
    return 'text-yellow-800'
  } else if (usage >= 10000) {
    return 'text-blue-800'
  } else if (usage > 0) {
    return 'text-green-800'
  }
  return 'text-gray-600'
})

const handleRegister = async () => {
  loading.value = true
  error.value = null
  success.value = false

  try {
    const response = await axios.post('/platforms/register', form.value)
    
    if (response.data.success) {
      apiKey.value = response.data.platform.api_key
      success.value = true
      
      // Store API key and platform data
      localStorage.setItem('platform_api_key', apiKey.value)
      localStorage.setItem('platform_data', JSON.stringify(response.data.platform))
      
      // Auto-login: Redirect to dashboard after 2 seconds
      setTimeout(() => {
        router.push('/platform/dashboard')
      }, 2000)
    }
  } catch (err) {
    error.value = err.response?.data?.error || 'Registration failed. Please try again.'
    console.error('Registration error:', err)
  } finally {
    loading.value = false
  }
}

const copyApiKey = () => {
  navigator.clipboard.writeText(apiKey.value)
  alert('API key copied to clipboard!')
}
</script>
