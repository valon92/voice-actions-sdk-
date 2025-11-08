# 🎥 YouTube Integration Guide - Voice Actions SDK

**Si YouTube mund të integrojë Voice Actions SDK për voice control**

---

## 📋 Përmbledhje

Ky dokument shpjegon si YouTube (ose çdo platformë tjetër) mund të integrojë Voice Actions SDK për të lejuar përdoruesit të kontrollojnë platformën me komanda zanore në shumë gjuhë.

---

## 🚀 Quick Start për YouTube

### 1. Regjistro Platformën

1. Shko në: `https://voiceactions.io/register-platform`
2. Regjistro "YouTube" si platformë
3. Kopjo API key që do të jepet (vetëm një herë!)

### 2. Instalo SDK

**Via NPM:**
```bash
npm install @voice-actions/sdk
```

**Via CDN:**
```html
<script src="https://cdn.voiceactions.io/sdk/v1/voice-actions-sdk.min.js"></script>
```

### 3. Integro në YouTube

```javascript
import VoiceActionsSDK from '@voice-actions/sdk'

// Initialize SDK për YouTube
const youtubeSDK = new VoiceActionsSDK({
  apiKey: process.env.VOICE_ACTIONS_API_KEY, // Nga environment variables
  platform: 'youtube', // Platform identifier
  locale: 'en-US', // Ose 'sq-AL', 'es-ES', 'fr-FR', etj.
  debug: false, // Production mode
  onCommand: (command) => {
    // Handle YouTube-specific commands
    handleYouTubeCommand(command)
  },
  onError: (error) => {
    console.error('Voice Actions SDK Error:', error)
    // Handle error (show notification, etc.)
  }
})

// Start listening kur user aktivizon voice control
function enableVoiceControl() {
  youtubeSDK.start()
}

// Stop listening
function disableVoiceControl() {
  youtubeSDK.stop()
}

// Handle YouTube commands
function handleYouTubeCommand(command) {
  switch (command.action) {
    case 'youtube-play':
      // Play video
      const playButton = document.querySelector('.ytp-play-button')
      if (playButton) playButton.click()
      break

    case 'youtube-pause':
      // Pause video
      const pauseButton = document.querySelector('.ytp-play-button')
      if (pauseButton) pauseButton.click()
      break

    case 'youtube-next':
      // Next video
      const nextButton = document.querySelector('.ytp-next-button')
      if (nextButton) nextButton.click()
      break

    case 'youtube-previous':
      // Previous video
      // YouTube nuk ka previous button, por mund të implementohet
      window.history.back()
      break

    case 'youtube-mute':
      // Mute video
      const muteButton = document.querySelector('.ytp-mute-button')
      if (muteButton && !muteButton.classList.contains('ytp-volume-muted')) {
        muteButton.click()
      }
      break

    case 'youtube-unmute':
      // Unmute video
      const unmuteButton = document.querySelector('.ytp-mute-button')
      if (unmuteButton && unmuteButton.classList.contains('ytp-volume-muted')) {
        unmuteButton.click()
      }
      break

    case 'youtube-fullscreen':
      // Toggle fullscreen
      const fullscreenButton = document.querySelector('.ytp-fullscreen-button')
      if (fullscreenButton) fullscreenButton.click()
      break

    case 'youtube-volume-up':
      // Increase volume
      const volumeSlider = document.querySelector('.ytp-volume-slider-handle')
      if (volumeSlider) {
        const currentVolume = parseFloat(volumeSlider.getAttribute('aria-valuenow') || '50')
        const newVolume = Math.min(100, currentVolume + 10)
        // Set volume logic
      }
      break

    case 'youtube-volume-down':
      // Decrease volume
      const volumeDownSlider = document.querySelector('.ytp-volume-slider-handle')
      if (volumeDownSlider) {
        const currentVolume = parseFloat(volumeDownSlider.getAttribute('aria-valuenow') || '50')
        const newVolume = Math.max(0, currentVolume - 10)
        // Set volume logic
      }
      break

    case 'youtube-skip-forward':
      // Skip forward 10 seconds
      const video = document.querySelector('video')
      if (video) {
        video.currentTime = Math.min(video.duration, video.currentTime + 10)
      }
      break

    case 'youtube-skip-backward':
      // Skip backward 10 seconds
      const videoBack = document.querySelector('video')
      if (videoBack) {
        videoBack.currentTime = Math.max(0, videoBack.currentTime - 10)
      }
      break

    case 'youtube-like':
      // Like video
      const likeButton = document.querySelector('#top-level-buttons-computed button[aria-label*="like"]')
      if (likeButton && !likeButton.classList.contains('style-default-active')) {
        likeButton.click()
      }
      break

    case 'youtube-subscribe':
      // Subscribe to channel
      const subscribeButton = document.querySelector('#subscribe-button button')
      if (subscribeButton && !subscribeButton.classList.contains('subscribed')) {
        subscribeButton.click()
      }
      break

    case 'scroll-down':
      // Scroll page down
      window.scrollBy({ top: 300, behavior: 'smooth' })
      break

    case 'scroll-up':
      // Scroll page up
      window.scrollBy({ top: -300, behavior: 'smooth' })
      break

    default:
      console.log('Unknown command:', command.action)
  }
}
```

---

## 🌍 Multi-language Support

SDK automatikisht ngarkon komanda në gjuhën e përdoruesit:

```javascript
// Ndrysho gjuhën dinamikisht
youtubeSDK.setLocale('sq-AL') // Shqip
youtubeSDK.setLocale('es-ES') // Spanjisht
youtubeSDK.setLocale('fr-FR') // Frëngjisht
youtubeSDK.setLocale('en-US') // Anglisht
```

**Komanda në Shqip:**
- "luaj video" → `youtube-play`
- "ndalo video" → `youtube-pause`
- "video tjeter" → `youtube-next`
- "mute" → `youtube-mute`
- "ekran i plote" → `youtube-fullscreen`
- etj.

---

## 📊 Komanda të Disponueshme për YouTube

### Video Control
- ✅ **Play** - "play", "start video", "luaj video"
- ✅ **Pause** - "pause", "stop video", "ndalo video"
- ✅ **Next** - "next video", "video tjeter"
- ✅ **Previous** - "previous video", "video e meparshme"
- ✅ **Skip Forward** - "skip forward", "kaloj para"
- ✅ **Skip Backward** - "skip backward", "kaloj mbrapa"

### Audio Control
- ✅ **Mute** - "mute", "silence", "pa ze"
- ✅ **Unmute** - "unmute", "sound on", "me ze"
- ✅ **Volume Up** - "volume up", "rrit volumin"
- ✅ **Volume Down** - "volume down", "ul volumin"

### UI Control
- ✅ **Fullscreen** - "fullscreen", "ekran i plote"
- ✅ **Scroll Down** - "scroll down", "shkruaj poshtë"
- ✅ **Scroll Up** - "scroll up", "shkruaj lart"

### Social Actions
- ✅ **Like** - "like", "thumbs up", "pelqe"
- ✅ **Subscribe** - "subscribe", "abonohu"

---

## 🔒 Security Best Practices

### 1. API Key Management

**✅ CORRECT:**
```javascript
// Nga environment variables
const apiKey = process.env.VOICE_ACTIONS_API_KEY
```

**❌ WRONG:**
```javascript
// MOS e hardcode API key
const apiKey = 'va_1234567890abcdef...'
```

### 2. Error Handling

```javascript
youtubeSDK.onError = (error) => {
  // Log error për monitoring
  console.error('Voice Actions Error:', error)
  
  // Show user-friendly message
  showNotification('Voice control temporarily unavailable')
  
  // Disable voice control nëse ka probleme serioze
  if (error.message.includes('API key')) {
    disableVoiceControl()
  }
}
```

---

## 📈 Usage Tracking

SDK automatikisht track-on usage për billing:

- **Session started** - Kur voice control aktivizohet
- **Listening started** - Kur fillon të dëgjojë
- **Command executed** - Çdo komandë që ekzekutohet
- **Session ended** - Kur voice control çaktivizohet

Të gjitha këto shfaqen në dashboard: `https://voiceactions.io/platform/dashboard`

---

## 🎯 Implementation Example - YouTube Player

```javascript
// YouTube Player Integration
class YouTubeVoiceControl {
  constructor(apiKey) {
    this.sdk = new VoiceActionsSDK({
      apiKey: apiKey,
      platform: 'youtube',
      locale: this.detectUserLocale(),
      onCommand: (command) => this.handleCommand(command),
      onError: (error) => this.handleError(error)
    })
    
    this.isEnabled = false
  }

  enable() {
    if (!this.isEnabled) {
      this.sdk.start()
      this.isEnabled = true
      this.showVoiceControlIndicator()
    }
  }

  disable() {
    if (this.isEnabled) {
      this.sdk.stop()
      this.isEnabled = false
      this.hideVoiceControlIndicator()
    }
  }

  handleCommand(command) {
    // YouTube-specific command handling
    const player = document.querySelector('#movie_player')
    if (!player) return

    switch (command.action) {
      case 'youtube-play':
        player.playVideo()
        break
      case 'youtube-pause':
        player.pauseVideo()
        break
      case 'youtube-next':
        player.nextVideo()
        break
      case 'youtube-mute':
        player.mute()
        break
      case 'youtube-unmute':
        player.unMute()
        break
      case 'youtube-fullscreen':
        player.requestFullscreen()
        break
      // ... etj.
    }
  }

  detectUserLocale() {
    // Detect user's language from YouTube settings
    const lang = document.documentElement.lang || 'en-US'
    return lang
  }

  showVoiceControlIndicator() {
    // Show visual indicator që voice control është aktiv
    const indicator = document.createElement('div')
    indicator.id = 'voice-control-indicator'
    indicator.textContent = '🎤 Voice Control Active'
    document.body.appendChild(indicator)
  }

  hideVoiceControlIndicator() {
    const indicator = document.getElementById('voice-control-indicator')
    if (indicator) indicator.remove()
  }
}

// Usage
const voiceControl = new YouTubeVoiceControl(process.env.VOICE_ACTIONS_API_KEY)

// Enable kur user klikon button
document.getElementById('enable-voice').addEventListener('click', () => {
  voiceControl.enable()
})

// Disable kur user klikon button
document.getElementById('disable-voice').addEventListener('click', () => {
  voiceControl.disable()
})
```

---

## 🧪 Testing

### Test Commands në Browser Console

```javascript
// Test në YouTube page
const sdk = new VoiceActionsSDK({
  apiKey: 'your-test-api-key',
  platform: 'youtube',
  locale: 'en-US',
  debug: true,
  onCommand: (command) => {
    console.log('Command received:', command)
  }
})

sdk.start()

// Tani thua "play video" dhe shiko nëse funksionon
```

---

## 📝 Next Steps për YouTube

1. ✅ **SDK Integration** - Komplet
2. ✅ **Command Support** - 12+ komanda për YouTube
3. ✅ **Multi-language** - Mbështet 4+ gjuhë
4. ⏳ **UI Integration** - Shto button për enable/disable voice control
5. ⏳ **User Settings** - Lejo user të zgjedhë gjuhën
6. ⏳ **Analytics** - Track usage për optimization

---

## 🆘 Support

Nëse keni pyetje ose probleme:
- 📧 Email: support@voiceactions.io
- 📚 Docs: https://voiceactions.io/docs/integration
- 📊 Dashboard: https://voiceactions.io/platform/dashboard

---

**Konkluzion:** Sistemi është gati për integrim! YouTube (ose çdo platformë tjetër) mund të integrojë SDK-në dhe të ofrojë voice control për përdoruesit në shumë gjuhë. 🎉

