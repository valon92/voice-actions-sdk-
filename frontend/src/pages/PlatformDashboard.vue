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

      <div v-else class="space-y-4 sm:space-y-6">
        <!-- Platform Info Card -->
        <div class="bg-white rounded-xl shadow-lg p-4 sm:p-6">
          <h2 class="text-lg sm:text-xl font-bold text-gray-900 mb-3 sm:mb-4">Platform Information</h2>
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
            <div>
              <p class="text-xs sm:text-sm text-gray-500 mb-1">Platform Name</p>
              <p class="text-base sm:text-lg font-semibold text-gray-900 break-words">{{ platformData?.name || 'N/A' }}</p>
            </div>
            <div>
              <p class="text-xs sm:text-sm text-gray-500 mb-1">Plan</p>
              <p class="text-base sm:text-lg font-semibold text-gray-900 capitalize">{{ platformData?.plan || 'free' }}</p>
            </div>
            <div>
              <p class="text-xs sm:text-sm text-gray-500 mb-1">Status</p>
              <p class="text-base sm:text-lg font-semibold text-green-600 capitalize">{{ platformData?.status || 'active' }}</p>
            </div>
            <div>
              <p class="text-xs sm:text-sm text-gray-500 mb-1">API Key</p>
              <p class="text-xs sm:text-sm font-mono text-gray-600 break-all">{{ maskedApiKey }}</p>
            </div>
          </div>
        </div>

        <!-- Usage Statistics -->
        <div class="bg-white rounded-xl shadow-lg p-4 sm:p-6">
          <h2 class="text-lg sm:text-xl font-bold text-gray-900 mb-3 sm:mb-4">Usage Statistics</h2>
          <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 sm:gap-6">
            <div class="text-center p-3 sm:p-4 bg-gray-50 rounded-lg">
              <p class="text-2xl sm:text-3xl font-bold text-gray-900">{{ stats?.total_commands || 0 }}</p>
              <p class="text-xs sm:text-sm text-gray-600 mt-1">Total Commands</p>
            </div>
            <div class="text-center p-3 sm:p-4 bg-gray-50 rounded-lg">
              <p class="text-2xl sm:text-3xl font-bold text-gray-900">{{ stats?.monthly_commands || 0 }}</p>
              <p class="text-xs sm:text-sm text-gray-600 mt-1">This Month</p>
            </div>
            <div class="text-center p-3 sm:p-4 bg-gray-50 rounded-lg">
              <p class="text-2xl sm:text-3xl font-bold text-gray-900">{{ stats?.last_30_days_commands || 0 }}</p>
              <p class="text-xs sm:text-sm text-gray-600 mt-1">Last 30 Days</p>
            </div>
          </div>
        </div>

        <!-- Plan Upgrade Section -->
        <div class="bg-gradient-to-r from-gray-900 to-gray-800 rounded-xl shadow-lg p-4 sm:p-6 text-white">
          <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 sm:gap-4">
            <div class="flex-1">
              <h2 class="text-lg sm:text-xl font-bold mb-1 sm:mb-2">Current Plan: <span class="capitalize">{{ platformData?.plan || 'free' }}</span></h2>
              <p class="text-gray-300 text-xs sm:text-sm md:text-base">
                <span v-if="platformData?.plan === 'free'">
                  You're on the Free plan. Upgrade to Pro for more features and higher limits.
                </span>
                <span v-else-if="platformData?.plan === 'pro'">
                  You're on the Pro plan. Need more? Contact us for Enterprise options.
                </span>
                <span v-else>
                  You're on the Enterprise plan. Thank you for your business!
                </span>
              </p>
            </div>
            <div class="flex flex-wrap gap-2 sm:gap-3">
              <router-link
                v-if="platformData?.plan === 'free'"
                to="/pricing"
                class="px-4 sm:px-6 py-2 sm:py-3 bg-white text-gray-900 rounded-lg hover:bg-gray-100 transition font-semibold text-xs sm:text-sm md:text-base whitespace-nowrap"
              >
                💰 Upgrade Plan
              </router-link>
              <a
                v-else-if="platformData?.plan === 'pro'"
                href="mailto:sales@voiceactions.io"
                class="px-4 sm:px-6 py-2 sm:py-3 bg-white text-gray-900 rounded-lg hover:bg-gray-100 transition font-semibold text-xs sm:text-sm md:text-base whitespace-nowrap"
              >
                📞 Contact Sales
              </a>
            </div>
          </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-xl shadow-lg p-4 sm:p-6">
          <h2 class="text-lg sm:text-xl font-bold text-gray-900 mb-3 sm:mb-4">Quick Actions</h2>
          <div class="flex flex-wrap gap-2 sm:gap-3 md:gap-4">
            <router-link
              to="/platform/settings"
              class="px-4 sm:px-6 py-2 sm:py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition text-xs sm:text-sm md:text-base whitespace-nowrap"
            >
              ⚙️ Settings
            </router-link>
            <router-link
              to="/docs/integration"
              class="px-4 sm:px-6 py-2 sm:py-3 bg-gray-900 text-white rounded-lg hover:bg-gray-800 transition text-xs sm:text-sm md:text-base whitespace-nowrap"
            >
              📚 Integration Guide
            </router-link>
            <router-link
              to="/pricing"
              class="px-4 sm:px-6 py-2 sm:py-3 bg-gray-100 text-gray-900 rounded-lg hover:bg-gray-200 transition text-xs sm:text-sm md:text-base whitespace-nowrap"
            >
              💰 Pricing
            </router-link>
            <button
              @click="refreshStats"
              class="px-4 sm:px-6 py-2 sm:py-3 bg-gray-100 text-gray-900 rounded-lg hover:bg-gray-200 transition text-xs sm:text-sm md:text-base whitespace-nowrap"
            >
              🔄 Refresh
            </button>
            <button
              @click="handleLogout"
              class="px-4 sm:px-6 py-2 sm:py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition text-xs sm:text-sm md:text-base whitespace-nowrap"
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
