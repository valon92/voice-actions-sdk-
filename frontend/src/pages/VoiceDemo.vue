<template>
  <div class="min-h-screen py-8 sm:py-12 px-4 bg-gradient-to-br from-slate-50 via-blue-50 to-purple-50">
    <div class="max-w-7xl mx-auto">
      <!-- Header -->
      <div class="text-center mb-8 sm:mb-12">
        <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold text-gray-900 mb-4">
          🎤 Voice Actions SDK Demo
        </h1>
        <p class="text-base sm:text-lg text-gray-600 max-w-2xl mx-auto">
          Provoni librarinë tonë me komanda zanore në shumë gjuhë. Të gjitha komandat janë universale dhe funksionojnë për çdo platformë!
        </p>
      </div>

      <!-- Voice Control Panel -->
      <div class="bg-white rounded-2xl shadow-xl p-6 sm:p-8 mb-8">
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4 mb-6">
          <div class="flex items-center gap-4">
            <button
              @click="toggleListening"
              :class="[
                'px-6 py-3 rounded-lg font-semibold text-white transition-all shadow-lg',
                isListening 
                  ? 'bg-red-600 hover:bg-red-700 animate-pulse' 
                  : 'bg-green-600 hover:bg-green-700'
              ]"
            >
              <span v-if="isListening">🛑 Stop Listening</span>
              <span v-else>🎤 Start Listening</span>
            </button>
            <div v-if="isListening" class="flex items-center gap-2 text-green-600">
              <div class="w-3 h-3 bg-green-500 rounded-full animate-pulse"></div>
              <span class="text-sm font-medium">Listening...</span>
            </div>
          </div>
          
          <!-- Language Selector -->
          <select
            v-model="selectedLocale"
            @change="changeLocale"
            class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
          >
            <option value="en-US">🇺🇸 English</option>
            <option value="sq-AL">🇦🇱 Shqip</option>
            <option value="es-ES">🇪🇸 Español</option>
            <option value="fr-FR">🇫🇷 Français</option>
          </select>
        </div>

        <!-- Transcript Display -->
        <div v-if="lastTranscript" class="mb-4 p-4 bg-gray-50 rounded-lg">
          <p class="text-sm text-gray-600 mb-1">Last command:</p>
          <p class="text-lg font-medium text-gray-900">{{ lastTranscript }}</p>
        </div>

        <!-- Status Messages -->
        <div v-if="statusMessage" :class="[
          'p-4 rounded-lg mb-4',
          statusMessageType === 'success' ? 'bg-green-50 text-green-800' : 
          statusMessageType === 'error' ? 'bg-red-50 text-red-800' : 
          'bg-blue-50 text-blue-800'
        ]">
          {{ statusMessage }}
        </div>
      </div>

      <!-- Commands Grid -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 mb-8">
        <!-- Navigation Commands -->
        <div class="bg-white rounded-xl shadow-lg p-6">
          <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center gap-2">
            🏠 Navigation
          </h3>
          <div class="space-y-2">
            <button
              v-for="cmd in navigationCommands"
              :key="cmd.id"
              @click="simulateCommand(cmd)"
              class="w-full text-left px-4 py-2 bg-gray-50 hover:bg-gray-100 rounded-lg transition text-sm"
            >
              <span class="font-medium text-gray-900">{{ cmd.name }}</span>
              <span class="text-gray-500 text-xs block mt-1">{{ cmd.phrases.join(', ') }}</span>
            </button>
          </div>
        </div>

        <!-- Social Actions -->
        <div class="bg-white rounded-xl shadow-lg p-6">
          <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center gap-2">
            ❤️ Social Actions
          </h3>
          <div class="space-y-2">
            <button
              v-for="cmd in socialCommands"
              :key="cmd.id"
              @click="simulateCommand(cmd)"
              class="w-full text-left px-4 py-2 bg-gray-50 hover:bg-gray-100 rounded-lg transition text-sm"
            >
              <span class="font-medium text-gray-900">{{ cmd.name }}</span>
              <span class="text-gray-500 text-xs block mt-1">{{ cmd.phrases.join(', ') }}</span>
            </button>
          </div>
        </div>

        <!-- Media Control -->
        <div class="bg-white rounded-xl shadow-lg p-6">
          <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center gap-2">
            🎬 Media Control
          </h3>
          <div class="space-y-2">
            <button
              v-for="cmd in mediaCommands"
              :key="cmd.id"
              @click="simulateCommand(cmd)"
              class="w-full text-left px-4 py-2 bg-gray-50 hover:bg-gray-100 rounded-lg transition text-sm"
            >
              <span class="font-medium text-gray-900">{{ cmd.name }}</span>
              <span class="text-gray-500 text-xs block mt-1">{{ cmd.phrases.join(', ') }}</span>
            </button>
          </div>
        </div>

        <!-- Content Creation -->
        <div class="bg-white rounded-xl shadow-lg p-6">
          <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center gap-2">
            ✍️ Content Creation
          </h3>
          <div class="space-y-2">
            <button
              v-for="cmd in contentCommands"
              :key="cmd.id"
              @click="simulateCommand(cmd)"
              class="w-full text-left px-4 py-2 bg-gray-50 hover:bg-gray-100 rounded-lg transition text-sm"
            >
              <span class="font-medium text-gray-900">{{ cmd.name }}</span>
              <span class="text-gray-500 text-xs block mt-1">{{ cmd.phrases.join(', ') }}</span>
            </button>
          </div>
        </div>

        <!-- Content Navigation -->
        <div class="bg-white rounded-xl shadow-lg p-6">
          <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center gap-2">
            📱 Content Navigation
          </h3>
          <div class="space-y-2">
            <button
              v-for="cmd in contentNavCommands"
              :key="cmd.id"
              @click="simulateCommand(cmd)"
              class="w-full text-left px-4 py-2 bg-gray-50 hover:bg-gray-100 rounded-lg transition text-sm"
            >
              <span class="font-medium text-gray-900">{{ cmd.name }}</span>
              <span class="text-gray-500 text-xs block mt-1">{{ cmd.phrases.join(', ') }}</span>
            </button>
          </div>
        </div>

        <!-- Basic Actions -->
        <div class="bg-white rounded-xl shadow-lg p-6">
          <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center gap-2">
            🖱️ Basic Actions
          </h3>
          <div class="space-y-2">
            <button
              v-for="cmd in basicCommands"
              :key="cmd.id"
              @click="simulateCommand(cmd)"
              class="w-full text-left px-4 py-2 bg-gray-50 hover:bg-gray-100 rounded-lg transition text-sm"
            >
              <span class="font-medium text-gray-900">{{ cmd.name }}</span>
              <span class="text-gray-500 text-xs block mt-1">{{ cmd.phrases.join(', ') }}</span>
            </button>
          </div>
        </div>
      </div>

      <!-- Demo Area -->
      <div class="bg-white rounded-2xl shadow-xl p-6 sm:p-8 mb-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-4">🎯 Demo Area</h2>
        <p class="text-gray-600 mb-6">Kjo është zona demo ku mund të shihni efektet e komandave:</p>
        
        <!-- Scrollable Demo Content -->
        <div 
          ref="demoContent"
          class="border-2 border-dashed border-gray-300 rounded-lg p-8 min-h-[400px] max-h-[600px] overflow-y-auto bg-gradient-to-br from-blue-50 to-purple-50"
        >
          <div v-for="i in 10" :key="i" class="mb-6 p-4 bg-white rounded-lg shadow">
            <h3 class="font-bold text-lg text-gray-900 mb-2">Demo Item {{ i }}</h3>
            <p class="text-gray-600">Ky është një element demo. Provoni komandat "scroll down" ose "scroll up" për të lëvizur në këtë zonë.</p>
            <div class="mt-4 flex gap-2">
              <button class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">
                Like
              </button>
              <button class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition">
                Share
              </button>
              <button class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition">
                Save
              </button>
            </div>
          </div>
        </div>
      </div>

      <!-- Command History -->
      <div class="bg-white rounded-2xl shadow-xl p-6 sm:p-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-4">📜 Command History</h2>
        <div v-if="commandHistory.length === 0" class="text-gray-500 text-center py-8">
          Asnjë komandë e ekzekutuar ende. Filloni të dëgjoni dhe provoni komandat!
        </div>
        <div v-else class="space-y-2 max-h-64 overflow-y-auto">
          <div
            v-for="(cmd, index) in commandHistory"
            :key="index"
            class="p-3 bg-gray-50 rounded-lg flex items-center justify-between"
          >
            <div>
              <span class="font-medium text-gray-900">{{ cmd.name }}</span>
              <span class="text-gray-500 text-sm ml-2">({{ cmd.action }})</span>
            </div>
            <span class="text-xs text-gray-400">{{ cmd.time }}</span>
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
  // Check if SDK is available
  if (!VoiceActionsSDK) {
    showStatus('SDK not loaded. Please check the SDK path.', 'error')
    return
  }

  try {
    sdk = new VoiceActionsSDK({
      apiKey: localStorage.getItem('platform_api_key') || 'demo-key',
      platform: 'demo',
      locale: selectedLocale.value,
      debug: true,
      onCommand: handleCommand,
      onError: handleError
    })

    showStatus('SDK initialized successfully! Click "Start Listening" to begin.', 'success')
  } catch (error) {
    showStatus(`Error initializing SDK: ${error.message}`, 'error')
  }
}

onUnmounted(() => {
  if (sdk) {
    sdk.destroy()
  }
})

function toggleListening() {
  if (!sdk) {
    showStatus('SDK not initialized', 'error')
    return
  }

  if (isListening.value) {
    sdk.stop()
    isListening.value = false
    showStatus('Stopped listening', 'info')
  } else {
    sdk.start()
    isListening.value = true
    showStatus('Started listening. Try saying a command!', 'success')
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
  showStatus(`Error: ${error.message}`, 'error')
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
.animate-pulse {
  animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}

@keyframes pulse {
  0%, 100% {
    opacity: 1;
  }
  50% {
    opacity: .5;
  }
}
</style>

