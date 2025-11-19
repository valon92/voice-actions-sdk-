<template>
  <div class="min-h-screen py-12 px-4 bg-gradient-to-br from-slate-50 via-blue-50 to-purple-50">
    <div class="max-w-7xl mx-auto">
      <!-- Header -->
      <div class="text-center mb-12">
        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 mb-4">Pricing Plans</h1>
        <p class="text-lg sm:text-xl text-gray-600 mb-2">Choose the plan that fits your platform's needs</p>
        <p class="text-sm sm:text-base text-gray-500 mb-4">All plans include <strong>550+ universal voice commands</strong> and <strong>English language</strong></p>
        <div class="inline-flex items-center gap-2 px-4 py-2 bg-green-100 text-green-800 rounded-full text-sm font-semibold">
          <span>✨</span>
          <span>Free plan available - No credit card required</span>
        </div>
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
              <span class="text-gray-700 text-sm sm:text-base"><strong>Up to 9,999 commands/month</strong></span>
            </li>
            <li class="flex items-start">
              <span class="text-green-500 mr-3 text-lg">✓</span>
              <span class="text-gray-700 text-sm sm:text-base"><strong>550+ universal voice commands</strong> (Social Media, E-Commerce, Gaming, Technology, Education, Communication, Development)</span>
            </li>
            <li class="flex items-start">
              <span class="text-green-500 mr-3 text-lg">✓</span>
              <span class="text-gray-700 text-sm sm:text-base"><strong>Language:</strong> English</span>
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
              <span class="text-gray-700 text-sm sm:text-base"><strong>10,000 - 999,999 commands/month</strong></span>
            </li>
            <li class="flex items-start">
              <span class="text-green-500 mr-3 text-lg">✓</span>
              <span class="text-gray-700 text-sm sm:text-base"><strong>550+ universal voice commands</strong> (All categories included)</span>
            </li>
            <li class="flex items-start">
              <span class="text-green-500 mr-3 text-lg">✓</span>
              <span class="text-gray-700 text-sm sm:text-base"><strong>Language:</strong> English</span>
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
              <span class="text-gray-700 text-sm sm:text-base"><strong>1,000,000+ commands/month</strong> (Custom limits available)</span>
            </li>
            <li class="flex items-start">
              <span class="text-green-500 mr-3 text-lg">✓</span>
              <span class="text-gray-700 text-sm sm:text-base"><strong>550+ universal commands</strong> + Custom command development</span>
            </li>
            <li class="flex items-start">
              <span class="text-green-500 mr-3 text-lg">✓</span>
              <span class="text-gray-700 text-sm sm:text-base"><strong>All languages</strong> + Custom language support</span>
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

      <!-- Features Comparison -->
      <div class="mt-16 max-w-6xl mx-auto">
        <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-8 text-center">What's Included in Each Plan</h2>
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
          <div class="overflow-x-auto">
            <table class="w-full">
              <thead class="bg-gray-50">
                <tr>
                  <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Feature</th>
                  <th class="px-6 py-4 text-center text-sm font-semibold text-gray-900">Free</th>
                  <th class="px-6 py-4 text-center text-sm font-semibold text-gray-900">Pro</th>
                  <th class="px-6 py-4 text-center text-sm font-semibold text-gray-900">Enterprise</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-gray-200">
                <tr>
                  <td class="px-6 py-4 text-sm text-gray-700 font-medium">Monthly Commands</td>
                  <td class="px-6 py-4 text-center text-sm text-gray-600">Up to 9,999</td>
                  <td class="px-6 py-4 text-center text-sm text-gray-600">10,000 - 999,999</td>
                  <td class="px-6 py-4 text-center text-sm text-gray-600">1M+ (Custom)</td>
                </tr>
                <tr class="bg-gray-50">
                  <td class="px-6 py-4 text-sm text-gray-700 font-medium">Voice Commands</td>
                  <td class="px-6 py-4 text-center text-sm text-gray-600">550+ Universal</td>
                  <td class="px-6 py-4 text-center text-sm text-gray-600">550+ Universal</td>
                  <td class="px-6 py-4 text-center text-sm text-gray-600">550+ + Custom</td>
                </tr>
                <tr>
                  <td class="px-6 py-4 text-sm text-gray-700 font-medium">Languages</td>
                  <td class="px-6 py-4 text-center text-sm text-gray-600">English</td>
                  <td class="px-6 py-4 text-center text-sm text-gray-600">English</td>
                  <td class="px-6 py-4 text-center text-sm text-gray-600">4+ Custom</td>
                </tr>
                <tr class="bg-gray-50">
                  <td class="px-6 py-4 text-sm text-gray-700 font-medium">API Rate Limits</td>
                  <td class="px-6 py-4 text-center text-sm text-gray-600">1,000/min</td>
                  <td class="px-6 py-4 text-center text-sm text-gray-600">10,000/min</td>
                  <td class="px-6 py-4 text-center text-sm text-gray-600">Custom</td>
                </tr>
                <tr>
                  <td class="px-6 py-4 text-sm text-gray-700 font-medium">Support</td>
                  <td class="px-6 py-4 text-center text-sm text-gray-600">Community</td>
                  <td class="px-6 py-4 text-center text-sm text-gray-600">Priority Email</td>
                  <td class="px-6 py-4 text-center text-sm text-gray-600">24/7 Phone & Chat</td>
                </tr>
                <tr class="bg-gray-50">
                  <td class="px-6 py-4 text-sm text-gray-700 font-medium">Analytics Dashboard</td>
                  <td class="px-6 py-4 text-center text-sm text-gray-600">Basic</td>
                  <td class="px-6 py-4 text-center text-sm text-gray-600">Advanced</td>
                  <td class="px-6 py-4 text-center text-sm text-gray-600">Custom Reports</td>
                </tr>
                <tr>
                  <td class="px-6 py-4 text-sm text-gray-700 font-medium">SLA</td>
                  <td class="px-6 py-4 text-center text-sm text-gray-600">-</td>
                  <td class="px-6 py-4 text-center text-sm text-gray-600">99%</td>
                  <td class="px-6 py-4 text-center text-sm text-gray-600">99.9%</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- FAQ Section -->
      <div class="mt-16 max-w-4xl mx-auto">
        <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-8 text-center">Frequently Asked Questions</h2>
        <div class="space-y-6">
          <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow">
            <h3 class="text-lg font-semibold text-gray-900 mb-2">How does billing work?</h3>
            <p class="text-gray-600 text-sm sm:text-base">Billing is based on the number of voice commands executed per month. Your plan is automatically determined based on your expected monthly usage during registration. You can upgrade or downgrade your plan at any time.</p>
          </div>
          <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow">
            <h3 class="text-lg font-semibold text-gray-900 mb-2">What are the 550+ universal commands?</h3>
            <p class="text-gray-600 text-sm sm:text-base">Our SDK includes 550+ voice commands covering all major platform categories: Social Media (Facebook, Instagram, TikTok, X), E-Commerce (Amazon, eBay, Shopify), Gaming (Steam, Epic, Xbox), Technology (Windows, macOS, AWS, GitHub), Education (Coursera, Udemy), Communication (Slack, Discord, Teams), and Development (GitHub, GitLab, Vercel). All commands work universally across any platform.</p>
          </div>
          <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow">
            <h3 class="text-lg font-semibold text-gray-900 mb-2">Can I change plans later?</h3>
            <p class="text-gray-600 text-sm sm:text-base">Yes! You can upgrade or downgrade your plan at any time. Changes take effect immediately, and billing is prorated. If you exceed your plan limits, we'll notify you and help you upgrade seamlessly.</p>
          </div>
          <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow">
            <h3 class="text-lg font-semibold text-gray-900 mb-2">What happens if I exceed my plan limits?</h3>
            <p class="text-gray-600 text-sm sm:text-base">We'll notify you when you're approaching your limits (at 80% and 95% usage). You can upgrade your plan immediately, or for Enterprise customers, we can discuss custom pricing for higher usage. Your service will continue uninterrupted.</p>
          </div>
          <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow">
            <h3 class="text-lg font-semibold text-gray-900 mb-2">Which languages are supported?</h3>
            <p class="text-gray-600 text-sm sm:text-base">Currently, we support English (en-US). All 550+ commands are available in English. More languages will be added gradually. Enterprise customers can request custom language support.</p>
          </div>
          <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow">
            <h3 class="text-lg font-semibold text-gray-900 mb-2">Do you offer refunds?</h3>
            <p class="text-gray-600 text-sm sm:text-base">Yes, we offer a 30-day money-back guarantee for Pro plans. Enterprise plans have custom terms. Contact us if you're not satisfied with our service.</p>
          </div>
          <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow">
            <h3 class="text-lg font-semibold text-gray-900 mb-2">How do I integrate the SDK?</h3>
            <p class="text-gray-600 text-sm sm:text-base">Integration is simple! After registration, you'll receive an API key. Install our SDK via NPM or CDN, initialize it with your API key, and start handling voice commands. Check out our <router-link to="/integration-guide" class="text-gray-900 font-semibold hover:underline">Integration Guide</router-link> for detailed instructions and examples.</p>
          </div>
        </div>
      </div>

      <!-- CTA Section -->
      <div class="mt-16 text-center">
        <div class="bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 rounded-2xl p-8 sm:p-12 text-white shadow-2xl">
          <h2 class="text-2xl sm:text-3xl lg:text-4xl font-bold mb-4">Ready to get started?</h2>
          <p class="text-gray-300 mb-2 text-sm sm:text-base">Join thousands of platforms using Voice Actions SDK</p>
          <p class="text-gray-400 mb-8 text-xs sm:text-sm">550+ commands • English • Easy integration</p>
          <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
            <router-link
              to="/register-platform"
              class="px-8 py-3 bg-white text-gray-900 rounded-lg font-semibold hover:bg-gray-100 transition text-sm sm:text-base shadow-lg hover:shadow-xl transform hover:scale-105"
            >
              🚀 Register Your Platform →
            </router-link>
            <router-link
              to="/demo"
              class="px-8 py-3 bg-transparent border-2 border-white text-white rounded-lg font-semibold hover:bg-white hover:text-gray-900 transition text-sm sm:text-base"
            >
              🎤 Try Demo First
            </router-link>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
</script>
