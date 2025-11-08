<template>
  <div class="min-h-screen py-12 px-4 bg-gradient-to-br from-slate-50 via-blue-50 to-purple-50">
    <div class="max-w-7xl mx-auto">
      <div class="mb-8">
        <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-2">Platform Dashboard</h1>
        <p class="text-gray-600">Monitor your SDK usage and manage your platform</p>
      </div>

      <div v-if="loading" class="text-center py-12">
        <p class="text-gray-600">Loading dashboard...</p>
      </div>

      <div v-else-if="error" class="bg-red-50 border border-red-200 rounded-lg p-6">
        <p class="text-red-800">{{ error }}</p>
      </div>

      <div v-else class="space-y-6">
        <!-- Platform Info Card -->
        <div class="bg-white rounded-xl shadow-lg p-6">
          <h2 class="text-xl font-bold text-gray-900 mb-4">Platform Information</h2>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <p class="text-sm text-gray-500">Platform Name</p>
              <p class="text-lg font-semibold text-gray-900">{{ platformData?.name || 'N/A' }}</p>
            </div>
            <div>
              <p class="text-sm text-gray-500">Plan</p>
              <p class="text-lg font-semibold text-gray-900 capitalize">{{ platformData?.plan || 'free' }}</p>
            </div>
            <div>
              <p class="text-sm text-gray-500">Status</p>
              <p class="text-lg font-semibold text-green-600 capitalize">{{ platformData?.status || 'active' }}</p>
            </div>
            <div>
              <p class="text-sm text-gray-500">API Key</p>
              <p class="text-sm font-mono text-gray-600 break-all">{{ maskedApiKey }}</p>
            </div>
          </div>
        </div>

        <!-- Usage Statistics -->
        <div class="bg-white rounded-xl shadow-lg p-6">
          <h2 class="text-xl font-bold text-gray-900 mb-4">Usage Statistics</h2>
          <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="text-center p-4 bg-gray-50 rounded-lg">
              <p class="text-3xl font-bold text-gray-900">{{ stats?.total_commands || 0 }}</p>
              <p class="text-sm text-gray-600 mt-1">Total Commands</p>
            </div>
            <div class="text-center p-4 bg-gray-50 rounded-lg">
              <p class="text-3xl font-bold text-gray-900">{{ stats?.monthly_commands || 0 }}</p>
              <p class="text-sm text-gray-600 mt-1">This Month</p>
            </div>
            <div class="text-center p-4 bg-gray-50 rounded-lg">
              <p class="text-3xl font-bold text-gray-900">{{ stats?.last_30_days_commands || 0 }}</p>
              <p class="text-sm text-gray-600 mt-1">Last 30 Days</p>
            </div>
          </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-xl shadow-lg p-6">
          <h2 class="text-xl font-bold text-gray-900 mb-4">Quick Actions</h2>
          <div class="flex flex-wrap gap-4">
            <router-link
              to="/docs/integration"
              class="px-6 py-3 bg-gray-900 text-white rounded-lg hover:bg-gray-800 transition"
            >
              📚 View Integration Guide
            </router-link>
            <button
              @click="refreshStats"
              class="px-6 py-3 bg-gray-100 text-gray-900 rounded-lg hover:bg-gray-200 transition"
            >
              🔄 Refresh Stats
            </button>
            <button
              @click="handleLogout"
              class="px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition"
            >
              🚪 Logout
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue'
import { useRouter } from 'vue-router'
import axios from 'axios'

const router = useRouter()

const loading = ref(true)
const error = ref(null)
const platformData = ref(null)
const stats = ref(null)
const apiKey = ref('')

const maskedApiKey = computed(() => {
  if (!apiKey.value) return 'N/A'
  return apiKey.value.substring(0, 10) + '...' + apiKey.value.substring(apiKey.value.length - 6)
})

onMounted(async () => {
  // Check if user is logged in
  const storedApiKey = localStorage.getItem('platform_api_key')
  const storedPlatformData = localStorage.getItem('platform_data')

  if (!storedApiKey || !storedPlatformData) {
    router.push('/platform/login')
    return
  }

  apiKey.value = storedApiKey
  platformData.value = JSON.parse(storedPlatformData)

  await loadStats()
})

const loadStats = async () => {
  loading.value = true
  error.value = null

  try {
    const response = await axios.get('/usage/stats')
    if (response.data.success) {
      stats.value = response.data.stats
    }
  } catch (err) {
    error.value = err.response?.data?.error || 'Failed to load statistics'
    console.error('Stats error:', err)
  } finally {
    loading.value = false
  }
}

const refreshStats = () => {
  loadStats()
}

const handleLogout = () => {
  localStorage.removeItem('platform_api_key')
  localStorage.removeItem('platform_data')
  router.push('/')
}
</script>
