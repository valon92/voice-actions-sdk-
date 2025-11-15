<template>
  <div class="min-h-screen py-12 px-4 bg-gradient-to-br from-slate-50 via-blue-50 to-purple-50">
    <div class="max-w-4xl mx-auto">
      <div class="bg-white rounded-2xl shadow-xl p-6 sm:p-8 lg:p-10">
        <div class="text-center mb-8">
          <div class="inline-flex items-center justify-center w-16 h-16 mb-4 rounded-2xl bg-gradient-to-br from-purple-500 to-pink-500 shadow-lg">
            <span class="text-3xl">💼</span>
          </div>
          <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-3">Sales Inquiry</h1>
          <p class="text-lg text-gray-600">Interested in Enterprise plans or custom solutions? Let's talk!</p>
          <p class="text-sm text-gray-500 mt-2">Visit us at <a href="https://voiceactions.dev" target="_blank" rel="noopener noreferrer" class="text-purple-600 hover:underline font-semibold">voiceactions.dev</a></p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
          <div class="bg-gradient-to-br from-blue-50 to-cyan-50 rounded-xl p-6 border border-blue-100 text-center">
            <div class="text-3xl mb-3">🚀</div>
            <h3 class="font-bold text-gray-900 mb-2">Enterprise Plans</h3>
            <p class="text-sm text-gray-600">Custom pricing, dedicated support, and SLA guarantees</p>
          </div>

          <div class="bg-gradient-to-br from-purple-50 to-pink-50 rounded-xl p-6 border border-purple-100 text-center">
            <div class="text-3xl mb-3">🔧</div>
            <h3 class="font-bold text-gray-900 mb-2">Custom Solutions</h3>
            <p class="text-sm text-gray-600">Tailored integrations and white-label options</p>
          </div>

          <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-xl p-6 border border-green-100 text-center">
            <div class="text-3xl mb-3">🤝</div>
            <h3 class="font-bold text-gray-900 mb-2">Partnerships</h3>
            <p class="text-sm text-gray-600">Reseller programs and strategic partnerships</p>
          </div>
        </div>

        <div class="bg-gradient-to-r from-gray-900 to-gray-800 rounded-xl p-6 mb-8 text-white">
          <h2 class="text-2xl font-bold mb-4">Enterprise Benefits</h2>
          <ul class="space-y-3">
            <li class="flex items-start gap-3">
              <span class="text-green-400 text-xl">✓</span>
              <span>Unlimited API calls and commands</span>
            </li>
            <li class="flex items-start gap-3">
              <span class="text-green-400 text-xl">✓</span>
              <span>99.9% uptime SLA guarantee</span>
            </li>
            <li class="flex items-start gap-3">
              <span class="text-green-400 text-xl">✓</span>
              <span>Priority support with 4-8 hour response time</span>
            </li>
            <li class="flex items-start gap-3">
              <span class="text-green-400 text-xl">✓</span>
              <span>Dedicated account manager</span>
            </li>
            <li class="flex items-start gap-3">
              <span class="text-green-400 text-xl">✓</span>
              <span>Custom voice command training</span>
            </li>
            <li class="flex items-start gap-3">
              <span class="text-green-400 text-xl">✓</span>
              <span>White-label options available</span>
            </li>
            <li class="flex items-start gap-3">
              <span class="text-green-400 text-xl">✓</span>
              <span>Advanced analytics and reporting</span>
            </li>
            <li class="flex items-start gap-3">
              <span class="text-green-400 text-xl">✓</span>
              <span>On-premise deployment options</span>
            </li>
          </ul>
        </div>

        <form @submit.prevent="handleSubmit" class="space-y-6">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full Name *</label>
              <input
                id="name"
                v-model="form.name"
                type="text"
                required
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                placeholder="John Doe"
              />
            </div>

            <div>
              <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Business Email *</label>
              <input
                id="email"
                v-model="form.email"
                type="email"
                required
                autocomplete="email"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                placeholder="john@company.com"
              />
            </div>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <label for="company" class="block text-sm font-medium text-gray-700 mb-2">Company Name *</label>
              <input
                id="company"
                v-model="form.company"
                type="text"
                required
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                placeholder="Acme Inc."
              />
            </div>

            <div>
              <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
              <input
                id="phone"
                v-model="form.phone"
                type="tel"
                autocomplete="tel"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                placeholder="+1 (555) 123-4567"
              />
            </div>
          </div>

          <div>
            <label for="interest" class="block text-sm font-medium text-gray-700 mb-2">I'm interested in *</label>
            <select
              id="interest"
              v-model="form.interest"
              required
              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
            >
              <option value="">Select an option...</option>
              <option value="enterprise">Enterprise Plan</option>
              <option value="custom">Custom Solution</option>
              <option value="partnership">Partnership Opportunity</option>
              <option value="pricing">Pricing Information</option>
              <option value="demo">Schedule a Demo</option>
              <option value="other">Other</option>
            </select>
          </div>

          <div>
            <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Tell us about your needs *</label>
            <textarea
              id="message"
              v-model="form.message"
              required
              rows="6"
              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
              placeholder="Please describe your requirements, expected usage, timeline, and any specific features you need..."
            ></textarea>
          </div>

          <div v-if="success" class="bg-green-50 border border-green-200 rounded-lg p-4">
            <p class="text-green-800">Thank you! Our sales team will contact you within 24 hours.</p>
            <p class="text-green-700 text-sm mt-2">Visit <a href="https://voiceactions.dev" target="_blank" rel="noopener noreferrer" class="font-semibold underline">voiceactions.dev</a> for more information.</p>
          </div>

          <div v-if="error" class="bg-red-50 border border-red-200 rounded-lg p-4">
            <p class="text-red-800">{{ error }}</p>
          </div>

          <button
            type="submit"
            :disabled="loading"
            class="w-full px-6 py-3 bg-gradient-to-r from-purple-600 to-pink-600 text-white rounded-lg font-semibold hover:from-purple-700 hover:to-pink-700 transition disabled:opacity-50 disabled:cursor-not-allowed shadow-lg"
          >
            <span v-if="loading">⏳ Sending...</span>
            <span v-else>💼 Contact Sales Team</span>
          </button>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'

const form = ref({
  name: '',
  email: '',
  company: '',
  phone: '',
  interest: '',
  message: ''
})

const loading = ref(false)
const success = ref(false)
const error = ref(null)

const handleSubmit = async () => {
  loading.value = true
  error.value = null
  success.value = false

  try {
    // In a real application, this would send to your backend
    // For now, we'll use mailto as fallback
    const subject = `Sales Inquiry: ${form.value.interest} - ${form.value.company}`
    const body = `Name: ${form.value.name}\nEmail: ${form.value.email}\nCompany: ${form.value.company}\nPhone: ${form.value.phone}\nInterest: ${form.value.interest}\n\nMessage:\n${form.value.message}`
    const mailtoLink = `mailto:sales@voiceactions.io?subject=${encodeURIComponent(subject)}&body=${encodeURIComponent(body)}`
    window.location.href = mailtoLink
    
    // Simulate success after a delay
    setTimeout(() => {
      success.value = true
      form.value = { name: '', email: '', company: '', phone: '', interest: '', message: '' }
      loading.value = false
    }, 1000)
  } catch (err) {
    error.value = 'Failed to send inquiry. Please try again or email us directly at sales@voiceactions.io or visit voiceactions.dev'
    loading.value = false
  }
}
</script>

