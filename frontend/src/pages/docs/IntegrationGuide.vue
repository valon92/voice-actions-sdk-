<template>
  <div class="min-h-screen py-8 sm:py-12 px-4 bg-gradient-to-br from-slate-50 via-blue-50 to-purple-50">
    <div class="max-w-4xl mx-auto">
      <div class="bg-white rounded-2xl shadow-xl p-4 sm:p-6 md:p-8 lg:p-10">
        <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-900 mb-2 sm:mb-4">Integration Guide</h1>
        <p class="text-sm sm:text-base text-gray-600 mb-4">Learn how to integrate Voice Actions SDK into your platform</p>
        <div class="flex flex-wrap gap-2 mb-6 sm:mb-8">
          <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-xs font-semibold">550+ Commands</span>
          <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-semibold">English</span>
          <span class="px-3 py-1 bg-purple-100 text-purple-800 rounded-full text-xs font-semibold">Universal SDK</span>
          <span class="px-3 py-1 bg-orange-100 text-orange-800 rounded-full text-xs font-semibold">Easy Integration</span>
        </div>

        <div class="prose max-w-none space-y-6 sm:space-y-8">
          <!-- Installation -->
          <section>
            <h2 class="text-xl sm:text-2xl font-bold text-gray-900 mb-3 sm:mb-4">1. Installation</h2>
            <div class="bg-gray-900 text-white p-3 sm:p-4 rounded-lg font-mono text-xs sm:text-sm overflow-x-auto">
              <pre class="m-0">npm install @voice-actions/sdk</pre>
            </div>
            <p class="text-sm sm:text-base text-gray-700 mt-3 sm:mt-4">Or include via CDN:</p>
            <div class="bg-gray-900 text-white p-3 sm:p-4 rounded-lg font-mono text-xs sm:text-sm overflow-x-auto">
              <pre class="m-0">&lt;script src="https://cdn.voiceactions.io/sdk/v1/voice-actions-sdk.min.js"&gt;&lt;/script&gt;</pre>
            </div>
          </section>

          <!-- Basic Usage -->
          <section>
            <h2 class="text-xl sm:text-2xl font-bold text-gray-900 mb-3 sm:mb-4">2. Basic Usage</h2>
            <div class="bg-gray-50 p-3 sm:p-4 rounded-lg">
              <pre class="text-xs sm:text-sm overflow-x-auto m-0"><code>import VoiceActionsSDK from '@voice-actions/sdk'

const sdk = new VoiceActionsSDK({
  apiKey: 'your-api-key-here',
  platform: 'your-platform-name',
  locale: 'en-US',
  debug: true,
  onCommand: (command) => {
    console.log('Command executed:', command)
    // Handle command execution
  },
  onError: (error) => {
    console.error('SDK Error:', error)
  }
})

// Start listening
sdk.start()

// Stop listening
sdk.stop()</code></pre>
            </div>
          </section>

          <!-- API Key -->
          <section>
            <h2 class="text-xl sm:text-2xl font-bold text-gray-900 mb-3 sm:mb-4">3. Get Your API Key</h2>
            <p class="text-sm sm:text-base text-gray-700 mb-3 sm:mb-4">
              Register your platform to get an API key. You'll receive it once after registration.
            </p>
            <router-link
              to="/register-platform"
              class="inline-block px-4 sm:px-6 py-2 sm:py-3 bg-gray-900 text-white rounded-lg font-semibold hover:bg-gray-800 transition text-sm sm:text-base"
            >
              Register Platform →
            </router-link>
          </section>

          <!-- Universal Platform Support -->
          <section>
            <h2 class="text-xl sm:text-2xl font-bold text-gray-900 mb-3 sm:mb-4">4. Universal Platform Support</h2>
            <p class="text-sm sm:text-base text-gray-700 mb-3 sm:mb-4">
              The Voice Actions SDK is <strong>100% universal</strong> and works with <strong>any platform</strong> - YouTube, E-commerce, CRM, Social Media, Healthcare, E-learning, Gaming, Development platforms, and more. Your platform implements the specific logic for each command:
            </p>
            <div class="bg-gray-50 p-3 sm:p-4 rounded-lg">
              <pre class="text-xs sm:text-sm overflow-x-auto m-0"><code>const sdk = new VoiceActionsSDK({
  apiKey: 'your-api-key',
  platform: 'your-platform-name', // Any platform name
  locale: 'en-US',
  onCommand: (command) => {
    // Your platform implements the logic
    switch (command.action) {
      // E-commerce: add-to-cart, checkout, search-products
      case 'add-to-cart':
        addProductToCart()
        break
      
      // CRM: create-contact, schedule-meeting, send-email
      case 'create-contact':
        openContactForm()
        break
      
      // Social Media: like-post, share-post, follow-user
      case 'like-post':
        likeCurrentPost()
        break
      
      // Healthcare: book-appointment, view-records
      case 'book-appointment':
        openAppointmentBooking()
        break
      
      // Any other command your platform needs
      default:
        handleCustomAction(command)
    }
  }
})

// Add custom commands
sdk.addCommand({
  id: 'my-custom-action',
  phrases: ['do something', 'perform action'],
  action: 'my-custom-action'
})

sdk.start()</code></pre>
            </div>
            <p class="text-sm sm:text-base text-gray-700 mt-3 sm:mt-4">
              <strong>The SDK only listens and notifies</strong> - your platform has complete control over what to do with each command!
            </p>
          </section>

          <!-- Available Commands -->
          <section>
            <h2 class="text-xl sm:text-2xl font-bold text-gray-900 mb-3 sm:mb-4">5. Available Voice Commands</h2>
            <p class="text-sm sm:text-base text-gray-700 mb-3 sm:mb-4">
              The SDK includes <strong>550+ universal voice commands</strong> covering all major platform categories:
            </p>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4 mb-4">
              <div class="bg-blue-50 p-3 sm:p-4 rounded-lg border border-blue-200">
                <h3 class="font-semibold text-blue-900 mb-2 text-sm sm:text-base">📱 Social Media</h3>
                <p class="text-xs sm:text-sm text-blue-700">Like, share, follow, comment, create post, view profile, and more</p>
              </div>
              <div class="bg-green-50 p-3 sm:p-4 rounded-lg border border-green-200">
                <h3 class="font-semibold text-green-900 mb-2 text-sm sm:text-base">🛒 E-Commerce</h3>
                <p class="text-xs sm:text-sm text-green-700">Add to cart, checkout, search products, view orders, manage account</p>
              </div>
              <div class="bg-purple-50 p-3 sm:p-4 rounded-lg border border-purple-200">
                <h3 class="font-semibold text-purple-900 mb-2 text-sm sm:text-base">🎮 Gaming</h3>
                <p class="text-xs sm:text-sm text-purple-700">Launch game, view library, manage achievements, purchase games</p>
              </div>
              <div class="bg-orange-50 p-3 sm:p-4 rounded-lg border border-orange-200">
                <h3 class="font-semibold text-orange-900 mb-2 text-sm sm:text-base">💻 Technology</h3>
                <p class="text-xs sm:text-sm text-orange-700">OS controls, cloud services, developer tools, mobile platforms</p>
              </div>
              <div class="bg-teal-50 p-3 sm:p-4 rounded-lg border border-teal-200">
                <h3 class="font-semibold text-teal-900 mb-2 text-sm sm:text-base">📚 Education</h3>
                <p class="text-xs sm:text-sm text-teal-700">Enroll in courses, view lessons, submit assignments, track progress</p>
              </div>
              <div class="bg-indigo-50 p-3 sm:p-4 rounded-lg border border-indigo-200">
                <h3 class="font-semibold text-indigo-900 mb-2 text-sm sm:text-base">💬 Communication</h3>
                <p class="text-xs sm:text-sm text-indigo-700">Send messages, make calls, manage groups, share files</p>
              </div>
              <div class="bg-red-50 p-3 sm:p-4 rounded-lg border border-red-200">
                <h3 class="font-semibold text-red-900 mb-2 text-sm sm:text-base">⚙️ Development</h3>
                <p class="text-xs sm:text-sm text-red-700">Create projects, deploy apps, manage code, collaborate with teams</p>
              </div>
              <div class="bg-gray-50 p-3 sm:p-4 rounded-lg border border-gray-200">
                <h3 class="font-semibold text-gray-900 mb-2 text-sm sm:text-base">🔧 Common Actions</h3>
                <p class="text-xs sm:text-sm text-gray-700">Scroll, click, search, navigate, and basic interactions</p>
              </div>
            </div>
            <p class="text-sm sm:text-base text-gray-700 mb-3 sm:mb-4">
              All commands are available in <strong>English</strong>. More languages will be added gradually. Check out our <router-link to="/demo" class="text-gray-900 font-semibold hover:underline">Voice Demo</router-link> to see all commands in action.
            </p>
          </section>

          <!-- Custom Commands -->
          <section>
            <h2 class="text-xl sm:text-2xl font-bold text-gray-900 mb-3 sm:mb-4">6. Custom Commands</h2>
            <p class="text-sm sm:text-base text-gray-700 mb-3 sm:mb-4">
              You can add custom commands specific to your platform. These commands work alongside the 550+ universal commands:
            </p>
            <div class="bg-gray-50 p-3 sm:p-4 rounded-lg">
              <pre class="text-xs sm:text-sm overflow-x-auto m-0"><code>// Add custom command
sdk.addCommand({
  id: 'custom-action',
  phrases: ['do something', 'perform action', 'execute task'],
  action: 'custom-action'
})

// Handle custom action in onCommand callback
const sdk = new VoiceActionsSDK({
  apiKey: 'your-api-key',
  platform: 'your-platform',
  onCommand: (command) => {
    if (command.action === 'custom-action') {
      // Your custom logic here
      performCustomAction()
    }
  }
})</code></pre>
            </div>
            <p class="text-sm sm:text-base text-gray-700 mt-3 sm:mt-4">
              <strong>Tip:</strong> Add multiple phrases for the same command to improve recognition accuracy. The SDK will match any of the phrases you provide.
            </p>
          </section>

          <!-- Multi-language Support -->
          <section>
            <h2 class="text-xl sm:text-2xl font-bold text-gray-900 mb-3 sm:mb-4">7. Multi-language Support</h2>
            <p class="text-sm sm:text-base text-gray-700 mb-3 sm:mb-4">
              The SDK supports <strong>English</strong> with all 550+ commands available. More languages will be added gradually. Change the locale dynamically:
            </p>
            <div class="bg-gray-50 p-3 sm:p-4 rounded-lg mb-3 sm:mb-4">
              <pre class="text-xs sm:text-sm overflow-x-auto m-0"><code>// English (default)
sdk.setLocale('en-US')

// More languages will be added gradually</code></pre>
            </div>
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-3 sm:p-4">
              <p class="text-xs sm:text-sm text-blue-800">
                <strong>Note:</strong> When you change the locale, the SDK automatically reloads commands with phrases in the selected language. All commands remain the same, only the voice recognition language changes.
              </p>
            </div>
          </section>

          <!-- Error Handling -->
          <section>
            <h2 class="text-xl sm:text-2xl font-bold text-gray-900 mb-3 sm:mb-4">8. Error Handling</h2>
            <p class="text-sm sm:text-base text-gray-700 mb-3 sm:mb-4">
              Always implement error handling to provide a better user experience:
            </p>
            <div class="bg-gray-50 p-3 sm:p-4 rounded-lg">
              <pre class="text-xs sm:text-sm overflow-x-auto m-0"><code>const sdk = new VoiceActionsSDK({
  apiKey: 'your-api-key',
  platform: 'your-platform',
  onError: (error) => {
    // Handle different error types
    if (error.message.includes('permission')) {
      showPermissionError()
    } else if (error.message.includes('network')) {
      showNetworkError()
    } else {
      console.error('SDK Error:', error)
      showGenericError()
    }
  }
})</code></pre>
            </div>
            <p class="text-sm sm:text-base text-gray-700 mt-3 sm:mt-4">
              Common errors include microphone permission denied, network issues, and browser compatibility. Always provide clear feedback to users.
            </p>
          </section>

          <!-- Best Practices -->
          <section>
            <h2 class="text-xl sm:text-2xl font-bold text-gray-900 mb-3 sm:mb-4">9. Best Practices</h2>
            <ul class="list-disc list-inside space-y-2 text-sm sm:text-base text-gray-700 mb-3 sm:mb-4">
              <li><strong>Security:</strong> Store your API key securely using environment variables, never commit it to source code</li>
              <li><strong>Error Handling:</strong> Always implement the <code class="bg-gray-100 px-1 rounded">onError</code> callback to handle errors gracefully</li>
              <li><strong>Lifecycle Management:</strong> Stop listening when users navigate away or when the component unmounts</li>
              <li><strong>Internationalization:</strong> Test with different locales to ensure your platform works for international users</li>
              <li><strong>Usage Monitoring:</strong> Monitor your usage through the dashboard to stay within plan limits</li>
              <li><strong>User Feedback:</strong> Provide visual feedback when listening starts/stops and when commands are recognized</li>
              <li><strong>Permission Handling:</strong> Request microphone permission proactively and guide users if permission is denied</li>
            </ul>
            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-3 sm:p-4">
              <p class="text-xs sm:text-sm text-yellow-800">
                <strong>Important:</strong> Always call <code class="bg-yellow-100 px-1 rounded">sdk.destroy()</code> when cleaning up to prevent memory leaks and stop background processes.
              </p>
            </div>
          </section>

          <!-- Framework Examples -->
          <section>
            <h2 class="text-xl sm:text-2xl font-bold text-gray-900 mb-3 sm:mb-4">10. Framework Examples</h2>
            
            <h3 class="text-lg sm:text-xl font-semibold text-gray-800 mb-2 sm:mb-3">React</h3>
            <div class="bg-gray-50 p-3 sm:p-4 rounded-lg mb-4">
              <pre class="text-xs sm:text-sm overflow-x-auto m-0"><code>import { useEffect, useRef } from 'react'
import VoiceActionsSDK from '@voice-actions/sdk'

function VoiceControl() {
  const sdkRef = useRef(null)

  useEffect(() => {
    sdkRef.current = new VoiceActionsSDK({
      apiKey: process.env.REACT_APP_VOICE_ACTIONS_API_KEY,
      platform: 'my-platform',
      locale: 'en-US',
      onCommand: (command) => {
        console.log('Command:', command)
        // Handle command
      },
      onError: (error) => {
        console.error('Error:', error)
      }
    })

    sdkRef.current.start()

    return () => {
      sdkRef.current?.destroy()
    }
  }, [])

  return &lt;div&gt;Voice control active&lt;/div&gt;
}</code></pre>
            </div>

            <h3 class="text-lg sm:text-xl font-semibold text-gray-800 mb-2 sm:mb-3">Vue.js</h3>
            <div class="bg-gray-50 p-3 sm:p-4 rounded-lg mb-4">
              <pre class="text-xs sm:text-sm overflow-x-auto m-0"><code>&lt;script setup&gt;
import { onMounted, onUnmounted, ref } from 'vue'
import VoiceActionsSDK from '@voice-actions/sdk'

const sdk = ref(null)

onMounted(() => {
  sdk.value = new VoiceActionsSDK({
    apiKey: import.meta.env.VITE_VOICE_ACTIONS_API_KEY,
    platform: 'my-platform',
    locale: 'en-US',
    onCommand: (command) => {
      console.log('Command:', command)
      // Handle command
    }
  })
  
  sdk.value.start()
})

onUnmounted(() => {
  sdk.value?.destroy()
})
&lt;/script&gt;</code></pre>
            </div>

            <h3 class="text-lg sm:text-xl font-semibold text-gray-800 mb-2 sm:mb-3">Vanilla JavaScript</h3>
            <div class="bg-gray-50 p-3 sm:p-4 rounded-lg">
              <pre class="text-xs sm:text-sm overflow-x-auto m-0"><code>// Include SDK via CDN or import
const sdk = new VoiceActionsSDK({
  apiKey: 'your-api-key',
  platform: 'my-platform',
  locale: 'en-US',
  onCommand: (command) => {
    console.log('Command:', command)
    // Handle command
  }
})

// Start listening
sdk.start()

// Clean up when done
window.addEventListener('beforeunload', () => {
  sdk.destroy()
})</code></pre>
            </div>
          </section>

          <!-- Support & Resources -->
          <section>
            <h2 class="text-xl sm:text-2xl font-bold text-gray-900 mb-3 sm:mb-4">11. Support & Resources</h2>
            <div class="space-y-4">
              <div class="bg-white border border-gray-200 rounded-lg p-4">
                <h3 class="font-semibold text-gray-900 mb-2 text-sm sm:text-base">📊 Dashboard</h3>
                <p class="text-sm text-gray-700 mb-3">Monitor your usage, view statistics, and manage your platform settings.</p>
                <router-link
                  to="/platform/dashboard"
                  class="inline-block px-4 py-2 bg-gray-900 text-white rounded-lg font-semibold hover:bg-gray-800 transition text-xs sm:text-sm"
                >
                  Go to Dashboard →
                </router-link>
              </div>
              
              <div class="bg-white border border-gray-200 rounded-lg p-4">
                <h3 class="font-semibold text-gray-900 mb-2 text-sm sm:text-base">🎤 Try Demo</h3>
                <p class="text-sm text-gray-700 mb-3">Experience all 550+ voice commands in action before integrating.</p>
                <router-link
                  to="/demo"
                  class="inline-block px-4 py-2 bg-gray-900 text-white rounded-lg font-semibold hover:bg-gray-800 transition text-xs sm:text-sm"
                >
                  View Demo →
                </router-link>
              </div>

              <div class="bg-white border border-gray-200 rounded-lg p-4">
                <h3 class="font-semibold text-gray-900 mb-2 text-sm sm:text-base">💡 Examples</h3>
                <p class="text-sm text-gray-700 mb-3">Check out our integration examples for different platforms and frameworks.</p>
                <a
                  href="https://github.com/your-org/voice-actions-sdk/tree/main/examples"
                  target="_blank"
                  rel="noopener noreferrer"
                  class="inline-block px-4 py-2 bg-gray-900 text-white rounded-lg font-semibold hover:bg-gray-800 transition text-xs sm:text-sm"
                >
                  View Examples →
                </a>
              </div>

              <div class="bg-white border border-gray-200 rounded-lg p-4">
                <h3 class="font-semibold text-gray-900 mb-2 text-sm sm:text-base">📧 Contact Support</h3>
                <p class="text-sm text-gray-700 mb-3">Need help? Contact our support team for assistance.</p>
                <a
                  href="mailto:support@voiceactions.io"
                  class="inline-block px-4 py-2 bg-gray-900 text-white rounded-lg font-semibold hover:bg-gray-800 transition text-xs sm:text-sm"
                >
                  Email Support →
                </a>
              </div>
            </div>
          </section>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
</script>
