<template>
  <div id="app" class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-purple-50">
    <nav class="bg-white/80 backdrop-blur-md shadow-lg border-b border-gray-200/50 sticky top-0 z-50">
      <div class="max-w-7xl mx-auto px-3 sm:px-4 lg:px-6 xl:px-8">
        <div class="flex justify-between items-center h-14 sm:h-16">
          <div class="flex items-center gap-2 sm:gap-3">
            <router-link to="/" class="flex items-center gap-2 sm:gap-3">
              <div class="w-8 h-8 sm:w-10 sm:h-10 bg-gray-900 rounded-lg flex items-center justify-center">
                <span class="text-white text-base sm:text-xl">🎤</span>
              </div>
              <h1 class="text-sm sm:text-base lg:text-lg xl:text-xl font-bold text-gray-900 hidden sm:block">
                Voice Actions SDK
              </h1>
              <h1 class="text-sm font-bold text-gray-900 sm:hidden">Voice SDK</h1>
            </router-link>
          </div>
          
          <!-- Desktop Menu -->
          <div class="hidden md:flex items-center gap-2 lg:gap-3">
            <template v-if="isAuthenticated">
              <router-link to="/platform/dashboard" class="px-3 lg:px-4 py-1.5 lg:py-2 rounded-lg text-sm lg:text-base font-medium transition-all duration-200 text-gray-600 hover:text-gray-900 hover:bg-gray-100">
                📊 Dashboard
              </router-link>
              <button @click="handleLogout" class="px-3 lg:px-4 py-1.5 lg:py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg text-sm lg:text-base font-medium transition-all shadow-md">
                🚪 Logout
              </button>
            </template>
            <template v-else>
              <router-link to="/" class="px-3 lg:px-4 py-1.5 lg:py-2 rounded-lg text-sm lg:text-base font-medium transition-all duration-200 text-gray-600 hover:text-gray-900 hover:bg-gray-100">
                🏠 Home
              </router-link>
              <router-link to="/pricing" class="px-3 lg:px-4 py-1.5 lg:py-2 rounded-lg text-sm lg:text-base font-medium transition-all duration-200 text-gray-600 hover:text-gray-900 hover:bg-gray-100">
                💰 Pricing
              </router-link>
              <router-link to="/platform/login" class="px-3 lg:px-4 py-1.5 lg:py-2 rounded-lg text-sm lg:text-base font-medium transition-all duration-200 text-gray-600 hover:text-gray-900 hover:bg-gray-100">
                🔑 Login
              </router-link>
              <router-link to="/register-platform" class="px-3 lg:px-4 py-1.5 lg:py-2 bg-gray-900 text-white rounded-lg text-sm lg:text-base font-medium hover:bg-gray-800 transition-all shadow-md">
                Get Started
              </router-link>
            </template>
          </div>

          <!-- Mobile Menu Button -->
          <button
            @click="mobileMenuOpen = !mobileMenuOpen"
            class="md:hidden p-2 rounded-lg text-gray-600 hover:text-gray-900 hover:bg-gray-100 transition-all z-10"
            aria-label="Toggle menu"
            type="button"
          >
            <svg v-if="!mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            <svg v-else class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>

        <!-- Mobile Menu -->
        <div
          v-show="mobileMenuOpen"
          class="md:hidden border-t border-gray-200 py-3 space-y-2"
        >
            <template v-if="isAuthenticated">
              <router-link
                to="/platform/dashboard"
                @click="mobileMenuOpen = false"
                class="block px-4 py-2 rounded-lg text-base font-medium transition-all duration-200 text-gray-600 hover:text-gray-900 hover:bg-gray-100"
              >
                📊 Dashboard
              </router-link>
              <button
                @click="handleLogout(); mobileMenuOpen = false"
                class="block w-full px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg text-base font-medium transition-all shadow-md text-left"
              >
                🚪 Logout
              </button>
            </template>
          <template v-else>
            <router-link
              to="/"
              @click="mobileMenuOpen = false"
              class="block px-4 py-2 rounded-lg text-base font-medium transition-all duration-200 text-gray-600 hover:text-gray-900 hover:bg-gray-100"
            >
              🏠 Home
            </router-link>
            <router-link
              to="/pricing"
              @click="mobileMenuOpen = false"
              class="block px-4 py-2 rounded-lg text-base font-medium transition-all duration-200 text-gray-600 hover:text-gray-900 hover:bg-gray-100"
            >
              💰 Pricing
            </router-link>
            <router-link
              to="/platform/login"
              @click="mobileMenuOpen = false"
              class="block px-4 py-2 rounded-lg text-base font-medium transition-all duration-200 text-gray-600 hover:text-gray-900 hover:bg-gray-100"
            >
              🔑 Login
            </router-link>
            <router-link
              to="/register-platform"
              @click="mobileMenuOpen = false"
              class="block px-4 py-2 bg-gray-900 text-white rounded-lg text-base font-medium hover:bg-gray-800 transition-all shadow-md text-center"
            >
              Get Started
            </router-link>
          </template>
        </div>
      </div>
    </nav>
    <main class="min-h-[calc(100vh-4rem)]">
      <router-view v-slot="{ Component }">
        <Transition name="fade" mode="out-in">
          <component :is="Component" />
        </Transition>
      </router-view>
    </main>
  </div>
</template>

<script setup>
import { ref, onMounted, watch } from 'vue'
import { useRoute } from 'vue-router'

const route = useRoute()
const isAuthenticated = ref(false)
const mobileMenuOpen = ref(false)

const handleLogout = () => {
  localStorage.removeItem('platform_api_key')
  localStorage.removeItem('platform_data')
  localStorage.removeItem('auth_token')
  localStorage.removeItem('user')
  isAuthenticated.value = false
  window.location.href = '/'
}

onMounted(() => {
  checkAuth()
  setInterval(checkAuth, 1000)
})

// Close mobile menu when route changes
watch(() => route.path, () => {
  mobileMenuOpen.value = false
})

const checkAuth = () => {
  isAuthenticated.value = !!localStorage.getItem('platform_api_key') || !!localStorage.getItem('auth_token')
}
</script>

<style>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.3s ease;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}

.slide-down-enter-active {
  transition: all 0.3s ease-out;
}

.slide-down-leave-active {
  transition: all 0.2s ease-in;
}

.slide-down-enter-from {
  opacity: 0;
  transform: translateY(-10px);
}

.slide-down-enter-to {
  opacity: 1;
  transform: translateY(0);
}

.slide-down-leave-from {
  opacity: 1;
  transform: translateY(0);
}

.slide-down-leave-to {
  opacity: 0;
  transform: translateY(-10px);
}
</style>

