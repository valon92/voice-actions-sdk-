# 📚 SDK Usage Guide - Si të Përdoret Voice Actions SDK

**Për Platformat që do të integrojnë SDK-në**

---

## 🚀 Quick Start

### 1. Instalimi

**Via NPM:**
```bash
npm install @voice-actions/sdk
```

**Via CDN:**
```html
<script src="https://cdn.voiceactions.io/sdk/v1/voice-actions-sdk.min.js"></script>
```

### 2. Marrja e API Key

1. Shko në: https://voiceactions.io/register-platform
2. Regjistro platformën tënde
3. Kopjo API key që do të jepet (vetëm një herë!)

### 3. Integrimi Bazë

```javascript
import VoiceActionsSDK from '@voice-actions/sdk'

// Initialize SDK
const sdk = new VoiceActionsSDK({
  apiKey: 'va_your_api_key_here', // API key nga registration
  platform: 'your-platform-name', // Emri i platformës suaj
  locale: 'en-US', // Gjuha (en-US, sq-AL, es-ES, fr-FR, etj.)
  debug: true, // Për development
  onCommand: (command) => {
    // Handle command execution
    console.log('Command executed:', command)
    
    // Execute platform-specific action
    switch (command.action) {
      case 'scroll-down':
        window.scrollBy({ top: 300, behavior: 'smooth' })
        break
      case 'scroll-up':
        window.scrollBy({ top: -300, behavior: 'smooth' })
        break
      case 'click':
        // Your click handler
        break
      default:
        console.log('Unknown action:', command.action)
    }
  },
  onError: (error) => {
    console.error('SDK Error:', error)
  }
})

// Start listening
sdk.start()

// Stop listening
sdk.stop()
```

---

## 🌍 Multi-language Support

SDK mbështet shumë gjuhë. Ndrysho locale dinamikisht:

```javascript
// Change to Albanian
sdk.setLocale('sq-AL')

// Change to Spanish
sdk.setLocale('es-ES')

// Change to French
sdk.setLocale('fr-FR')
```

**Gjuhët e mbështetura:**
- 🇺🇸 English (en-US)
- 🇦🇱 Albanian (sq-AL)
- 🇪🇸 Spanish (es-ES)
- 🇫🇷 French (fr-FR)
- Dhe më shumë...

---

## 🎯 Custom Commands

Shto komanda të personalizuara:

```javascript
// Add custom command
sdk.addCommand({
  id: 'custom-action',
  phrases: ['do something', 'perform action', 'execute task'],
  action: 'custom-action',
  description: 'Custom action description'
})

// Handle custom action
sdk.onCommand = (command) => {
  if (command.action === 'custom-action') {
    // Your custom logic here
    console.log('Custom action executed!')
  }
}
```

---

## 📊 Usage Tracking

SDK automatikisht track-on usage për billing:

- **Session started** - Kur SDK inicializohet
- **Listening started** - Kur fillon të dëgjojë
- **Command executed** - Kur ekzekutohet një komandë
- **Session ended** - Kur SDK shkatërrohet

Të gjitha këto trackohen automatikisht në backend.

---

## 🔒 API Key Security

**⚠️ RËNDËSI:**
- **MOS** e vendos API key në source code
- **Përdor** environment variables
- **MOS** e commit API key në Git

**Example:**
```javascript
// ✅ CORRECT - Use environment variable
const sdk = new VoiceActionsSDK({
  apiKey: process.env.VOICE_ACTIONS_API_KEY,
  // ...
})

// ❌ WRONG - Don't hardcode
const sdk = new VoiceActionsSDK({
  apiKey: 'va_1234567890abcdef...', // NEVER DO THIS!
  // ...
})
```

---

## 🛠️ Advanced Usage

### Platform-Specific Commands

Për platforma si YouTube, Instagram, etj., SDK mund të ngarkojë komanda specifike:

```javascript
const sdk = new VoiceActionsSDK({
  apiKey: 'your-api-key',
  platform: 'youtube', // Platform-specific commands
  locale: 'en-US',
  onCommand: (command) => {
    // YouTube-specific commands
    if (command.action === 'play-video') {
      // Play video logic
    } else if (command.action === 'pause-video') {
      // Pause video logic
    }
  }
})
```

### Error Handling

```javascript
const sdk = new VoiceActionsSDK({
  apiKey: 'your-api-key',
  onError: (error) => {
    // Handle errors gracefully
    if (error.message.includes('not supported')) {
      // Web Speech API not supported
      alert('Voice recognition not supported in this browser')
    } else if (error.message.includes('API key')) {
      // Invalid API key
      console.error('Invalid API key')
    } else {
      // Other errors
      console.error('SDK Error:', error)
    }
  }
})
```

---

## 📝 Complete Example

```html
<!DOCTYPE html>
<html>
<head>
  <title>Voice Actions SDK Example</title>
</head>
<body>
  <button id="startBtn">Start Listening</button>
  <button id="stopBtn">Stop Listening</button>
  <div id="status">Not listening</div>

  <script src="https://cdn.voiceactions.io/sdk/v1/voice-actions-sdk.min.js"></script>
  <script>
    const sdk = new VoiceActionsSDK({
      apiKey: 'va_your_api_key_here',
      platform: 'my-platform',
      locale: 'en-US',
      debug: true,
      onCommand: (command) => {
        console.log('Command:', command)
        document.getElementById('status').textContent = `Executed: ${command.action}`
      },
      onError: (error) => {
        console.error('Error:', error)
        document.getElementById('status').textContent = `Error: ${error.message}`
      }
    })

    document.getElementById('startBtn').addEventListener('click', () => {
      sdk.start()
      document.getElementById('status').textContent = 'Listening...'
    })

    document.getElementById('stopBtn').addEventListener('click', () => {
      sdk.stop()
      document.getElementById('status').textContent = 'Stopped'
    })
  </script>
</body>
</html>
```

---

## 🔗 API Endpoints

Kur SDK inicializohet, ai automatikisht:
1. **GET /api/commands** - Ngarkon komandat për platformën dhe locale
2. **POST /api/usage/track** - Track-on usage events

Të gjitha requests përfshijnë API key në header:
```
Authorization: Bearer va_your_api_key_here
X-API-Key: va_your_api_key_here
```

---

## 📞 Support

- **Documentation:** https://voiceactions.io/docs/integration
- **Dashboard:** https://voiceactions.io/platform/dashboard
- **Email:** support@voiceactions.io

---

**Made with ❤️ by Voice Actions SDK Team**

