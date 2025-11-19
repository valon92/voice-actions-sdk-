<template>
  <div class="min-h-screen py-12 px-4 bg-gradient-to-br from-slate-50 via-blue-50 to-purple-50">
    <div class="max-w-4xl mx-auto">
      <div class="bg-white rounded-2xl shadow-xl p-6 sm:p-8 lg:p-10">
        <div class="text-center mb-8">
          <div class="inline-flex items-center justify-center w-16 h-16 mb-4 rounded-2xl bg-gradient-to-br from-blue-500 to-cyan-500 shadow-lg">
            <span class="text-3xl">💬</span>
          </div>
          <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-3">Contact Support</h1>
          <p class="text-lg text-gray-600">We're here to help! Get in touch with our support team</p>
          <p class="text-sm text-gray-500 mt-2">Visit us at <a href="https://voiceactions.dev" target="_blank" rel="noopener noreferrer" class="text-blue-600 hover:underline font-semibold">voiceactions.dev</a></p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
          <div class="bg-gradient-to-br from-blue-50 to-cyan-50 rounded-xl p-6 border border-blue-100">
            <div class="flex items-center gap-3 mb-3">
              <span class="text-2xl">📧</span>
              <h3 class="text-xl font-bold text-gray-900">Email Support</h3>
            </div>
            <p class="text-gray-600 mb-4">Send us an email and we'll respond within 24 hours</p>
            <div class="space-y-2">
              <a href="mailto:support@voiceactions.io" class="inline-block px-6 py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition">
                support@voiceactions.io
              </a>
              <p class="text-xs text-gray-500">Website: <a href="https://voiceactions.dev" target="_blank" rel="noopener noreferrer" class="text-blue-600 hover:underline">voiceactions.dev</a></p>
            </div>
          </div>

          <div class="bg-gradient-to-br from-purple-50 to-pink-50 rounded-xl p-6 border border-purple-100">
            <div class="flex items-center gap-3 mb-3">
              <span class="text-2xl">⏰</span>
              <h3 class="text-xl font-bold text-gray-900">Response Time</h3>
            </div>
            <p class="text-gray-600 mb-2"><strong class="text-gray-900">Free Plan:</strong> 48-72 hours</p>
            <p class="text-gray-600 mb-2"><strong class="text-gray-900">Pro Plan:</strong> 24 hours</p>
            <p class="text-gray-600"><strong class="text-gray-900">Enterprise:</strong> 4-8 hours</p>
          </div>
        </div>

        <div class="bg-gray-50 rounded-xl p-6 mb-8">
          <h2 class="text-2xl font-bold text-gray-900 mb-4">Frequently Asked Questions</h2>
          <div class="space-y-4">
            <div class="border-l-4 border-blue-500 pl-4">
              <h3 class="font-semibold text-gray-900 mb-2">How do I integrate the SDK?</h3>
              <p class="text-gray-600">Check out our <router-link to="/docs/integration" class="text-blue-600 hover:underline">Integration Guide</router-link> for step-by-step instructions.</p>
            </div>
            <div class="border-l-4 border-purple-500 pl-4">
              <h3 class="font-semibold text-gray-900 mb-2">What languages are supported?</h3>
              <p class="text-gray-600">We support English. More languages will be added gradually.</p>
            </div>
            <div class="border-l-4 border-green-500 pl-4">
              <h3 class="font-semibold text-gray-900 mb-2">How do I upgrade my plan?</h3>
              <p class="text-gray-600">Visit our <router-link to="/pricing" class="text-blue-600 hover:underline">Pricing page</router-link> or contact sales for Enterprise plans.</p>
            </div>
            <div class="border-l-4 border-orange-500 pl-4">
              <h3 class="font-semibold text-gray-900 mb-2">Is there a free trial?</h3>
              <p class="text-gray-600">Yes! Our Free plan includes 1,000 commands per month. <router-link to="/register-platform" class="text-blue-600 hover:underline">Get started</router-link> today.</p>
            </div>
          </div>
        </div>

        <form @submit.prevent="handleSubmit" class="space-y-6">
          <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Your Name *</label>
            <input
              id="name"
              v-model="form.name"
              type="text"
              required
              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
              placeholder="John Doe"
            />
          </div>

          <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address *</label>
            <input
              id="email"
              v-model="form.email"
              type="email"
              required
              autocomplete="email"
              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
              placeholder="john@example.com"
            />
          </div>

          <div>
            <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">Subject *</label>
            <select
              id="subject"
              v-model="form.subject"
              required
              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
            >
              <option value="">Select a topic...</option>
              <option value="technical">Technical Support</option>
              <option value="billing">Billing Question</option>
              <option value="feature">Feature Request</option>
              <option value="bug">Bug Report</option>
              <option value="other">Other</option>
            </select>
          </div>

          <div>
            <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Message *</label>
            <textarea
              id="message"
              v-model="form.message"
              required
              rows="6"
              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
              placeholder="Please describe your issue or question in detail..."
            ></textarea>
          </div>

          <div v-if="success" class="bg-green-50 border border-green-200 rounded-lg p-4">
            <p class="text-green-800">Thank you! We've received your message and will respond soon.</p>
          </div>

          <div v-if="error" class="bg-red-50 border border-red-200 rounded-lg p-4">
            <p class="text-red-800">{{ error }}</p>
          </div>

          <button
            type="submit"
            :disabled="loading"
            class="w-full px-6 py-3 bg-gray-900 text-white rounded-lg font-semibold hover:bg-gray-800 transition disabled:opacity-50 disabled:cursor-not-allowed"
          >
            <span v-if="loading">⏳ Sending...</span>
            <span v-else>📤 Send Message</span>
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
  subject: '',
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
    const mailtoLink = `mailto:support@voiceactions.io?subject=${encodeURIComponent(form.value.subject)}&body=${encodeURIComponent(`Name: ${form.value.name}\nEmail: ${form.value.email}\n\nMessage:\n${form.value.message}`)}`
    window.location.href = mailtoLink
    
    // Simulate success after a delay
    setTimeout(() => {
      success.value = true
      form.value = { name: '', email: '', subject: '', message: '' }
      loading.value = false
    }, 1000)
  } catch (err) {
    error.value = 'Failed to send message. Please try again or email us directly.'
    loading.value = false
  }
}
</script>

