<template>
  <div class="min-h-screen py-12 px-4 bg-gradient-to-br from-slate-50 via-blue-50 to-purple-50">
    <div class="max-w-7xl mx-auto">
      <div class="text-center mb-12">
        <h1 class="text-4xl sm:text-5xl font-bold text-gray-900 mb-4">Pricing Plans</h1>
        <p class="text-xl text-gray-600">Choose the plan that fits your platform's needs</p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Free Plan -->
        <div class="bg-white rounded-2xl shadow-lg p-8 border-2 border-gray-200">
          <h3 class="text-2xl font-bold text-gray-900 mb-2">Free</h3>
          <div class="mb-6">
            <span class="text-4xl font-bold text-gray-900">$0</span>
            <span class="text-gray-600">/month</span>
          </div>
          <ul class="space-y-4 mb-8">
            <li class="flex items-start">
              <span class="text-green-500 mr-2">✓</span>
              <span class="text-gray-700">Up to 10,000 commands/month</span>
            </li>
            <li class="flex items-start">
              <span class="text-green-500 mr-2">✓</span>
              <span class="text-gray-700">Basic voice commands</span>
            </li>
            <li class="flex items-start">
              <span class="text-green-500 mr-2">✓</span>
              <span class="text-gray-700">Community support</span>
            </li>
            <li class="flex items-start">
              <span class="text-green-500 mr-2">✓</span>
              <span class="text-gray-700">Standard API rate limits</span>
            </li>
          </ul>
          <router-link
            to="/register-platform"
            class="block w-full px-6 py-3 bg-gray-900 text-white rounded-lg font-semibold hover:bg-gray-800 transition text-center"
          >
            Get Started
          </router-link>
        </div>

        <!-- Pro Plan -->
        <div class="bg-white rounded-2xl shadow-xl p-8 border-2 border-gray-900 transform scale-105">
          <div class="bg-gray-900 text-white px-3 py-1 rounded-full text-sm font-semibold inline-block mb-4">
            Popular
          </div>
          <h3 class="text-2xl font-bold text-gray-900 mb-2">Pro</h3>
          <div class="mb-6">
            <span class="text-4xl font-bold text-gray-900">$99</span>
            <span class="text-gray-600">/month</span>
          </div>
          <ul class="space-y-4 mb-8">
            <li class="flex items-start">
              <span class="text-green-500 mr-2">✓</span>
              <span class="text-gray-700">Up to 100,000 commands/month</span>
            </li>
            <li class="flex items-start">
              <span class="text-green-500 mr-2">✓</span>
              <span class="text-gray-700">Advanced voice commands</span>
            </li>
            <li class="flex items-start">
              <span class="text-green-500 mr-2">✓</span>
              <span class="text-gray-700">Priority support</span>
            </li>
            <li class="flex items-start">
              <span class="text-green-500 mr-2">✓</span>
              <span class="text-gray-700">Higher API rate limits</span>
            </li>
            <li class="flex items-start">
              <span class="text-green-500 mr-2">✓</span>
              <span class="text-gray-700">Custom command sets</span>
            </li>
          </ul>
          <router-link
            to="/register-platform"
            class="block w-full px-6 py-3 bg-gray-900 text-white rounded-lg font-semibold hover:bg-gray-800 transition text-center"
          >
            Get Started
          </router-link>
        </div>

        <!-- Enterprise Plan -->
        <div class="bg-white rounded-2xl shadow-lg p-8 border-2 border-gray-200">
          <h3 class="text-2xl font-bold text-gray-900 mb-2">Enterprise</h3>
          <div class="mb-6">
            <span class="text-4xl font-bold text-gray-900">Custom</span>
          </div>
          <ul class="space-y-4 mb-8">
            <li class="flex items-start">
              <span class="text-green-500 mr-2">✓</span>
              <span class="text-gray-700">Unlimited commands</span>
            </li>
            <li class="flex items-start">
              <span class="text-green-500 mr-2">✓</span>
              <span class="text-gray-700">Custom voice recognition</span>
            </li>
            <li class="flex items-start">
              <span class="text-green-500 mr-2">✓</span>
              <span class="text-gray-700">Dedicated support</span>
            </li>
            <li class="flex items-start">
              <span class="text-green-500 mr-2">✓</span>
              <span class="text-gray-700">SLA guarantee</span>
            </li>
            <li class="flex items-start">
              <span class="text-green-500 mr-2">✓</span>
              <span class="text-gray-700">Custom integrations</span>
            </li>
          </ul>
          <a
            href="mailto:sales@voiceactions.io"
            class="block w-full px-6 py-3 bg-gray-900 text-white rounded-lg font-semibold hover:bg-gray-800 transition text-center"
          >
            Contact Sales
          </a>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
</script>
