<template>
  <div class="min-h-screen py-12 px-4 bg-gradient-to-br from-slate-50 via-blue-50 to-purple-50">
    <div class="max-w-4xl mx-auto">
      <div class="bg-white rounded-2xl shadow-xl p-6 sm:p-8 lg:p-10">
        <div class="text-center mb-8">
          <div class="inline-flex items-center justify-center w-16 h-16 mb-4 rounded-2xl bg-gradient-to-br from-amber-500 to-orange-500 shadow-lg">
            <span class="text-3xl">🍪</span>
          </div>
          <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-3">Cookie Policy</h1>
          <p class="text-gray-600">Last updated: {{ lastUpdated }}</p>
        </div>

        <div class="prose prose-lg max-w-none space-y-8">
          <section>
            <h2 class="text-2xl font-bold text-gray-900 mb-4">1. What Are Cookies?</h2>
            <p class="text-gray-700 leading-relaxed mb-4">
              Cookies are small text files that are placed on your device (computer, tablet, or mobile) when you visit a website. They are widely used to make websites work more efficiently and provide information to website owners.
            </p>
            <p class="text-gray-700 leading-relaxed">
              Voice Actions SDK uses cookies and similar tracking technologies to enhance your experience, analyze usage patterns, and improve our services. This Cookie Policy explains what cookies we use, why we use them, and how you can manage your cookie preferences.
            </p>
          </section>

          <section>
            <h2 class="text-2xl font-bold text-gray-900 mb-4">2. Types of Cookies We Use</h2>
            
            <h3 class="text-xl font-semibold text-gray-900 mb-3">2.1 Essential Cookies</h3>
            <p class="text-gray-700 leading-relaxed mb-4">
              These cookies are necessary for the website to function properly. They enable core functionality such as security, network management, and accessibility. You cannot opt-out of these cookies.
            </p>
            <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded mb-4">
              <p class="text-sm text-gray-700">
                <strong>Examples:</strong> Session management, authentication tokens, security preferences
              </p>
            </div>

            <h3 class="text-xl font-semibold text-gray-900 mb-3 mt-6">2.2 Functional Cookies</h3>
            <p class="text-gray-700 leading-relaxed mb-4">
              These cookies allow the website to remember choices you make (such as your language preference, region, or username) and provide enhanced, personalized features.
            </p>
            <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded mb-4">
              <p class="text-sm text-gray-700">
                <strong>Examples:</strong> Voice control language settings, theme preferences, user interface customizations
              </p>
            </div>

            <h3 class="text-xl font-semibold text-gray-900 mb-3 mt-6">2.3 Analytics Cookies</h3>
            <p class="text-gray-700 leading-relaxed mb-4">
              These cookies help us understand how visitors interact with our website by collecting and reporting information anonymously. This helps us improve the way our website works.
            </p>
            <div class="bg-purple-50 border-l-4 border-purple-500 p-4 rounded mb-4">
              <p class="text-sm text-gray-700">
                <strong>Examples:</strong> Page views, time spent on site, error tracking, performance metrics
              </p>
            </div>

            <h3 class="text-xl font-semibold text-gray-900 mb-3 mt-6">2.4 Performance Cookies</h3>
            <p class="text-gray-700 leading-relaxed mb-4">
              These cookies collect information about how you use our website, such as which pages you visit most often. This data helps us optimize our website's performance and user experience.
            </p>
            <div class="bg-yellow-50 border-l-4 border-yellow-500 p-4 rounded mb-4">
              <p class="text-sm text-gray-700">
                <strong>Examples:</strong> API response times, SDK usage statistics, command execution metrics
              </p>
            </div>
          </section>

          <section>
            <h2 class="text-2xl font-bold text-gray-900 mb-4">3. Specific Cookies We Use</h2>
            
            <div class="overflow-x-auto">
              <table class="min-w-full divide-y divide-gray-200 border border-gray-300 rounded-lg">
                <thead class="bg-gray-50">
                  <tr>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider border-b">Cookie Name</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider border-b">Purpose</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider border-b">Duration</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider border-b">Type</th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                  <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 text-sm text-gray-900 font-mono">auth_token</td>
                    <td class="px-4 py-3 text-sm text-gray-700">Stores authentication token for logged-in users</td>
                    <td class="px-4 py-3 text-sm text-gray-700">Session</td>
                    <td class="px-4 py-3 text-sm text-gray-700"><span class="px-2 py-1 bg-blue-100 text-blue-800 rounded text-xs">Essential</span></td>
                  </tr>
                  <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 text-sm text-gray-900 font-mono">voice_language</td>
                    <td class="px-4 py-3 text-sm text-gray-700">Stores your preferred voice control language</td>
                    <td class="px-4 py-3 text-sm text-gray-700">1 year</td>
                    <td class="px-4 py-3 text-sm text-gray-700"><span class="px-2 py-1 bg-green-100 text-green-800 rounded text-xs">Functional</span></td>
                  </tr>
                  <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 text-sm text-gray-900 font-mono">voice_control_enabled</td>
                    <td class="px-4 py-3 text-sm text-gray-700">Remembers your voice control toggle preference</td>
                    <td class="px-4 py-3 text-sm text-gray-700">1 year</td>
                    <td class="px-4 py-3 text-sm text-gray-700"><span class="px-2 py-1 bg-green-100 text-green-800 rounded text-xs">Functional</span></td>
                  </tr>
                  <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 text-sm text-gray-900 font-mono">analytics_session</td>
                    <td class="px-4 py-3 text-sm text-gray-700">Tracks user session for analytics purposes</td>
                    <td class="px-4 py-3 text-sm text-gray-700">30 minutes</td>
                    <td class="px-4 py-3 text-sm text-gray-700"><span class="px-2 py-1 bg-purple-100 text-purple-800 rounded text-xs">Analytics</span></td>
                  </tr>
                  <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 text-sm text-gray-900 font-mono">cookie_consent</td>
                    <td class="px-4 py-3 text-sm text-gray-700">Stores your cookie consent preferences</td>
                    <td class="px-4 py-3 text-sm text-gray-700">1 year</td>
                    <td class="px-4 py-3 text-sm text-gray-700"><span class="px-2 py-1 bg-blue-100 text-blue-800 rounded text-xs">Essential</span></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </section>

          <section>
            <h2 class="text-2xl font-bold text-gray-900 mb-4">4. Third-Party Cookies</h2>
            <p class="text-gray-700 leading-relaxed mb-4">
              In addition to our own cookies, we may also use various third-party cookies to report usage statistics, deliver advertisements, and provide enhanced functionality:
            </p>
            <ul class="list-disc pl-6 space-y-3 text-gray-700">
              <li>
                <strong>Analytics Services:</strong> We may use services like Google Analytics to understand how visitors use our website. These services use cookies to collect information anonymously.
              </li>
              <li>
                <strong>Error Tracking:</strong> We use Sentry for error tracking and performance monitoring. This helps us identify and fix issues quickly.
              </li>
              <li>
                <strong>Payment Processors:</strong> When processing payments, third-party payment processors may set cookies to ensure secure transactions.
              </li>
            </ul>
            <p class="text-gray-700 leading-relaxed mt-4">
              These third-party cookies are subject to the respective third parties' privacy policies. We do not have access to or control over these cookies.
            </p>
          </section>

          <section>
            <h2 class="text-2xl font-bold text-gray-900 mb-4">5. How We Use Cookies</h2>
            <p class="text-gray-700 leading-relaxed mb-4">We use cookies for the following purposes:</p>
            <div class="grid md:grid-cols-2 gap-4">
              <div class="bg-gradient-to-br from-blue-50 to-indigo-50 p-5 rounded-xl border border-blue-200">
                <h4 class="font-semibold text-gray-900 mb-2 flex items-center gap-2">
                  <span>🔐</span> Authentication
                </h4>
                <p class="text-sm text-gray-700">To keep you logged in and maintain your session security</p>
              </div>
              <div class="bg-gradient-to-br from-green-50 to-emerald-50 p-5 rounded-xl border border-green-200">
                <h4 class="font-semibold text-gray-900 mb-2 flex items-center gap-2">
                  <span>⚙️</span> Preferences
                </h4>
                <p class="text-sm text-gray-700">To remember your settings and preferences for a better experience</p>
              </div>
              <div class="bg-gradient-to-br from-purple-50 to-pink-50 p-5 rounded-xl border border-purple-200">
                <h4 class="font-semibold text-gray-900 mb-2 flex items-center gap-2">
                  <span>📊</span> Analytics
                </h4>
                <p class="text-sm text-gray-700">To understand how you use our service and improve it</p>
              </div>
              <div class="bg-gradient-to-br from-yellow-50 to-orange-50 p-5 rounded-xl border border-yellow-200">
                <h4 class="font-semibold text-gray-900 mb-2 flex items-center gap-2">
                  <span>🚀</span> Performance
                </h4>
                <p class="text-sm text-gray-700">To monitor and optimize our service performance</p>
              </div>
            </div>
          </section>

          <section>
            <h2 class="text-2xl font-bold text-gray-900 mb-4">6. Managing Your Cookie Preferences</h2>
            <p class="text-gray-700 leading-relaxed mb-4">
              You have the right to accept or reject cookies. Most web browsers automatically accept cookies, but you can usually modify your browser settings to decline cookies if you prefer.
            </p>
            
            <h3 class="text-xl font-semibold text-gray-900 mb-3">6.1 Browser Settings</h3>
            <p class="text-gray-700 leading-relaxed mb-4">
              You can control cookies through your browser settings. Here are links to instructions for popular browsers:
            </p>
            <div class="grid sm:grid-cols-2 gap-3 mb-4">
              <a href="https://support.google.com/chrome/answer/95647" target="_blank" rel="noopener noreferrer" class="flex items-center gap-2 p-3 bg-gray-50 hover:bg-gray-100 rounded-lg transition">
                <span>🌐</span>
                <span class="text-sm font-medium text-gray-700">Google Chrome</span>
              </a>
              <a href="https://support.mozilla.org/en-US/kb/enable-and-disable-cookies-website-preferences" target="_blank" rel="noopener noreferrer" class="flex items-center gap-2 p-3 bg-gray-50 hover:bg-gray-100 rounded-lg transition">
                <span>🦊</span>
                <span class="text-sm font-medium text-gray-700">Mozilla Firefox</span>
              </a>
              <a href="https://support.apple.com/guide/safari/manage-cookies-and-website-data-sfri11471/mac" target="_blank" rel="noopener noreferrer" class="flex items-center gap-2 p-3 bg-gray-50 hover:bg-gray-100 rounded-lg transition">
                <span>🍎</span>
                <span class="text-sm font-medium text-gray-700">Safari</span>
              </a>
              <a href="https://support.microsoft.com/en-us/microsoft-edge/delete-cookies-in-microsoft-edge-63947406-40ac-c3b8-57b9-2a946a29ae09" target="_blank" rel="noopener noreferrer" class="flex items-center gap-2 p-3 bg-gray-50 hover:bg-gray-100 rounded-lg transition">
                <span>🔷</span>
                <span class="text-sm font-medium text-gray-700">Microsoft Edge</span>
              </a>
            </div>

            <h3 class="text-xl font-semibold text-gray-900 mb-3 mt-6">6.2 Cookie Consent Banner</h3>
            <p class="text-gray-700 leading-relaxed mb-4">
              When you first visit our website, you will see a cookie consent banner. You can choose which types of cookies to accept. You can change your preferences at any time by accessing the cookie settings in your account or browser.
            </p>
            <div class="bg-amber-50 border-l-4 border-amber-500 p-4 rounded">
              <p class="text-sm text-gray-700">
                <strong>Note:</strong> If you choose to disable cookies, some features of our Service may not function properly. Essential cookies cannot be disabled as they are necessary for the website to function.
              </p>
            </div>
          </section>

          <section>
            <h2 class="text-2xl font-bold text-gray-900 mb-4">7. Local Storage and Similar Technologies</h2>
            <p class="text-gray-700 leading-relaxed mb-4">
              In addition to cookies, we use other similar technologies such as Local Storage and Session Storage to store information on your device:
            </p>
            <ul class="list-disc pl-6 space-y-2 text-gray-700">
              <li><strong>Local Storage:</strong> Used to store your preferences and settings persistently (e.g., voice control language, theme preferences)</li>
              <li><strong>Session Storage:</strong> Used to store temporary data during your browsing session (e.g., form data, temporary preferences)</li>
            </ul>
            <p class="text-gray-700 leading-relaxed mt-4">
              You can clear Local Storage and Session Storage through your browser's developer tools or privacy settings.
            </p>
          </section>

          <section>
            <h2 class="text-2xl font-bold text-gray-900 mb-4">8. Do Not Track Signals</h2>
            <p class="text-gray-700 leading-relaxed">
              Some browsers include a "Do Not Track" (DNT) feature that signals to websites you visit that you do not want to have your online activity tracked. Currently, there is no standard for how DNT signals should be interpreted. As a result, our Service does not currently respond to DNT browser signals or mechanisms. However, you can control cookies through your browser settings as described above.
            </p>
          </section>

          <section>
            <h2 class="text-2xl font-bold text-gray-900 mb-4">9. Updates to This Cookie Policy</h2>
            <p class="text-gray-700 leading-relaxed">
              We may update this Cookie Policy from time to time to reflect changes in our practices or for other operational, legal, or regulatory reasons. We will notify you of any material changes by posting the new Cookie Policy on this page and updating the "Last updated" date. We encourage you to review this Cookie Policy periodically to stay informed about our use of cookies.
            </p>
          </section>

          <section>
            <h2 class="text-2xl font-bold text-gray-900 mb-4">10. Contact Us</h2>
            <p class="text-gray-700 leading-relaxed mb-4">
              If you have any questions about this Cookie Policy or our use of cookies, please contact us:
            </p>
            <div class="bg-gray-50 rounded-lg p-6">
              <p class="text-gray-700 mb-2"><strong>Website:</strong> <a href="https://voiceactions.dev" target="_blank" rel="noopener noreferrer" class="text-blue-600 hover:underline font-semibold">voiceactions.dev</a></p>
              <p class="text-gray-700 mb-2"><strong>Email:</strong> <a href="mailto:privacy@voiceactions.io" class="text-blue-600 hover:underline">privacy@voiceactions.io</a></p>
              <p class="text-gray-700 mb-2"><strong>Support:</strong> <a href="mailto:support@voiceactions.io" class="text-blue-600 hover:underline">support@voiceactions.io</a></p>
              <p class="text-gray-700"><strong>Address:</strong> Voice Actions SDK, Privacy Department</p>
            </div>
          </section>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'

const lastUpdated = ref('')

onMounted(() => {
  lastUpdated.value = new Date().toLocaleDateString('en-US', { 
    year: 'numeric', 
    month: 'long', 
    day: 'numeric' 
  })
})
</script>

<style scoped>
.prose {
  color: inherit;
}

.prose h2 {
  margin-top: 2rem;
  margin-bottom: 1rem;
}

.prose h3 {
  margin-top: 1.5rem;
  margin-bottom: 0.75rem;
}

.prose section {
  margin-bottom: 2rem;
}

table {
  font-size: 0.875rem;
}

table th {
  font-weight: 600;
}

table td {
  vertical-align: top;
}
</style>

