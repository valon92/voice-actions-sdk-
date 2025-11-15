<template>
  <div class="min-h-screen py-8 sm:py-12 px-4 bg-gradient-to-br from-slate-50 via-blue-50 to-purple-50">
    <div class="max-w-md mx-auto">
      <div class="bg-white rounded-2xl shadow-xl p-6 sm:p-8 lg:p-10">
        <div class="text-center mb-6 sm:mb-8">
          <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold mb-2 text-gray-900">Platform Login</h1>
          <p class="text-sm sm:text-base text-gray-600">Login with your API key to access your dashboard</p>
        </div>

        <form @submit.prevent="handleLogin" class="space-y-5 sm:space-y-6">
          <div>
            <label for="api_key" class="block text-sm sm:text-base font-medium text-gray-700 mb-2">
              API Key <span class="text-red-500">*</span>
            </label>
            <input
              id="api_key"
              v-model="apiKey"
              type="password"
              autocomplete="new-password"
              required
              class="w-full px-3 sm:px-4 py-2.5 sm:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-transparent font-mono text-xs sm:text-sm"
              placeholder="va_xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx"
            />
            <p class="mt-2 text-xs sm:text-sm text-gray-500">
              Don't have an API key? 
              <router-link to="/register-platform" class="text-gray-900 font-semibold hover:underline">
                Register your platform
              </router-link>
            </p>
          </div>

          <div v-if="error" class="bg-red-50 border border-red-200 rounded-lg p-3 sm:p-4">
            <p class="text-red-800 text-xs sm:text-sm">{{ error }}</p>
          </div>

          <button
            type="submit"
            :disabled="loading"
            class="w-full px-6 py-2.5 sm:py-3 bg-gray-900 text-white rounded-lg font-semibold hover:bg-gray-800 transition disabled:opacity-50 disabled:cursor-not-allowed text-sm sm:text-base"
          >
            <span v-if="loading">⏳ Logging in...</span>
            <span v-else>🔑 Login</span>
          </button>
        </form>

        <div class="mt-6 sm:mt-8 pt-6 sm:pt-8 border-t border-gray-200">
          <p class="text-xs sm:text-sm text-gray-500 text-center">
            Need help? 
            <a href="mailto:support@voiceactions.io" class="text-gray-900 font-semibold hover:underline">
              Contact Support
            </a>
          </p>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import axios from 'axios'

const router = useRouter()

const apiKey = ref('')
const loading = ref(false)
const error = ref(null)

const handleLogin = async () => {
  loading.value = true
  error.value = null

  try {
    const response = await axios.post('/platforms/login', {
      api_key: apiKey.value
    })
    
    if (response.data.success) {
      // Store API key and platform data
      localStorage.setItem('platform_api_key', apiKey.value)
      localStorage.setItem('platform_data', JSON.stringify(response.data.platform))
      
      // Redirect to dashboard
      router.push('/platform/dashboard')
    }
  } catch (err) {
    error.value = err.response?.data?.error || 'Login failed. Please check your API key.'
    console.error('Login error:', err)
  } finally {
    loading.value = false
  }
}
</script>
