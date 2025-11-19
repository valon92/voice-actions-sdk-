<template>
  <div class="min-h-screen bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900 relative overflow-hidden">
    <!-- Animated Background -->
    <div class="absolute inset-0 overflow-hidden">
      <div class="absolute -top-40 -right-40 w-80 h-80 bg-purple-500 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob"></div>
      <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-blue-500 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-2000"></div>
      <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-80 h-80 bg-pink-500 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-4000"></div>
    </div>

    <div class="relative z-10 py-8 sm:py-12 px-4">
      <div class="max-w-7xl mx-auto">
        <!-- Header Section -->
        <div class="text-center mb-12 sm:mb-16">
          <div class="inline-flex items-center justify-center w-20 h-20 sm:w-24 sm:h-24 mb-6 rounded-2xl bg-gradient-to-br from-purple-500 to-pink-500 shadow-2xl shadow-purple-500/50 animate-pulse-slow">
            <span class="text-4xl sm:text-5xl">🎤</span>
          </div>
          <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-extrabold text-white mb-4 bg-clip-text text-transparent bg-gradient-to-r from-white via-purple-200 to-pink-200">
            Voice Actions SDK Demo
          </h1>
          <p class="text-lg sm:text-xl text-purple-200 max-w-3xl mx-auto leading-relaxed mb-6">
            Experience <strong class="text-white">600+ universal voice commands</strong> covering all social media, e-commerce, gaming, technology, education, communication, development, AND AI platform features. Works with Facebook, Instagram, TikTok, X, Amazon, eBay, Steam, Windows, macOS, Android, iOS, AWS, GitHub, Coursera, Udemy, Slack, Discord, Teams, Zoom, Vercel, Netlify, ChatGPT, Gemini, Claude, and more!
          </p>
          <!-- Benefits Badge -->
          <div class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-green-500/20 to-emerald-500/20 backdrop-blur-sm border border-green-400/30 rounded-full">
            <span class="text-2xl">✨</span>
            <span class="text-green-200 font-semibold">600+ Universal Commands</span>
            <span class="text-green-300 text-sm">|</span>
            <span class="text-green-200 font-semibold">English</span>
            <span class="text-green-300 text-sm">|</span>
            <span class="text-green-200 font-semibold">Any Platform</span>
          </div>
        </div>

        <!-- Benefits Section -->
        <div class="backdrop-blur-xl bg-white/10 rounded-3xl shadow-2xl border border-white/20 p-6 sm:p-8 mb-8 backdrop-saturate-150">
          <h2 class="text-3xl sm:text-4xl font-bold mb-6 bg-clip-text text-transparent bg-gradient-to-r from-yellow-400 to-orange-500 flex items-center gap-3">
            <span class="text-4xl">💎</span>
            <span>Why Choose Voice Actions SDK?</span>
          </h2>
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="p-6 bg-gradient-to-br from-blue-500/20 to-cyan-500/20 rounded-2xl border border-blue-400/30 backdrop-blur-sm">
              <div class="text-4xl mb-3">🌐</div>
              <h3 class="text-xl font-bold text-white mb-2">Universal Commands</h3>
              <p class="text-blue-200 text-sm">600+ commands that work across all platforms - Social Media (Facebook, Instagram, TikTok, X), E-Commerce (Amazon, eBay, Shopify), Gaming (Steam, Epic, Xbox, PlayStation), Technology (Windows, macOS, Android, iOS, AWS, GitHub), Education (Coursera, Udemy, Khan Academy), Communication (Slack, Discord, Teams, Zoom), Development (GitHub, GitLab, Vercel, Netlify), AND AI Platforms (ChatGPT, Gemini, Claude, Midjourney, Runway ML)!</p>
            </div>
            <div class="p-6 bg-gradient-to-br from-purple-500/20 to-pink-500/20 rounded-2xl border border-purple-400/30 backdrop-blur-sm">
              <div class="text-4xl mb-3">🌍</div>
              <h3 class="text-xl font-bold text-white mb-2">Multi-Language</h3>
              <p class="text-purple-200 text-sm">Supports English. More languages will be added gradually.</p>
            </div>
            <div class="p-6 bg-gradient-to-br from-green-500/20 to-emerald-500/20 rounded-2xl border border-green-400/30 backdrop-blur-sm">
              <div class="text-4xl mb-3">⚡</div>
              <h3 class="text-xl font-bold text-white mb-2">Easy Integration</h3>
              <p class="text-green-200 text-sm">Simple SDK integration - just add a script tag and start using voice commands in minutes!</p>
            </div>
            <div class="p-6 bg-gradient-to-br from-orange-500/20 to-amber-500/20 rounded-2xl border border-orange-400/30 backdrop-blur-sm">
              <div class="text-4xl mb-3">🎯</div>
              <h3 class="text-xl font-bold text-white mb-2">Comprehensive Coverage</h3>
              <p class="text-orange-200 text-sm">Covers ALL features: Social Media (Profile, Content, Interactions, Messaging), E-Commerce (Account, Search, Orders, Payments, Shipping, Reviews, Loyalty, Returns, Seller), Gaming (Account, Discovery, Download, Gameplay, Library, Social, Achievements, Purchases, Security, Refunds, UX, Devices), Technology (OS, Mobile, Cloud, Developer, Common Features), Education (Student Actions, Instructor Actions, Common Features), Communication (Chat, Calls, Groups, Files, Notifications, Collaboration, Integrations, Security, Admin, Common Features), Development (Project, Collaboration, Deploy, Integration, Version Control, Testing, Security, Package, Environment, Admin, Common Features), AND AI Platforms (Interaction, Multimodal Generation, Personalization, Integration, Data Analysis, Security, Payment, Development, Analytics, Learning)!</p>
            </div>
            <div class="p-6 bg-gradient-to-br from-red-500/20 to-rose-500/20 rounded-2xl border border-red-400/30 backdrop-blur-sm">
              <div class="text-4xl mb-3">🔒</div>
              <h3 class="text-xl font-bold text-white mb-2">Secure & Private</h3>
              <p class="text-red-200 text-sm">API key authentication, usage tracking, and secure command processing. Your data stays private.</p>
            </div>
            <div class="p-6 bg-gradient-to-br from-indigo-500/20 to-violet-500/20 rounded-2xl border border-indigo-400/30 backdrop-blur-sm">
              <div class="text-4xl mb-3">📊</div>
              <h3 class="text-xl font-bold text-white mb-2">Usage Analytics</h3>
              <p class="text-indigo-200 text-sm">Track command usage, monitor performance, and optimize your voice control implementation.</p>
            </div>
          </div>
        </div>

        <!-- Voice Control Card -->
        <div class="backdrop-blur-xl bg-white/10 rounded-3xl shadow-2xl border border-white/20 p-6 sm:p-8 mb-8 backdrop-saturate-150">
          <div class="flex flex-col lg:flex-row items-center justify-between gap-6 mb-6">
            <!-- Modern Voice Icon with Visual Feedback -->
            <div class="flex flex-col items-center gap-4">
              <button
                @click="toggleListening"
                :class="[
                  'group relative w-24 h-24 sm:w-28 sm:h-28 rounded-full font-bold text-white transition-all duration-300 shadow-2xl transform hover:scale-110 active:scale-95 flex items-center justify-center',
                  isListening 
                    ? 'bg-gradient-to-br from-red-500 via-red-600 to-red-700 hover:from-red-600 hover:via-red-700 hover:to-red-800' 
                    : 'bg-gradient-to-br from-green-500 via-emerald-600 to-teal-700 hover:from-green-600 hover:via-emerald-700 hover:to-teal-800'
                ]"
              >
                <!-- Animated Ripple Effect when listening -->
                <div v-if="isListening" class="absolute inset-0 rounded-full bg-red-400 opacity-30 animate-ping"></div>
                <div v-if="isListening" class="absolute inset-0 rounded-full bg-red-500 opacity-20 animate-pulse"></div>
                
                <!-- Microphone Icon -->
                <svg 
                  :class="[
                    'relative z-10 w-12 h-12 sm:w-14 sm:h-14 transition-all duration-300',
                    isListening ? 'text-white animate-pulse' : 'text-white'
                  ]"
                  fill="none" 
                  stroke="currentColor" 
                  viewBox="0 0 24 24"
                >
                  <path 
                    v-if="!isListening"
                    stroke-linecap="round" 
                    stroke-linejoin="round" 
                    stroke-width="2" 
                    d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"
                  />
                  <path 
                    v-else
                    stroke-linecap="round" 
                    stroke-linejoin="round" 
                    stroke-width="2" 
                    d="M5.636 18.364a9 9 0 010-12.728m12.728 0a9 9 0 010 12.728m-9.9-2.829a5 5 0 010-7.07m7.072 0a5 5 0 010 7.07M13 11a1 1 0 11-2 0 1 1 0 012 0z"
                  />
                </svg>
                
                <!-- Voice Level Indicator (animated waves) -->
                <div v-if="isListening" class="absolute inset-0 flex items-center justify-center">
                  <div class="flex items-end gap-1 h-12">
                    <div class="w-1 bg-white rounded-full animate-wave" style="animation-delay: 0s; height: 20%;"></div>
                    <div class="w-1 bg-white rounded-full animate-wave" style="animation-delay: 0.1s; height: 40%;"></div>
                    <div class="w-1 bg-white rounded-full animate-wave" style="animation-delay: 0.2s; height: 60%;"></div>
                    <div class="w-1 bg-white rounded-full animate-wave" style="animation-delay: 0.3s; height: 80%;"></div>
                    <div class="w-1 bg-white rounded-full animate-wave" style="animation-delay: 0.4s; height: 100%;"></div>
                  </div>
                </div>
              </button>
              
              <!-- Status Text -->
              <div class="text-center">
                <p v-if="isListening" class="text-green-300 font-semibold text-sm sm:text-base flex items-center justify-center gap-2">
                  <span class="relative flex items-center justify-center">
                    <span class="absolute w-2 h-2 bg-green-400 rounded-full animate-ping"></span>
                    <span class="relative w-2 h-2 bg-green-400 rounded-full"></span>
                  </span>
                  Listening...
                </p>
                <p v-else class="text-purple-300 font-medium text-sm sm:text-base">
                  Click to start
                </p>
              </div>
            </div>
            
            <!-- Language Selector -->
            <div class="relative">
              <select
                v-model="selectedLocale"
                @change="changeLocale"
                class="appearance-none px-6 py-3 pr-10 bg-white/10 backdrop-blur-sm border border-white/20 rounded-xl text-white font-semibold focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all cursor-pointer hover:bg-white/20"
              >
                <option value="en-US" class="bg-slate-900">🇺🇸 English</option>
              </select>
              <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
              </div>
            </div>
          </div>

          <!-- Transcript Display with Voice Waveform -->
          <Transition name="slide-up">
            <div v-if="lastTranscript || isListening" class="mb-4 p-5 bg-gradient-to-r from-purple-500/20 to-pink-500/20 backdrop-blur-sm rounded-2xl border border-white/10">
              <div v-if="lastTranscript">
                <p class="text-sm text-purple-200 mb-2 font-medium">Last command:</p>
                <p class="text-2xl font-bold text-white animate-fade-in">{{ lastTranscript }}</p>
              </div>
              <div v-else-if="isListening" class="flex items-center gap-3">
                <div class="flex items-end gap-1 h-8">
                  <div class="w-1.5 bg-purple-400 rounded-full animate-wave" style="animation-delay: 0s; height: 30%;"></div>
                  <div class="w-1.5 bg-purple-400 rounded-full animate-wave" style="animation-delay: 0.1s; height: 50%;"></div>
                  <div class="w-1.5 bg-purple-400 rounded-full animate-wave" style="animation-delay: 0.2s; height: 70%;"></div>
                  <div class="w-1.5 bg-purple-400 rounded-full animate-wave" style="animation-delay: 0.3s; height: 90%;"></div>
                  <div class="w-1.5 bg-purple-400 rounded-full animate-wave" style="animation-delay: 0.4s; height: 100%;"></div>
                  <div class="w-1.5 bg-purple-400 rounded-full animate-wave" style="animation-delay: 0.5s; height: 60%;"></div>
                  <div class="w-1.5 bg-purple-400 rounded-full animate-wave" style="animation-delay: 0.6s; height: 40%;"></div>
                </div>
                <p class="text-lg text-purple-200 font-medium">Waiting for voice command...</p>
              </div>
            </div>
          </Transition>

          <!-- Status Messages -->
          <Transition name="fade">
            <div v-if="statusMessage" :class="[
              'p-4 rounded-2xl mb-4 backdrop-blur-sm border',
              statusMessageType === 'success' ? 'bg-green-500/20 text-green-200 border-green-400/30' : 
              statusMessageType === 'error' ? 'bg-red-500/20 text-red-200 border-red-400/30' : 
              'bg-blue-500/20 text-blue-200 border-blue-400/30'
            ]">
              <div class="flex items-start gap-3">
                <span class="text-2xl flex-shrink-0">
                  <span v-if="statusMessageType === 'success'">✅</span>
                  <span v-else-if="statusMessageType === 'error'">⚠️</span>
                  <span v-else>ℹ️</span>
                </span>
                <div class="flex-1">
                  <p class="font-semibold mb-2">{{ statusMessage }}</p>
                  <!-- Show permission instructions for permission errors -->
                  <div v-if="statusMessageType === 'error' && statusMessage.includes('permission')" class="mt-3 text-sm space-y-2">
                    <p class="font-semibold text-white mb-2">How to allow microphone access:</p>
                    <ul class="list-disc list-inside space-y-1 text-gray-300 ml-2">
                      <li><strong>Chrome/Edge:</strong> Click the lock icon 🔒 in the address bar → Site settings → Microphone → Allow</li>
                      <li><strong>Firefox:</strong> Click the shield icon 🛡️ in the address bar → Permissions → Microphone → Allow</li>
                      <li><strong>Safari:</strong> Safari → Settings → Websites → Microphone → Allow for this site</li>
                      <li><strong>Or:</strong> Go to your browser settings and search for "microphone" or "site permissions"</li>
                    </ul>
                    <button 
                      @click="requestPermissionAgain"
                      class="mt-3 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-medium transition transform hover:scale-105"
                    >
                      🔄 Try Again
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </Transition>
        </div>

        <!-- Commands Grid - All Categories -->
        <div class="mb-8">
          <h2 class="text-3xl sm:text-4xl font-bold mb-6 bg-clip-text text-transparent bg-gradient-to-r from-cyan-400 to-blue-500 flex items-center gap-3">
            <span class="text-4xl">🎯</span>
            <span>All Voice Commands (600+)</span>
          </h2>
          <p class="text-purple-200 mb-6 text-lg">Click any command to simulate it, or say it out loud when listening is active!</p>
          
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            <!-- Profile Management -->
            <div class="group backdrop-blur-xl bg-white/10 rounded-3xl shadow-2xl border border-white/20 p-6 hover:bg-white/15 transition-all duration-300 hover:scale-105 hover:shadow-blue-500/20">
              <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-500 to-cyan-500 flex items-center justify-center text-2xl shadow-lg">👤</div>
                <h3 class="text-xl font-bold text-white">Profile</h3>
                <span class="text-xs text-purple-300/70 bg-purple-500/20 px-2 py-1 rounded-full">{{ profileCommands.length }}</span>
              </div>
              <div class="space-y-2 max-h-64 overflow-y-auto custom-scrollbar">
                <button v-for="cmd in profileCommands" :key="cmd.id" @click="simulateCommand(cmd)" class="w-full text-left px-3 py-2 bg-white/5 hover:bg-white/10 rounded-lg transition-all duration-200 border border-white/10 hover:border-white/20 group/btn text-sm">
                  <span class="font-semibold text-white block mb-1 group-hover/btn:text-blue-300 transition-colors">{{ cmd.name || cmd.id }}</span>
                  <span class="text-xs text-blue-300/70 line-clamp-1">{{ (cmd.phrases || []).slice(0, 2).join(', ') }}</span>
                </button>
              </div>
            </div>
            
            <!-- Content Posting -->
            <div class="group backdrop-blur-xl bg-white/10 rounded-3xl shadow-2xl border border-white/20 p-6 hover:bg-white/15 transition-all duration-300 hover:scale-105 hover:shadow-purple-500/20">
              <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-purple-500 to-pink-500 flex items-center justify-center text-2xl shadow-lg">📝</div>
                <h3 class="text-xl font-bold text-white">Content</h3>
                <span class="text-xs text-purple-300/70 bg-purple-500/20 px-2 py-1 rounded-full">{{ contentPostingCommands.length }}</span>
              </div>
              <div class="space-y-2 max-h-64 overflow-y-auto custom-scrollbar">
                <button v-for="cmd in contentPostingCommands" :key="cmd.id" @click="simulateCommand(cmd)" class="w-full text-left px-3 py-2 bg-white/5 hover:bg-white/10 rounded-lg transition-all duration-200 border border-white/10 hover:border-white/20 group/btn text-sm">
                  <span class="font-semibold text-white block mb-1 group-hover/btn:text-purple-300 transition-colors">{{ cmd.name || cmd.id }}</span>
                  <span class="text-xs text-purple-300/70 line-clamp-1">{{ (cmd.phrases || []).slice(0, 2).join(', ') }}</span>
                </button>
              </div>
            </div>
            
            <!-- Interactions -->
            <div class="group backdrop-blur-xl bg-white/10 rounded-3xl shadow-2xl border border-white/20 p-6 hover:bg-white/15 transition-all duration-300 hover:scale-105 hover:shadow-pink-500/20">
              <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-pink-500 to-rose-500 flex items-center justify-center text-2xl shadow-lg">💬</div>
                <h3 class="text-xl font-bold text-white">Interactions</h3>
                <span class="text-xs text-purple-300/70 bg-purple-500/20 px-2 py-1 rounded-full">{{ interactionCommands.length }}</span>
              </div>
              <div class="space-y-2 max-h-64 overflow-y-auto custom-scrollbar">
                <button v-for="cmd in interactionCommands" :key="cmd.id" @click="simulateCommand(cmd)" class="w-full text-left px-3 py-2 bg-white/5 hover:bg-white/10 rounded-lg transition-all duration-200 border border-white/10 hover:border-white/20 group/btn text-sm">
                  <span class="font-semibold text-white block mb-1 group-hover/btn:text-pink-300 transition-colors">{{ cmd.name || cmd.id }}</span>
                  <span class="text-xs text-pink-300/70 line-clamp-1">{{ (cmd.phrases || []).slice(0, 2).join(', ') }}</span>
                </button>
              </div>
            </div>
            
            <!-- Messaging & Calls -->
            <div class="group backdrop-blur-xl bg-white/10 rounded-3xl shadow-2xl border border-white/20 p-6 hover:bg-white/15 transition-all duration-300 hover:scale-105 hover:shadow-green-500/20">
              <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-green-500 to-emerald-500 flex items-center justify-center text-2xl shadow-lg">📩</div>
                <h3 class="text-xl font-bold text-white">Messaging</h3>
                <span class="text-xs text-purple-300/70 bg-purple-500/20 px-2 py-1 rounded-full">{{ messagingCommands.length }}</span>
              </div>
              <div class="space-y-2 max-h-64 overflow-y-auto custom-scrollbar">
                <button v-for="cmd in messagingCommands" :key="cmd.id" @click="simulateCommand(cmd)" class="w-full text-left px-3 py-2 bg-white/5 hover:bg-white/10 rounded-lg transition-all duration-200 border border-white/10 hover:border-white/20 group/btn text-sm">
                  <span class="font-semibold text-white block mb-1 group-hover/btn:text-green-300 transition-colors">{{ cmd.name || cmd.id }}</span>
                  <span class="text-xs text-green-300/70 line-clamp-1">{{ (cmd.phrases || []).slice(0, 2).join(', ') }}</span>
                </button>
              </div>
            </div>
            
            <!-- Privacy & Security -->
            <div class="group backdrop-blur-xl bg-white/10 rounded-3xl shadow-2xl border border-white/20 p-6 hover:bg-white/15 transition-all duration-300 hover:scale-105 hover:shadow-red-500/20">
              <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-red-500 to-orange-500 flex items-center justify-center text-2xl shadow-lg">🔒</div>
                <h3 class="text-xl font-bold text-white">Privacy</h3>
                <span class="text-xs text-purple-300/70 bg-purple-500/20 px-2 py-1 rounded-full">{{ privacyCommands.length }}</span>
              </div>
              <div class="space-y-2 max-h-64 overflow-y-auto custom-scrollbar">
                <button v-for="cmd in privacyCommands" :key="cmd.id" @click="simulateCommand(cmd)" class="w-full text-left px-3 py-2 bg-white/5 hover:bg-white/10 rounded-lg transition-all duration-200 border border-white/10 hover:border-white/20 group/btn text-sm">
                  <span class="font-semibold text-white block mb-1 group-hover/btn:text-red-300 transition-colors">{{ cmd.name || cmd.id }}</span>
                  <span class="text-xs text-red-300/70 line-clamp-1">{{ (cmd.phrases || []).slice(0, 2).join(', ') }}</span>
                </button>
              </div>
            </div>
            
            <!-- Analytics -->
            <div class="group backdrop-blur-xl bg-white/10 rounded-3xl shadow-2xl border border-white/20 p-6 hover:bg-white/15 transition-all duration-300 hover:scale-105 hover:shadow-indigo-500/20">
              <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-indigo-500 to-violet-500 flex items-center justify-center text-2xl shadow-lg">📊</div>
                <h3 class="text-xl font-bold text-white">Analytics</h3>
                <span class="text-xs text-purple-300/70 bg-purple-500/20 px-2 py-1 rounded-full">{{ analyticsCommands.length }}</span>
              </div>
              <div class="space-y-2 max-h-64 overflow-y-auto custom-scrollbar">
                <button v-for="cmd in analyticsCommands" :key="cmd.id" @click="simulateCommand(cmd)" class="w-full text-left px-3 py-2 bg-white/5 hover:bg-white/10 rounded-lg transition-all duration-200 border border-white/10 hover:border-white/20 group/btn text-sm">
                  <span class="font-semibold text-white block mb-1 group-hover/btn:text-indigo-300 transition-colors">{{ cmd.name || cmd.id }}</span>
                  <span class="text-xs text-indigo-300/70 line-clamp-1">{{ (cmd.phrases || []).slice(0, 2).join(', ') }}</span>
                </button>
              </div>
            </div>
            
            <!-- Monetization -->
            <div class="group backdrop-blur-xl bg-white/10 rounded-3xl shadow-2xl border border-white/20 p-6 hover:bg-white/15 transition-all duration-300 hover:scale-105 hover:shadow-yellow-500/20">
              <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-yellow-500 to-amber-500 flex items-center justify-center text-2xl shadow-lg">💰</div>
                <h3 class="text-xl font-bold text-white">Monetization</h3>
                <span class="text-xs text-purple-300/70 bg-purple-500/20 px-2 py-1 rounded-full">{{ monetizationCommands.length }}</span>
              </div>
              <div class="space-y-2 max-h-64 overflow-y-auto custom-scrollbar">
                <button v-for="cmd in monetizationCommands" :key="cmd.id" @click="simulateCommand(cmd)" class="w-full text-left px-3 py-2 bg-white/5 hover:bg-white/10 rounded-lg transition-all duration-200 border border-white/10 hover:border-white/20 group/btn text-sm">
                  <span class="font-semibold text-white block mb-1 group-hover/btn:text-yellow-300 transition-colors">{{ cmd.name || cmd.id }}</span>
                  <span class="text-xs text-yellow-300/70 line-clamp-1">{{ (cmd.phrases || []).slice(0, 2).join(', ') }}</span>
                </button>
              </div>
            </div>
            
            <!-- Live & Stories -->
            <div class="group backdrop-blur-xl bg-white/10 rounded-3xl shadow-2xl border border-white/20 p-6 hover:bg-white/15 transition-all duration-300 hover:scale-105 hover:shadow-red-500/20">
              <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-red-500 to-pink-500 flex items-center justify-center text-2xl shadow-lg">🎥</div>
                <h3 class="text-xl font-bold text-white">Live & Stories</h3>
                <span class="text-xs text-purple-300/70 bg-purple-500/20 px-2 py-1 rounded-full">{{ liveCommands.length }}</span>
              </div>
              <div class="space-y-2 max-h-64 overflow-y-auto custom-scrollbar">
                <button v-for="cmd in liveCommands" :key="cmd.id" @click="simulateCommand(cmd)" class="w-full text-left px-3 py-2 bg-white/5 hover:bg-white/10 rounded-lg transition-all duration-200 border border-white/10 hover:border-white/20 group/btn text-sm">
                  <span class="font-semibold text-white block mb-1 group-hover/btn:text-red-300 transition-colors">{{ cmd.name || cmd.id }}</span>
                  <span class="text-xs text-red-300/70 line-clamp-1">{{ (cmd.phrases || []).slice(0, 2).join(', ') }}</span>
                </button>
              </div>
            </div>
            
            <!-- User Experience -->
            <div class="group backdrop-blur-xl bg-white/10 rounded-3xl shadow-2xl border border-white/20 p-6 hover:bg-white/15 transition-all duration-300 hover:scale-105 hover:shadow-cyan-500/20">
              <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-cyan-500 to-blue-500 flex items-center justify-center text-2xl shadow-lg">✨</div>
                <h3 class="text-xl font-bold text-white">UX</h3>
                <span class="text-xs text-purple-300/70 bg-purple-500/20 px-2 py-1 rounded-full">{{ uxCommands.length }}</span>
              </div>
              <div class="space-y-2 max-h-64 overflow-y-auto custom-scrollbar">
                <button v-for="cmd in uxCommands" :key="cmd.id" @click="simulateCommand(cmd)" class="w-full text-left px-3 py-2 bg-white/5 hover:bg-white/10 rounded-lg transition-all duration-200 border border-white/10 hover:border-white/20 group/btn text-sm">
                  <span class="font-semibold text-white block mb-1 group-hover/btn:text-cyan-300 transition-colors">{{ cmd.name || cmd.id }}</span>
                  <span class="text-xs text-cyan-300/70 line-clamp-1">{{ (cmd.phrases || []).slice(0, 2).join(', ') }}</span>
                </button>
              </div>
            </div>
            
            <!-- Business Features -->
            <div class="group backdrop-blur-xl bg-white/10 rounded-3xl shadow-2xl border border-white/20 p-6 hover:bg-white/15 transition-all duration-300 hover:scale-105 hover:shadow-slate-500/20">
              <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-slate-500 to-gray-600 flex items-center justify-center text-2xl shadow-lg">🏢</div>
                <h3 class="text-xl font-bold text-white">Business</h3>
                <span class="text-xs text-purple-300/70 bg-purple-500/20 px-2 py-1 rounded-full">{{ businessCommands.length }}</span>
              </div>
              <div class="space-y-2 max-h-64 overflow-y-auto custom-scrollbar">
                <button v-for="cmd in businessCommands" :key="cmd.id" @click="simulateCommand(cmd)" class="w-full text-left px-3 py-2 bg-white/5 hover:bg-white/10 rounded-lg transition-all duration-200 border border-white/10 hover:border-white/20 group/btn text-sm">
                  <span class="font-semibold text-white block mb-1 group-hover/btn:text-slate-300 transition-colors">{{ cmd.name || cmd.id }}</span>
                  <span class="text-xs text-slate-300/70 line-clamp-1">{{ (cmd.phrases || []).slice(0, 2).join(', ') }}</span>
                </button>
              </div>
            </div>
            
            <!-- Navigation -->
            <div class="group backdrop-blur-xl bg-white/10 rounded-3xl shadow-2xl border border-white/20 p-6 hover:bg-white/15 transition-all duration-300 hover:scale-105 hover:shadow-blue-500/20">
              <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-500 to-indigo-500 flex items-center justify-center text-2xl shadow-lg">🧭</div>
                <h3 class="text-xl font-bold text-white">Navigation</h3>
                <span class="text-xs text-purple-300/70 bg-purple-500/20 px-2 py-1 rounded-full">{{ navigationCommands.length }}</span>
              </div>
              <div class="space-y-2 max-h-64 overflow-y-auto custom-scrollbar">
                <button v-for="cmd in navigationCommands" :key="cmd.id" @click="simulateCommand(cmd)" class="w-full text-left px-3 py-2 bg-white/5 hover:bg-white/10 rounded-lg transition-all duration-200 border border-white/10 hover:border-white/20 group/btn text-sm">
                  <span class="font-semibold text-white block mb-1 group-hover/btn:text-blue-300 transition-colors">{{ cmd.name || cmd.id }}</span>
                  <span class="text-xs text-blue-300/70 line-clamp-1">{{ (cmd.phrases || []).slice(0, 2).join(', ') }}</span>
                </button>
              </div>
            </div>
            
            <!-- Media Control -->
            <div class="group backdrop-blur-xl bg-white/10 rounded-3xl shadow-2xl border border-white/20 p-6 hover:bg-white/15 transition-all duration-300 hover:scale-105 hover:shadow-purple-500/20">
              <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-purple-500 to-indigo-500 flex items-center justify-center text-2xl shadow-lg">▶️</div>
                <h3 class="text-xl font-bold text-white">Media</h3>
                <span class="text-xs text-purple-300/70 bg-purple-500/20 px-2 py-1 rounded-full">{{ mediaCommands.length }}</span>
              </div>
              <div class="space-y-2 max-h-64 overflow-y-auto custom-scrollbar">
                <button v-for="cmd in mediaCommands" :key="cmd.id" @click="simulateCommand(cmd)" class="w-full text-left px-3 py-2 bg-white/5 hover:bg-white/10 rounded-lg transition-all duration-200 border border-white/10 hover:border-white/20 group/btn text-sm">
                  <span class="font-semibold text-white block mb-1 group-hover/btn:text-purple-300 transition-colors">{{ cmd.name || cmd.id }}</span>
                  <span class="text-xs text-purple-300/70 line-clamp-1">{{ (cmd.phrases || []).slice(0, 2).join(', ') }}</span>
                </button>
              </div>
            </div>
            
            <!-- Camera & Creation -->
            <div class="group backdrop-blur-xl bg-white/10 rounded-3xl shadow-2xl border border-white/20 p-6 hover:bg-white/15 transition-all duration-300 hover:scale-105 hover:shadow-green-500/20">
              <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-green-500 to-teal-500 flex items-center justify-center text-2xl shadow-lg">📷</div>
                <h3 class="text-xl font-bold text-white">Creation</h3>
                <span class="text-xs text-purple-300/70 bg-purple-500/20 px-2 py-1 rounded-full">{{ creationCommands.length }}</span>
              </div>
              <div class="space-y-2 max-h-64 overflow-y-auto custom-scrollbar">
                <button v-for="cmd in creationCommands" :key="cmd.id" @click="simulateCommand(cmd)" class="w-full text-left px-3 py-2 bg-white/5 hover:bg-white/10 rounded-lg transition-all duration-200 border border-white/10 hover:border-white/20 group/btn text-sm">
                  <span class="font-semibold text-white block mb-1 group-hover/btn:text-green-300 transition-colors">{{ cmd.name || cmd.id }}</span>
                  <span class="text-xs text-green-300/70 line-clamp-1">{{ (cmd.phrases || []).slice(0, 2).join(', ') }}</span>
                </button>
              </div>
            </div>
            
            <!-- Basic Actions -->
            <div class="group backdrop-blur-xl bg-white/10 rounded-3xl shadow-2xl border border-white/20 p-6 hover:bg-white/15 transition-all duration-300 hover:scale-105 hover:shadow-orange-500/20">
              <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-orange-500 to-amber-500 flex items-center justify-center text-2xl shadow-lg">👆</div>
                <h3 class="text-xl font-bold text-white">Basic</h3>
                <span class="text-xs text-purple-300/70 bg-purple-500/20 px-2 py-1 rounded-full">{{ basicCommands.length }}</span>
              </div>
              <div class="space-y-2 max-h-64 overflow-y-auto custom-scrollbar">
                <button v-for="cmd in basicCommands" :key="cmd.id" @click="simulateCommand(cmd)" class="w-full text-left px-3 py-2 bg-white/5 hover:bg-white/10 rounded-lg transition-all duration-200 border border-white/10 hover:border-white/20 group/btn text-sm">
                  <span class="font-semibold text-white block mb-1 group-hover/btn:text-orange-300 transition-colors">{{ cmd.name || cmd.id }}</span>
                  <span class="text-xs text-orange-300/70 line-clamp-1">{{ (cmd.phrases || []).slice(0, 2).join(', ') }}</span>
                </button>
              </div>
            </div>

            <!-- E-Commerce: Account Management -->
            <div class="group backdrop-blur-xl bg-white/10 rounded-3xl shadow-2xl border border-white/20 p-6 hover:bg-white/15 transition-all duration-300 hover:scale-105 hover:shadow-blue-500/20">
              <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-500 to-indigo-500 flex items-center justify-center text-2xl shadow-lg">👤</div>
                <h3 class="text-xl font-bold text-white">E-Commerce: Account</h3>
                <span class="text-xs text-purple-300/70 bg-purple-500/20 px-2 py-1 rounded-full">{{ ecommerceAccountCommands.length }}</span>
              </div>
              <div class="space-y-2 max-h-64 overflow-y-auto custom-scrollbar">
                <button v-for="cmd in ecommerceAccountCommands" :key="cmd.id" @click="simulateCommand(cmd)" class="w-full text-left px-3 py-2 bg-white/5 hover:bg-white/10 rounded-lg transition-all duration-200 border border-white/10 hover:border-white/20 group/btn text-sm">
                  <span class="font-semibold text-white block mb-1 group-hover/btn:text-blue-300 transition-colors">{{ cmd.name || cmd.id }}</span>
                  <span class="text-xs text-blue-300/70 line-clamp-1">{{ (cmd.phrases || []).slice(0, 2).join(', ') }}</span>
                </button>
              </div>
            </div>

            <!-- E-Commerce: Product Search -->
            <div class="group backdrop-blur-xl bg-white/10 rounded-3xl shadow-2xl border border-white/20 p-6 hover:bg-white/15 transition-all duration-300 hover:scale-105 hover:shadow-purple-500/20">
              <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-purple-500 to-pink-500 flex items-center justify-center text-2xl shadow-lg">🔍</div>
                <h3 class="text-xl font-bold text-white">E-Commerce: Search</h3>
                <span class="text-xs text-purple-300/70 bg-purple-500/20 px-2 py-1 rounded-full">{{ ecommerceSearchCommands.length }}</span>
              </div>
              <div class="space-y-2 max-h-64 overflow-y-auto custom-scrollbar">
                <button v-for="cmd in ecommerceSearchCommands" :key="cmd.id" @click="simulateCommand(cmd)" class="w-full text-left px-3 py-2 bg-white/5 hover:bg-white/10 rounded-lg transition-all duration-200 border border-white/10 hover:border-white/20 group/btn text-sm">
                  <span class="font-semibold text-white block mb-1 group-hover/btn:text-purple-300 transition-colors">{{ cmd.name || cmd.id }}</span>
                  <span class="text-xs text-purple-300/70 line-clamp-1">{{ (cmd.phrases || []).slice(0, 2).join(', ') }}</span>
                </button>
              </div>
            </div>

            <!-- E-Commerce: Order Management -->
            <div class="group backdrop-blur-xl bg-white/10 rounded-3xl shadow-2xl border border-white/20 p-6 hover:bg-white/15 transition-all duration-300 hover:scale-105 hover:shadow-green-500/20">
              <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-green-500 to-emerald-500 flex items-center justify-center text-2xl shadow-lg">🛒</div>
                <h3 class="text-xl font-bold text-white">E-Commerce: Orders</h3>
                <span class="text-xs text-purple-300/70 bg-purple-500/20 px-2 py-1 rounded-full">{{ ecommerceOrderCommands.length }}</span>
              </div>
              <div class="space-y-2 max-h-64 overflow-y-auto custom-scrollbar">
                <button v-for="cmd in ecommerceOrderCommands" :key="cmd.id" @click="simulateCommand(cmd)" class="w-full text-left px-3 py-2 bg-white/5 hover:bg-white/10 rounded-lg transition-all duration-200 border border-white/10 hover:border-white/20 group/btn text-sm">
                  <span class="font-semibold text-white block mb-1 group-hover/btn:text-green-300 transition-colors">{{ cmd.name || cmd.id }}</span>
                  <span class="text-xs text-green-300/70 line-clamp-1">{{ (cmd.phrases || []).slice(0, 2).join(', ') }}</span>
                </button>
              </div>
            </div>

            <!-- E-Commerce: Payments -->
            <div class="group backdrop-blur-xl bg-white/10 rounded-3xl shadow-2xl border border-white/20 p-6 hover:bg-white/15 transition-all duration-300 hover:scale-105 hover:shadow-yellow-500/20">
              <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-yellow-500 to-amber-500 flex items-center justify-center text-2xl shadow-lg">💳</div>
                <h3 class="text-xl font-bold text-white">E-Commerce: Payments</h3>
                <span class="text-xs text-purple-300/70 bg-purple-500/20 px-2 py-1 rounded-full">{{ ecommercePaymentCommands.length }}</span>
              </div>
              <div class="space-y-2 max-h-64 overflow-y-auto custom-scrollbar">
                <button v-for="cmd in ecommercePaymentCommands" :key="cmd.id" @click="simulateCommand(cmd)" class="w-full text-left px-3 py-2 bg-white/5 hover:bg-white/10 rounded-lg transition-all duration-200 border border-white/10 hover:border-white/20 group/btn text-sm">
                  <span class="font-semibold text-white block mb-1 group-hover/btn:text-yellow-300 transition-colors">{{ cmd.name || cmd.id }}</span>
                  <span class="text-xs text-yellow-300/70 line-clamp-1">{{ (cmd.phrases || []).slice(0, 2).join(', ') }}</span>
                </button>
              </div>
            </div>

            <!-- E-Commerce: Shipping -->
            <div class="group backdrop-blur-xl bg-white/10 rounded-3xl shadow-2xl border border-white/20 p-6 hover:bg-white/15 transition-all duration-300 hover:scale-105 hover:shadow-cyan-500/20">
              <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-cyan-500 to-blue-500 flex items-center justify-center text-2xl shadow-lg">🚚</div>
                <h3 class="text-xl font-bold text-white">E-Commerce: Shipping</h3>
                <span class="text-xs text-purple-300/70 bg-purple-500/20 px-2 py-1 rounded-full">{{ ecommerceShippingCommands.length }}</span>
              </div>
              <div class="space-y-2 max-h-64 overflow-y-auto custom-scrollbar">
                <button v-for="cmd in ecommerceShippingCommands" :key="cmd.id" @click="simulateCommand(cmd)" class="w-full text-left px-3 py-2 bg-white/5 hover:bg-white/10 rounded-lg transition-all duration-200 border border-white/10 hover:border-white/20 group/btn text-sm">
                  <span class="font-semibold text-white block mb-1 group-hover/btn:text-cyan-300 transition-colors">{{ cmd.name || cmd.id }}</span>
                  <span class="text-xs text-cyan-300/70 line-clamp-1">{{ (cmd.phrases || []).slice(0, 2).join(', ') }}</span>
                </button>
              </div>
            </div>

            <!-- E-Commerce: Support -->
            <div class="group backdrop-blur-xl bg-white/10 rounded-3xl shadow-2xl border border-white/20 p-6 hover:bg-white/15 transition-all duration-300 hover:scale-105 hover:shadow-pink-500/20">
              <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-pink-500 to-rose-500 flex items-center justify-center text-2xl shadow-lg">💬</div>
                <h3 class="text-xl font-bold text-white">E-Commerce: Support</h3>
                <span class="text-xs text-purple-300/70 bg-purple-500/20 px-2 py-1 rounded-full">{{ ecommerceSupportCommands.length }}</span>
              </div>
              <div class="space-y-2 max-h-64 overflow-y-auto custom-scrollbar">
                <button v-for="cmd in ecommerceSupportCommands" :key="cmd.id" @click="simulateCommand(cmd)" class="w-full text-left px-3 py-2 bg-white/5 hover:bg-white/10 rounded-lg transition-all duration-200 border border-white/10 hover:border-white/20 group/btn text-sm">
                  <span class="font-semibold text-white block mb-1 group-hover/btn:text-pink-300 transition-colors">{{ cmd.name || cmd.id }}</span>
                  <span class="text-xs text-pink-300/70 line-clamp-1">{{ (cmd.phrases || []).slice(0, 2).join(', ') }}</span>
                </button>
              </div>
            </div>

            <!-- E-Commerce: Reviews -->
            <div class="group backdrop-blur-xl bg-white/10 rounded-3xl shadow-2xl border border-white/20 p-6 hover:bg-white/15 transition-all duration-300 hover:scale-105 hover:shadow-yellow-500/20">
              <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-yellow-500 to-orange-500 flex items-center justify-center text-2xl shadow-lg">⭐</div>
                <h3 class="text-xl font-bold text-white">E-Commerce: Reviews</h3>
                <span class="text-xs text-purple-300/70 bg-purple-500/20 px-2 py-1 rounded-full">{{ ecommerceReviewCommands.length }}</span>
              </div>
              <div class="space-y-2 max-h-64 overflow-y-auto custom-scrollbar">
                <button v-for="cmd in ecommerceReviewCommands" :key="cmd.id" @click="simulateCommand(cmd)" class="w-full text-left px-3 py-2 bg-white/5 hover:bg-white/10 rounded-lg transition-all duration-200 border border-white/10 hover:border-white/20 group/btn text-sm">
                  <span class="font-semibold text-white block mb-1 group-hover/btn:text-yellow-300 transition-colors">{{ cmd.name || cmd.id }}</span>
                  <span class="text-xs text-yellow-300/70 line-clamp-1">{{ (cmd.phrases || []).slice(0, 2).join(', ') }}</span>
                </button>
              </div>
            </div>

            <!-- E-Commerce: Loyalty -->
            <div class="group backdrop-blur-xl bg-white/10 rounded-3xl shadow-2xl border border-white/20 p-6 hover:bg-white/15 transition-all duration-300 hover:scale-105 hover:shadow-emerald-500/20">
              <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-emerald-500 to-teal-500 flex items-center justify-center text-2xl shadow-lg">🎁</div>
                <h3 class="text-xl font-bold text-white">E-Commerce: Loyalty</h3>
                <span class="text-xs text-purple-300/70 bg-purple-500/20 px-2 py-1 rounded-full">{{ ecommerceLoyaltyCommands.length }}</span>
              </div>
              <div class="space-y-2 max-h-64 overflow-y-auto custom-scrollbar">
                <button v-for="cmd in ecommerceLoyaltyCommands" :key="cmd.id" @click="simulateCommand(cmd)" class="w-full text-left px-3 py-2 bg-white/5 hover:bg-white/10 rounded-lg transition-all duration-200 border border-white/10 hover:border-white/20 group/btn text-sm">
                  <span class="font-semibold text-white block mb-1 group-hover/btn:text-emerald-300 transition-colors">{{ cmd.name || cmd.id }}</span>
                  <span class="text-xs text-emerald-300/70 line-clamp-1">{{ (cmd.phrases || []).slice(0, 2).join(', ') }}</span>
                </button>
              </div>
            </div>

            <!-- E-Commerce: Returns -->
            <div class="group backdrop-blur-xl bg-white/10 rounded-3xl shadow-2xl border border-white/20 p-6 hover:bg-white/15 transition-all duration-300 hover:scale-105 hover:shadow-red-500/20">
              <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-red-500 to-orange-500 flex items-center justify-center text-2xl shadow-lg">↩️</div>
                <h3 class="text-xl font-bold text-white">E-Commerce: Returns</h3>
                <span class="text-xs text-purple-300/70 bg-purple-500/20 px-2 py-1 rounded-full">{{ ecommerceReturnCommands.length }}</span>
              </div>
              <div class="space-y-2 max-h-64 overflow-y-auto custom-scrollbar">
                <button v-for="cmd in ecommerceReturnCommands" :key="cmd.id" @click="simulateCommand(cmd)" class="w-full text-left px-3 py-2 bg-white/5 hover:bg-white/10 rounded-lg transition-all duration-200 border border-white/10 hover:border-white/20 group/btn text-sm">
                  <span class="font-semibold text-white block mb-1 group-hover/btn:text-red-300 transition-colors">{{ cmd.name || cmd.id }}</span>
                  <span class="text-xs text-red-300/70 line-clamp-1">{{ (cmd.phrases || []).slice(0, 2).join(', ') }}</span>
                </button>
              </div>
            </div>

            <!-- E-Commerce: Seller -->
            <div class="group backdrop-blur-xl bg-white/10 rounded-3xl shadow-2xl border border-white/20 p-6 hover:bg-white/15 transition-all duration-300 hover:scale-105 hover:shadow-indigo-500/20">
              <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-indigo-500 to-violet-500 flex items-center justify-center text-2xl shadow-lg">🏪</div>
                <h3 class="text-xl font-bold text-white">E-Commerce: Seller</h3>
                <span class="text-xs text-purple-300/70 bg-purple-500/20 px-2 py-1 rounded-full">{{ ecommerceSellerCommands.length }}</span>
              </div>
              <div class="space-y-2 max-h-64 overflow-y-auto custom-scrollbar">
                <button v-for="cmd in ecommerceSellerCommands" :key="cmd.id" @click="simulateCommand(cmd)" class="w-full text-left px-3 py-2 bg-white/5 hover:bg-white/10 rounded-lg transition-all duration-200 border border-white/10 hover:border-white/20 group/btn text-sm">
                  <span class="font-semibold text-white block mb-1 group-hover/btn:text-indigo-300 transition-colors">{{ cmd.name || cmd.id }}</span>
                  <span class="text-xs text-indigo-300/70 line-clamp-1">{{ (cmd.phrases || []).slice(0, 2).join(', ') }}</span>
                </button>
              </div>
            </div>

            <!-- Gaming: Account Management -->
            <div class="group backdrop-blur-xl bg-white/10 rounded-3xl shadow-2xl border border-white/20 p-6 hover:bg-white/15 transition-all duration-300 hover:scale-105 hover:shadow-blue-500/20">
              <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-500 to-indigo-500 flex items-center justify-center text-2xl shadow-lg">🎮</div>
                <h3 class="text-xl font-bold text-white">Gaming: Account</h3>
                <span class="text-xs text-purple-300/70 bg-purple-500/20 px-2 py-1 rounded-full">{{ gamingAccountCommands.length }}</span>
              </div>
              <div class="space-y-2 max-h-64 overflow-y-auto custom-scrollbar">
                <button v-for="cmd in gamingAccountCommands" :key="cmd.id" @click="simulateCommand(cmd)" class="w-full text-left px-3 py-2 bg-white/5 hover:bg-white/10 rounded-lg transition-all duration-200 border border-white/10 hover:border-white/20 group/btn text-sm">
                  <span class="font-semibold text-white block mb-1 group-hover/btn:text-blue-300 transition-colors">{{ cmd.name || cmd.id }}</span>
                  <span class="text-xs text-blue-300/70 line-clamp-1">{{ (cmd.phrases || []).slice(0, 2).join(', ') }}</span>
                </button>
              </div>
            </div>

            <!-- Gaming: Discovery & Purchase -->
            <div class="group backdrop-blur-xl bg-white/10 rounded-3xl shadow-2xl border border-white/20 p-6 hover:bg-white/15 transition-all duration-300 hover:scale-105 hover:shadow-purple-500/20">
              <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-purple-500 to-pink-500 flex items-center justify-center text-2xl shadow-lg">🔍</div>
                <h3 class="text-xl font-bold text-white">Gaming: Discovery</h3>
                <span class="text-xs text-purple-300/70 bg-purple-500/20 px-2 py-1 rounded-full">{{ gamingDiscoveryCommands.length }}</span>
              </div>
              <div class="space-y-2 max-h-64 overflow-y-auto custom-scrollbar">
                <button v-for="cmd in gamingDiscoveryCommands" :key="cmd.id" @click="simulateCommand(cmd)" class="w-full text-left px-3 py-2 bg-white/5 hover:bg-white/10 rounded-lg transition-all duration-200 border border-white/10 hover:border-white/20 group/btn text-sm">
                  <span class="font-semibold text-white block mb-1 group-hover/btn:text-purple-300 transition-colors">{{ cmd.name || cmd.id }}</span>
                  <span class="text-xs text-purple-300/70 line-clamp-1">{{ (cmd.phrases || []).slice(0, 2).join(', ') }}</span>
                </button>
              </div>
            </div>

            <!-- Gaming: Download & Installation -->
            <div class="group backdrop-blur-xl bg-white/10 rounded-3xl shadow-2xl border border-white/20 p-6 hover:bg-white/15 transition-all duration-300 hover:scale-105 hover:shadow-green-500/20">
              <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-green-500 to-emerald-500 flex items-center justify-center text-2xl shadow-lg">💾</div>
                <h3 class="text-xl font-bold text-white">Gaming: Download</h3>
                <span class="text-xs text-purple-300/70 bg-purple-500/20 px-2 py-1 rounded-full">{{ gamingDownloadCommands.length }}</span>
              </div>
              <div class="space-y-2 max-h-64 overflow-y-auto custom-scrollbar">
                <button v-for="cmd in gamingDownloadCommands" :key="cmd.id" @click="simulateCommand(cmd)" class="w-full text-left px-3 py-2 bg-white/5 hover:bg-white/10 rounded-lg transition-all duration-200 border border-white/10 hover:border-white/20 group/btn text-sm">
                  <span class="font-semibold text-white block mb-1 group-hover/btn:text-green-300 transition-colors">{{ cmd.name || cmd.id }}</span>
                  <span class="text-xs text-green-300/70 line-clamp-1">{{ (cmd.phrases || []).slice(0, 2).join(', ') }}</span>
                </button>
              </div>
            </div>

            <!-- Gaming: Gameplay -->
            <div class="group backdrop-blur-xl bg-white/10 rounded-3xl shadow-2xl border border-white/20 p-6 hover:bg-white/15 transition-all duration-300 hover:scale-105 hover:shadow-red-500/20">
              <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-red-500 to-orange-500 flex items-center justify-center text-2xl shadow-lg">👾</div>
                <h3 class="text-xl font-bold text-white">Gaming: Gameplay</h3>
                <span class="text-xs text-purple-300/70 bg-purple-500/20 px-2 py-1 rounded-full">{{ gamingPlayCommands.length }}</span>
              </div>
              <div class="space-y-2 max-h-64 overflow-y-auto custom-scrollbar">
                <button v-for="cmd in gamingPlayCommands" :key="cmd.id" @click="simulateCommand(cmd)" class="w-full text-left px-3 py-2 bg-white/5 hover:bg-white/10 rounded-lg transition-all duration-200 border border-white/10 hover:border-white/20 group/btn text-sm">
                  <span class="font-semibold text-white block mb-1 group-hover/btn:text-red-300 transition-colors">{{ cmd.name || cmd.id }}</span>
                  <span class="text-xs text-red-300/70 line-clamp-1">{{ (cmd.phrases || []).slice(0, 2).join(', ') }}</span>
                </button>
              </div>
            </div>

            <!-- Gaming: Library -->
            <div class="group backdrop-blur-xl bg-white/10 rounded-3xl shadow-2xl border border-white/20 p-6 hover:bg-white/15 transition-all duration-300 hover:scale-105 hover:shadow-cyan-500/20">
              <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-cyan-500 to-blue-500 flex items-center justify-center text-2xl shadow-lg">📚</div>
                <h3 class="text-xl font-bold text-white">Gaming: Library</h3>
                <span class="text-xs text-purple-300/70 bg-purple-500/20 px-2 py-1 rounded-full">{{ gamingLibraryCommands.length }}</span>
              </div>
              <div class="space-y-2 max-h-64 overflow-y-auto custom-scrollbar">
                <button v-for="cmd in gamingLibraryCommands" :key="cmd.id" @click="simulateCommand(cmd)" class="w-full text-left px-3 py-2 bg-white/5 hover:bg-white/10 rounded-lg transition-all duration-200 border border-white/10 hover:border-white/20 group/btn text-sm">
                  <span class="font-semibold text-white block mb-1 group-hover/btn:text-cyan-300 transition-colors">{{ cmd.name || cmd.id }}</span>
                  <span class="text-xs text-cyan-300/70 line-clamp-1">{{ (cmd.phrases || []).slice(0, 2).join(', ') }}</span>
                </button>
              </div>
            </div>

            <!-- Gaming: Social -->
            <div class="group backdrop-blur-xl bg-white/10 rounded-3xl shadow-2xl border border-white/20 p-6 hover:bg-white/15 transition-all duration-300 hover:scale-105 hover:shadow-pink-500/20">
              <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-pink-500 to-rose-500 flex items-center justify-center text-2xl shadow-lg">👥</div>
                <h3 class="text-xl font-bold text-white">Gaming: Social</h3>
                <span class="text-xs text-purple-300/70 bg-purple-500/20 px-2 py-1 rounded-full">{{ gamingSocialCommands.length }}</span>
              </div>
              <div class="space-y-2 max-h-64 overflow-y-auto custom-scrollbar">
                <button v-for="cmd in gamingSocialCommands" :key="cmd.id" @click="simulateCommand(cmd)" class="w-full text-left px-3 py-2 bg-white/5 hover:bg-white/10 rounded-lg transition-all duration-200 border border-white/10 hover:border-white/20 group/btn text-sm">
                  <span class="font-semibold text-white block mb-1 group-hover/btn:text-pink-300 transition-colors">{{ cmd.name || cmd.id }}</span>
                  <span class="text-xs text-pink-300/70 line-clamp-1">{{ (cmd.phrases || []).slice(0, 2).join(', ') }}</span>
                </button>
              </div>
            </div>

            <!-- Gaming: Achievements -->
            <div class="group backdrop-blur-xl bg-white/10 rounded-3xl shadow-2xl border border-white/20 p-6 hover:bg-white/15 transition-all duration-300 hover:scale-105 hover:shadow-yellow-500/20">
              <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-yellow-500 to-amber-500 flex items-center justify-center text-2xl shadow-lg">🏆</div>
                <h3 class="text-xl font-bold text-white">Gaming: Achievements</h3>
                <span class="text-xs text-purple-300/70 bg-purple-500/20 px-2 py-1 rounded-full">{{ gamingAchievementCommands.length }}</span>
              </div>
              <div class="space-y-2 max-h-64 overflow-y-auto custom-scrollbar">
                <button v-for="cmd in gamingAchievementCommands" :key="cmd.id" @click="simulateCommand(cmd)" class="w-full text-left px-3 py-2 bg-white/5 hover:bg-white/10 rounded-lg transition-all duration-200 border border-white/10 hover:border-white/20 group/btn text-sm">
                  <span class="font-semibold text-white block mb-1 group-hover/btn:text-yellow-300 transition-colors">{{ cmd.name || cmd.id }}</span>
                  <span class="text-xs text-yellow-300/70 line-clamp-1">{{ (cmd.phrases || []).slice(0, 2).join(', ') }}</span>
                </button>
              </div>
            </div>

            <!-- Gaming: Support -->
            <div class="group backdrop-blur-xl bg-white/10 rounded-3xl shadow-2xl border border-white/20 p-6 hover:bg-white/15 transition-all duration-300 hover:scale-105 hover:shadow-orange-500/20">
              <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-orange-500 to-red-500 flex items-center justify-center text-2xl shadow-lg">💬</div>
                <h3 class="text-xl font-bold text-white">Gaming: Support</h3>
                <span class="text-xs text-purple-300/70 bg-purple-500/20 px-2 py-1 rounded-full">{{ gamingSupportCommands.length }}</span>
              </div>
              <div class="space-y-2 max-h-64 overflow-y-auto custom-scrollbar">
                <button v-for="cmd in gamingSupportCommands" :key="cmd.id" @click="simulateCommand(cmd)" class="w-full text-left px-3 py-2 bg-white/5 hover:bg-white/10 rounded-lg transition-all duration-200 border border-white/10 hover:border-white/20 group/btn text-sm">
                  <span class="font-semibold text-white block mb-1 group-hover/btn:text-orange-300 transition-colors">{{ cmd.name || cmd.id }}</span>
                  <span class="text-xs text-orange-300/70 line-clamp-1">{{ (cmd.phrases || []).slice(0, 2).join(', ') }}</span>
                </button>
              </div>
            </div>

            <!-- Gaming: Purchases -->
            <div class="group backdrop-blur-xl bg-white/10 rounded-3xl shadow-2xl border border-white/20 p-6 hover:bg-white/15 transition-all duration-300 hover:scale-105 hover:shadow-emerald-500/20">
              <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-emerald-500 to-teal-500 flex items-center justify-center text-2xl shadow-lg">💰</div>
                <h3 class="text-xl font-bold text-white">Gaming: Purchases</h3>
                <span class="text-xs text-purple-300/70 bg-purple-500/20 px-2 py-1 rounded-full">{{ gamingPurchaseCommands.length }}</span>
              </div>
              <div class="space-y-2 max-h-64 overflow-y-auto custom-scrollbar">
                <button v-for="cmd in gamingPurchaseCommands" :key="cmd.id" @click="simulateCommand(cmd)" class="w-full text-left px-3 py-2 bg-white/5 hover:bg-white/10 rounded-lg transition-all duration-200 border border-white/10 hover:border-white/20 group/btn text-sm">
                  <span class="font-semibold text-white block mb-1 group-hover/btn:text-emerald-300 transition-colors">{{ cmd.name || cmd.id }}</span>
                  <span class="text-xs text-emerald-300/70 line-clamp-1">{{ (cmd.phrases || []).slice(0, 2).join(', ') }}</span>
                </button>
              </div>
            </div>

            <!-- Gaming: Security -->
            <div class="group backdrop-blur-xl bg-white/10 rounded-3xl shadow-2xl border border-white/20 p-6 hover:bg-white/15 transition-all duration-300 hover:scale-105 hover:shadow-red-500/20">
              <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-red-500 to-pink-500 flex items-center justify-center text-2xl shadow-lg">🔒</div>
                <h3 class="text-xl font-bold text-white">Gaming: Security</h3>
                <span class="text-xs text-purple-300/70 bg-purple-500/20 px-2 py-1 rounded-full">{{ gamingSecurityCommands.length }}</span>
              </div>
              <div class="space-y-2 max-h-64 overflow-y-auto custom-scrollbar">
                <button v-for="cmd in gamingSecurityCommands" :key="cmd.id" @click="simulateCommand(cmd)" class="w-full text-left px-3 py-2 bg-white/5 hover:bg-white/10 rounded-lg transition-all duration-200 border border-white/10 hover:border-white/20 group/btn text-sm">
                  <span class="font-semibold text-white block mb-1 group-hover/btn:text-red-300 transition-colors">{{ cmd.name || cmd.id }}</span>
                  <span class="text-xs text-red-300/70 line-clamp-1">{{ (cmd.phrases || []).slice(0, 2).join(', ') }}</span>
                </button>
              </div>
            </div>

            <!-- Gaming: Refunds -->
            <div class="group backdrop-blur-xl bg-white/10 rounded-3xl shadow-2xl border border-white/20 p-6 hover:bg-white/15 transition-all duration-300 hover:scale-105 hover:shadow-blue-500/20">
              <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-500 to-indigo-500 flex items-center justify-center text-2xl shadow-lg">↩️</div>
                <h3 class="text-xl font-bold text-white">Gaming: Refunds</h3>
                <span class="text-xs text-purple-300/70 bg-purple-500/20 px-2 py-1 rounded-full">{{ gamingRefundCommands.length }}</span>
              </div>
              <div class="space-y-2 max-h-64 overflow-y-auto custom-scrollbar">
                <button v-for="cmd in gamingRefundCommands" :key="cmd.id" @click="simulateCommand(cmd)" class="w-full text-left px-3 py-2 bg-white/5 hover:bg-white/10 rounded-lg transition-all duration-200 border border-white/10 hover:border-white/20 group/btn text-sm">
                  <span class="font-semibold text-white block mb-1 group-hover/btn:text-blue-300 transition-colors">{{ cmd.name || cmd.id }}</span>
                  <span class="text-xs text-blue-300/70 line-clamp-1">{{ (cmd.phrases || []).slice(0, 2).join(', ') }}</span>
                </button>
              </div>
            </div>

            <!-- Gaming: UX -->
            <div class="group backdrop-blur-xl bg-white/10 rounded-3xl shadow-2xl border border-white/20 p-6 hover:bg-white/15 transition-all duration-300 hover:scale-105 hover:shadow-purple-500/20">
              <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-purple-500 to-pink-500 flex items-center justify-center text-2xl shadow-lg">✨</div>
                <h3 class="text-xl font-bold text-white">Gaming: UX</h3>
                <span class="text-xs text-purple-300/70 bg-purple-500/20 px-2 py-1 rounded-full">{{ gamingUxCommands.length }}</span>
              </div>
              <div class="space-y-2 max-h-64 overflow-y-auto custom-scrollbar">
                <button v-for="cmd in gamingUxCommands" :key="cmd.id" @click="simulateCommand(cmd)" class="w-full text-left px-3 py-2 bg-white/5 hover:bg-white/10 rounded-lg transition-all duration-200 border border-white/10 hover:border-white/20 group/btn text-sm">
                  <span class="font-semibold text-white block mb-1 group-hover/btn:text-purple-300 transition-colors">{{ cmd.name || cmd.id }}</span>
                  <span class="text-xs text-purple-300/70 line-clamp-1">{{ (cmd.phrases || []).slice(0, 2).join(', ') }}</span>
                </button>
              </div>
            </div>

            <!-- Gaming: Device -->
            <div class="group backdrop-blur-xl bg-white/10 rounded-3xl shadow-2xl border border-white/20 p-6 hover:bg-white/15 transition-all duration-300 hover:scale-105 hover:shadow-cyan-500/20">
              <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-cyan-500 to-blue-500 flex items-center justify-center text-2xl shadow-lg">🕹️</div>
                <h3 class="text-xl font-bold text-white">Gaming: Device</h3>
                <span class="text-xs text-purple-300/70 bg-purple-500/20 px-2 py-1 rounded-full">{{ gamingDeviceCommands.length }}</span>
              </div>
              <div class="space-y-2 max-h-64 overflow-y-auto custom-scrollbar">
                <button v-for="cmd in gamingDeviceCommands" :key="cmd.id" @click="simulateCommand(cmd)" class="w-full text-left px-3 py-2 bg-white/5 hover:bg-white/10 rounded-lg transition-all duration-200 border border-white/10 hover:border-white/20 group/btn text-sm">
                  <span class="font-semibold text-white block mb-1 group-hover/btn:text-cyan-300 transition-colors">{{ cmd.name || cmd.id }}</span>
                  <span class="text-xs text-cyan-300/70 line-clamp-1">{{ (cmd.phrases || []).slice(0, 2).join(', ') }}</span>
                </button>
              </div>
            </div>

            <!-- Operating Systems -->
            <div class="group backdrop-blur-xl bg-white/10 rounded-3xl shadow-2xl border border-white/20 p-6 hover:bg-white/15 transition-all duration-300 hover:scale-105 hover:shadow-blue-500/20">
              <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-500 to-indigo-500 flex items-center justify-center text-2xl shadow-lg">💻</div>
                <h3 class="text-xl font-bold text-white">OS (Windows/macOS/Linux)</h3>
                <span class="text-xs text-purple-300/70 bg-purple-500/20 px-2 py-1 rounded-full">{{ osCommands.length }}</span>
              </div>
              <div class="space-y-2 max-h-64 overflow-y-auto custom-scrollbar">
                <button v-for="cmd in osCommands" :key="cmd.id" @click="simulateCommand(cmd)" class="w-full text-left px-3 py-2 bg-white/5 hover:bg-white/10 rounded-lg transition-all duration-200 border border-white/10 hover:border-white/20 group/btn text-sm">
                  <span class="font-semibold text-white block mb-1 group-hover/btn:text-blue-300 transition-colors">{{ cmd.name || cmd.id }}</span>
                  <span class="text-xs text-blue-300/70 line-clamp-1">{{ (cmd.phrases || []).slice(0, 2).join(', ') }}</span>
                </button>
              </div>
            </div>

            <!-- Mobile Platforms -->
            <div class="group backdrop-blur-xl bg-white/10 rounded-3xl shadow-2xl border border-white/20 p-6 hover:bg-white/15 transition-all duration-300 hover:scale-105 hover:shadow-green-500/20">
              <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-green-500 to-emerald-500 flex items-center justify-center text-2xl shadow-lg">📱</div>
                <h3 class="text-xl font-bold text-white">Mobile (Android/iOS)</h3>
                <span class="text-xs text-purple-300/70 bg-purple-500/20 px-2 py-1 rounded-full">{{ mobileCommands.length }}</span>
              </div>
              <div class="space-y-2 max-h-64 overflow-y-auto custom-scrollbar">
                <button v-for="cmd in mobileCommands" :key="cmd.id" @click="simulateCommand(cmd)" class="w-full text-left px-3 py-2 bg-white/5 hover:bg-white/10 rounded-lg transition-all duration-200 border border-white/10 hover:border-white/20 group/btn text-sm">
                  <span class="font-semibold text-white block mb-1 group-hover/btn:text-green-300 transition-colors">{{ cmd.name || cmd.id }}</span>
                  <span class="text-xs text-green-300/70 line-clamp-1">{{ (cmd.phrases || []).slice(0, 2).join(', ') }}</span>
                </button>
              </div>
            </div>

            <!-- Cloud Platforms -->
            <div class="group backdrop-blur-xl bg-white/10 rounded-3xl shadow-2xl border border-white/20 p-6 hover:bg-white/15 transition-all duration-300 hover:scale-105 hover:shadow-purple-500/20">
              <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-purple-500 to-pink-500 flex items-center justify-center text-2xl shadow-lg">☁️</div>
                <h3 class="text-xl font-bold text-white">Cloud (AWS/Azure/GCP)</h3>
                <span class="text-xs text-purple-300/70 bg-purple-500/20 px-2 py-1 rounded-full">{{ cloudCommands.length }}</span>
              </div>
              <div class="space-y-2 max-h-64 overflow-y-auto custom-scrollbar">
                <button v-for="cmd in cloudCommands" :key="cmd.id" @click="simulateCommand(cmd)" class="w-full text-left px-3 py-2 bg-white/5 hover:bg-white/10 rounded-lg transition-all duration-200 border border-white/10 hover:border-white/20 group/btn text-sm">
                  <span class="font-semibold text-white block mb-1 group-hover/btn:text-purple-300 transition-colors">{{ cmd.name || cmd.id }}</span>
                  <span class="text-xs text-purple-300/70 line-clamp-1">{{ (cmd.phrases || []).slice(0, 2).join(', ') }}</span>
                </button>
              </div>
            </div>

            <!-- Developer Platforms -->
            <div class="group backdrop-blur-xl bg-white/10 rounded-3xl shadow-2xl border border-white/20 p-6 hover:bg-white/15 transition-all duration-300 hover:scale-105 hover:shadow-orange-500/20">
              <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-orange-500 to-amber-500 flex items-center justify-center text-2xl shadow-lg">👨‍💻</div>
                <h3 class="text-xl font-bold text-white">Developer (GitHub/GitLab)</h3>
                <span class="text-xs text-purple-300/70 bg-purple-500/20 px-2 py-1 rounded-full">{{ developerCommands.length }}</span>
              </div>
              <div class="space-y-2 max-h-64 overflow-y-auto custom-scrollbar">
                <button v-for="cmd in developerCommands" :key="cmd.id" @click="simulateCommand(cmd)" class="w-full text-left px-3 py-2 bg-white/5 hover:bg-white/10 rounded-lg transition-all duration-200 border border-white/10 hover:border-white/20 group/btn text-sm">
                  <span class="font-semibold text-white block mb-1 group-hover/btn:text-orange-300 transition-colors">{{ cmd.name || cmd.id }}</span>
                  <span class="text-xs text-orange-300/70 line-clamp-1">{{ (cmd.phrases || []).slice(0, 2).join(', ') }}</span>
                </button>
              </div>
            </div>

            <!-- Common Technical Features -->
            <div class="group backdrop-blur-xl bg-white/10 rounded-3xl shadow-2xl border border-white/20 p-6 hover:bg-white/15 transition-all duration-300 hover:scale-105 hover:shadow-teal-500/20">
              <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-teal-500 to-cyan-500 flex items-center justify-center text-2xl shadow-lg">⚙️</div>
                <h3 class="text-xl font-bold text-white">Common Tech Features</h3>
                <span class="text-xs text-purple-300/70 bg-purple-500/20 px-2 py-1 rounded-full">{{ techCommonCommands.length }}</span>
              </div>
              <div class="space-y-2 max-h-64 overflow-y-auto custom-scrollbar">
                <button v-for="cmd in techCommonCommands" :key="cmd.id" @click="simulateCommand(cmd)" class="w-full text-left px-3 py-2 bg-white/5 hover:bg-white/10 rounded-lg transition-all duration-200 border border-white/10 hover:border-white/20 group/btn text-sm">
                  <span class="font-semibold text-white block mb-1 group-hover/btn:text-teal-300 transition-colors">{{ cmd.name || cmd.id }}</span>
                  <span class="text-xs text-teal-300/70 line-clamp-1">{{ (cmd.phrases || []).slice(0, 2).join(', ') }}</span>
                </button>
              </div>
            </div>

            <!-- Education: Student -->
            <div class="group backdrop-blur-xl bg-white/10 rounded-3xl shadow-2xl border border-white/20 p-6 hover:bg-white/15 transition-all duration-300 hover:scale-105 hover:shadow-blue-500/20">
              <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-500 to-indigo-500 flex items-center justify-center text-2xl shadow-lg">👩‍🎓</div>
                <h3 class="text-xl font-bold text-white">Education: Student</h3>
                <span class="text-xs text-purple-300/70 bg-purple-500/20 px-2 py-1 rounded-full">{{ educationStudentCommands.length }}</span>
              </div>
              <div class="space-y-2 max-h-64 overflow-y-auto custom-scrollbar">
                <button v-for="cmd in educationStudentCommands" :key="cmd.id" @click="simulateCommand(cmd)" class="w-full text-left px-3 py-2 bg-white/5 hover:bg-white/10 rounded-lg transition-all duration-200 border border-white/10 hover:border-white/20 group/btn text-sm">
                  <span class="font-semibold text-white block mb-1 group-hover/btn:text-blue-300 transition-colors">{{ cmd.name || cmd.id }}</span>
                  <span class="text-xs text-blue-300/70 line-clamp-1">{{ (cmd.phrases || []).slice(0, 2).join(', ') }}</span>
                </button>
              </div>
            </div>

            <!-- Education: Instructor -->
            <div class="group backdrop-blur-xl bg-white/10 rounded-3xl shadow-2xl border border-white/20 p-6 hover:bg-white/15 transition-all duration-300 hover:scale-105 hover:shadow-green-500/20">
              <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-green-500 to-emerald-500 flex items-center justify-center text-2xl shadow-lg">👨‍🏫</div>
                <h3 class="text-xl font-bold text-white">Education: Instructor</h3>
                <span class="text-xs text-purple-300/70 bg-purple-500/20 px-2 py-1 rounded-full">{{ educationInstructorCommands.length }}</span>
              </div>
              <div class="space-y-2 max-h-64 overflow-y-auto custom-scrollbar">
                <button v-for="cmd in educationInstructorCommands" :key="cmd.id" @click="simulateCommand(cmd)" class="w-full text-left px-3 py-2 bg-white/5 hover:bg-white/10 rounded-lg transition-all duration-200 border border-white/10 hover:border-white/20 group/btn text-sm">
                  <span class="font-semibold text-white block mb-1 group-hover/btn:text-green-300 transition-colors">{{ cmd.name || cmd.id }}</span>
                  <span class="text-xs text-green-300/70 line-clamp-1">{{ (cmd.phrases || []).slice(0, 2).join(', ') }}</span>
                </button>
              </div>
            </div>

            <!-- Education: Common -->
            <div class="group backdrop-blur-xl bg-white/10 rounded-3xl shadow-2xl border border-white/20 p-6 hover:bg-white/15 transition-all duration-300 hover:scale-105 hover:shadow-purple-500/20">
              <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-purple-500 to-pink-500 flex items-center justify-center text-2xl shadow-lg">📚</div>
                <h3 class="text-xl font-bold text-white">Education: Common</h3>
                <span class="text-xs text-purple-300/70 bg-purple-500/20 px-2 py-1 rounded-full">{{ educationCommonCommands.length }}</span>
              </div>
              <div class="space-y-2 max-h-64 overflow-y-auto custom-scrollbar">
                <button v-for="cmd in educationCommonCommands" :key="cmd.id" @click="simulateCommand(cmd)" class="w-full text-left px-3 py-2 bg-white/5 hover:bg-white/10 rounded-lg transition-all duration-200 border border-white/10 hover:border-white/20 group/btn text-sm">
                  <span class="font-semibold text-white block mb-1 group-hover/btn:text-purple-300 transition-colors">{{ cmd.name || cmd.id }}</span>
                  <span class="text-xs text-purple-300/70 line-clamp-1">{{ (cmd.phrases || []).slice(0, 2).join(', ') }}</span>
                </button>
              </div>
            </div>

            <!-- Communication: Chat & Messaging -->
            <div class="group backdrop-blur-xl bg-white/10 rounded-3xl shadow-2xl border border-white/20 p-6 hover:bg-white/15 transition-all duration-300 hover:scale-105 hover:shadow-blue-500/20">
              <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-500 to-indigo-500 flex items-center justify-center text-2xl shadow-lg">💬</div>
                <h3 class="text-xl font-bold text-white">Communication: Chat</h3>
                <span class="text-xs text-purple-300/70 bg-purple-500/20 px-2 py-1 rounded-full">{{ communicationChatCommands.length }}</span>
              </div>
              <div class="space-y-2 max-h-64 overflow-y-auto custom-scrollbar">
                <button v-for="cmd in communicationChatCommands" :key="cmd.id" @click="simulateCommand(cmd)" class="w-full text-left px-3 py-2 bg-white/5 hover:bg-white/10 rounded-lg transition-all duration-200 border border-white/10 hover:border-white/20 group/btn text-sm">
                  <span class="font-semibold text-white block mb-1 group-hover/btn:text-blue-300 transition-colors">{{ cmd.name || cmd.id }}</span>
                  <span class="text-xs text-blue-300/70 line-clamp-1">{{ (cmd.phrases || []).slice(0, 2).join(', ') }}</span>
                </button>
              </div>
            </div>

            <!-- Communication: Calls & Video -->
            <div class="group backdrop-blur-xl bg-white/10 rounded-3xl shadow-2xl border border-white/20 p-6 hover:bg-white/15 transition-all duration-300 hover:scale-105 hover:shadow-green-500/20">
              <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-green-500 to-emerald-500 flex items-center justify-center text-2xl shadow-lg">📞</div>
                <h3 class="text-xl font-bold text-white">Communication: Calls</h3>
                <span class="text-xs text-purple-300/70 bg-purple-500/20 px-2 py-1 rounded-full">{{ communicationCallCommands.length }}</span>
              </div>
              <div class="space-y-2 max-h-64 overflow-y-auto custom-scrollbar">
                <button v-for="cmd in communicationCallCommands" :key="cmd.id" @click="simulateCommand(cmd)" class="w-full text-left px-3 py-2 bg-white/5 hover:bg-white/10 rounded-lg transition-all duration-200 border border-white/10 hover:border-white/20 group/btn text-sm">
                  <span class="font-semibold text-white block mb-1 group-hover/btn:text-green-300 transition-colors">{{ cmd.name || cmd.id }}</span>
                  <span class="text-xs text-green-300/70 line-clamp-1">{{ (cmd.phrases || []).slice(0, 2).join(', ') }}</span>
                </button>
              </div>
            </div>

            <!-- Communication: Groups & Channels -->
            <div class="group backdrop-blur-xl bg-white/10 rounded-3xl shadow-2xl border border-white/20 p-6 hover:bg-white/15 transition-all duration-300 hover:scale-105 hover:shadow-purple-500/20">
              <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-purple-500 to-pink-500 flex items-center justify-center text-2xl shadow-lg">👥</div>
                <h3 class="text-xl font-bold text-white">Communication: Groups</h3>
                <span class="text-xs text-purple-300/70 bg-purple-500/20 px-2 py-1 rounded-full">{{ communicationGroupCommands.length }}</span>
              </div>
              <div class="space-y-2 max-h-64 overflow-y-auto custom-scrollbar">
                <button v-for="cmd in communicationGroupCommands" :key="cmd.id" @click="simulateCommand(cmd)" class="w-full text-left px-3 py-2 bg-white/5 hover:bg-white/10 rounded-lg transition-all duration-200 border border-white/10 hover:border-white/20 group/btn text-sm">
                  <span class="font-semibold text-white block mb-1 group-hover/btn:text-purple-300 transition-colors">{{ cmd.name || cmd.id }}</span>
                  <span class="text-xs text-purple-300/70 line-clamp-1">{{ (cmd.phrases || []).slice(0, 2).join(', ') }}</span>
                </button>
              </div>
            </div>

            <!-- Communication: Files & Documents -->
            <div class="group backdrop-blur-xl bg-white/10 rounded-3xl shadow-2xl border border-white/20 p-6 hover:bg-white/15 transition-all duration-300 hover:scale-105 hover:shadow-orange-500/20">
              <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-orange-500 to-amber-500 flex items-center justify-center text-2xl shadow-lg">📁</div>
                <h3 class="text-xl font-bold text-white">Communication: Files</h3>
                <span class="text-xs text-purple-300/70 bg-purple-500/20 px-2 py-1 rounded-full">{{ communicationFileCommands.length }}</span>
              </div>
              <div class="space-y-2 max-h-64 overflow-y-auto custom-scrollbar">
                <button v-for="cmd in communicationFileCommands" :key="cmd.id" @click="simulateCommand(cmd)" class="w-full text-left px-3 py-2 bg-white/5 hover:bg-white/10 rounded-lg transition-all duration-200 border border-white/10 hover:border-white/20 group/btn text-sm">
                  <span class="font-semibold text-white block mb-1 group-hover/btn:text-orange-300 transition-colors">{{ cmd.name || cmd.id }}</span>
                  <span class="text-xs text-orange-300/70 line-clamp-1">{{ (cmd.phrases || []).slice(0, 2).join(', ') }}</span>
                </button>
              </div>
            </div>

            <!-- Communication: Notifications & Settings -->
            <div class="group backdrop-blur-xl bg-white/10 rounded-3xl shadow-2xl border border-white/20 p-6 hover:bg-white/15 transition-all duration-300 hover:scale-105 hover:shadow-teal-500/20">
              <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-teal-500 to-cyan-500 flex items-center justify-center text-2xl shadow-lg">🔔</div>
                <h3 class="text-xl font-bold text-white">Communication: Notifications</h3>
                <span class="text-xs text-purple-300/70 bg-purple-500/20 px-2 py-1 rounded-full">{{ communicationNotificationCommands.length }}</span>
              </div>
              <div class="space-y-2 max-h-64 overflow-y-auto custom-scrollbar">
                <button v-for="cmd in communicationNotificationCommands" :key="cmd.id" @click="simulateCommand(cmd)" class="w-full text-left px-3 py-2 bg-white/5 hover:bg-white/10 rounded-lg transition-all duration-200 border border-white/10 hover:border-white/20 group/btn text-sm">
                  <span class="font-semibold text-white block mb-1 group-hover/btn:text-teal-300 transition-colors">{{ cmd.name || cmd.id }}</span>
                  <span class="text-xs text-teal-300/70 line-clamp-1">{{ (cmd.phrases || []).slice(0, 2).join(', ') }}</span>
                </button>
              </div>
            </div>

            <!-- Communication: Collaboration & Tasks -->
            <div class="group backdrop-blur-xl bg-white/10 rounded-3xl shadow-2xl border border-white/20 p-6 hover:bg-white/15 transition-all duration-300 hover:scale-105 hover:shadow-red-500/20">
              <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-red-500 to-rose-500 flex items-center justify-center text-2xl shadow-lg">🧠</div>
                <h3 class="text-xl font-bold text-white">Communication: Collaboration</h3>
                <span class="text-xs text-purple-300/70 bg-purple-500/20 px-2 py-1 rounded-full">{{ communicationCollaborationCommands.length }}</span>
              </div>
              <div class="space-y-2 max-h-64 overflow-y-auto custom-scrollbar">
                <button v-for="cmd in communicationCollaborationCommands" :key="cmd.id" @click="simulateCommand(cmd)" class="w-full text-left px-3 py-2 bg-white/5 hover:bg-white/10 rounded-lg transition-all duration-200 border border-white/10 hover:border-white/20 group/btn text-sm">
                  <span class="font-semibold text-white block mb-1 group-hover/btn:text-red-300 transition-colors">{{ cmd.name || cmd.id }}</span>
                  <span class="text-xs text-red-300/70 line-clamp-1">{{ (cmd.phrases || []).slice(0, 2).join(', ') }}</span>
                </button>
              </div>
            </div>

            <!-- Communication: Integrations -->
            <div class="group backdrop-blur-xl bg-white/10 rounded-3xl shadow-2xl border border-white/20 p-6 hover:bg-white/15 transition-all duration-300 hover:scale-105 hover:shadow-indigo-500/20">
              <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-indigo-500 to-violet-500 flex items-center justify-center text-2xl shadow-lg">🔗</div>
                <h3 class="text-xl font-bold text-white">Communication: Integrations</h3>
                <span class="text-xs text-purple-300/70 bg-purple-500/20 px-2 py-1 rounded-full">{{ communicationIntegrationCommands.length }}</span>
              </div>
              <div class="space-y-2 max-h-64 overflow-y-auto custom-scrollbar">
                <button v-for="cmd in communicationIntegrationCommands" :key="cmd.id" @click="simulateCommand(cmd)" class="w-full text-left px-3 py-2 bg-white/5 hover:bg-white/10 rounded-lg transition-all duration-200 border border-white/10 hover:border-white/20 group/btn text-sm">
                  <span class="font-semibold text-white block mb-1 group-hover/btn:text-indigo-300 transition-colors">{{ cmd.name || cmd.id }}</span>
                  <span class="text-xs text-indigo-300/70 line-clamp-1">{{ (cmd.phrases || []).slice(0, 2).join(', ') }}</span>
                </button>
              </div>
            </div>

            <!-- Communication: Security & Profile -->
            <div class="group backdrop-blur-xl bg-white/10 rounded-3xl shadow-2xl border border-white/20 p-6 hover:bg-white/15 transition-all duration-300 hover:scale-105 hover:shadow-yellow-500/20">
              <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-yellow-500 to-amber-500 flex items-center justify-center text-2xl shadow-lg">🔐</div>
                <h3 class="text-xl font-bold text-white">Communication: Security</h3>
                <span class="text-xs text-purple-300/70 bg-purple-500/20 px-2 py-1 rounded-full">{{ communicationSecurityCommands.length }}</span>
              </div>
              <div class="space-y-2 max-h-64 overflow-y-auto custom-scrollbar">
                <button v-for="cmd in communicationSecurityCommands" :key="cmd.id" @click="simulateCommand(cmd)" class="w-full text-left px-3 py-2 bg-white/5 hover:bg-white/10 rounded-lg transition-all duration-200 border border-white/10 hover:border-white/20 group/btn text-sm">
                  <span class="font-semibold text-white block mb-1 group-hover/btn:text-yellow-300 transition-colors">{{ cmd.name || cmd.id }}</span>
                  <span class="text-xs text-yellow-300/70 line-clamp-1">{{ (cmd.phrases || []).slice(0, 2).join(', ') }}</span>
                </button>
              </div>
            </div>

            <!-- Communication: Admin Actions -->
            <div class="group backdrop-blur-xl bg-white/10 rounded-3xl shadow-2xl border border-white/20 p-6 hover:bg-white/15 transition-all duration-300 hover:scale-105 hover:shadow-pink-500/20">
              <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-pink-500 to-rose-500 flex items-center justify-center text-2xl shadow-lg">👑</div>
                <h3 class="text-xl font-bold text-white">Communication: Admin</h3>
                <span class="text-xs text-purple-300/70 bg-purple-500/20 px-2 py-1 rounded-full">{{ communicationAdminCommands.length }}</span>
              </div>
              <div class="space-y-2 max-h-64 overflow-y-auto custom-scrollbar">
                <button v-for="cmd in communicationAdminCommands" :key="cmd.id" @click="simulateCommand(cmd)" class="w-full text-left px-3 py-2 bg-white/5 hover:bg-white/10 rounded-lg transition-all duration-200 border border-white/10 hover:border-white/20 group/btn text-sm">
                  <span class="font-semibold text-white block mb-1 group-hover/btn:text-pink-300 transition-colors">{{ cmd.name || cmd.id }}</span>
                  <span class="text-xs text-pink-300/70 line-clamp-1">{{ (cmd.phrases || []).slice(0, 2).join(', ') }}</span>
                </button>
              </div>
            </div>

            <!-- Communication: Common -->
            <div class="group backdrop-blur-xl bg-white/10 rounded-3xl shadow-2xl border border-white/20 p-6 hover:bg-white/15 transition-all duration-300 hover:scale-105 hover:shadow-cyan-500/20">
              <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-cyan-500 to-blue-500 flex items-center justify-center text-2xl shadow-lg">⚙️</div>
                <h3 class="text-xl font-bold text-white">Communication: Common</h3>
                <span class="text-xs text-purple-300/70 bg-purple-500/20 px-2 py-1 rounded-full">{{ communicationCommonCommands.length }}</span>
              </div>
              <div class="space-y-2 max-h-64 overflow-y-auto custom-scrollbar">
                <button v-for="cmd in communicationCommonCommands" :key="cmd.id" @click="simulateCommand(cmd)" class="w-full text-left px-3 py-2 bg-white/5 hover:bg-white/10 rounded-lg transition-all duration-200 border border-white/10 hover:border-white/20 group/btn text-sm">
                  <span class="font-semibold text-white block mb-1 group-hover/btn:text-cyan-300 transition-colors">{{ cmd.name || cmd.id }}</span>
                  <span class="text-xs text-cyan-300/70 line-clamp-1">{{ (cmd.phrases || []).slice(0, 2).join(', ') }}</span>
                </button>
              </div>
            </div>

            <!-- Development: Project & Code -->
            <div class="group backdrop-blur-xl bg-white/10 rounded-3xl shadow-2xl border border-white/20 p-6 hover:bg-white/15 transition-all duration-300 hover:scale-105 hover:shadow-blue-500/20">
              <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-500 to-indigo-500 flex items-center justify-center text-2xl shadow-lg">👨‍💻</div>
                <h3 class="text-xl font-bold text-white">Development: Project</h3>
                <span class="text-xs text-purple-300/70 bg-purple-500/20 px-2 py-1 rounded-full">{{ developmentProjectCommands.length }}</span>
              </div>
              <div class="space-y-2 max-h-64 overflow-y-auto custom-scrollbar">
                <button v-for="cmd in developmentProjectCommands" :key="cmd.id" @click="simulateCommand(cmd)" class="w-full text-left px-3 py-2 bg-white/5 hover:bg-white/10 rounded-lg transition-all duration-200 border border-white/10 hover:border-white/20 group/btn text-sm">
                  <span class="font-semibold text-white block mb-1 group-hover/btn:text-blue-300 transition-colors">{{ cmd.name || cmd.id }}</span>
                  <span class="text-xs text-blue-300/70 line-clamp-1">{{ (cmd.phrases || []).slice(0, 2).join(', ') }}</span>
                </button>
              </div>
            </div>

            <!-- Development: Collaboration -->
            <div class="group backdrop-blur-xl bg-white/10 rounded-3xl shadow-2xl border border-white/20 p-6 hover:bg-white/15 transition-all duration-300 hover:scale-105 hover:shadow-green-500/20">
              <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-green-500 to-emerald-500 flex items-center justify-center text-2xl shadow-lg">🔀</div>
                <h3 class="text-xl font-bold text-white">Development: Collaboration</h3>
                <span class="text-xs text-purple-300/70 bg-purple-500/20 px-2 py-1 rounded-full">{{ developmentCollaborationCommands.length }}</span>
              </div>
              <div class="space-y-2 max-h-64 overflow-y-auto custom-scrollbar">
                <button v-for="cmd in developmentCollaborationCommands" :key="cmd.id" @click="simulateCommand(cmd)" class="w-full text-left px-3 py-2 bg-white/5 hover:bg-white/10 rounded-lg transition-all duration-200 border border-white/10 hover:border-white/20 group/btn text-sm">
                  <span class="font-semibold text-white block mb-1 group-hover/btn:text-green-300 transition-colors">{{ cmd.name || cmd.id }}</span>
                  <span class="text-xs text-green-300/70 line-clamp-1">{{ (cmd.phrases || []).slice(0, 2).join(', ') }}</span>
                </button>
              </div>
            </div>

            <!-- Development: Deploy -->
            <div class="group backdrop-blur-xl bg-white/10 rounded-3xl shadow-2xl border border-white/20 p-6 hover:bg-white/15 transition-all duration-300 hover:scale-105 hover:shadow-purple-500/20">
              <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-purple-500 to-pink-500 flex items-center justify-center text-2xl shadow-lg">🚀</div>
                <h3 class="text-xl font-bold text-white">Development: Deploy</h3>
                <span class="text-xs text-purple-300/70 bg-purple-500/20 px-2 py-1 rounded-full">{{ developmentDeployCommands.length }}</span>
              </div>
              <div class="space-y-2 max-h-64 overflow-y-auto custom-scrollbar">
                <button v-for="cmd in developmentDeployCommands" :key="cmd.id" @click="simulateCommand(cmd)" class="w-full text-left px-3 py-2 bg-white/5 hover:bg-white/10 rounded-lg transition-all duration-200 border border-white/10 hover:border-white/20 group/btn text-sm">
                  <span class="font-semibold text-white block mb-1 group-hover/btn:text-purple-300 transition-colors">{{ cmd.name || cmd.id }}</span>
                  <span class="text-xs text-purple-300/70 line-clamp-1">{{ (cmd.phrases || []).slice(0, 2).join(', ') }}</span>
                </button>
              </div>
            </div>

            <!-- Development: Integration -->
            <div class="group backdrop-blur-xl bg-white/10 rounded-3xl shadow-2xl border border-white/20 p-6 hover:bg-white/15 transition-all duration-300 hover:scale-105 hover:shadow-orange-500/20">
              <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-orange-500 to-amber-500 flex items-center justify-center text-2xl shadow-lg">⚙️</div>
                <h3 class="text-xl font-bold text-white">Development: Integration</h3>
                <span class="text-xs text-purple-300/70 bg-purple-500/20 px-2 py-1 rounded-full">{{ developmentIntegrationCommands.length }}</span>
              </div>
              <div class="space-y-2 max-h-64 overflow-y-auto custom-scrollbar">
                <button v-for="cmd in developmentIntegrationCommands" :key="cmd.id" @click="simulateCommand(cmd)" class="w-full text-left px-3 py-2 bg-white/5 hover:bg-white/10 rounded-lg transition-all duration-200 border border-white/10 hover:border-white/20 group/btn text-sm">
                  <span class="font-semibold text-white block mb-1 group-hover/btn:text-orange-300 transition-colors">{{ cmd.name || cmd.id }}</span>
                  <span class="text-xs text-orange-300/70 line-clamp-1">{{ (cmd.phrases || []).slice(0, 2).join(', ') }}</span>
                </button>
              </div>
            </div>

            <!-- Development: Version Control -->
            <div class="group backdrop-blur-xl bg-white/10 rounded-3xl shadow-2xl border border-white/20 p-6 hover:bg-white/15 transition-all duration-300 hover:scale-105 hover:shadow-teal-500/20">
              <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-teal-500 to-cyan-500 flex items-center justify-center text-2xl shadow-lg">🧠</div>
                <h3 class="text-xl font-bold text-white">Development: Version</h3>
                <span class="text-xs text-purple-300/70 bg-purple-500/20 px-2 py-1 rounded-full">{{ developmentVersionCommands.length }}</span>
              </div>
              <div class="space-y-2 max-h-64 overflow-y-auto custom-scrollbar">
                <button v-for="cmd in developmentVersionCommands" :key="cmd.id" @click="simulateCommand(cmd)" class="w-full text-left px-3 py-2 bg-white/5 hover:bg-white/10 rounded-lg transition-all duration-200 border border-white/10 hover:border-white/20 group/btn text-sm">
                  <span class="font-semibold text-white block mb-1 group-hover/btn:text-teal-300 transition-colors">{{ cmd.name || cmd.id }}</span>
                  <span class="text-xs text-teal-300/70 line-clamp-1">{{ (cmd.phrases || []).slice(0, 2).join(', ') }}</span>
                </button>
              </div>
            </div>

            <!-- Development: Testing -->
            <div class="group backdrop-blur-xl bg-white/10 rounded-3xl shadow-2xl border border-white/20 p-6 hover:bg-white/15 transition-all duration-300 hover:scale-105 hover:shadow-red-500/20">
              <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-red-500 to-rose-500 flex items-center justify-center text-2xl shadow-lg">📊</div>
                <h3 class="text-xl font-bold text-white">Development: Testing</h3>
                <span class="text-xs text-purple-300/70 bg-purple-500/20 px-2 py-1 rounded-full">{{ developmentTestingCommands.length }}</span>
              </div>
              <div class="space-y-2 max-h-64 overflow-y-auto custom-scrollbar">
                <button v-for="cmd in developmentTestingCommands" :key="cmd.id" @click="simulateCommand(cmd)" class="w-full text-left px-3 py-2 bg-white/5 hover:bg-white/10 rounded-lg transition-all duration-200 border border-white/10 hover:border-white/20 group/btn text-sm">
                  <span class="font-semibold text-white block mb-1 group-hover/btn:text-red-300 transition-colors">{{ cmd.name || cmd.id }}</span>
                  <span class="text-xs text-red-300/70 line-clamp-1">{{ (cmd.phrases || []).slice(0, 2).join(', ') }}</span>
                </button>
              </div>
            </div>

            <!-- Development: Security -->
            <div class="group backdrop-blur-xl bg-white/10 rounded-3xl shadow-2xl border border-white/20 p-6 hover:bg-white/15 transition-all duration-300 hover:scale-105 hover:shadow-yellow-500/20">
              <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-yellow-500 to-amber-500 flex items-center justify-center text-2xl shadow-lg">🔒</div>
                <h3 class="text-xl font-bold text-white">Development: Security</h3>
                <span class="text-xs text-purple-300/70 bg-purple-500/20 px-2 py-1 rounded-full">{{ developmentSecurityCommands.length }}</span>
              </div>
              <div class="space-y-2 max-h-64 overflow-y-auto custom-scrollbar">
                <button v-for="cmd in developmentSecurityCommands" :key="cmd.id" @click="simulateCommand(cmd)" class="w-full text-left px-3 py-2 bg-white/5 hover:bg-white/10 rounded-lg transition-all duration-200 border border-white/10 hover:border-white/20 group/btn text-sm">
                  <span class="font-semibold text-white block mb-1 group-hover/btn:text-yellow-300 transition-colors">{{ cmd.name || cmd.id }}</span>
                  <span class="text-xs text-yellow-300/70 line-clamp-1">{{ (cmd.phrases || []).slice(0, 2).join(', ') }}</span>
                </button>
              </div>
            </div>

            <!-- Development: Package -->
            <div class="group backdrop-blur-xl bg-white/10 rounded-3xl shadow-2xl border border-white/20 p-6 hover:bg-white/15 transition-all duration-300 hover:scale-105 hover:shadow-indigo-500/20">
              <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-indigo-500 to-violet-500 flex items-center justify-center text-2xl shadow-lg">🧰</div>
                <h3 class="text-xl font-bold text-white">Development: Package</h3>
                <span class="text-xs text-purple-300/70 bg-purple-500/20 px-2 py-1 rounded-full">{{ developmentPackageCommands.length }}</span>
              </div>
              <div class="space-y-2 max-h-64 overflow-y-auto custom-scrollbar">
                <button v-for="cmd in developmentPackageCommands" :key="cmd.id" @click="simulateCommand(cmd)" class="w-full text-left px-3 py-2 bg-white/5 hover:bg-white/10 rounded-lg transition-all duration-200 border border-white/10 hover:border-white/20 group/btn text-sm">
                  <span class="font-semibold text-white block mb-1 group-hover/btn:text-indigo-300 transition-colors">{{ cmd.name || cmd.id }}</span>
                  <span class="text-xs text-indigo-300/70 line-clamp-1">{{ (cmd.phrases || []).slice(0, 2).join(', ') }}</span>
                </button>
              </div>
            </div>

            <!-- Development: Environment -->
            <div class="group backdrop-blur-xl bg-white/10 rounded-3xl shadow-2xl border border-white/20 p-6 hover:bg-white/15 transition-all duration-300 hover:scale-105 hover:shadow-pink-500/20">
              <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-pink-500 to-rose-500 flex items-center justify-center text-2xl shadow-lg">🪄</div>
                <h3 class="text-xl font-bold text-white">Development: Environment</h3>
                <span class="text-xs text-purple-300/70 bg-purple-500/20 px-2 py-1 rounded-full">{{ developmentEnvironmentCommands.length }}</span>
              </div>
              <div class="space-y-2 max-h-64 overflow-y-auto custom-scrollbar">
                <button v-for="cmd in developmentEnvironmentCommands" :key="cmd.id" @click="simulateCommand(cmd)" class="w-full text-left px-3 py-2 bg-white/5 hover:bg-white/10 rounded-lg transition-all duration-200 border border-white/10 hover:border-white/20 group/btn text-sm">
                  <span class="font-semibold text-white block mb-1 group-hover/btn:text-pink-300 transition-colors">{{ cmd.name || cmd.id }}</span>
                  <span class="text-xs text-pink-300/70 line-clamp-1">{{ (cmd.phrases || []).slice(0, 2).join(', ') }}</span>
                </button>
              </div>
            </div>

            <!-- Development: Admin -->
            <div class="group backdrop-blur-xl bg-white/10 rounded-3xl shadow-2xl border border-white/20 p-6 hover:bg-white/15 transition-all duration-300 hover:scale-105 hover:shadow-cyan-500/20">
              <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-cyan-500 to-blue-500 flex items-center justify-center text-2xl shadow-lg">👑</div>
                <h3 class="text-xl font-bold text-white">Development: Admin</h3>
                <span class="text-xs text-purple-300/70 bg-purple-500/20 px-2 py-1 rounded-full">{{ developmentAdminCommands.length }}</span>
              </div>
              <div class="space-y-2 max-h-64 overflow-y-auto custom-scrollbar">
                <button v-for="cmd in developmentAdminCommands" :key="cmd.id" @click="simulateCommand(cmd)" class="w-full text-left px-3 py-2 bg-white/5 hover:bg-white/10 rounded-lg transition-all duration-200 border border-white/10 hover:border-white/20 group/btn text-sm">
                  <span class="font-semibold text-white block mb-1 group-hover/btn:text-cyan-300 transition-colors">{{ cmd.name || cmd.id }}</span>
                  <span class="text-xs text-cyan-300/70 line-clamp-1">{{ (cmd.phrases || []).slice(0, 2).join(', ') }}</span>
                </button>
              </div>
            </div>

            <!-- Development: Common -->
            <div class="group backdrop-blur-xl bg-white/10 rounded-3xl shadow-2xl border border-white/20 p-6 hover:bg-white/15 transition-all duration-300 hover:scale-105 hover:shadow-emerald-500/20">
              <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-emerald-500 to-green-500 flex items-center justify-center text-2xl shadow-lg">⚙️</div>
                <h3 class="text-xl font-bold text-white">Development: Common</h3>
                <span class="text-xs text-purple-300/70 bg-purple-500/20 px-2 py-1 rounded-full">{{ developmentCommonCommands.length }}</span>
              </div>
              <div class="space-y-2 max-h-64 overflow-y-auto custom-scrollbar">
                <button v-for="cmd in developmentCommonCommands" :key="cmd.id" @click="simulateCommand(cmd)" class="w-full text-left px-3 py-2 bg-white/5 hover:bg-white/10 rounded-lg transition-all duration-200 border border-white/10 hover:border-white/20 group/btn text-sm">
                  <span class="font-semibold text-white block mb-1 group-hover/btn:text-emerald-300 transition-colors">{{ cmd.name || cmd.id }}</span>
                  <span class="text-xs text-emerald-300/70 line-clamp-1">{{ (cmd.phrases || []).slice(0, 2).join(', ') }}</span>
                </button>
              </div>
            </div>
          </div>
        </div>

        <!-- AI Platform Commands -->
        <div class="backdrop-blur-xl bg-white/10 rounded-3xl shadow-2xl border border-white/20 p-6 sm:p-8 mb-8">
          <h2 class="text-3xl sm:text-4xl font-bold mb-6 bg-clip-text text-transparent bg-gradient-to-r from-cyan-400 to-blue-500 flex items-center gap-3">
            <span class="text-4xl">🤖</span>
            <span>AI Platform Commands</span>
          </h2>
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-4">
            <!-- AI: Interaction & Content Creation -->
            <div class="bg-gradient-to-br from-cyan-500/20 to-blue-500/20 rounded-2xl border border-cyan-400/30 p-4 backdrop-blur-sm">
              <div class="flex items-center justify-between mb-3">
                <h3 class="text-lg font-bold text-white flex items-center gap-2">
                  <span>💬</span>
                  <span>Interaction</span>
                </h3>
                <span class="text-xs text-purple-300/70 bg-purple-500/20 px-2 py-1 rounded-full">{{ aiInteractionCommands.length }}</span>
              </div>
              <div class="space-y-2 max-h-64 overflow-y-auto custom-scrollbar">
                <button v-for="cmd in aiInteractionCommands" :key="cmd.id" @click="simulateCommand(cmd)" class="w-full text-left px-3 py-2 bg-white/5 hover:bg-white/10 rounded-lg transition-all duration-200 border border-white/10 hover:border-white/20 group/btn text-sm">
                  <span class="font-semibold text-white block mb-1 group-hover/btn:text-cyan-300 transition-colors">{{ cmd.name || cmd.id }}</span>
                  <span class="text-xs text-cyan-300/70 line-clamp-1">{{ (cmd.phrases || []).slice(0, 2).join(', ') }}</span>
                </button>
              </div>
            </div>

            <!-- AI: Multimodal Generation -->
            <div class="bg-gradient-to-br from-pink-500/20 to-rose-500/20 rounded-2xl border border-pink-400/30 p-4 backdrop-blur-sm">
              <div class="flex items-center justify-between mb-3">
                <h3 class="text-lg font-bold text-white flex items-center gap-2">
                  <span>🎨</span>
                  <span>Multimodal</span>
                </h3>
                <span class="text-xs text-purple-300/70 bg-purple-500/20 px-2 py-1 rounded-full">{{ aiMultimodalCommands.length }}</span>
              </div>
              <div class="space-y-2 max-h-64 overflow-y-auto custom-scrollbar">
                <button v-for="cmd in aiMultimodalCommands" :key="cmd.id" @click="simulateCommand(cmd)" class="w-full text-left px-3 py-2 bg-white/5 hover:bg-white/10 rounded-lg transition-all duration-200 border border-white/10 hover:border-white/20 group/btn text-sm">
                  <span class="font-semibold text-white block mb-1 group-hover/btn:text-pink-300 transition-colors">{{ cmd.name || cmd.id }}</span>
                  <span class="text-xs text-pink-300/70 line-clamp-1">{{ (cmd.phrases || []).slice(0, 2).join(', ') }}</span>
                </button>
              </div>
            </div>

            <!-- AI: Personalization & Training -->
            <div class="bg-gradient-to-br from-purple-500/20 to-indigo-500/20 rounded-2xl border border-purple-400/30 p-4 backdrop-blur-sm">
              <div class="flex items-center justify-between mb-3">
                <h3 class="text-lg font-bold text-white flex items-center gap-2">
                  <span>🧠</span>
                  <span>Personalization</span>
                </h3>
                <span class="text-xs text-purple-300/70 bg-purple-500/20 px-2 py-1 rounded-full">{{ aiPersonalizationCommands.length }}</span>
              </div>
              <div class="space-y-2 max-h-64 overflow-y-auto custom-scrollbar">
                <button v-for="cmd in aiPersonalizationCommands" :key="cmd.id" @click="simulateCommand(cmd)" class="w-full text-left px-3 py-2 bg-white/5 hover:bg-white/10 rounded-lg transition-all duration-200 border border-white/10 hover:border-white/20 group/btn text-sm">
                  <span class="font-semibold text-white block mb-1 group-hover/btn:text-purple-300 transition-colors">{{ cmd.name || cmd.id }}</span>
                  <span class="text-xs text-purple-300/70 line-clamp-1">{{ (cmd.phrases || []).slice(0, 2).join(', ') }}</span>
                </button>
              </div>
            </div>

            <!-- AI: Integration & Collaboration -->
            <div class="bg-gradient-to-br from-green-500/20 to-emerald-500/20 rounded-2xl border border-green-400/30 p-4 backdrop-blur-sm">
              <div class="flex items-center justify-between mb-3">
                <h3 class="text-lg font-bold text-white flex items-center gap-2">
                  <span>🔗</span>
                  <span>Integration</span>
                </h3>
                <span class="text-xs text-purple-300/70 bg-purple-500/20 px-2 py-1 rounded-full">{{ aiIntegrationCommands.length }}</span>
              </div>
              <div class="space-y-2 max-h-64 overflow-y-auto custom-scrollbar">
                <button v-for="cmd in aiIntegrationCommands" :key="cmd.id" @click="simulateCommand(cmd)" class="w-full text-left px-3 py-2 bg-white/5 hover:bg-white/10 rounded-lg transition-all duration-200 border border-white/10 hover:border-white/20 group/btn text-sm">
                  <span class="font-semibold text-white block mb-1 group-hover/btn:text-green-300 transition-colors">{{ cmd.name || cmd.id }}</span>
                  <span class="text-xs text-green-300/70 line-clamp-1">{{ (cmd.phrases || []).slice(0, 2).join(', ') }}</span>
                </button>
              </div>
            </div>

            <!-- AI: Data Analysis & Understanding -->
            <div class="bg-gradient-to-br from-orange-500/20 to-amber-500/20 rounded-2xl border border-orange-400/30 p-4 backdrop-blur-sm">
              <div class="flex items-center justify-between mb-3">
                <h3 class="text-lg font-bold text-white flex items-center gap-2">
                  <span>📊</span>
                  <span>Analysis</span>
                </h3>
                <span class="text-xs text-purple-300/70 bg-purple-500/20 px-2 py-1 rounded-full">{{ aiAnalysisCommands.length }}</span>
              </div>
              <div class="space-y-2 max-h-64 overflow-y-auto custom-scrollbar">
                <button v-for="cmd in aiAnalysisCommands" :key="cmd.id" @click="simulateCommand(cmd)" class="w-full text-left px-3 py-2 bg-white/5 hover:bg-white/10 rounded-lg transition-all duration-200 border border-white/10 hover:border-white/20 group/btn text-sm">
                  <span class="font-semibold text-white block mb-1 group-hover/btn:text-orange-300 transition-colors">{{ cmd.name || cmd.id }}</span>
                  <span class="text-xs text-orange-300/70 line-clamp-1">{{ (cmd.phrases || []).slice(0, 2).join(', ') }}</span>
                </button>
              </div>
            </div>

            <!-- AI: Security & Account Management -->
            <div class="bg-gradient-to-br from-red-500/20 to-rose-500/20 rounded-2xl border border-red-400/30 p-4 backdrop-blur-sm">
              <div class="flex items-center justify-between mb-3">
                <h3 class="text-lg font-bold text-white flex items-center gap-2">
                  <span>🔐</span>
                  <span>Security</span>
                </h3>
                <span class="text-xs text-purple-300/70 bg-purple-500/20 px-2 py-1 rounded-full">{{ aiSecurityCommands.length }}</span>
              </div>
              <div class="space-y-2 max-h-64 overflow-y-auto custom-scrollbar">
                <button v-for="cmd in aiSecurityCommands" :key="cmd.id" @click="simulateCommand(cmd)" class="w-full text-left px-3 py-2 bg-white/5 hover:bg-white/10 rounded-lg transition-all duration-200 border border-white/10 hover:border-white/20 group/btn text-sm">
                  <span class="font-semibold text-white block mb-1 group-hover/btn:text-red-300 transition-colors">{{ cmd.name || cmd.id }}</span>
                  <span class="text-xs text-red-300/70 line-clamp-1">{{ (cmd.phrases || []).slice(0, 2).join(', ') }}</span>
                </button>
              </div>
            </div>

            <!-- AI: Payment & Subscription -->
            <div class="bg-gradient-to-br from-yellow-500/20 to-amber-500/20 rounded-2xl border border-yellow-400/30 p-4 backdrop-blur-sm">
              <div class="flex items-center justify-between mb-3">
                <h3 class="text-lg font-bold text-white flex items-center gap-2">
                  <span>💵</span>
                  <span>Payment</span>
                </h3>
                <span class="text-xs text-purple-300/70 bg-purple-500/20 px-2 py-1 rounded-full">{{ aiPaymentCommands.length }}</span>
              </div>
              <div class="space-y-2 max-h-64 overflow-y-auto custom-scrollbar">
                <button v-for="cmd in aiPaymentCommands" :key="cmd.id" @click="simulateCommand(cmd)" class="w-full text-left px-3 py-2 bg-white/5 hover:bg-white/10 rounded-lg transition-all duration-200 border border-white/10 hover:border-white/20 group/btn text-sm">
                  <span class="font-semibold text-white block mb-1 group-hover/btn:text-yellow-300 transition-colors">{{ cmd.name || cmd.id }}</span>
                  <span class="text-xs text-yellow-300/70 line-clamp-1">{{ (cmd.phrases || []).slice(0, 2).join(', ') }}</span>
                </button>
              </div>
            </div>

            <!-- AI: Development & Testing -->
            <div class="bg-gradient-to-br from-teal-500/20 to-cyan-500/20 rounded-2xl border border-teal-400/30 p-4 backdrop-blur-sm">
              <div class="flex items-center justify-between mb-3">
                <h3 class="text-lg font-bold text-white flex items-center gap-2">
                  <span>⚙️</span>
                  <span>Development</span>
                </h3>
                <span class="text-xs text-purple-300/70 bg-purple-500/20 px-2 py-1 rounded-full">{{ aiDevelopmentCommands.length }}</span>
              </div>
              <div class="space-y-2 max-h-64 overflow-y-auto custom-scrollbar">
                <button v-for="cmd in aiDevelopmentCommands" :key="cmd.id" @click="simulateCommand(cmd)" class="w-full text-left px-3 py-2 bg-white/5 hover:bg-white/10 rounded-lg transition-all duration-200 border border-white/10 hover:border-white/20 group/btn text-sm">
                  <span class="font-semibold text-white block mb-1 group-hover/btn:text-teal-300 transition-colors">{{ cmd.name || cmd.id }}</span>
                  <span class="text-xs text-teal-300/70 line-clamp-1">{{ (cmd.phrases || []).slice(0, 2).join(', ') }}</span>
                </button>
              </div>
            </div>

            <!-- AI: Analytics & Monitoring -->
            <div class="bg-gradient-to-br from-indigo-500/20 to-violet-500/20 rounded-2xl border border-indigo-400/30 p-4 backdrop-blur-sm">
              <div class="flex items-center justify-between mb-3">
                <h3 class="text-lg font-bold text-white flex items-center gap-2">
                  <span>📈</span>
                  <span>Analytics</span>
                </h3>
                <span class="text-xs text-purple-300/70 bg-purple-500/20 px-2 py-1 rounded-full">{{ aiAnalyticsCommands.length }}</span>
              </div>
              <div class="space-y-2 max-h-64 overflow-y-auto custom-scrollbar">
                <button v-for="cmd in aiAnalyticsCommands" :key="cmd.id" @click="simulateCommand(cmd)" class="w-full text-left px-3 py-2 bg-white/5 hover:bg-white/10 rounded-lg transition-all duration-200 border border-white/10 hover:border-white/20 group/btn text-sm">
                  <span class="font-semibold text-white block mb-1 group-hover/btn:text-indigo-300 transition-colors">{{ cmd.name || cmd.id }}</span>
                  <span class="text-xs text-indigo-300/70 line-clamp-1">{{ (cmd.phrases || []).slice(0, 2).join(', ') }}</span>
                </button>
              </div>
            </div>

            <!-- AI: Learning & Exploration -->
            <div class="bg-gradient-to-br from-blue-500/20 to-sky-500/20 rounded-2xl border border-blue-400/30 p-4 backdrop-blur-sm">
              <div class="flex items-center justify-between mb-3">
                <h3 class="text-lg font-bold text-white flex items-center gap-2">
                  <span>🧭</span>
                  <span>Learning</span>
                </h3>
                <span class="text-xs text-purple-300/70 bg-purple-500/20 px-2 py-1 rounded-full">{{ aiLearningCommands.length }}</span>
              </div>
              <div class="space-y-2 max-h-64 overflow-y-auto custom-scrollbar">
                <button v-for="cmd in aiLearningCommands" :key="cmd.id" @click="simulateCommand(cmd)" class="w-full text-left px-3 py-2 bg-white/5 hover:bg-white/10 rounded-lg transition-all duration-200 border border-white/10 hover:border-white/20 group/btn text-sm">
                  <span class="font-semibold text-white block mb-1 group-hover/btn:text-blue-300 transition-colors">{{ cmd.name || cmd.id }}</span>
                  <span class="text-xs text-blue-300/70 line-clamp-1">{{ (cmd.phrases || []).slice(0, 2).join(', ') }}</span>
                </button>
              </div>
            </div>
          </div>
        </div>

        <!-- Demo Area -->
        <div class="backdrop-blur-xl bg-white/10 rounded-3xl shadow-2xl border border-white/20 p-6 sm:p-8 mb-8">
          <h2 class="text-3xl sm:text-4xl font-bold mb-6 bg-clip-text text-transparent bg-gradient-to-r from-teal-400 to-green-500 flex items-center gap-3">
            <span class="text-4xl">🎯</span>
            <span>Interactive Demo Area</span>
          </h2>
          <p class="text-purple-200 mb-6">Try saying commands like "scroll down", "scroll up", "like", "unlike" to see them in action:</p>
          
          <!-- Scrollable Demo Content -->
          <div 
            ref="demoContent"
            class="border-2 border-dashed border-white/20 rounded-2xl p-8 min-h-[400px] max-h-[600px] overflow-y-auto bg-gradient-to-br from-slate-800/50 to-purple-900/50 backdrop-blur-sm custom-scrollbar"
          >
            <div v-for="i in 10" :key="i" class="mb-6 p-6 bg-white/10 backdrop-blur-sm rounded-2xl border border-white/10 hover:bg-white/15 transition-all duration-300 hover:scale-[1.02]">
              <h3 class="font-bold text-xl text-white mb-3">Demo Item {{ i }}</h3>
              <p class="text-purple-200 mb-4">This is a demo element. Try commands like "scroll down", "scroll up", "like", "unlike", "share", "save" to interact with this content.</p>
              <div class="flex gap-3 flex-wrap">
                <button 
                  @click="toggleLike"
                  :class="[
                    'px-5 py-2.5 rounded-xl transition-all shadow-lg font-semibold',
                    isLiked ? 'bg-gradient-to-r from-red-500 to-pink-500 hover:from-red-600 hover:to-pink-600' : 'bg-gradient-to-r from-blue-500 to-cyan-500 hover:from-blue-600 hover:to-cyan-600'
                  ]"
                >
                  {{ isLiked ? '❤️ Liked' : '🤍 Like' }}
                </button>
                <button class="px-5 py-2.5 bg-gradient-to-r from-green-500 to-emerald-500 text-white rounded-xl hover:from-green-600 hover:to-emerald-600 transition-all shadow-lg hover:shadow-green-500/50 font-semibold">
                  Share
                </button>
                <button class="px-5 py-2.5 bg-gradient-to-r from-purple-500 to-pink-500 text-white rounded-xl hover:from-purple-600 hover:to-pink-600 transition-all shadow-lg hover:shadow-purple-500/50 font-semibold">
                  Save
                </button>
              </div>
            </div>
          </div>
        </div>

        <!-- Command History -->
        <div class="backdrop-blur-xl bg-white/10 rounded-3xl shadow-2xl border border-white/20 p-6 sm:p-8">
          <h2 class="text-3xl sm:text-4xl font-bold mb-6 bg-clip-text text-transparent bg-gradient-to-r from-yellow-400 to-orange-500 flex items-center gap-3">
            <span class="text-4xl">📜</span>
            <span>Command History</span>
          </h2>
          <div v-if="commandHistory.length === 0" class="text-purple-300 text-center py-12">
            <div class="text-6xl mb-4 opacity-50">🎤</div>
            <p class="text-lg">No commands executed yet. Start listening and try the commands!</p>
          </div>
          <div v-else class="space-y-3 max-h-64 overflow-y-auto custom-scrollbar">
            <TransitionGroup name="list">
              <div
                v-for="(cmd, index) in commandHistory"
                :key="index"
                class="p-4 bg-gradient-to-r from-purple-500/20 to-pink-500/20 backdrop-blur-sm rounded-xl border border-white/10 hover:border-white/20 transition-all hover:scale-[1.02] flex items-center justify-between"
              >
                <div class="flex items-center gap-3">
                  <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-purple-500 to-pink-500 flex items-center justify-center text-lg">
                    🎯
                  </div>
                  <div>
                    <span class="font-bold text-white block">{{ cmd.name }}</span>
                    <span class="text-purple-300 text-sm">({{ cmd.action }})</span>
                  </div>
                </div>
                <span class="text-xs text-purple-400 font-medium">{{ cmd.time }}</span>
              </div>
            </TransitionGroup>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted, computed } from 'vue'

// Import SDK - use static import if possible, or load from window
let VoiceActionsSDK = null

// Try to get SDK from window first (if loaded via script tag)
if (typeof window !== 'undefined' && window.VoiceActionsSDK) {
  VoiceActionsSDK = window.VoiceActionsSDK
}

const isListening = ref(false)
const selectedLocale = ref('en-US')
const lastTranscript = ref('')
const statusMessage = ref('')
const statusMessageType = ref('info')
const commandHistory = ref([])
const demoContent = ref(null)
const isLiked = ref(false)
let sdk = null
let isInitializing = false
let isDestroyed = false

// Load commands from API
const allCommands = ref([])

// Load commands from API
async function loadCommands() {
  try {
    const baseLocale = selectedLocale.value.split('-')[0]
    // Use relative path to leverage Vite proxy in development, or full URL in production
    const apiUrl = import.meta.env.VITE_API_URL || (import.meta.env.DEV ? '/api' : 'https://api.voiceactions.dev/api')
    const response = await fetch(`${apiUrl}/commands/demo?locale=${selectedLocale.value}&platform_name=demo`)
    if (response.ok) {
      const data = await response.json()
      allCommands.value = data.commands || []
      console.log(`Loaded ${allCommands.value.length} commands from API`)
    } else {
      console.error('Failed to load commands: HTTP', response.status, response.statusText)
    }
  } catch (error) {
    console.error('Failed to load commands:', error)
  }
}

// Computed properties for command categories
const profileCommands = computed(() => {
  return allCommands.value.filter(cmd => cmd.category === 'profile').slice(0, 8)
})

const contentPostingCommands = computed(() => {
  return allCommands.value.filter(cmd => cmd.category === 'content').slice(0, 12)
})

const interactionCommands = computed(() => {
  return allCommands.value.filter(cmd => cmd.category === 'interaction').slice(0, 16)
})

const messagingCommands = computed(() => {
  return allCommands.value.filter(cmd => cmd.category === 'messaging').slice(0, 9)
})

const privacyCommands = computed(() => {
  return allCommands.value.filter(cmd => cmd.category === 'privacy').slice(0, 6)
})

const analyticsCommands = computed(() => {
  return allCommands.value.filter(cmd => cmd.category === 'analytics').slice(0, 5)
})

const monetizationCommands = computed(() => {
  return allCommands.value.filter(cmd => cmd.category === 'monetization').slice(0, 3)
})

const liveCommands = computed(() => {
  return allCommands.value.filter(cmd => cmd.category === 'live').slice(0, 8)
})

const uxCommands = computed(() => {
  return allCommands.value.filter(cmd => cmd.category === 'ux').slice(0, 4)
})

const businessCommands = computed(() => {
  return allCommands.value.filter(cmd => cmd.category === 'business').slice(0, 3)
})

const navigationCommands = computed(() => {
  return allCommands.value.filter(cmd => cmd.category === 'navigation').slice(0, 11)
})

const mediaCommands = computed(() => {
  return allCommands.value.filter(cmd => cmd.category === 'media').slice(0, 9)
})

const creationCommands = computed(() => {
  return allCommands.value.filter(cmd => cmd.category === 'creation').slice(0, 3)
})

const basicCommands = computed(() => {
  return allCommands.value.filter(cmd => cmd.category === 'basic').slice(0, 3)
})

// E-Commerce Commands
const ecommerceAccountCommands = computed(() => {
  return allCommands.value.filter(cmd => cmd.category === 'ecommerce-account')
})

const ecommerceSearchCommands = computed(() => {
  return allCommands.value.filter(cmd => cmd.category === 'ecommerce-search')
})

const ecommerceOrderCommands = computed(() => {
  return allCommands.value.filter(cmd => cmd.category === 'ecommerce-order')
})

const ecommercePaymentCommands = computed(() => {
  return allCommands.value.filter(cmd => cmd.category === 'ecommerce-payment')
})

const ecommerceShippingCommands = computed(() => {
  return allCommands.value.filter(cmd => cmd.category === 'ecommerce-shipping')
})

const ecommerceSupportCommands = computed(() => {
  return allCommands.value.filter(cmd => cmd.category === 'ecommerce-support')
})

const ecommerceReviewCommands = computed(() => {
  return allCommands.value.filter(cmd => cmd.category === 'ecommerce-review')
})

const ecommerceLoyaltyCommands = computed(() => {
  return allCommands.value.filter(cmd => cmd.category === 'ecommerce-loyalty')
})

const ecommerceReturnCommands = computed(() => {
  return allCommands.value.filter(cmd => cmd.category === 'ecommerce-return')
})

const ecommerceSellerCommands = computed(() => {
  return allCommands.value.filter(cmd => cmd.category === 'ecommerce-seller')
})

// Gaming Commands
const gamingAccountCommands = computed(() => {
  return allCommands.value.filter(cmd => cmd.category === 'gaming-account')
})

const gamingDiscoveryCommands = computed(() => {
  return allCommands.value.filter(cmd => cmd.category === 'gaming-discovery')
})

const gamingDownloadCommands = computed(() => {
  return allCommands.value.filter(cmd => cmd.category === 'gaming-download')
})

const gamingPlayCommands = computed(() => {
  return allCommands.value.filter(cmd => cmd.category === 'gaming-play')
})

const gamingLibraryCommands = computed(() => {
  return allCommands.value.filter(cmd => cmd.category === 'gaming-library')
})

const gamingSocialCommands = computed(() => {
  return allCommands.value.filter(cmd => cmd.category === 'gaming-social')
})

const gamingAchievementCommands = computed(() => {
  return allCommands.value.filter(cmd => cmd.category === 'gaming-achievement')
})

const gamingSupportCommands = computed(() => {
  return allCommands.value.filter(cmd => cmd.category === 'gaming-support')
})

const gamingPurchaseCommands = computed(() => {
  return allCommands.value.filter(cmd => cmd.category === 'gaming-purchase')
})

const gamingSecurityCommands = computed(() => {
  return allCommands.value.filter(cmd => cmd.category === 'gaming-security')
})

const gamingRefundCommands = computed(() => {
  return allCommands.value.filter(cmd => cmd.category === 'gaming-refund')
})

const gamingUxCommands = computed(() => {
  return allCommands.value.filter(cmd => cmd.category === 'gaming-ux')
})

const gamingDeviceCommands = computed(() => {
  return allCommands.value.filter(cmd => cmd.category === 'gaming-device')
})

// Technology Platform Commands
const osCommands = computed(() => {
  return allCommands.value.filter(cmd => cmd.category === 'os')
})

const mobileCommands = computed(() => {
  return allCommands.value.filter(cmd => cmd.category === 'mobile')
})

const cloudCommands = computed(() => {
  return allCommands.value.filter(cmd => cmd.category === 'cloud')
})

const developerCommands = computed(() => {
  return allCommands.value.filter(cmd => cmd.category === 'developer')
})

const techCommonCommands = computed(() => {
  return allCommands.value.filter(cmd => cmd.category === 'tech-common')
})

// Education Commands
const educationStudentCommands = computed(() => {
  return allCommands.value.filter(cmd => cmd.category === 'education-student')
})

const educationInstructorCommands = computed(() => {
  return allCommands.value.filter(cmd => cmd.category === 'education-instructor')
})

const educationCommonCommands = computed(() => {
  return allCommands.value.filter(cmd => cmd.category === 'education-common')
})

// Communication Commands
const communicationChatCommands = computed(() => {
  return allCommands.value.filter(cmd => cmd.category === 'communication-chat')
})

const communicationCallCommands = computed(() => {
  return allCommands.value.filter(cmd => cmd.category === 'communication-call')
})

const communicationGroupCommands = computed(() => {
  return allCommands.value.filter(cmd => cmd.category === 'communication-group')
})

const communicationFileCommands = computed(() => {
  return allCommands.value.filter(cmd => cmd.category === 'communication-file')
})

const communicationNotificationCommands = computed(() => {
  return allCommands.value.filter(cmd => cmd.category === 'communication-notification')
})

const communicationCollaborationCommands = computed(() => {
  return allCommands.value.filter(cmd => cmd.category === 'communication-collaboration')
})

const communicationIntegrationCommands = computed(() => {
  return allCommands.value.filter(cmd => cmd.category === 'communication-integration')
})

const communicationSecurityCommands = computed(() => {
  return allCommands.value.filter(cmd => cmd.category === 'communication-security')
})

const communicationAdminCommands = computed(() => {
  return allCommands.value.filter(cmd => cmd.category === 'communication-admin')
})

const communicationCommonCommands = computed(() => {
  return allCommands.value.filter(cmd => cmd.category === 'communication-common')
})

// Development Commands
const developmentProjectCommands = computed(() => {
  return allCommands.value.filter(cmd => cmd.category === 'development-project')
})

const developmentCollaborationCommands = computed(() => {
  return allCommands.value.filter(cmd => cmd.category === 'development-collaboration')
})

const developmentDeployCommands = computed(() => {
  return allCommands.value.filter(cmd => cmd.category === 'development-deploy')
})

const developmentIntegrationCommands = computed(() => {
  return allCommands.value.filter(cmd => cmd.category === 'development-integration')
})

const developmentVersionCommands = computed(() => {
  return allCommands.value.filter(cmd => cmd.category === 'development-version')
})

const developmentTestingCommands = computed(() => {
  return allCommands.value.filter(cmd => cmd.category === 'development-testing')
})

const developmentSecurityCommands = computed(() => {
  return allCommands.value.filter(cmd => cmd.category === 'development-security')
})

const developmentPackageCommands = computed(() => {
  return allCommands.value.filter(cmd => cmd.category === 'development-package')
})

const developmentEnvironmentCommands = computed(() => {
  return allCommands.value.filter(cmd => cmd.category === 'development-environment')
})

const developmentAdminCommands = computed(() => {
  return allCommands.value.filter(cmd => cmd.category === 'development-admin')
})

const developmentCommonCommands = computed(() => {
  return allCommands.value.filter(cmd => cmd.category === 'development-common')
})

// AI Commands
const aiInteractionCommands = computed(() => {
  return allCommands.value.filter(cmd => cmd.category === 'ai-interaction')
})

const aiMultimodalCommands = computed(() => {
  return allCommands.value.filter(cmd => cmd.category === 'ai-multimodal')
})

const aiPersonalizationCommands = computed(() => {
  return allCommands.value.filter(cmd => cmd.category === 'ai-personalization')
})

const aiIntegrationCommands = computed(() => {
  return allCommands.value.filter(cmd => cmd.category === 'ai-integration')
})

const aiAnalysisCommands = computed(() => {
  return allCommands.value.filter(cmd => cmd.category === 'ai-analysis')
})

const aiSecurityCommands = computed(() => {
  return allCommands.value.filter(cmd => cmd.category === 'ai-security')
})

const aiPaymentCommands = computed(() => {
  return allCommands.value.filter(cmd => cmd.category === 'ai-payment')
})

const aiDevelopmentCommands = computed(() => {
  return allCommands.value.filter(cmd => cmd.category === 'ai-development')
})

const aiAnalyticsCommands = computed(() => {
  return allCommands.value.filter(cmd => cmd.category === 'ai-analytics')
})

const aiLearningCommands = computed(() => {
  return allCommands.value.filter(cmd => cmd.category === 'ai-learning')
})

// Initialize SDK
onMounted(async () => {
  await loadCommands()
  
  // If SDK is already available from window, use it
  if (VoiceActionsSDK) {
    initializeSDK()
    return
  }

  // Otherwise, try to load SDK dynamically
  setTimeout(() => {
    import('../../../sdk/src/index.js')
      .then((SDKModule) => {
        VoiceActionsSDK = SDKModule.default || SDKModule
        initializeSDK()
      })
      .catch((e) => {
        if (typeof window !== 'undefined' && window.VoiceActionsSDK) {
          VoiceActionsSDK = window.VoiceActionsSDK
          initializeSDK()
        } else {
          showStatus('SDK not loaded. Please check the SDK path.', 'error')
          console.error('SDK import error:', e)
        }
      })
  }, 0)
})

function initializeSDK() {
  if (isInitializing || (sdk && !isDestroyed)) {
    return
  }

  if (!VoiceActionsSDK) {
    showStatus('SDK not loaded. Please check the SDK path.', 'error')
    return
  }

  isInitializing = true

  try {
    if (sdk) {
      try {
        sdk.destroy()
      } catch (e) {}
      sdk = null
    }

    sdk = new VoiceActionsSDK({
      apiKey: localStorage.getItem('platform_api_key') || 'demo-key',
      platform: 'demo',
      locale: selectedLocale.value,
      debug: true,
      onCommand: handleCommand,
      onError: handleError
    })

    isDestroyed = false
    showStatus('SDK initialized successfully! Click microphone to start.', 'success')
  } catch (error) {
    showStatus(`Error initializing SDK: ${error.message}`, 'error')
    sdk = null
  } finally {
    isInitializing = false
  }
}

onUnmounted(() => {
  if (sdk && !isDestroyed) {
    try {
      sdk.destroy()
      isDestroyed = true
      sdk = null
    } catch (error) {
      console.error('Error destroying SDK:', error)
    }
  }
})

async function toggleListening() {
  if (!sdk) {
    showStatus('SDK not initialized', 'error')
    return
  }

  if (isListening.value) {
    sdk.stop()
    isListening.value = false
    showStatus('Stopped listening', 'info')
  } else {
    isListening.value = true
    showStatus('Requesting microphone permission...', 'info')
    
    try {
      await sdk.start()
      if (sdk.isListening) {
        showStatus('Listening activated! Speak a command now.', 'success')
      }
    } catch (error) {
      isListening.value = false
    }
  }
}

function requestPermissionAgain() {
  if (sdk && !isListening.value) {
    toggleListening()
  }
}

async function changeLocale() {
  if (sdk) {
    sdk.setLocale(selectedLocale.value)
    await loadCommands()
    showStatus(`Locale changed to ${selectedLocale.value}`, 'info')
  }
}

function toggleLike() {
  isLiked.value = !isLiked.value
  showStatus(isLiked.value ? 'Liked!' : 'Unliked!', 'success')
}

function handleCommand(command) {
  const spokenPhrase = command.phrases?.[0] || command.name || command.action
  lastTranscript.value = spokenPhrase
  
  setTimeout(() => {
    if (lastTranscript.value === spokenPhrase) {
      // Keep visible
    }
  }, 2000)
  
  addToHistory(command)
  executeCommand(command)
}

function handleError(error) {
  console.error('Voice SDK Error:', error)
  
  let errorMessage = error.message
  
  if (error.message.includes('not supported')) {
    errorMessage = 'Voice recognition is not supported in this browser. Please use Chrome, Edge, or Safari.'
  } else if (error.message.includes('permission') || error.message.includes('denied')) {
    errorMessage = 'Microphone permission denied. Please allow microphone access in your browser settings.'
  } else if (error.message.includes('network')) {
    errorMessage = 'Network error. Please check your internet connection.'
  } else if (error.message.includes('audio-capture')) {
    errorMessage = 'No microphone found. Please check your microphone connection.'
  }
  
  showStatus(errorMessage, 'error')
  
  if (error.message.includes('permission') || error.message.includes('not supported')) {
    isListening.value = false
  }
}

function executeCommand(command) {
  const action = command.action

  switch (action) {
    case 'scroll-down':
      if (demoContent.value) {
        demoContent.value.scrollBy({ top: 300, behavior: 'smooth' })
      }
      showStatus('Scrolled down', 'success')
      break
    
    case 'scroll-up':
      if (demoContent.value) {
        demoContent.value.scrollBy({ top: -300, behavior: 'smooth' })
      }
      showStatus('Scrolled up', 'success')
      break
    
    case 'like':
      isLiked.value = true
      showStatus('Liked content', 'success')
      break
    
    case 'unlike':
      isLiked.value = false
      showStatus('Unliked content', 'success')
      break
    
    default:
      // Show success for all other commands
      showStatus(`Command executed: ${command.name || action}`, 'success')
  }
}

function simulateCommand(cmd) {
  handleCommand({
    id: cmd.id,
    action: cmd.action,
    name: cmd.name || cmd.id,
    phrases: cmd.phrases || []
  })
}

function addToHistory(command) {
  commandHistory.value.unshift({
    name: command.name || command.action,
    action: command.action,
    time: new Date().toLocaleTimeString()
  })
  
  if (commandHistory.value.length > 20) {
    commandHistory.value = commandHistory.value.slice(0, 20)
  }
}

function showStatus(message, type = 'info') {
  statusMessage.value = message
  statusMessageType.value = type
  
  setTimeout(() => {
    statusMessage.value = ''
  }, 3000)
}
</script>

<style scoped>
/* Custom Scrollbar */
.custom-scrollbar::-webkit-scrollbar {
  width: 8px;
}

.custom-scrollbar::-webkit-scrollbar-track {
  background: rgba(255, 255, 255, 0.1);
  border-radius: 10px;
}

.custom-scrollbar::-webkit-scrollbar-thumb {
  background: linear-gradient(to bottom, #a855f7, #ec4899);
  border-radius: 10px;
}

.custom-scrollbar::-webkit-scrollbar-thumb:hover {
  background: linear-gradient(to bottom, #9333ea, #db2777);
}

/* Animations */
@keyframes blob {
  0%, 100% {
    transform: translate(0, 0) scale(1);
  }
  33% {
    transform: translate(30px, -50px) scale(1.1);
  }
  66% {
    transform: translate(-20px, 20px) scale(0.9);
  }
  100% {
    transform: translate(0, 0) scale(1);
  }
}

.animate-blob {
  animation: blob 7s infinite;
}

.animation-delay-2000 {
  animation-delay: 2s;
}

.animation-delay-4000 {
  animation-delay: 4s;
}

@keyframes pulse-slow {
  0%, 100% {
    opacity: 1;
    transform: scale(1);
  }
  50% {
    opacity: 0.8;
    transform: scale(1.05);
  }
}

.animate-pulse-slow {
  animation: pulse-slow 3s ease-in-out infinite;
}

/* Voice Wave Animation */
@keyframes wave {
  0%, 100% {
    transform: scaleY(0.4);
    opacity: 0.7;
  }
  50% {
    transform: scaleY(1);
    opacity: 1;
  }
}

.animate-wave {
  animation: wave 1s ease-in-out infinite;
  transform-origin: bottom;
}

/* Fade In Animation */
@keyframes fade-in {
  from {
    opacity: 0;
    transform: translateY(-10px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.animate-fade-in {
  animation: fade-in 0.5s ease-out;
}

/* Transitions */
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.3s ease;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}

.slide-up-enter-active, .slide-up-leave-active {
  transition: all 0.3s ease-out;
}
.slide-up-enter-from, .slide-up-leave-to {
  opacity: 0;
  transform: translateY(10px);
}

.list-enter-active,
.list-leave-active {
  transition: all 0.3s ease;
}

.list-enter-from {
  opacity: 0;
  transform: translateX(-30px);
}

.list-leave-to {
  opacity: 0;
  transform: translateX(30px);
}

.line-clamp-1 {
  display: -webkit-box;
  -webkit-line-clamp: 1;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
</style>
