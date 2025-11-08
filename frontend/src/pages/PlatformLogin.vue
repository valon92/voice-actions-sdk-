<template>
  <div class="min-h-screen py-12 px-4 bg-gradient-to-br from-slate-50 via-blue-50 to-purple-50">
    <div class="max-w-md mx-auto">
      <div class="bg-white rounded-2xl shadow-xl p-8 sm:p-10">
        <h1 class="text-3xl sm:text-4xl font-bold mb-2 text-gray-900">Platform Login</h1>
        <p class="text-gray-600 mb-8">Login with your API key to access your dashboard</p>

        <form @submit.prevent="handleLogin" class="space-y-6">
          <div>
            <label for="api_key" class="block text-sm font-medium text-gray-700 mb-2">
              API Key <span class="text-red-500">*</span>
            </label>
            <input
              id="api_key"
              v-model="apiKey"
              type="password"
              required
              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-transparent font-mono"
              placeholder="va_xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx"
            />
            <p class="mt-1 text-sm text-gray-500">
              Don't have an API key? 
              <router-link to="/register-platform" class="text-gray-900 font-semibold hover:underline">
                Register your platform
              </router-link>
            </p>
          </div>

          <div v-if="error" class="bg-red-50 border border-red-200 rounded-lg p-4">
            <p class="text-red-800 text-sm">{{ error }}</p>
          </div>

          <button
            type="submit"
            :disabled="loading"
            class="w-full px-6 py-3 bg-gray-900 text-white rounded-lg font-semibold hover:bg-gray-800 transition disabled:opacity-50 disabled:cursor-not-allowed"
          >
            <span v-if="loading">⏳ Logging in...</span>
            <span v-else>🔑 Login</span>
          </button>
        </form>
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
