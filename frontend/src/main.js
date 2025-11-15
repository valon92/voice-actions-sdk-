import { createApp } from 'vue'
import { createRouter, createWebHistory } from 'vue-router'
import * as Sentry from '@sentry/vue'
import App from './App.vue'
import './style.css'

// Import pages
import Home from './pages/Home.vue'
import PlatformRegister from './pages/PlatformRegister.vue'
import PlatformDashboard from './pages/PlatformDashboard.vue'
import PlatformLogin from './pages/PlatformLogin.vue'
import IntegrationGuide from './pages/docs/IntegrationGuide.vue'
import Pricing from './pages/Pricing.vue'
import VoiceDemo from './pages/VoiceDemo.vue'
import ContactSupport from './pages/ContactSupport.vue'
import SalesInquiry from './pages/SalesInquiry.vue'
import PrivacyPolicy from './pages/PrivacyPolicy.vue'
import TermsOfService from './pages/TermsOfService.vue'
import PlatformSettings from './pages/PlatformSettings.vue'

const routes = [
  { path: '/', component: Home },
  { path: '/register-platform', component: PlatformRegister },
  { path: '/platform/login', component: PlatformLogin },
  { path: '/platform/dashboard', component: PlatformDashboard },
  { path: '/platform/settings', component: PlatformSettings },
  { path: '/docs/integration', component: IntegrationGuide },
  { path: '/pricing', component: Pricing },
  { path: '/demo', component: VoiceDemo },
  { path: '/contact', component: ContactSupport },
  { path: '/sales', component: SalesInquiry },
  { path: '/privacy', component: PrivacyPolicy },
  { path: '/terms', component: TermsOfService },
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

// Axios configuration
import axios from 'axios'
// Use relative path in development (Vite proxy) or full URL in production
axios.defaults.baseURL = import.meta.env.VITE_API_URL || (import.meta.env.DEV ? '/api' : 'https://api.voiceactions.dev/api')
axios.interceptors.request.use((config) => {
  const token = localStorage.getItem('auth_token')
  const apiKey = localStorage.getItem('platform_api_key')
  if (token) {
    config.headers.Authorization = `Bearer ${token}`
  }
  if (apiKey) {
    config.headers['X-API-Key'] = apiKey
  }
  return config
})

// Error handling interceptor
axios.interceptors.response.use(
  (response) => response,
  (error) => {
    // Send to Sentry if configured
    if (import.meta.env.VITE_SENTRY_DSN && error.response) {
      Sentry.captureException(error, {
        contexts: {
          response: {
            status: error.response.status,
            statusText: error.response.statusText,
            data: error.response.data,
          },
          request: {
            url: error.config?.url,
            method: error.config?.method,
          },
        },
      })
    }
    return Promise.reject(error)
  }
)

const app = createApp(App)

// Initialize Sentry if DSN is configured
if (import.meta.env.VITE_SENTRY_DSN) {
  Sentry.init({
    app,
    dsn: import.meta.env.VITE_SENTRY_DSN,
    integrations: [
      new Sentry.BrowserTracing({
        routingInstrumentation: Sentry.vueRouterInstrumentation(router),
      }),
      new Sentry.Replay({
        maskAllText: true,
        blockAllMedia: true,
      }),
    ],
    // Performance Monitoring
    tracesSampleRate: import.meta.env.VITE_SENTRY_TRACES_SAMPLE_RATE || 0.1,
    // Session Replay
    replaysSessionSampleRate: import.meta.env.VITE_SENTRY_REPLAYS_SESSION_SAMPLE_RATE || 0.1,
    replaysOnErrorSampleRate: 1.0,
    environment: import.meta.env.MODE || 'development',
    beforeSend(event, hint) {
      // Filter out sensitive data
      if (event.request) {
        // Remove API keys from request headers
        if (event.request.headers) {
          delete event.request.headers['X-API-Key']
          delete event.request.headers['Authorization']
        }
      }
      return event
    },
  })
}

app.use(router).mount('#app')

