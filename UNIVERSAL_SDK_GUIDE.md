# 🌍 Universal SDK Guide - Librari Universale për Çdo Platformë

**Voice Actions SDK është universale dhe e përshtatshme për çdo platformë në botë!**

---

## 🎯 Filozofia e SDK-së

Voice Actions SDK është **100% universale** dhe **platform-agnostic**. Ajo:
- ✅ **Nuk ka logjikë hardcoded** për platforma specifike
- ✅ **Fleksibël** - çdo platformë mund ta përshtasë
- ✅ **E zgjidhshme** - mbështet çdo lloj komande dhe veprimi
- ✅ **Multi-language** - mbështet 50+ gjuhë
- ✅ **E shkallëzueshme** - funksionon për miliona platforma

---

## 🚀 Si Funksionon

### 1. SDK Vetëm Dëgjon dhe Njofton

SDK **vetëm**:
- Dëgjon komanda zanore
- I konverton në tekst
- I përputh me komanda të definuara
- Njofton platformën përmes `onCommand` callback

**SDK NUK:**
- ❌ Nuk ekzekuton logjikë specifike të platformës
- ❌ Nuk di çfarë të bëjë me komanda të ndryshme
- ❌ Nuk ka hardcoded logic për YouTube, Instagram, etj.

### 2. Platforma Implementon Logjikën

**Platforma** (YouTube, Instagram, E-commerce, CRM, etj.):
- ✅ Merr komandën nga SDK
- ✅ Implementon logjikën e vet specifike
- ✅ Ekzekuton veprimin në platformën e vet

---

## 📋 Shembuj për Platforma Të Ndryshme

### 🛒 E-Commerce Platform (Shopify, WooCommerce, etj.)

```javascript
import VoiceActionsSDK from '@voice-actions/sdk'

const sdk = new VoiceActionsSDK({
  apiKey: process.env.VOICE_ACTIONS_API_KEY,
  platform: 'my-ecommerce',
  locale: 'en-US',
  onCommand: (command) => {
    switch (command.action) {
      case 'add-to-cart':
        // E-commerce specific: Add product to cart
        const productId = getCurrentProductId()
        addToCart(productId)
        showNotification('Product added to cart!')
        break
      
      case 'checkout':
        // E-commerce specific: Go to checkout
        window.location.href = '/checkout'
        break
      
      case 'search-products':
        // E-commerce specific: Search products
        openSearchBar()
        break
      
      case 'view-cart':
        // E-commerce specific: View shopping cart
        window.location.href = '/cart'
        break
      
      case 'apply-discount':
        // E-commerce specific: Apply discount code
        openDiscountInput()
        break
      
      default:
        // Handle other commands
        console.log('Command:', command)
    }
  }
})

// Add custom commands për e-commerce
sdk.addCommand({
  id: 'add-to-cart',
  phrases: ['add to cart', 'add product', 'buy now'],
  action: 'add-to-cart'
})

sdk.addCommand({
  id: 'checkout',
  phrases: ['checkout', 'go to checkout', 'proceed to payment'],
  action: 'checkout'
})

sdk.start()
```

---

### 📊 CRM Platform (Salesforce, HubSpot, etj.)

```javascript
const sdk = new VoiceActionsSDK({
  apiKey: process.env.VOICE_ACTIONS_API_KEY,
  platform: 'my-crm',
  locale: 'en-US',
  onCommand: (command) => {
    switch (command.action) {
      case 'create-contact':
        // CRM specific: Create new contact
        openNewContactForm()
        break
      
      case 'search-leads':
        // CRM specific: Search for leads
        openLeadSearch()
        break
      
      case 'schedule-meeting':
        // CRM specific: Schedule a meeting
        openCalendarModal()
        break
      
      case 'send-email':
        // CRM specific: Compose email
        openEmailComposer()
        break
      
      case 'view-dashboard':
        // CRM specific: View analytics dashboard
        navigateToDashboard()
        break
      
      default:
        console.log('Command:', command)
    }
  }
})

// Add CRM-specific commands
sdk.addCommand({
  id: 'create-contact',
  phrases: ['new contact', 'add contact', 'create contact'],
  action: 'create-contact'
})

sdk.addCommand({
  id: 'schedule-meeting',
  phrases: ['schedule meeting', 'book meeting', 'new appointment'],
  action: 'schedule-meeting'
})

sdk.start()
```

---

### 📱 Social Media Platform (Facebook, Twitter, etj.)

```javascript
const sdk = new VoiceActionsSDK({
  apiKey: process.env.VOICE_ACTIONS_API_KEY,
  platform: 'my-social',
  locale: 'en-US',
  onCommand: (command) => {
    switch (command.action) {
      case 'create-post':
        // Social media: Create new post
        openPostComposer()
        break
      
      case 'like-post':
        // Social media: Like current post
        const likeButton = document.querySelector('[data-testid="like-button"]')
        likeButton?.click()
        break
      
      case 'share-post':
        // Social media: Share post
        openShareModal()
        break
      
      case 'follow-user':
        // Social media: Follow user
        const followButton = document.querySelector('[data-testid="follow-button"]')
        followButton?.click()
        break
      
      case 'view-notifications':
        // Social media: View notifications
        navigateToNotifications()
        break
      
      default:
        console.log('Command:', command)
    }
  }
})

sdk.addCommand({
  id: 'create-post',
  phrases: ['new post', 'create post', 'write post'],
  action: 'create-post'
})

sdk.start()
```

---

### 🏥 Healthcare Platform

```javascript
const sdk = new VoiceActionsSDK({
  apiKey: process.env.VOICE_ACTIONS_API_KEY,
  platform: 'my-healthcare',
  locale: 'en-US',
  onCommand: (command) => {
    switch (command.action) {
      case 'book-appointment':
        // Healthcare: Book appointment
        openAppointmentBooking()
        break
      
      case 'view-medical-records':
        // Healthcare: View patient records
        navigateToRecords()
        break
      
      case 'prescribe-medication':
        // Healthcare: Prescribe medication
        openPrescriptionForm()
        break
      
      case 'schedule-surgery':
        // Healthcare: Schedule surgery
        openSurgeryScheduler()
        break
      
      default:
        console.log('Command:', command)
    }
  }
})

sdk.addCommand({
  id: 'book-appointment',
  phrases: ['book appointment', 'schedule visit', 'make appointment'],
  action: 'book-appointment'
})

sdk.start()
```

---

### 🎓 E-Learning Platform

```javascript
const sdk = new VoiceActionsSDK({
  apiKey: process.env.VOICE_ACTIONS_API_KEY,
  platform: 'my-elearning',
  locale: 'en-US',
  onCommand: (command) => {
    switch (command.action) {
      case 'start-course':
        // E-learning: Start course
        startCurrentCourse()
        break
      
      case 'submit-assignment':
        // E-learning: Submit assignment
        submitCurrentAssignment()
        break
      
      case 'view-grades':
        // E-learning: View grades
        navigateToGrades()
        break
      
      case 'join-live-class':
        // E-learning: Join live class
        joinLiveSession()
        break
      
      default:
        console.log('Command:', command)
    }
  }
})

sdk.addCommand({
  id: 'start-course',
  phrases: ['start course', 'begin lesson', 'open course'],
  action: 'start-course'
})

sdk.start()
```

---

## 🔧 Si të Krijoj Komanda Të Personalizuara

### Metoda 1: Në Frontend (Client-Side)

```javascript
// Shto komanda pas inicializimit
sdk.addCommand({
  id: 'my-custom-action',
  phrases: ['do something', 'perform action', 'execute task'],
  action: 'my-custom-action',
  description: 'My custom action description'
})

// Handle në onCommand
sdk.onCommand = (command) => {
  if (command.action === 'my-custom-action') {
    // Your custom logic
  }
}
```

### Metoda 2: Në Backend (Server-Side) - Në Zhvillim

Në të ardhmen, platformat do të mund të:
1. Krijojnë komanda në dashboard
2. I ruajnë në databazë
3. SDK automatikisht i ngarkon

**Status:** Kjo feature do të shtohet në versionin e ardhshëm.

---

## 🌍 Multi-Language Support

SDK mbështet **50+ gjuhë** automatikisht:

```javascript
// Ndrysho gjuhën dinamikisht
sdk.setLocale('sq-AL') // Shqip
sdk.setLocale('es-ES') // Spanjisht
sdk.setLocale('fr-FR') // Frëngjisht
sdk.setLocale('de-DE') // Gjermanisht
sdk.setLocale('it-IT') // Italianisht
sdk.setLocale('pt-BR') // Portugalisht (Brazil)
sdk.setLocale('ar-SA') // Arabisht
sdk.setLocale('zh-CN') // Kinezisht
sdk.setLocale('ja-JP') // Japonisht
// ... dhe më shumë
```

**Komanda të personalizuara** mund të kenë fraza në çdo gjuhë:

```javascript
sdk.addCommand({
  id: 'my-action',
  phrases: [
    'do something',        // English
    'bëj diçka',          // Albanian
    'hacer algo',         // Spanish
    'faire quelque chose' // French
  ],
  action: 'my-action'
})
```

---

## 📊 Architecture

```
┌─────────────────────────────────────────┐
│         Voice Actions SDK                │
│  (Universale - Pa logjikë hardcoded)    │
│                                          │
│  • Voice Recognition                     │
│  • Command Matching                      │
│  • Multi-language Support                │
│  • Usage Tracking                        │
│  • onCommand Callback                    │
└─────────────────────────────────────────┘
                    │
                    ▼
┌─────────────────────────────────────────┐
│         Platforma Juaj                  │
│  (Implementon logjikën specifike)       │
│                                          │
│  • YouTube: play, pause, next            │
│  • E-commerce: add to cart, checkout    │
│  • CRM: create contact, schedule        │
│  • Social: like, share, follow           │
│  • Healthcare: book appointment         │
│  • E-learning: start course             │
│  • ... çdo platformë tjetër             │
└─────────────────────────────────────────┘
```

---

## ✅ Përmbledhje

**SDK është:**
- ✅ **100% Universale** - funksionon për çdo platformë
- ✅ **Fleksibël** - platformat implementojnë logjikën e tyre
- ✅ **Multi-language** - mbështet 50+ gjuhë
- ✅ **E zgjidhshme** - mbështet çdo lloj komande
- ✅ **E shkallëzueshme** - për miliona platforma

**Platformat:**
- ✅ Implementojnë logjikën e tyre specifike
- ✅ Shtojnë komanda të personalizuara
- ✅ Kontrollojnë plotësisht veprimet

**Rezultati:**
🎉 **Një SDK, miliona platforma, pafund mundësi!**

---

## 🆘 Support

- 📧 Email: support@voiceactions.io
- 📚 Docs: https://voiceactions.io/docs/integration
- 📊 Dashboard: https://voiceactions.io/platform/dashboard

