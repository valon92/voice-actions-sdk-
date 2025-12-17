<template>
  <div class="bg-white rounded-xl shadow-lg p-6">
    <h2 class="text-2xl font-bold text-gray-900 mb-6">Billing & Invoices</h2>

    <!-- Loading State -->
    <div v-if="loading" class="text-center py-8">
      <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-gray-900"></div>
    </div>

    <!-- Invoices List -->
    <div v-else-if="invoices.length > 0" class="space-y-4">
      <div
        v-for="invoice in invoices"
        :key="invoice.id"
        class="p-4 border border-gray-200 rounded-lg hover:border-gray-300 transition"
      >
        <div class="flex items-center justify-between">
          <div>
            <p class="font-semibold text-gray-900">
              Invoice #{{ invoice.id }}
            </p>
            <p class="text-sm text-gray-600 mt-1">
              {{ formatDate(invoice.period_start) }} - {{ formatDate(invoice.period_end) }}
            </p>
          </div>
          <div class="text-right">
            <p class="font-bold text-gray-900">
              ${{ invoice.amount.toFixed(2) }} {{ invoice.currency }}
            </p>
            <span :class="[
              'inline-block mt-1 px-2 py-1 rounded-full text-xs font-semibold',
              invoice.status === 'paid' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800'
            ]">
              {{ invoice.status }}
            </span>
          </div>
        </div>

        <div class="mt-4 flex gap-3">
          <a
            v-if="invoice.invoice_pdf_url"
            :href="invoice.invoice_pdf_url"
            target="_blank"
            class="text-sm text-gray-600 hover:text-gray-900 underline"
          >
            Download PDF
          </a>
          <a
            v-if="invoice.invoice_hosted_url"
            :href="invoice.invoice_hosted_url"
            target="_blank"
            class="text-sm text-gray-600 hover:text-gray-900 underline"
          >
            View Online
          </a>
        </div>
      </div>
    </div>

    <!-- No Invoices -->
    <div v-else class="text-center py-8">
      <p class="text-gray-600">No invoices found</p>
    </div>

    <!-- Error Message -->
    <div v-if="error" class="mt-4 p-4 bg-red-50 border border-red-200 rounded-lg">
      <p class="text-red-800 text-sm">{{ error }}</p>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'

const invoices = ref([])
const loading = ref(true)
const error = ref(null)

const getApiKey = () => {
  return localStorage.getItem('platform_api_key')
}

const loadInvoices = async () => {
  loading.value = true
  error.value = null

  try {
    const apiKey = getApiKey()
    if (!apiKey) {
      error.value = 'Please login first'
      loading.value = false
      return
    }

    const response = await axios.get('/api/invoices', {
      headers: {
        'X-API-Key': apiKey,
      },
    })

    if (response.data.success) {
      invoices.value = response.data.invoices
    }
  } catch (err) {
    error.value = err.response?.data?.error || 'Failed to load invoices'
    console.error('Invoices load error:', err)
  } finally {
    loading.value = false
  }
}

const formatDate = (dateString) => {
  if (!dateString) return 'N/A'
  return new Date(dateString).toLocaleDateString('en-US', {
    year: 'numeric',
    month: 'short',
    day: 'numeric',
  })
}

onMounted(() => {
  loadInvoices()
})
</script>

