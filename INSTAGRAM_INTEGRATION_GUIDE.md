# 📸 Instagram Integration Guide - Voice Actions SDK

**Si Instagram mund të integrojë Voice Actions SDK për voice control të plotë**

---

## 📋 Përmbledhje

Ky dokument shpjegon si Instagram mund të integrojë Voice Actions SDK për të lejuar përdoruesit të kontrollojnë të gjitha veçoritë e Instagram me komanda zanore në shumë gjuhë.

---

## 🚀 Quick Start për Instagram

### 1. Regjistro Platformën

1. Shko në: `https://voiceactions.io/register-platform`
2. Regjistro "Instagram" si platformë
3. Kopjo API key që do të jepet (vetëm një herë!)

### 2. Instalo SDK

```bash
npm install @voice-actions/sdk
```

### 3. Integro në Instagram

```javascript
import VoiceActionsSDK from '@voice-actions/sdk'

// Initialize SDK për Instagram
const instagramSDK = new VoiceActionsSDK({
  apiKey: process.env.VOICE_ACTIONS_API_KEY,
  platform: 'instagram', // Platform identifier
  locale: 'en-US', // Ose 'sq-AL', 'es-ES', 'fr-FR', etj.
  debug: false,
  onCommand: (command) => {
    // Handle Instagram-specific commands
    handleInstagramCommand(command)
  },
  onError: (error) => {
    console.error('Voice Actions SDK Error:', error)
  }
})

// Start listening
instagramSDK.start()
```

---

## 📱 Komanda Të Plota Për Instagram

### 🏠 Navigation Commands

```javascript
function handleInstagramCommand(command) {
  switch (command.action) {
    // Navigation
    case 'instagram-home':
      // Go to home feed
      window.location.href = '/'
      break
    
    case 'instagram-reels':
      // Go to Reels
      window.location.href = '/reels/'
      break
    
    case 'instagram-explore':
      // Go to Explore
      window.location.href = '/explore/'
      break
    
    case 'instagram-stories':
      // Go to Stories
      openStoriesViewer()
      break
    
    case 'instagram-profile':
      // Go to profile
      window.location.href = '/username/'
      break
    
    case 'instagram-messages':
      // Go to Direct Messages
      window.location.href = '/direct/inbox/'
      break
    
    case 'instagram-notifications':
      // Go to notifications
      window.location.href = '/accounts/activity/'
      break
    
    case 'instagram-search':
      // Open search
      document.querySelector('input[placeholder*="Search"]')?.focus()
      break
```

### 📸 Post Actions

```javascript
    // Post Actions
    case 'instagram-next':
      // Next post
      const nextButton = document.querySelector('[aria-label="Next"]')
      nextButton?.click()
      break
    
    case 'instagram-previous':
      // Previous post
      const prevButton = document.querySelector('[aria-label="Previous"]')
      prevButton?.click()
      break
    
    case 'instagram-like':
      // Like post
      const likeButton = document.querySelector('svg[aria-label="Like"]')
      likeButton?.closest('button')?.click()
      break
    
    case 'instagram-unlike':
      // Unlike post
      const likedButton = document.querySelector('svg[aria-label="Unlike"]')
      likedButton?.closest('button')?.click()
      break
    
    case 'instagram-comment':
      // Open comment section
      const commentButton = document.querySelector('svg[aria-label="Comment"]')
      commentButton?.closest('button')?.click()
      break
    
    case 'instagram-share':
      // Share post
      const shareButton = document.querySelector('svg[aria-label="Share"]')
      shareButton?.closest('button')?.click()
      break
    
    case 'instagram-save':
      // Save post
      const saveButton = document.querySelector('svg[aria-label="Save"]')
      saveButton?.closest('button')?.click()
      break
    
    case 'instagram-unsave':
      // Unsave post
      const savedButton = document.querySelector('svg[aria-label="Unsave"]')
      savedButton?.closest('button')?.click()
      break
```

### 👥 User Actions

```javascript
    // User Actions
    case 'instagram-follow':
      // Follow user
      const followButton = document.querySelector('button:contains("Follow")')
      if (followButton && !followButton.textContent.includes('Following')) {
        followButton.click()
      }
      break
    
    case 'instagram-unfollow':
      // Unfollow user
      const followingButton = document.querySelector('button:contains("Following")')
      if (followingButton) {
        followingButton.click()
        // Click "Unfollow" in confirmation dialog
        setTimeout(() => {
          document.querySelector('button:contains("Unfollow")')?.click()
        }, 100)
      }
      break
    
    case 'instagram-view-profile':
      // View user profile
      const profileLink = document.querySelector('a[href*="/"]')
      profileLink?.click()
      break
```

### 🎬 Content Creation

```javascript
    // Content Creation
    case 'instagram-create-post':
      // Create new post
      window.location.href = '/create/select/'
      break
    
    case 'instagram-camera':
      // Open camera
      window.location.href = '/camera/'
      break
    
    case 'instagram-create-story':
      // Create story
      window.location.href = '/stories/create/'
      break
    
    case 'instagram-create-reel':
      // Create reel
      window.location.href = '/reels/create/'
      break
```

### 📖 Stories Navigation

```javascript
    // Stories Navigation
    case 'instagram-next-story':
      // Next story
      const storyNext = document.querySelector('[aria-label="Next"]')
      storyNext?.click()
      break
    
    case 'instagram-previous-story':
      // Previous story
      const storyPrev = document.querySelector('[aria-label="Previous"]')
      storyPrev?.click()
      break
    
    case 'instagram-skip-story':
      // Skip story
      const storySkip = document.querySelector('[aria-label="Skip"]')
      storySkip?.click()
      break
```

### 🎥 Reels Actions

```javascript
    // Reels Actions
    case 'instagram-next-reel':
      // Next reel
      scrollReel('down')
      break
    
    case 'instagram-previous-reel':
      // Previous reel
      scrollReel('up')
      break
    
    case 'instagram-pause-reel':
      // Pause reel
      const reelVideo = document.querySelector('video')
      if (reelVideo) reelVideo.pause()
      break
    
    case 'instagram-play-reel':
      // Play reel
      const reelVideoPlay = document.querySelector('video')
      if (reelVideoPlay) reelVideoPlay.play()
      break
    
    default:
      console.log('Unknown command:', command.action)
  }
}
```

---

## 🌍 Komanda Në Shumë Gjuhë

### English (en-US)
- "go home" → `instagram-home`
- "go to reels" → `instagram-reels`
- "like post" → `instagram-like`
- "follow user" → `instagram-follow`
- "create story" → `instagram-create-story`
- "next post" → `instagram-next`
- "share post" → `instagram-share`
- "save post" → `instagram-save`

### Shqip (sq-AL)
- "shko ne shtepi" → `instagram-home`
- "shko ne reels" → `instagram-reels`
- "pelqe postimin" → `instagram-like`
- "ndiq perdoruesin" → `instagram-follow`
- "krijo story" → `instagram-create-story`
- "postimi tjeter" → `instagram-next`
- "ndaj postimin" → `instagram-share`
- "ruaj postimin" → `instagram-save`

### Español (es-ES)
- "ir a inicio" → `instagram-home`
- "ir a reels" → `instagram-reels`
- "me gusta" → `instagram-like`
- "seguir usuario" → `instagram-follow`
- "crear historia" → `instagram-create-story`
- "siguiente publicación" → `instagram-next`
- "compartir" → `instagram-share`
- "guardar" → `instagram-save`

### Français (fr-FR)
- "aller à l'accueil" → `instagram-home`
- "aller aux reels" → `instagram-reels`
- "aimer" → `instagram-like`
- "suivre l'utilisateur" → `instagram-follow`
- "créer une story" → `instagram-create-story`
- "publication suivante" → `instagram-next`
- "partager" → `instagram-share`
- "enregistrer" → `instagram-save`

---

## 📊 Komanda Të Disponueshme (30+)

### Navigation (8 komanda)
- ✅ Home
- ✅ Reels
- ✅ Explore
- ✅ Stories
- ✅ Profile
- ✅ Messages
- ✅ Notifications
- ✅ Search

### Post Actions (8 komanda)
- ✅ Next post
- ✅ Previous post
- ✅ Like post
- ✅ Unlike post
- ✅ Comment
- ✅ Share post
- ✅ Save post
- ✅ Unsave post

### User Actions (3 komanda)
- ✅ Follow user
- ✅ Unfollow user
- ✅ View profile

### Content Creation (4 komanda)
- ✅ Create post
- ✅ Open camera
- ✅ Create story
- ✅ Create reel

### Stories Navigation (3 komanda)
- ✅ Next story
- ✅ Previous story
- ✅ Skip story

### Reels Actions (4 komanda)
- ✅ Next reel
- ✅ Previous reel
- ✅ Pause reel
- ✅ Play reel

**Gjithsej: 30+ komanda për Instagram!**

---

## 🎯 Implementation Example

```javascript
// Instagram Voice Control Integration
class InstagramVoiceControl {
  constructor(apiKey) {
    this.sdk = new VoiceActionsSDK({
      apiKey: apiKey,
      platform: 'instagram',
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
    // Instagram-specific command handling
    switch (command.action) {
      case 'instagram-home':
        window.location.href = '/'
        break
      case 'instagram-reels':
        window.location.href = '/reels/'
        break
      case 'instagram-like':
        this.likeCurrentPost()
        break
      case 'instagram-follow':
        this.followCurrentUser()
        break
      // ... etj.
    }
  }

  likeCurrentPost() {
    const likeButton = document.querySelector('svg[aria-label="Like"]')
    likeButton?.closest('button')?.click()
  }

  followCurrentUser() {
    const followButton = document.querySelector('button:contains("Follow")')
    if (followButton && !followButton.textContent.includes('Following')) {
      followButton.click()
    }
  }

  detectUserLocale() {
    const lang = document.documentElement.lang || 'en-US'
    return lang
  }

  showVoiceControlIndicator() {
    const indicator = document.createElement('div')
    indicator.id = 'voice-control-indicator'
    indicator.textContent = '🎤 Voice Control Active'
    indicator.style.cssText = 'position: fixed; top: 20px; right: 20px; background: #E4405F; color: white; padding: 10px 20px; border-radius: 20px; z-index: 9999;'
    document.body.appendChild(indicator)
  }

  hideVoiceControlIndicator() {
    const indicator = document.getElementById('voice-control-indicator')
    if (indicator) indicator.remove()
  }
}

// Usage
const voiceControl = new InstagramVoiceControl(process.env.VOICE_ACTIONS_API_KEY)

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

## ✅ Përmbledhje

**Komanda të disponueshme për Instagram:**
- ✅ **30+ komanda** për të gjitha veçoritë
- ✅ **Multi-language** - 4+ gjuhë (EN, SQ, ES, FR)
- ✅ **Navigation** - Home, Reels, Explore, Stories, Profile, Messages, Notifications, Search
- ✅ **Post Actions** - Like, Comment, Share, Save, Next, Previous
- ✅ **User Actions** - Follow, Unfollow, View Profile
- ✅ **Content Creation** - Create Post, Story, Reel, Camera
- ✅ **Stories & Reels** - Navigation dhe control

**Instagram tani ka të gjitha komandat e nevojshme për voice control të plotë!** 🎉

---

## 🆘 Support

- 📧 Email: support@voiceactions.io
- 📚 Docs: https://voiceactions.io/docs/integration
- 📊 Dashboard: https://voiceactions.io/platform/dashboard

