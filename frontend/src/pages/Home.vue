<template>
  <div class="min-h-screen">
    <!-- Hero Section -->
    <div class="bg-gray-900 text-white py-20 sm:py-32">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold mb-6">
          Voice Actions SDK
        </h1>
        <p class="text-xl sm:text-2xl text-gray-300 mb-8 max-w-3xl mx-auto">
          Global Voice Control SDK for Web Applications
        </p>
        <p class="text-lg text-gray-400 mb-12 max-w-2xl mx-auto">
          Enable voice commands in multiple languages for your platform. Easy integration, powerful features.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
          <router-link
            to="/register-platform"
            class="inline-block px-8 py-4 bg-white text-gray-900 rounded-lg font-semibold hover:bg-gray-100 transition text-lg"
          >
            Get Started
          </router-link>
          <router-link
            to="/platform/login"
            class="inline-block px-8 py-4 bg-gray-800 text-white rounded-lg font-semibold hover:bg-gray-700 transition text-lg"
          >
            Login
          </router-link>
          <router-link
            to="/docs/integration"
            class="inline-block px-8 py-4 bg-gray-800 text-white rounded-lg font-semibold hover:bg-gray-700 transition text-lg"
          >
            View Docs
          </router-link>
          <router-link
            to="/demo"
            class="inline-block px-8 py-4 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition text-lg"
          >
            🎤 Try Demo
          </router-link>
        </div>
      </div>
    </div>

    <!-- Features Section -->
    <div class="py-20 bg-white">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl sm:text-4xl font-bold text-center text-gray-900 mb-12">
          Why Voice Actions SDK?
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
          <div class="text-center p-6">
            <div class="text-4xl mb-4">🌍</div>
            <h3 class="text-xl font-bold text-gray-900 mb-2">Multi-language</h3>
            <p class="text-gray-600">Support for 50+ languages and locales</p>
          </div>
          <div class="text-center p-6">
            <div class="text-4xl mb-4">⚡</div>
            <h3 class="text-xl font-bold text-gray-900 mb-2">Easy Integration</h3>
            <p class="text-gray-600">Get started in minutes with simple API</p>
          </div>
          <div class="text-center p-6">
            <div class="text-4xl mb-4">🔒</div>
            <h3 class="text-xl font-bold text-gray-900 mb-2">Secure & Scalable</h3>
            <p class="text-gray-600">API key authentication and usage tracking</p>
          </div>
        </div>
      </div>
    </div>

    <!-- CTA Section -->
    <div class="py-20 bg-gray-50">
      <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">
          Ready to Get Started?
        </h2>
        <p class="text-xl text-gray-600 mb-8">
          Register your platform and start integrating voice commands today.
        </p>
        <router-link
          to="/register-platform"
          class="inline-block px-8 py-4 bg-gray-900 text-white rounded-lg font-semibold hover:bg-gray-800 transition text-lg"
        >
          Register Your Platform
        </router-link>
      </div>
    </div>
  </div>
</template>

<script setup>
</script>
