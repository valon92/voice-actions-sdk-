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
          <p class="text-lg sm:text-xl text-purple-200 max-w-3xl mx-auto leading-relaxed">
            Provoni librarinë tonë me komanda zanore në shumë gjuhë. Të gjitha komandat janë universale dhe funksionojnë për çdo platformë!
          </p>
        </div>

        <!-- Voice Control Card -->
        <div class="backdrop-blur-xl bg-white/10 rounded-3xl shadow-2xl border border-white/20 p-6 sm:p-8 mb-8 backdrop-saturate-150">
          <div class="flex flex-col lg:flex-row items-center justify-between gap-6 mb-6">
            <div class="flex items-center gap-4 flex-wrap justify-center">
              <button
                @click="toggleListening"
                :class="[
                  'group relative px-8 py-4 rounded-2xl font-bold text-white transition-all duration-300 shadow-2xl transform hover:scale-105 active:scale-95',
                  isListening 
                    ? 'bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 animate-pulse' 
                    : 'bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700'
                ]"
              >
                <span class="relative z-10 flex items-center gap-2 text-lg">
                  <span v-if="isListening" class="animate-spin">🛑</span>
                  <span v-else>🎤</span>
                  <span v-if="isListening">Stop Listening</span>
                  <span v-else>Start Listening</span>
                </span>
                <div v-if="isListening" class="absolute inset-0 rounded-2xl bg-red-400 opacity-50 blur-xl"></div>
              </button>
              
              <div v-if="isListening" class="flex items-center gap-3 px-4 py-2 bg-green-500/20 backdrop-blur-sm rounded-full border border-green-400/30">
                <div class="relative flex items-center justify-center">
                  <div class="absolute w-3 h-3 bg-green-400 rounded-full animate-ping"></div>
                  <div class="relative w-2 h-2 bg-green-400 rounded-full"></div>
                </div>
                <span class="text-green-300 font-semibold text-sm">Listening...</span>
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
                <option value="sq-AL" class="bg-slate-900">🇦🇱 Shqip</option>
                <option value="es-ES" class="bg-slate-900">🇪🇸 Español</option>
                <option value="fr-FR" class="bg-slate-900">🇫🇷 Français</option>
              </select>
              <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
              </div>
            </div>
          </div>

          <!-- Transcript Display -->
          <Transition name="slide-up">
            <div v-if="lastTranscript" class="mb-4 p-5 bg-gradient-to-r from-purple-500/20 to-pink-500/20 backdrop-blur-sm rounded-2xl border border-white/10">
              <p class="text-sm text-purple-200 mb-2 font-medium">Last command:</p>
              <p class="text-2xl font-bold text-white">{{ lastTranscript }}</p>
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
              <div class="flex items-center gap-2">
                <span v-if="statusMessageType === 'success'">✅</span>
                <span v-else-if="statusMessageType === 'error'">❌</span>
                <span v-else>ℹ️</span>
                <span class="font-semibold">{{ statusMessage }}</span>
              </div>
            </div>
          </Transition>
        </div>

        <!-- Commands Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
          <!-- Navigation Commands -->
          <div class="group backdrop-blur-xl bg-white/10 rounded-3xl shadow-2xl border border-white/20 p-6 hover:bg-white/15 transition-all duration-300 hover:scale-105 hover:shadow-purple-500/20">
            <div class="flex items-center gap-3 mb-6">
              <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-500 to-cyan-500 flex items-center justify-center text-2xl shadow-lg">
                🏠
              </div>
              <h3 class="text-2xl font-bold text-white">Navigation</h3>
            </div>
            <div class="space-y-2">
              <button
                v-for="cmd in navigationCommands"
                :key="cmd.id"
                @click="simulateCommand(cmd)"
                class="w-full text-left px-4 py-3 bg-white/5 hover:bg-white/10 rounded-xl transition-all duration-200 border border-white/10 hover:border-white/20 group/btn"
              >
                <span class="font-semibold text-white block mb-1 group-hover/btn:text-purple-300 transition-colors">{{ cmd.name }}</span>
                <span class="text-xs text-purple-300/70">{{ cmd.phrases.join(', ') }}</span>
              </button>
            </div>
          </div>

          <!-- Social Actions -->
          <div class="group backdrop-blur-xl bg-white/10 rounded-3xl shadow-2xl border border-white/20 p-6 hover:bg-white/15 transition-all duration-300 hover:scale-105 hover:shadow-pink-500/20">
            <div class="flex items-center gap-3 mb-6">
              <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-pink-500 to-rose-500 flex items-center justify-center text-2xl shadow-lg">
                ❤️
              </div>
              <h3 class="text-2xl font-bold text-white">Social Actions</h3>
            </div>
            <div class="space-y-2">
              <button
                v-for="cmd in socialCommands"
                :key="cmd.id"
                @click="simulateCommand(cmd)"
                class="w-full text-left px-4 py-3 bg-white/5 hover:bg-white/10 rounded-xl transition-all duration-200 border border-white/10 hover:border-white/20 group/btn"
              >
                <span class="font-semibold text-white block mb-1 group-hover/btn:text-pink-300 transition-colors">{{ cmd.name }}</span>
                <span class="text-xs text-pink-300/70">{{ cmd.phrases.join(', ') }}</span>
              </button>
            </div>
          </div>

          <!-- Media Control -->
          <div class="group backdrop-blur-xl bg-white/10 rounded-3xl shadow-2xl border border-white/20 p-6 hover:bg-white/15 transition-all duration-300 hover:scale-105 hover:shadow-blue-500/20">
            <div class="flex items-center gap-3 mb-6">
              <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-purple-500 to-indigo-500 flex items-center justify-center text-2xl shadow-lg">
                🎬
              </div>
              <h3 class="text-2xl font-bold text-white">Media Control</h3>
            </div>
            <div class="space-y-2">
              <button
                v-for="cmd in mediaCommands"
                :key="cmd.id"
                @click="simulateCommand(cmd)"
                class="w-full text-left px-4 py-3 bg-white/5 hover:bg-white/10 rounded-xl transition-all duration-200 border border-white/10 hover:border-white/20 group/btn"
              >
                <span class="font-semibold text-white block mb-1 group-hover/btn:text-purple-300 transition-colors">{{ cmd.name }}</span>
                <span class="text-xs text-purple-300/70">{{ cmd.phrases.join(', ') }}</span>
              </button>
            </div>
          </div>

          <!-- Content Creation -->
          <div class="group backdrop-blur-xl bg-white/10 rounded-3xl shadow-2xl border border-white/20 p-6 hover:bg-white/15 transition-all duration-300 hover:scale-105 hover:shadow-green-500/20">
            <div class="flex items-center gap-3 mb-6">
              <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-green-500 to-emerald-500 flex items-center justify-center text-2xl shadow-lg">
                ✍️
              </div>
              <h3 class="text-2xl font-bold text-white">Content Creation</h3>
            </div>
            <div class="space-y-2">
              <button
                v-for="cmd in contentCommands"
                :key="cmd.id"
                @click="simulateCommand(cmd)"
                class="w-full text-left px-4 py-3 bg-white/5 hover:bg-white/10 rounded-xl transition-all duration-200 border border-white/10 hover:border-white/20 group/btn"
              >
                <span class="font-semibold text-white block mb-1 group-hover/btn:text-green-300 transition-colors">{{ cmd.name }}</span>
                <span class="text-xs text-green-300/70">{{ cmd.phrases.join(', ') }}</span>
              </button>
            </div>
          </div>

          <!-- Content Navigation -->
          <div class="group backdrop-blur-xl bg-white/10 rounded-3xl shadow-2xl border border-white/20 p-6 hover:bg-white/15 transition-all duration-300 hover:scale-105 hover:shadow-cyan-500/20">
            <div class="flex items-center gap-3 mb-6">
              <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-cyan-500 to-blue-500 flex items-center justify-center text-2xl shadow-lg">
                📱
              </div>
              <h3 class="text-2xl font-bold text-white">Content Navigation</h3>
            </div>
            <div class="space-y-2">
              <button
                v-for="cmd in contentNavCommands"
                :key="cmd.id"
                @click="simulateCommand(cmd)"
                class="w-full text-left px-4 py-3 bg-white/5 hover:bg-white/10 rounded-xl transition-all duration-200 border border-white/10 hover:border-white/20 group/btn"
              >
                <span class="font-semibold text-white block mb-1 group-hover/btn:text-cyan-300 transition-colors">{{ cmd.name }}</span>
                <span class="text-xs text-cyan-300/70">{{ cmd.phrases.join(', ') }}</span>
              </button>
            </div>
          </div>

          <!-- Basic Actions -->
          <div class="group backdrop-blur-xl bg-white/10 rounded-3xl shadow-2xl border border-white/20 p-6 hover:bg-white/15 transition-all duration-300 hover:scale-105 hover:shadow-orange-500/20">
            <div class="flex items-center gap-3 mb-6">
              <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-orange-500 to-amber-500 flex items-center justify-center text-2xl shadow-lg">
                🖱️
              </div>
              <h3 class="text-2xl font-bold text-white">Basic Actions</h3>
            </div>
            <div class="space-y-2">
              <button
                v-for="cmd in basicCommands"
                :key="cmd.id"
                @click="simulateCommand(cmd)"
                class="w-full text-left px-4 py-3 bg-white/5 hover:bg-white/10 rounded-xl transition-all duration-200 border border-white/10 hover:border-white/20 group/btn"
              >
                <span class="font-semibold text-white block mb-1 group-hover/btn:text-orange-300 transition-colors">{{ cmd.name }}</span>
                <span class="text-xs text-orange-300/70">{{ cmd.phrases.join(', ') }}</span>
              </button>
            </div>
          </div>
        </div>

        <!-- Demo Area -->
        <div class="backdrop-blur-xl bg-white/10 rounded-3xl shadow-2xl border border-white/20 p-6 sm:p-8 mb-8">
          <h2 class="text-3xl font-bold text-white mb-2 flex items-center gap-3">
            <span class="text-4xl">🎯</span>
            <span>Demo Area</span>
          </h2>
          <p class="text-purple-200 mb-6">Kjo është zona demo ku mund të shihni efektet e komandave:</p>
          
          <!-- Scrollable Demo Content -->
          <div 
            ref="demoContent"
            class="border-2 border-dashed border-white/20 rounded-2xl p-8 min-h-[400px] max-h-[600px] overflow-y-auto bg-gradient-to-br from-slate-800/50 to-purple-900/50 backdrop-blur-sm custom-scrollbar"
          >
            <div v-for="i in 10" :key="i" class="mb-6 p-6 bg-white/10 backdrop-blur-sm rounded-2xl border border-white/10 hover:bg-white/15 transition-all duration-300 hover:scale-[1.02]">
              <h3 class="font-bold text-xl text-white mb-3">Demo Item {{ i }}</h3>
              <p class="text-purple-200 mb-4">Ky është një element demo. Provoni komandat "scroll down" ose "scroll up" për të lëvizur në këtë zonë.</p>
              <div class="flex gap-3 flex-wrap">
                <button class="px-5 py-2.5 bg-gradient-to-r from-blue-500 to-cyan-500 text-white rounded-xl hover:from-blue-600 hover:to-cyan-600 transition-all shadow-lg hover:shadow-blue-500/50 font-semibold">
                  Like
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
          <h2 class="text-3xl font-bold text-white mb-2 flex items-center gap-3">
            <span class="text-4xl">📜</span>
            <span>Command History</span>
          </h2>
          <div v-if="commandHistory.length === 0" class="text-purple-300 text-center py-12">
            <div class="text-6xl mb-4 opacity-50">🎤</div>
            <p class="text-lg">Asnjë komandë e ekzekutuar ende. Filloni të dëgjoni dhe provoni komandat!</p>
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
let sdk = null
let isInitializing = false
let isDestroyed = false

// Command definitions with phrases for all languages
const commands = {
  // Navigation
  'go-home': {
    name: 'Go Home',
    phrases: {
      'en-US': ['go home', 'home', 'home feed'],
      'sq-AL': ['shko ne shtepi', 'home', 'faqja kryesore'],
      'es-ES': ['ir a inicio', 'inicio', 'feed principal'],
      'fr-FR': ['aller à l\'accueil', 'accueil', 'fil principal']
    }
  },
  'go-profile': {
    name: 'Go to Profile',
    phrases: {
      'en-US': ['go to profile', 'profile', 'my profile'],
      'sq-AL': ['shko ne profile', 'profile', 'profili im'],
      'es-ES': ['ir a perfil', 'perfil', 'mi perfil'],
      'fr-FR': ['aller au profil', 'profil', 'mon profil']
    }
  },
  'go-messages': {
    name: 'Go to Messages',
    phrases: {
      'en-US': ['messages', 'direct messages', 'dm'],
      'sq-AL': ['mesazhe', 'direct', 'dm'],
      'es-ES': ['mensajes', 'mensajes directos', 'dm'],
      'fr-FR': ['messages', 'messages directs', 'dm']
    }
  },
  'go-notifications': {
    name: 'Go to Notifications',
    phrases: {
      'en-US': ['notifications', 'alerts'],
      'sq-AL': ['njoftime', 'alerts'],
      'es-ES': ['notificaciones', 'alertas'],
      'fr-FR': ['notifications', 'alertes']
    }
  },
  'search': {
    name: 'Search',
    phrases: {
      'en-US': ['search', 'find'],
      'sq-AL': ['kerko', 'gjej'],
      'es-ES': ['buscar', 'encontrar'],
      'fr-FR': ['chercher', 'trouver']
    }
  },
  'scroll-down': {
    name: 'Scroll Down',
    phrases: {
      'en-US': ['scroll down', 'scroll down page', 'go down'],
      'sq-AL': ['shkruaj poshtë', 'shkruaj poshtë faqen', 'shko poshtë'],
      'es-ES': ['desplazar abajo', 'bajar', 'ir abajo'],
      'fr-FR': ['défiler vers le bas', 'descendre', 'aller en bas']
    }
  },
  'scroll-up': {
    name: 'Scroll Up',
    phrases: {
      'en-US': ['scroll up', 'scroll up page', 'go up'],
      'sq-AL': ['shkruaj lart', 'shkruaj lart faqen', 'shko lart'],
      'es-ES': ['desplazar arriba', 'subir', 'ir arriba'],
      'fr-FR': ['défiler vers le haut', 'monter', 'aller en haut']
    }
  },
  // Social Actions
  'like': {
    name: 'Like',
    phrases: {
      'en-US': ['like', 'thumbs up', 'heart'],
      'sq-AL': ['pelqe', 'zemer', 'thumbs up'],
      'es-ES': ['me gusta', 'corazón', 'pulgar arriba'],
      'fr-FR': ['aimer', 'cœur', 'pouce en haut']
    }
  },
  'unlike': {
    name: 'Unlike',
    phrases: {
      'en-US': ['unlike', 'remove like'],
      'sq-AL': ['heq pelqimin', 'heq zemer'],
      'es-ES': ['quitar me gusta', 'quitar corazón'],
      'fr-FR': ['ne plus aimer', 'retirer le cœur']
    }
  },
  'comment': {
    name: 'Comment',
    phrases: {
      'en-US': ['comment', 'add comment'],
      'sq-AL': ['komento', 'shto koment'],
      'es-ES': ['comentar', 'agregar comentario'],
      'fr-FR': ['commenter', 'ajouter un commentaire']
    }
  },
  'share': {
    name: 'Share',
    phrases: {
      'en-US': ['share', 'share post'],
      'sq-AL': ['ndaj', 'shpernda'],
      'es-ES': ['compartir', 'compartir publicación'],
      'fr-FR': ['partager', 'partager la publication']
    }
  },
  'save': {
    name: 'Save',
    phrases: {
      'en-US': ['save', 'save post', 'bookmark'],
      'sq-AL': ['ruaj', 'ruaj postimin'],
      'es-ES': ['guardar', 'guardar publicación'],
      'fr-FR': ['enregistrer', 'sauvegarder']
    }
  },
  'follow': {
    name: 'Follow',
    phrases: {
      'en-US': ['follow', 'follow user'],
      'sq-AL': ['ndiq', 'ndiq perdoruesin'],
      'es-ES': ['seguir', 'seguir usuario'],
      'fr-FR': ['suivre', 'suivre l\'utilisateur']
    }
  },
  'unfollow': {
    name: 'Unfollow',
    phrases: {
      'en-US': ['unfollow', 'stop following'],
      'sq-AL': ['mos ndiq', 'heq ndjekjen'],
      'es-ES': ['dejar de seguir', 'dejar seguir'],
      'fr-FR': ['ne plus suivre', 'arrêter de suivre']
    }
  },
  // Media Control
  'play': {
    name: 'Play',
    phrases: {
      'en-US': ['play', 'start video'],
      'sq-AL': ['luaj', 'fillo video'],
      'es-ES': ['reproducir', 'iniciar video'],
      'fr-FR': ['lire', 'démarrer vidéo']
    }
  },
  'pause': {
    name: 'Pause',
    phrases: {
      'en-US': ['pause', 'stop video'],
      'sq-AL': ['pauzë', 'ndalo video'],
      'es-ES': ['pausar', 'detener video'],
      'fr-FR': ['pause', 'arrêter vidéo']
    }
  },
  'mute': {
    name: 'Mute',
    phrases: {
      'en-US': ['mute', 'silence'],
      'sq-AL': ['mute', 'pa ze'],
      'es-ES': ['silenciar', 'sin sonido'],
      'fr-FR': ['couper le son', 'sourdine']
    }
  },
  'unmute': {
    name: 'Unmute',
    phrases: {
      'en-US': ['unmute', 'sound on'],
      'sq-AL': ['unmute', 'me ze'],
      'es-ES': ['activar sonido', 'con sonido'],
      'fr-FR': ['activer le son', 'avec son']
    }
  },
  'volume-up': {
    name: 'Volume Up',
    phrases: {
      'en-US': ['volume up', 'increase volume'],
      'sq-AL': ['rrit volumin', 'me ze'],
      'es-ES': ['subir volumen', 'aumentar volumen'],
      'fr-FR': ['augmenter le volume', 'plus fort']
    }
  },
  'volume-down': {
    name: 'Volume Down',
    phrases: {
      'en-US': ['volume down', 'decrease volume'],
      'sq-AL': ['ul volumin', 'me pak ze'],
      'es-ES': ['bajar volumen', 'disminuir volumen'],
      'fr-FR': ['diminuer le volume', 'plus bas']
    }
  },
  'fullscreen': {
    name: 'Fullscreen',
    phrases: {
      'en-US': ['fullscreen', 'full screen'],
      'sq-AL': ['ekran i plote', 'fullscreen'],
      'es-ES': ['pantalla completa', 'pantalla completa'],
      'fr-FR': ['plein écran', 'plein écran']
    }
  },
  // Content Creation
  'create-post': {
    name: 'Create Post',
    phrases: {
      'en-US': ['create post', 'new post'],
      'sq-AL': ['krijo postim', 'postim i ri'],
      'es-ES': ['crear publicación', 'nueva publicación'],
      'fr-FR': ['créer une publication', 'nouvelle publication']
    }
  },
  'open-camera': {
    name: 'Open Camera',
    phrases: {
      'en-US': ['camera', 'open camera'],
      'sq-AL': ['kamera', 'hape kamere'],
      'es-ES': ['cámara', 'abrir cámara'],
      'fr-FR': ['caméra', 'ouvrir la caméra']
    }
  },
  // Content Navigation
  'next': {
    name: 'Next',
    phrases: {
      'en-US': ['next', 'next post', 'next video'],
      'sq-AL': ['tjeter', 'postimi tjeter', 'video tjeter'],
      'es-ES': ['siguiente', 'siguiente publicación'],
      'fr-FR': ['suivant', 'publication suivante']
    }
  },
  'previous': {
    name: 'Previous',
    phrases: {
      'en-US': ['previous', 'previous post', 'go back'],
      'sq-AL': ['i meparshem', 'postimi i meparshem', 'kthe mbrapa'],
      'es-ES': ['anterior', 'publicación anterior'],
      'fr-FR': ['précédent', 'publication précédente']
    }
  },
  // Basic
  'click': {
    name: 'Click',
    phrases: {
      'en-US': ['click', 'tap'],
      'sq-AL': ['kliko', 'prek'],
      'es-ES': ['clic', 'tocar'],
      'fr-FR': ['cliquer', 'toucher']
    }
  }
}

// Computed properties for command categories
const navigationCommands = computed(() => {
  return getCommandsByCategory(['go-home', 'go-profile', 'go-messages', 'go-notifications', 'search', 'scroll-down', 'scroll-up'])
})

const socialCommands = computed(() => {
  return getCommandsByCategory(['like', 'unlike', 'comment', 'share', 'save', 'follow', 'unfollow'])
})

const mediaCommands = computed(() => {
  return getCommandsByCategory(['play', 'pause', 'mute', 'unmute', 'volume-up', 'volume-down', 'fullscreen'])
})

const contentCommands = computed(() => {
  return getCommandsByCategory(['create-post', 'open-camera'])
})

const contentNavCommands = computed(() => {
  return getCommandsByCategory(['next', 'previous'])
})

const basicCommands = computed(() => {
  return getCommandsByCategory(['click'])
})

function getCommandsByCategory(ids) {
  return ids.map(id => ({
    id,
    name: commands[id].name,
    action: id,
    phrases: commands[id].phrases[selectedLocale.value] || commands[id].phrases['en-US']
  }))
}

// Initialize SDK
onMounted(() => {
  // If SDK is already available from window, use it
  if (VoiceActionsSDK) {
    initializeSDK()
    return
  }

  // Otherwise, try to load SDK dynamically
  // Use setTimeout to ensure this runs after component is mounted
  setTimeout(() => {
    import('../../../sdk/src/index.js')
      .then((SDKModule) => {
        VoiceActionsSDK = SDKModule.default || SDKModule
        initializeSDK()
      })
      .catch((e) => {
        // Try from window if loaded via script tag
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
  // Prevent multiple initializations
  if (isInitializing || sdk || isDestroyed) {
    if (sdk && !isDestroyed) {
      return // SDK already initialized
    }
  }

  // Check if SDK is available
  if (!VoiceActionsSDK) {
    showStatus('SDK not loaded. Please check the SDK path.', 'error')
    return
  }

  isInitializing = true

  try {
    // Destroy existing SDK if any
    if (sdk) {
      try {
        sdk.destroy()
      } catch (e) {
        // Ignore destroy errors
      }
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
    showStatus('SDK initialized successfully! Click "Start Listening" to begin.', 'success')
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
    // Set listening state optimistically, but it will be reset if permission is denied
    isListening.value = true
    showStatus('Requesting microphone permission...', 'info')
    
    try {
      await sdk.start()
      // Only show success if we actually started listening
      if (sdk.isListening) {
        showStatus('Started listening. Try saying a command!', 'success')
      }
    } catch (error) {
      isListening.value = false
      // Error will be handled by handleError callback
    }
  }
}

function requestPermissionAgain() {
  if (sdk && !isListening.value) {
    toggleListening()
  }
}

function changeLocale() {
  if (sdk) {
    sdk.setLocale(selectedLocale.value)
    showStatus(`Locale changed to ${selectedLocale.value}`, 'info')
  }
}

function handleCommand(command) {
  lastTranscript.value = command.phrases?.[0] || command.action
  addToHistory(command)
  executeCommand(command)
}

function handleError(error) {
  console.error('Voice SDK Error:', error)
  
  // Show user-friendly error messages
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
  
  // Stop listening on critical errors
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
    
    case 'go-home':
      showStatus('Navigated to home', 'success')
      break
    
    case 'go-profile':
      showStatus('Navigated to profile', 'success')
      break
    
    case 'go-messages':
      showStatus('Navigated to messages', 'success')
      break
    
    case 'go-notifications':
      showStatus('Navigated to notifications', 'success')
      break
    
    case 'search':
      showStatus('Opened search', 'success')
      break
    
    case 'like':
      showStatus('Liked content', 'success')
      break
    
    case 'unlike':
      showStatus('Unliked content', 'success')
      break
    
    case 'comment':
      showStatus('Opened comment section', 'success')
      break
    
    case 'share':
      showStatus('Shared content', 'success')
      break
    
    case 'save':
      showStatus('Saved content', 'success')
      break
    
    case 'follow':
      showStatus('Followed user', 'success')
      break
    
    case 'unfollow':
      showStatus('Unfollowed user', 'success')
      break
    
    case 'play':
      showStatus('Playing media', 'success')
      break
    
    case 'pause':
      showStatus('Paused media', 'success')
      break
    
    case 'mute':
      showStatus('Muted audio', 'success')
      break
    
    case 'unmute':
      showStatus('Unmuted audio', 'success')
      break
    
    case 'volume-up':
      showStatus('Volume increased', 'success')
      break
    
    case 'volume-down':
      showStatus('Volume decreased', 'success')
      break
    
    case 'fullscreen':
      showStatus('Toggled fullscreen', 'success')
      break
    
    case 'create-post':
      showStatus('Opened create post', 'success')
      break
    
    case 'open-camera':
      showStatus('Opened camera', 'success')
      break
    
    case 'next':
      showStatus('Next item', 'success')
      break
    
    case 'previous':
      showStatus('Previous item', 'success')
      break
    
    case 'click':
      showStatus('Clicked element', 'success')
      break
    
    default:
      showStatus(`Command executed: ${action}`, 'info')
  }
}

function simulateCommand(cmd) {
  handleCommand({
    id: cmd.id,
    action: cmd.action,
    name: cmd.name,
    phrases: cmd.phrases
  })
}

function addToHistory(command) {
  commandHistory.value.unshift({
    name: commands[command.action]?.name || command.action,
    action: command.action,
    time: new Date().toLocaleTimeString()
  })
  
  // Keep only last 20 commands
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

/* Transitions */
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.3s ease;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}

.slide-up-enter-active {
  transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
}

.slide-up-leave-active {
  transition: all 0.3s ease;
}

.slide-up-enter-from {
  opacity: 0;
  transform: translateY(20px) scale(0.9);
}

.slide-up-leave-to {
  opacity: 0;
  transform: translateY(-10px);
}

.list-enter-active,
.list-leave-active {
  transition: all 0.4s ease;
}

.list-enter-from {
  opacity: 0;
  transform: translateX(-30px) scale(0.9);
}

.list-leave-to {
  opacity: 0;
  transform: translateX(30px) scale(0.9);
}

.list-move {
  transition: transform 0.4s ease;
}
</style>
