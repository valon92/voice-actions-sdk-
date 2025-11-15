<template>
  <div class="min-h-screen py-12 px-4 bg-gradient-to-br from-slate-50 via-blue-50 to-purple-50">
    <div class="max-w-4xl mx-auto">
      <div class="bg-white rounded-2xl shadow-xl p-6 sm:p-8 lg:p-10">
        <div class="text-center mb-8">
          <div class="inline-flex items-center justify-center w-16 h-16 mb-4 rounded-2xl bg-gradient-to-br from-green-500 to-emerald-500 shadow-lg">
            <span class="text-3xl">🔒</span>
          </div>
          <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-3">Privacy Policy</h1>
          <p class="text-gray-600">Last updated: {{ lastUpdated }}</p>
        </div>

        <div class="prose prose-lg max-w-none space-y-8">
          <section>
            <h2 class="text-2xl font-bold text-gray-900 mb-4">1. Introduction</h2>
            <p class="text-gray-700 leading-relaxed mb-4">
              Voice Actions SDK ("we," "our," or "us") is committed to protecting your privacy. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you use our voice control SDK and related services (collectively, the "Service").
            </p>
            <p class="text-gray-700 leading-relaxed">
              By using our Service, you agree to the collection and use of information in accordance with this policy. If you do not agree with our policies and practices, do not use our Service.
            </p>
          </section>

          <section>
            <h2 class="text-2xl font-bold text-gray-900 mb-4">2. Information We Collect</h2>
            
            <h3 class="text-xl font-semibold text-gray-900 mb-3">2.1 Information You Provide</h3>
            <ul class="list-disc pl-6 space-y-2 text-gray-700">
              <li><strong>Account Information:</strong> Name, email address, company name, and contact details when you register for an account</li>
              <li><strong>API Keys:</strong> Generated API keys for accessing our services</li>
              <li><strong>Payment Information:</strong> Billing details processed through secure third-party payment processors</li>
              <li><strong>Support Communications:</strong> Information you provide when contacting our support team</li>
            </ul>

            <h3 class="text-xl font-semibold text-gray-900 mb-3 mt-6">2.2 Automatically Collected Information</h3>
            <ul class="list-disc pl-6 space-y-2 text-gray-700">
              <li><strong>Usage Data:</strong> API call logs, command execution statistics, and service usage patterns</li>
              <li><strong>Technical Data:</strong> IP addresses, browser type, device information, and operating system</li>
              <li><strong>Performance Data:</strong> Response times, error rates, and system performance metrics</li>
            </ul>

            <h3 class="text-xl font-semibold text-gray-900 mb-3 mt-6">2.3 Voice Data</h3>
            <p class="text-gray-700 leading-relaxed">
              Our SDK processes voice commands locally in your browser or application. We do not store, record, or transmit your voice data to our servers. Voice recognition is performed client-side using the Web Speech API, and only recognized text commands are sent to our API for processing.
            </p>
          </section>

          <section>
            <h2 class="text-2xl font-bold text-gray-900 mb-4">3. How We Use Your Information</h2>
            <p class="text-gray-700 leading-relaxed mb-4">We use the collected information for the following purposes:</p>
            <ul class="list-disc pl-6 space-y-2 text-gray-700">
              <li>To provide, maintain, and improve our Service</li>
              <li>To process transactions and manage your account</li>
              <li>To send you service-related notifications and updates</li>
              <li>To respond to your inquiries and provide customer support</li>
              <li>To monitor and analyze usage patterns and trends</li>
              <li>To detect, prevent, and address technical issues and security threats</li>
              <li>To comply with legal obligations and enforce our terms</li>
            </ul>
          </section>

          <section>
            <h2 class="text-2xl font-bold text-gray-900 mb-4">4. Data Sharing and Disclosure</h2>
            <p class="text-gray-700 leading-relaxed mb-4">We do not sell, trade, or rent your personal information to third parties. We may share your information only in the following circumstances:</p>
            <ul class="list-disc pl-6 space-y-2 text-gray-700">
              <li><strong>Service Providers:</strong> With trusted third-party service providers who assist in operating our Service (e.g., payment processors, hosting providers)</li>
              <li><strong>Legal Requirements:</strong> When required by law, court order, or government regulation</li>
              <li><strong>Business Transfers:</strong> In connection with a merger, acquisition, or sale of assets</li>
              <li><strong>With Your Consent:</strong> When you explicitly authorize us to share your information</li>
            </ul>
          </section>

          <section>
            <h2 class="text-2xl font-bold text-gray-900 mb-4">5. Data Security</h2>
            <p class="text-gray-700 leading-relaxed mb-4">
              We implement industry-standard security measures to protect your information, including:
            </p>
            <ul class="list-disc pl-6 space-y-2 text-gray-700">
              <li>Encryption of data in transit using TLS/SSL</li>
              <li>Secure API key storage and authentication</li>
              <li>Regular security audits and vulnerability assessments</li>
              <li>Access controls and authentication mechanisms</li>
              <li>Monitoring and logging of security events</li>
            </ul>
            <p class="text-gray-700 leading-relaxed mt-4">
              However, no method of transmission over the Internet or electronic storage is 100% secure. While we strive to use commercially acceptable means to protect your information, we cannot guarantee absolute security.
            </p>
          </section>

          <section>
            <h2 class="text-2xl font-bold text-gray-900 mb-4">6. Your Rights and Choices</h2>
            <p class="text-gray-700 leading-relaxed mb-4">You have the following rights regarding your personal information:</p>
            <ul class="list-disc pl-6 space-y-2 text-gray-700">
              <li><strong>Access:</strong> Request access to your personal information</li>
              <li><strong>Correction:</strong> Request correction of inaccurate or incomplete information</li>
              <li><strong>Deletion:</strong> Request deletion of your personal information</li>
              <li><strong>Portability:</strong> Request a copy of your data in a portable format</li>
              <li><strong>Opt-Out:</strong> Unsubscribe from marketing communications</li>
              <li><strong>Account Closure:</strong> Close your account at any time</li>
            </ul>
            <p class="text-gray-700 leading-relaxed mt-4">
              To exercise these rights, please contact us at <a href="mailto:privacy@voiceactions.io" class="text-blue-600 hover:underline">privacy@voiceactions.io</a>
            </p>
          </section>

          <section>
            <h2 class="text-2xl font-bold text-gray-900 mb-4">7. Cookies and Tracking Technologies</h2>
            <p class="text-gray-700 leading-relaxed mb-4">
              We use cookies and similar tracking technologies to track activity on our Service and store certain information. You can instruct your browser to refuse all cookies or to indicate when a cookie is being sent. However, if you do not accept cookies, you may not be able to use some portions of our Service.
            </p>
          </section>

          <section>
            <h2 class="text-2xl font-bold text-gray-900 mb-4">8. Children's Privacy</h2>
            <p class="text-gray-700 leading-relaxed">
              Our Service is not intended for children under the age of 13. We do not knowingly collect personal information from children under 13. If you are a parent or guardian and believe your child has provided us with personal information, please contact us immediately.
            </p>
          </section>

          <section>
            <h2 class="text-2xl font-bold text-gray-900 mb-4">9. International Data Transfers</h2>
            <p class="text-gray-700 leading-relaxed">
              Your information may be transferred to and maintained on computers located outside of your state, province, country, or other governmental jurisdiction where data protection laws may differ. By using our Service, you consent to the transfer of your information to our facilities and those third parties with whom we share it as described in this policy.
            </p>
          </section>

          <section>
            <h2 class="text-2xl font-bold text-gray-900 mb-4">10. Changes to This Privacy Policy</h2>
            <p class="text-gray-700 leading-relaxed">
              We may update our Privacy Policy from time to time. We will notify you of any changes by posting the new Privacy Policy on this page and updating the "Last updated" date. You are advised to review this Privacy Policy periodically for any changes.
            </p>
          </section>

          <section>
            <h2 class="text-2xl font-bold text-gray-900 mb-4">11. Contact Us</h2>
            <p class="text-gray-700 leading-relaxed mb-4">
              If you have any questions about this Privacy Policy, please contact us:
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
const lastUpdated = new Date().toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' })
</script>

