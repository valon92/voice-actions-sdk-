<template>
  <div class="min-h-screen py-8 sm:py-12 px-4 bg-gradient-to-br from-slate-50 via-blue-50 to-purple-50">
    <div class="max-w-4xl mx-auto">
      <div class="bg-white rounded-2xl shadow-xl p-4 sm:p-6 md:p-8 lg:p-10">
        <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-900 mb-2 sm:mb-4">Integration Guide</h1>
        <p class="text-sm sm:text-base text-gray-600 mb-6 sm:mb-8">Learn how to integrate Voice Actions SDK into your platform</p>

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

          <!-- Platform-Specific Commands -->
          <section>
            <h2 class="text-xl sm:text-2xl font-bold text-gray-900 mb-3 sm:mb-4">4. Platform-Specific Commands</h2>
            <p class="text-sm sm:text-base text-gray-700 mb-3 sm:mb-4">
              SDK automatikisht ngarkon komanda specifike për platformën tuaj. Për shembull, për YouTube:
            </p>
            <div class="bg-gray-50 p-3 sm:p-4 rounded-lg">
              <pre class="text-xs sm:text-sm overflow-x-auto m-0"><code>const sdk = new VoiceActionsSDK({
  apiKey: 'your-api-key',
  platform: 'youtube', // Platform identifier
  locale: 'en-US',
  onCommand: (command) => {
    // YouTube-specific commands
    switch (command.action) {
      case 'youtube-play':
        // Play video logic
        document.querySelector('.ytp-play-button')?.click()
        break
      case 'youtube-pause':
        // Pause video logic
        document.querySelector('.ytp-play-button')?.click()
        break
      case 'youtube-next':
        // Next video logic
        document.querySelector('.ytp-next-button')?.click()
        break
      case 'youtube-mute':
        // Mute logic
        document.querySelector('.ytp-mute-button')?.click()
        break
      // ... etj.
    }
  }
})</code></pre>
            </div>
            <p class="text-sm sm:text-base text-gray-700 mt-3 sm:mt-4">
              <strong>Komanda të disponueshme për YouTube:</strong> play, pause, next, previous, mute, unmute, fullscreen, volume-up, volume-down, skip-forward, skip-backward, like, subscribe
            </p>
          </section>

          <!-- Custom Commands -->
          <section>
            <h2 class="text-xl sm:text-2xl font-bold text-gray-900 mb-3 sm:mb-4">5. Custom Commands</h2>
            <div class="bg-gray-50 p-3 sm:p-4 rounded-lg">
              <pre class="text-xs sm:text-sm overflow-x-auto m-0"><code>// Add custom command
sdk.addCommand({
  id: 'custom-action',
  phrases: ['do something', 'perform action'],
  action: 'custom-action'
})

// Handle custom action
sdk.onCommand = (command) => {
  if (command.action === 'custom-action') {
    // Your custom logic here
  }
}</code></pre>
            </div>
          </section>

          <!-- Locales -->
          <section>
            <h2 class="text-xl sm:text-2xl font-bold text-gray-900 mb-3 sm:mb-4">6. Multi-language Support</h2>
            <p class="text-sm sm:text-base text-gray-700 mb-3 sm:mb-4">Change locale dynamically:</p>
            <div class="bg-gray-50 p-3 sm:p-4 rounded-lg">
              <pre class="text-xs sm:text-sm overflow-x-auto m-0"><code>// Change to Spanish
sdk.setLocale('es-ES')

// Change to French
sdk.setLocale('fr-FR')

// Change to Albanian
sdk.setLocale('sq-AL')</code></pre>
            </div>
          </section>

          <!-- Best Practices -->
          <section>
            <h2 class="text-xl sm:text-2xl font-bold text-gray-900 mb-3 sm:mb-4">7. Best Practices</h2>
            <ul class="list-disc list-inside space-y-2 text-sm sm:text-base text-gray-700">
              <li>Store your API key securely (environment variables, not in source code)</li>
              <li>Handle errors gracefully with the onError callback</li>
              <li>Stop listening when the user navigates away</li>
              <li>Test with different locales for international users</li>
              <li>Monitor usage through the dashboard</li>
            </ul>
          </section>

          <!-- Support -->
          <section>
            <h2 class="text-xl sm:text-2xl font-bold text-gray-900 mb-3 sm:mb-4">8. Need Help?</h2>
            <p class="text-sm sm:text-base text-gray-700 mb-3 sm:mb-4">
              Check the dashboard for usage statistics or contact support.
            </p>
            <router-link
              to="/platform/dashboard"
              class="inline-block px-4 sm:px-6 py-2 sm:py-3 bg-gray-900 text-white rounded-lg font-semibold hover:bg-gray-800 transition text-sm sm:text-base"
            >
              Go to Dashboard →
            </router-link>
          </section>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
</script>
