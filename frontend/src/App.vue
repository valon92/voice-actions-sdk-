<template>
  <div id="app" class="min-h-screen flex flex-col bg-gradient-to-br from-slate-50 via-blue-50 to-purple-50">
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
            <router-link to="/" class="px-3 lg:px-4 py-1.5 lg:py-2 rounded-lg text-sm lg:text-base font-medium transition-all duration-200 text-gray-600 hover:text-gray-900 hover:bg-gray-100">
              🏠 Home
            </router-link>
            <router-link to="/pricing" class="px-3 lg:px-4 py-1.5 lg:py-2 rounded-lg text-sm lg:text-base font-medium transition-all duration-200 text-gray-600 hover:text-gray-900 hover:bg-gray-100">
              💰 Pricing
            </router-link>
            <router-link to="/demo" class="px-3 lg:px-4 py-1.5 lg:py-2 rounded-lg text-sm lg:text-base font-medium transition-all duration-200 text-gray-600 hover:text-gray-900 hover:bg-gray-100">
              🎤 Demo
            </router-link>
            <template v-if="isAuthenticated">
              <router-link to="/platform/dashboard" class="px-3 lg:px-4 py-1.5 lg:py-2 rounded-lg text-sm lg:text-base font-medium transition-all duration-200 text-gray-600 hover:text-gray-900 hover:bg-gray-100">
                📊 Dashboard
              </router-link>
              <button @click="handleLogout" class="px-3 lg:px-4 py-1.5 lg:py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg text-sm lg:text-base font-medium transition-all shadow-md">
                🚪 Logout
              </button>
            </template>
            <template v-else>
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
            to="/demo"
            @click="mobileMenuOpen = false"
            class="block px-4 py-2 rounded-lg text-base font-medium transition-all duration-200 text-gray-600 hover:text-gray-900 hover:bg-gray-100"
          >
            🎤 Demo
          </router-link>
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

    <!-- Footer -->
    <footer class="bg-gray-900 text-white mt-auto">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 sm:gap-8">
          <!-- Brand -->
          <div class="col-span-1 md:col-span-2">
            <div class="flex items-center gap-2 sm:gap-3 mb-3 sm:mb-4">
              <div class="w-8 h-8 sm:w-10 sm:h-10 bg-white rounded-lg flex items-center justify-center">
                <span class="text-gray-900 text-base sm:text-xl">🎤</span>
              </div>
              <h3 class="text-lg sm:text-xl font-bold">Voice Actions SDK</h3>
            </div>
            <p class="text-sm sm:text-base text-gray-400 mb-4">
              Global Voice Control SDK for Web Applications. Enable voice commands in multiple languages for your platform.
            </p>
            <div class="flex gap-3 sm:gap-4">
              <a href="https://github.com" target="_blank" rel="noopener noreferrer" class="text-gray-400 hover:text-white transition">
                <span class="sr-only">GitHub</span>
                <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M12 2C6.477 2 2 6.477 2 12c0 4.42 2.865 8.17 6.839 9.49.5.092.682-.217.682-.482 0-.237-.008-.866-.013-1.7-2.782.603-3.369-1.34-3.369-1.34-.454-1.156-1.11-1.463-1.11-1.463-.908-.62.069-.608.069-.608 1.003.07 1.531 1.03 1.531 1.03.892 1.529 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.11-4.555-4.943 0-1.091.39-1.984 1.029-2.683-.103-.253-.446-1.27.098-2.647 0 0 .84-.269 2.75 1.025A9.578 9.578 0 0112 6.836c.85.004 1.705.114 2.504.336 1.909-1.294 2.747-1.025 2.747-1.025.546 1.377.203 2.394.1 2.647.64.699 1.028 1.592 1.028 2.683 0 3.842-2.339 4.687-4.566 4.935.359.309.678.919.678 1.852 0 1.336-.012 2.415-.012 2.743 0 .267.18.578.688.48C19.138 20.167 22 16.418 22 12c0-5.523-4.477-10-10-10z"/>
                </svg>
              </a>
              <a href="https://twitter.com" target="_blank" rel="noopener noreferrer" class="text-gray-400 hover:text-white transition">
                <span class="sr-only">Twitter</span>
                <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"/>
                </svg>
              </a>
              <a href="https://linkedin.com" target="_blank" rel="noopener noreferrer" class="text-gray-400 hover:text-white transition">
                <span class="sr-only">LinkedIn</span>
                <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                </svg>
              </a>
            </div>
          </div>

          <!-- Quick Links -->
          <div>
            <h4 class="text-sm sm:text-base font-semibold mb-3 sm:mb-4">Quick Links</h4>
            <ul class="space-y-2 sm:space-y-3">
              <li>
                <router-link to="/" class="text-sm sm:text-base text-gray-400 hover:text-white transition">
                  Home
                </router-link>
              </li>
              <li>
                <router-link to="/pricing" class="text-sm sm:text-base text-gray-400 hover:text-white transition">
                  Pricing
                </router-link>
              </li>
              <li>
                <router-link to="/docs/integration" class="text-sm sm:text-base text-gray-400 hover:text-white transition">
                  Documentation
                </router-link>
              </li>
              <li>
                <router-link to="/register-platform" class="text-sm sm:text-base text-gray-400 hover:text-white transition">
                  Get Started
                </router-link>
              </li>
            </ul>
          </div>

          <!-- Support -->
          <div>
            <h4 class="text-sm sm:text-base font-semibold mb-3 sm:mb-4">Support</h4>
            <ul class="space-y-2 sm:space-y-3">
              <li>
                <router-link to="/contact" class="text-sm sm:text-base text-gray-400 hover:text-white transition">
                  Contact Support
                </router-link>
              </li>
              <li>
                <router-link to="/sales" class="text-sm sm:text-base text-gray-400 hover:text-white transition">
                  Sales Inquiry
                </router-link>
              </li>
              <li>
                <router-link to="/privacy" class="text-sm sm:text-base text-gray-400 hover:text-white transition">
                  Privacy Policy
                </router-link>
              </li>
              <li>
                <router-link to="/terms" class="text-sm sm:text-base text-gray-400 hover:text-white transition">
                  Terms of Service
                </router-link>
              </li>
            </ul>
          </div>
        </div>

        <div class="mt-8 sm:mt-12 pt-6 sm:pt-8 border-t border-gray-800">
          <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
            <p class="text-xs sm:text-sm text-gray-400 text-center sm:text-left">
              © {{ new Date().getFullYear() }} Voice Actions SDK. All rights reserved.
            </p>
            <div class="flex gap-4 sm:gap-6 text-xs sm:text-sm text-gray-400">
              <router-link to="/privacy" class="hover:text-white transition">Privacy</router-link>
              <router-link to="/terms" class="hover:text-white transition">Terms</router-link>
              <a href="#" class="hover:text-white transition">Cookies</a>
            </div>
          </div>
        </div>
      </div>
    </footer>
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

