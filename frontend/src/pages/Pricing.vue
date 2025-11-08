<template>
  <div class="min-h-screen py-12 px-4 bg-gradient-to-br from-slate-50 via-blue-50 to-purple-50">
    <div class="max-w-7xl mx-auto">
      <!-- Header -->
      <div class="text-center mb-12">
        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 mb-4">Pricing Plans</h1>
        <p class="text-lg sm:text-xl text-gray-600 mb-2">Choose the plan that fits your platform's needs</p>
        <p class="text-sm sm:text-base text-gray-500">All plans include multi-language support and SDK access</p>
      </div>

      <!-- Pricing Cards -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8 mb-12">
        <!-- Free Plan -->
        <div class="bg-white rounded-2xl shadow-lg p-6 sm:p-8 border-2 border-gray-200 hover:shadow-xl transition-shadow">
          <div class="mb-6">
            <h3 class="text-2xl font-bold text-gray-900 mb-2">Free</h3>
            <div class="mb-4">
              <span class="text-4xl sm:text-5xl font-bold text-gray-900">$0</span>
              <span class="text-gray-600 text-lg">/month</span>
            </div>
            <p class="text-sm text-gray-500">Perfect for small projects and testing</p>
          </div>
          <ul class="space-y-3 sm:space-y-4 mb-8">
            <li class="flex items-start">
              <span class="text-green-500 mr-3 text-lg">✓</span>
              <span class="text-gray-700 text-sm sm:text-base">Up to 10,000 commands/month</span>
            </li>
            <li class="flex items-start">
              <span class="text-green-500 mr-3 text-lg">✓</span>
              <span class="text-gray-700 text-sm sm:text-base">Basic voice commands</span>
            </li>
            <li class="flex items-start">
              <span class="text-green-500 mr-3 text-lg">✓</span>
              <span class="text-gray-700 text-sm sm:text-base">Multi-language support (4+ languages)</span>
            </li>
            <li class="flex items-start">
              <span class="text-green-500 mr-3 text-lg">✓</span>
              <span class="text-gray-700 text-sm sm:text-base">Community support</span>
            </li>
            <li class="flex items-start">
              <span class="text-green-500 mr-3 text-lg">✓</span>
              <span class="text-gray-700 text-sm sm:text-base">Standard API rate limits (1,000/min)</span>
            </li>
            <li class="flex items-start">
              <span class="text-green-500 mr-3 text-lg">✓</span>
              <span class="text-gray-700 text-sm sm:text-base">SDK access & documentation</span>
            </li>
          </ul>
          <router-link
            to="/register-platform"
            class="block w-full px-6 py-3 bg-gray-900 text-white rounded-lg font-semibold hover:bg-gray-800 transition text-center text-sm sm:text-base"
          >
            Get Started Free
          </router-link>
        </div>

        <!-- Pro Plan -->
        <div class="bg-white rounded-2xl shadow-xl p-6 sm:p-8 border-2 border-gray-900 transform scale-105 relative">
          <div class="absolute -top-4 left-1/2 transform -translate-x-1/2">
            <div class="bg-gray-900 text-white px-4 py-1 rounded-full text-xs sm:text-sm font-semibold">
              Most Popular
            </div>
          </div>
          <div class="mb-6">
            <h3 class="text-2xl font-bold text-gray-900 mb-2">Pro</h3>
            <div class="mb-4">
              <span class="text-4xl sm:text-5xl font-bold text-gray-900">$99</span>
              <span class="text-gray-600 text-lg">/month</span>
            </div>
            <p class="text-sm text-gray-500">Ideal for growing platforms</p>
          </div>
          <ul class="space-y-3 sm:space-y-4 mb-8">
            <li class="flex items-start">
              <span class="text-green-500 mr-3 text-lg">✓</span>
              <span class="text-gray-700 text-sm sm:text-base">Up to 100,000 commands/month</span>
            </li>
            <li class="flex items-start">
              <span class="text-green-500 mr-3 text-lg">✓</span>
              <span class="text-gray-700 text-sm sm:text-base">Advanced voice commands</span>
            </li>
            <li class="flex items-start">
              <span class="text-green-500 mr-3 text-lg">✓</span>
              <span class="text-gray-700 text-sm sm:text-base">All languages supported</span>
            </li>
            <li class="flex items-start">
              <span class="text-green-500 mr-3 text-lg">✓</span>
              <span class="text-gray-700 text-sm sm:text-base">Priority email support</span>
            </li>
            <li class="flex items-start">
              <span class="text-green-500 mr-3 text-lg">✓</span>
              <span class="text-gray-700 text-sm sm:text-base">Higher API rate limits (10,000/min)</span>
            </li>
            <li class="flex items-start">
              <span class="text-green-500 mr-3 text-lg">✓</span>
              <span class="text-gray-700 text-sm sm:text-base">Custom command sets</span>
            </li>
            <li class="flex items-start">
              <span class="text-green-500 mr-3 text-lg">✓</span>
              <span class="text-gray-700 text-sm sm:text-base">Usage analytics dashboard</span>
            </li>
          </ul>
          <router-link
            to="/register-platform"
            class="block w-full px-6 py-3 bg-gray-900 text-white rounded-lg font-semibold hover:bg-gray-800 transition text-center text-sm sm:text-base"
          >
            Start Pro Trial
          </router-link>
        </div>

        <!-- Enterprise Plan -->
        <div class="bg-white rounded-2xl shadow-lg p-6 sm:p-8 border-2 border-gray-200 hover:shadow-xl transition-shadow">
          <div class="mb-6">
            <h3 class="text-2xl font-bold text-gray-900 mb-2">Enterprise</h3>
            <div class="mb-4">
              <span class="text-4xl sm:text-5xl font-bold text-gray-900">Custom</span>
            </div>
            <p class="text-sm text-gray-500">For large-scale platforms</p>
          </div>
          <ul class="space-y-3 sm:space-y-4 mb-8">
            <li class="flex items-start">
              <span class="text-green-500 mr-3 text-lg">✓</span>
              <span class="text-gray-700 text-sm sm:text-base">Unlimited commands</span>
            </li>
            <li class="flex items-start">
              <span class="text-green-500 mr-3 text-lg">✓</span>
              <span class="text-gray-700 text-sm sm:text-base">Custom voice recognition models</span>
            </li>
            <li class="flex items-start">
              <span class="text-green-500 mr-3 text-lg">✓</span>
              <span class="text-gray-700 text-sm sm:text-base">Dedicated account manager</span>
            </li>
            <li class="flex items-start">
              <span class="text-green-500 mr-3 text-lg">✓</span>
              <span class="text-gray-700 text-sm sm:text-base">99.9% SLA guarantee</span>
            </li>
            <li class="flex items-start">
              <span class="text-green-500 mr-3 text-lg">✓</span>
              <span class="text-gray-700 text-sm sm:text-base">Custom integrations & APIs</span>
            </li>
            <li class="flex items-start">
              <span class="text-green-500 mr-3 text-lg">✓</span>
              <span class="text-gray-700 text-sm sm:text-base">On-premise deployment option</span>
            </li>
            <li class="flex items-start">
              <span class="text-green-500 mr-3 text-lg">✓</span>
              <span class="text-gray-700 text-sm sm:text-base">24/7 phone & chat support</span>
            </li>
          </ul>
          <a
            href="mailto:sales@voiceactions.io"
            class="block w-full px-6 py-3 bg-gray-900 text-white rounded-lg font-semibold hover:bg-gray-800 transition text-center text-sm sm:text-base"
          >
            Contact Sales
          </a>
        </div>
      </div>

      <!-- FAQ Section -->
      <div class="mt-16 max-w-4xl mx-auto">
        <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-8 text-center">Frequently Asked Questions</h2>
        <div class="space-y-6">
          <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-2">How does billing work?</h3>
            <p class="text-gray-600 text-sm sm:text-base">Billing is based on the number of voice commands executed per month. You can upgrade or downgrade your plan at any time.</p>
          </div>
          <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-2">Can I change plans later?</h3>
            <p class="text-gray-600 text-sm sm:text-base">Yes! You can upgrade or downgrade your plan at any time. Changes take effect immediately, and billing is prorated.</p>
          </div>
          <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-2">What happens if I exceed my plan limits?</h3>
            <p class="text-gray-600 text-sm sm:text-base">We'll notify you when you're approaching your limits. You can upgrade your plan or we can discuss custom pricing for higher usage.</p>
          </div>
          <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-2">Do you offer refunds?</h3>
            <p class="text-gray-600 text-sm sm:text-base">Yes, we offer a 30-day money-back guarantee for Pro plans. Enterprise plans have custom terms.</p>
          </div>
        </div>
      </div>

      <!-- CTA Section -->
      <div class="mt-16 text-center">
        <div class="bg-gray-900 rounded-2xl p-8 sm:p-12 text-white">
          <h2 class="text-2xl sm:text-3xl font-bold mb-4">Ready to get started?</h2>
          <p class="text-gray-300 mb-6 text-sm sm:text-base">Join thousands of platforms using Voice Actions SDK</p>
          <router-link
            to="/register-platform"
            class="inline-block px-8 py-3 bg-white text-gray-900 rounded-lg font-semibold hover:bg-gray-100 transition text-sm sm:text-base"
          >
            Register Your Platform →
          </router-link>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
</script>
