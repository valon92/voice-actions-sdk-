<template>
  <div class="min-h-screen py-12 px-4 bg-gradient-to-br from-slate-50 via-blue-50 to-purple-50">
    <div class="max-w-4xl mx-auto">
      <div class="bg-white rounded-2xl shadow-xl p-6 sm:p-8 lg:p-10">
        <div class="text-center mb-8">
          <div class="inline-flex items-center justify-center w-16 h-16 mb-4 rounded-2xl bg-gradient-to-br from-orange-500 to-red-500 shadow-lg">
            <span class="text-3xl">📜</span>
          </div>
          <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-3">Terms of Service</h1>
          <p class="text-gray-600">Last updated: {{ lastUpdated }}</p>
        </div>

        <div class="prose prose-lg max-w-none space-y-8">
          <section>
            <h2 class="text-2xl font-bold text-gray-900 mb-4">1. Acceptance of Terms</h2>
            <p class="text-gray-700 leading-relaxed">
              By accessing and using Voice Actions SDK ("Service"), you accept and agree to be bound by the terms and provision of this agreement. If you do not agree to abide by the above, please do not use this Service.
            </p>
          </section>

          <section>
            <h2 class="text-2xl font-bold text-gray-900 mb-4">2. Description of Service</h2>
            <p class="text-gray-700 leading-relaxed mb-4">
              Voice Actions SDK provides a voice control software development kit that enables web applications to process voice commands in multiple languages. The Service includes:
            </p>
            <ul class="list-disc pl-6 space-y-2 text-gray-700">
              <li>JavaScript SDK for voice command integration</li>
              <li>RESTful API for command processing and management</li>
              <li>Multi-language support (English, Albanian, Spanish, French, and more)</li>
              <li>Usage analytics and statistics</li>
              <li>Documentation and developer resources</li>
            </ul>
          </section>

          <section>
            <h2 class="text-2xl font-bold text-gray-900 mb-4">3. Account Registration and Security</h2>
            <h3 class="text-xl font-semibold text-gray-900 mb-3">3.1 Registration</h3>
            <p class="text-gray-700 leading-relaxed mb-4">
              To use certain features of the Service, you must register for an account and provide accurate, current, and complete information. You are responsible for maintaining the confidentiality of your account credentials, including your API keys.
            </p>
            <h3 class="text-xl font-semibold text-gray-900 mb-3">3.2 Account Security</h3>
            <p class="text-gray-700 leading-relaxed">
              You are responsible for all activities that occur under your account. You must immediately notify us of any unauthorized use of your account or any other breach of security.
            </p>
          </section>

          <section>
            <h2 class="text-2xl font-bold text-gray-900 mb-4">4. Acceptable Use</h2>
            <p class="text-gray-700 leading-relaxed mb-4">You agree not to use the Service:</p>
            <ul class="list-disc pl-6 space-y-2 text-gray-700">
              <li>For any illegal purpose or in violation of any laws</li>
              <li>To transmit any malicious code, viruses, or harmful software</li>
              <li>To attempt to gain unauthorized access to our systems or networks</li>
              <li>To interfere with or disrupt the Service or servers</li>
              <li>To abuse, harass, threaten, or harm others</li>
              <li>To violate any intellectual property rights</li>
              <li>To collect or store personal data about other users without consent</li>
              <li>To exceed your plan's rate limits or attempt to circumvent usage restrictions</li>
            </ul>
          </section>

          <section>
            <h2 class="text-2xl font-bold text-gray-900 mb-4">5. Service Plans and Pricing</h2>
            <h3 class="text-xl font-semibold text-gray-900 mb-3">5.1 Plans</h3>
            <p class="text-gray-700 leading-relaxed mb-4">
              We offer multiple service plans (Free, Pro, Enterprise) with different features, usage limits, and pricing. Plan details are available on our Pricing page and may be updated from time to time.
            </p>
            <h3 class="text-xl font-semibold text-gray-900 mb-3">5.2 Payment</h3>
            <p class="text-gray-700 leading-relaxed mb-4">
              For paid plans, you agree to pay all fees associated with your selected plan. Payments are processed through secure third-party payment processors. All fees are non-refundable except as required by law.
            </p>
            <h3 class="text-xl font-semibold text-gray-900 mb-3">5.3 Plan Changes</h3>
            <p class="text-gray-700 leading-relaxed">
              You may upgrade or downgrade your plan at any time. Plan changes take effect immediately, and billing adjustments will be prorated.
            </p>
          </section>

          <section>
            <h2 class="text-2xl font-bold text-gray-900 mb-4">6. Rate Limiting and Usage</h2>
            <p class="text-gray-700 leading-relaxed mb-4">
              Your use of the Service is subject to rate limits based on your plan. We reserve the right to:
            </p>
            <ul class="list-disc pl-6 space-y-2 text-gray-700">
              <li>Throttle or suspend your access if you exceed your plan's limits</li>
              <li>Implement rate limiting to ensure fair usage and system stability</li>
              <li>Modify rate limits with reasonable notice</li>
            </ul>
          </section>

          <section>
            <h2 class="text-2xl font-bold text-gray-900 mb-4">7. Intellectual Property</h2>
            <h3 class="text-xl font-semibold text-gray-900 mb-3">7.1 Our Rights</h3>
            <p class="text-gray-700 leading-relaxed mb-4">
              The Service, including all content, features, functionality, and technology, is owned by Voice Actions SDK and is protected by copyright, trademark, and other intellectual property laws.
            </p>
            <h3 class="text-xl font-semibold text-gray-900 mb-3">7.2 License to Use</h3>
            <p class="text-gray-700 leading-relaxed">
              We grant you a limited, non-exclusive, non-transferable license to use the SDK and API in accordance with these Terms. This license does not include the right to resell, redistribute, or create derivative works for commercial purposes without our written consent.
            </p>
          </section>

          <section>
            <h2 class="text-2xl font-bold text-gray-900 mb-4">8. Service Availability and Modifications</h2>
            <p class="text-gray-700 leading-relaxed mb-4">
              We strive to maintain high availability of the Service but do not guarantee uninterrupted access. We may:
            </p>
            <ul class="list-disc pl-6 space-y-2 text-gray-700">
              <li>Perform scheduled maintenance with advance notice</li>
              <li>Modify, suspend, or discontinue features at any time</li>
              <li>Update the Service to improve functionality or security</li>
            </ul>
            <p class="text-gray-700 leading-relaxed mt-4">
              Enterprise plans include SLA guarantees as specified in your service agreement.
            </p>
          </section>

          <section>
            <h2 class="text-2xl font-bold text-gray-900 mb-4">9. Data and Privacy</h2>
            <p class="text-gray-700 leading-relaxed">
              Your use of the Service is also governed by our Privacy Policy. By using the Service, you consent to the collection and use of information as described in the Privacy Policy. We do not store or process voice recordings; voice recognition is performed client-side.
            </p>
          </section>

          <section>
            <h2 class="text-2xl font-bold text-gray-900 mb-4">10. Termination</h2>
            <h3 class="text-xl font-semibold text-gray-900 mb-3">10.1 By You</h3>
            <p class="text-gray-700 leading-relaxed mb-4">
              You may terminate your account at any time by contacting us or using the account deletion feature in your dashboard.
            </p>
            <h3 class="text-xl font-semibold text-gray-900 mb-3">10.2 By Us</h3>
            <p class="text-gray-700 leading-relaxed">
              We may suspend or terminate your account immediately if you violate these Terms, engage in fraudulent activity, or fail to pay required fees.
            </p>
          </section>

          <section>
            <h2 class="text-2xl font-bold text-gray-900 mb-4">11. Disclaimers and Limitations of Liability</h2>
            <h3 class="text-xl font-semibold text-gray-900 mb-3">11.1 Disclaimer</h3>
            <p class="text-gray-700 leading-relaxed mb-4">
              THE SERVICE IS PROVIDED "AS IS" AND "AS AVAILABLE" WITHOUT WARRANTIES OF ANY KIND, EITHER EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE, OR NON-INFRINGEMENT.
            </p>
            <h3 class="text-xl font-semibold text-gray-900 mb-3">11.2 Limitation of Liability</h3>
            <p class="text-gray-700 leading-relaxed">
              TO THE MAXIMUM EXTENT PERMITTED BY LAW, WE SHALL NOT BE LIABLE FOR ANY INDIRECT, INCIDENTAL, SPECIAL, CONSEQUENTIAL, OR PUNITIVE DAMAGES, OR ANY LOSS OF PROFITS OR REVENUES, WHETHER INCURRED DIRECTLY OR INDIRECTLY, OR ANY LOSS OF DATA, USE, GOODWILL, OR OTHER INTANGIBLE LOSSES.
            </p>
          </section>

          <section>
            <h2 class="text-2xl font-bold text-gray-900 mb-4">12. Indemnification</h2>
            <p class="text-gray-700 leading-relaxed">
              You agree to indemnify and hold harmless Voice Actions SDK, its officers, directors, employees, and agents from any claims, damages, losses, liabilities, and expenses (including legal fees) arising out of or relating to your use of the Service, violation of these Terms, or infringement of any rights of another.
            </p>
          </section>

          <section>
            <h2 class="text-2xl font-bold text-gray-900 mb-4">13. Governing Law</h2>
            <p class="text-gray-700 leading-relaxed">
              These Terms shall be governed by and construed in accordance with the laws of the jurisdiction in which Voice Actions SDK operates, without regard to its conflict of law provisions.
            </p>
          </section>

          <section>
            <h2 class="text-2xl font-bold text-gray-900 mb-4">14. Changes to Terms</h2>
            <p class="text-gray-700 leading-relaxed">
              We reserve the right to modify these Terms at any time. We will notify you of material changes by posting the updated Terms on this page and updating the "Last updated" date. Your continued use of the Service after such changes constitutes acceptance of the new Terms.
            </p>
          </section>

          <section>
            <h2 class="text-2xl font-bold text-gray-900 mb-4">15. Contact Information</h2>
            <p class="text-gray-700 leading-relaxed mb-4">
              If you have any questions about these Terms of Service, please contact us:
            </p>
            <div class="bg-gray-50 rounded-lg p-6">
              <p class="text-gray-700 mb-2"><strong>Website:</strong> <a href="https://voiceactions.dev" target="_blank" rel="noopener noreferrer" class="text-blue-600 hover:underline font-semibold">voiceactions.dev</a></p>
              <p class="text-gray-700 mb-2"><strong>Email:</strong> <a href="mailto:legal@voiceactions.io" class="text-blue-600 hover:underline">legal@voiceactions.io</a></p>
              <p class="text-gray-700 mb-2"><strong>Support:</strong> <a href="mailto:support@voiceactions.io" class="text-blue-600 hover:underline">support@voiceactions.io</a></p>
              <p class="text-gray-700"><strong>Address:</strong> Voice Actions SDK, Legal Department</p>
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

