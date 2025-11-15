<template>
  <div class="min-h-screen py-12 px-4 bg-gradient-to-br from-slate-50 via-blue-50 to-purple-50">
    <div class="max-w-4xl mx-auto">
      <div class="mb-8">
        <router-link to="/platform/dashboard" class="inline-flex items-center gap-2 text-gray-600 hover:text-gray-900 mb-4">
          <span>←</span>
          <span>Back to Dashboard</span>
        </router-link>
        <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-2">Platform Settings</h1>
        <p class="text-gray-600">Manage your Voice Actions SDK configuration</p>
      </div>

      <div v-if="loading" class="text-center py-12">
        <p class="text-gray-600">Loading settings...</p>
      </div>

      <div v-else-if="error" class="bg-red-50 border border-red-200 rounded-lg p-6 mb-6">
        <p class="text-red-800">{{ error }}</p>
      </div>

      <div v-else class="space-y-6">
        <!-- Voice Actions Toggle -->
        <div class="bg-white rounded-xl shadow-lg p-6">
          <div class="flex items-start justify-between mb-4">
            <div class="flex-1">
              <div class="flex items-center gap-3 mb-2">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-500 to-purple-500 flex items-center justify-center text-2xl">
                  🎤
                </div>
                <div>
                  <h2 class="text-xl font-bold text-gray-900">Voice Actions SDK</h2>
                  <p class="text-sm text-gray-500">Enable or disable voice commands for your platform</p>
                </div>
              </div>
            </div>
            <label class="relative inline-flex items-center cursor-pointer">
              <input
                type="checkbox"
                v-model="settings.voice_actions_enabled"
                @change="handleToggle"
                :disabled="saving"
                class="sr-only peer"
              />
              <div class="w-14 h-7 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[4px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-blue-600"></div>
            </label>
          </div>

          <div v-if="settings.voice_actions_enabled" class="mt-4 p-4 bg-green-50 border border-green-200 rounded-lg">
            <div class="flex items-start gap-3">
              <span class="text-green-600 text-xl">✓</span>
              <div>
                <p class="font-semibold text-green-900 mb-1">Voice Actions is Active</p>
                <p class="text-sm text-green-700">
                  Users can now use voice commands on your platform. The SDK will be visible and functional.
                </p>
              </div>
            </div>
          </div>

          <div v-else class="mt-4 p-4 bg-gray-50 border border-gray-200 rounded-lg">
            <div class="flex items-start gap-3">
              <span class="text-gray-600 text-xl">✗</span>
              <div>
                <p class="font-semibold text-gray-900 mb-1">Voice Actions is Disabled</p>
                <p class="text-sm text-gray-700">
                  The Voice Actions SDK is hidden and inactive. Users will not be able to use voice commands.
                </p>
              </div>
            </div>
          </div>

          <div v-if="saving" class="mt-4 text-sm text-gray-600">
            <span class="inline-flex items-center gap-2">
              <span class="animate-spin">⏳</span>
              Saving settings...
            </span>
          </div>

          <div v-if="saveSuccess" class="mt-4 p-3 bg-green-50 border border-green-200 rounded-lg">
            <p class="text-green-800 text-sm">✓ Settings saved successfully!</p>
          </div>
        </div>

        <!-- Integration Instructions -->
        <div class="bg-white rounded-xl shadow-lg p-6">
          <h3 class="text-lg font-bold text-gray-900 mb-4">Integration Instructions</h3>
          <div class="space-y-4">
            <div class="p-4 bg-gray-50 rounded-lg">
              <p class="text-sm text-gray-700 mb-2">
                <strong>When Voice Actions is ON:</strong> The SDK will be active and users can interact with voice commands.
              </p>
              <p class="text-sm text-gray-700">
                <strong>When Voice Actions is OFF:</strong> The SDK will be hidden and all voice command functionality will be disabled.
              </p>
            </div>

            <div class="p-4 bg-blue-50 rounded-lg">
              <p class="text-sm font-semibold text-blue-900 mb-2">How to check this setting in your code:</p>
              <pre class="text-xs bg-gray-900 text-green-400 p-3 rounded overflow-x-auto"><code>// Check if Voice Actions is enabled
const response = await fetch('https://api.voiceactions.dev/api/platforms/settings', {
  headers: {
    'X-API-Key': 'your-api-key'
  }
});

const data = await response.json();
if (data.settings.voice_actions_enabled) {
  // Initialize SDK
  const sdk = new VoiceActionsSDK({...});
} else {
  // Hide SDK UI
  document.getElementById('voice-actions-widget').style.display = 'none';
}</code></pre>
            </div>
          </div>
        </div>

        <!-- Quick Links -->
        <div class="bg-white rounded-xl shadow-lg p-6">
          <h3 class="text-lg font-bold text-gray-900 mb-4">Quick Links</h3>
          <div class="flex flex-wrap gap-3">
            <router-link
              to="/docs/integration"
              class="px-4 py-2 bg-gray-900 text-white rounded-lg hover:bg-gray-800 transition text-sm"
            >
              📚 Integration Guide
            </router-link>
            <router-link
              to="/demo"
              class="px-4 py-2 bg-gray-100 text-gray-900 rounded-lg hover:bg-gray-200 transition text-sm"
            >
              🎤 Try Demo
            </router-link>
            <router-link
              to="/platform/dashboard"
              class="px-4 py-2 bg-gray-100 text-gray-900 rounded-lg hover:bg-gray-200 transition text-sm"
            >
              📊 Dashboard
            </router-link>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import axios from 'axios'

const router = useRouter()

const loading = ref(true)
const saving = ref(false)
const error = ref(null)
const saveSuccess = ref(false)
const settings = ref({
  voice_actions_enabled: true
})

const loadSettings = async () => {
  loading.value = true
  error.value = null

  try {
    const response = await axios.get('/platforms/settings')
    if (response.data.success) {
      settings.value = response.data.settings
    }
  } catch (err) {
    if (err.response?.status === 401) {
      router.push('/platform/login')
    } else {
      error.value = err.response?.data?.error || 'Failed to load settings'
    }
  } finally {
    loading.value = false
  }
}

const handleToggle = async () => {
  saving.value = true
  saveSuccess.value = false
  error.value = null

  try {
    const response = await axios.put('/platforms/settings', {
      voice_actions_enabled: settings.value.voice_actions_enabled
    })

    if (response.data.success) {
      saveSuccess.value = true
      setTimeout(() => {
        saveSuccess.value = false
      }, 3000)
    }
  } catch (err) {
    error.value = err.response?.data?.error || 'Failed to save settings'
    // Revert toggle on error
    settings.value.voice_actions_enabled = !settings.value.voice_actions_enabled
  } finally {
    saving.value = false
  }
}

onMounted(() => {
  loadSettings()
})
</script>

