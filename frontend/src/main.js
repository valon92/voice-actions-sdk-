import { createApp } from 'vue'
import { createRouter, createWebHistory } from 'vue-router'
import App from './App.vue'
import './style.css'

// Import pages
import Home from './pages/Home.vue'
import PlatformRegister from './pages/PlatformRegister.vue'
import PlatformDashboard from './pages/PlatformDashboard.vue'
import PlatformLogin from './pages/PlatformLogin.vue'
import IntegrationGuide from './pages/docs/IntegrationGuide.vue'
import Pricing from './pages/Pricing.vue'

const routes = [
  { path: '/', component: Home },
  { path: '/register-platform', component: PlatformRegister },
  { path: '/platform/login', component: PlatformLogin },
  { path: '/platform/dashboard', component: PlatformDashboard },
  { path: '/docs/integration', component: IntegrationGuide },
  { path: '/pricing', component: Pricing },
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

// Axios configuration
import axios from 'axios'
axios.defaults.baseURL = import.meta.env.VITE_API_URL || 'http://localhost:8000/api'
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

createApp(App).use(router).mount('#app')

