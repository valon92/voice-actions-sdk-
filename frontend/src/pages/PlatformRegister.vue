<template>
  <div class="min-h-screen py-12 px-4 bg-gradient-to-br from-slate-50 via-blue-50 to-purple-50">
    <div class="max-w-2xl mx-auto">
      <div class="bg-white rounded-2xl shadow-xl p-8 sm:p-10">
        <h1 class="text-3xl sm:text-4xl font-bold mb-2 text-gray-900">Register Your Platform</h1>
        <p class="text-gray-600 mb-8">Get your API key to start integrating Voice Actions SDK</p>

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
            <input
              id="expected_usage"
              v-model.number="form.expected_usage"
              type="number"
              min="0"
              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-transparent"
              placeholder="10000"
            />
            <p class="mt-1 text-sm text-gray-500">Estimated number of voice commands per month</p>
          </div>

          <div v-if="error" class="bg-red-50 border border-red-200 rounded-lg p-4">
            <p class="text-red-800 text-sm">{{ error }}</p>
          </div>

          <div v-if="success" class="bg-green-50 border border-green-200 rounded-lg p-4">
            <p class="text-green-800 font-semibold mb-2">✅ Registration Successful!</p>
            <p class="text-green-700 text-sm mb-4">Your API key has been generated. Please save it securely.</p>
            <div class="bg-gray-900 text-white p-4 rounded-lg font-mono text-sm break-all">
              {{ apiKey }}
            </div>
            <button
              type="button"
              @click="copyApiKey"
              class="mt-4 w-full px-4 py-2 bg-gray-900 text-white rounded-lg hover:bg-gray-800 transition"
            >
              📋 Copy API Key
            </button>
            <router-link
              to="/platform/dashboard"
              class="mt-4 block w-full px-4 py-2 bg-gray-900 text-white rounded-lg hover:bg-gray-800 transition text-center"
            >
              Go to Dashboard →
            </router-link>
          </div>

          <button
            type="submit"
            :disabled="loading"
            class="w-full px-6 py-3 bg-gray-900 text-white rounded-lg font-semibold hover:bg-gray-800 transition disabled:opacity-50 disabled:cursor-not-allowed"
          >
            <span v-if="loading">⏳ Registering...</span>
            <span v-else">🚀 Register Platform</span>
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
