# 🎤 Voice Actions SDK

**Universal Voice Control SDK për Web Applications - Funksionon për Çdo Platformë në Botë!**

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)
[![Version](https://img.shields.io/badge/version-1.0.0-blue.svg)](https://github.com/valon92/voice-actions-sdk-)

---

## 🌍 Universale dhe Globale

Voice Actions SDK është **100% universale** dhe e përshtatshme për **çdo platformë**:

- ✅ **YouTube, Instagram, Facebook** - Social Media & Video
- ✅ **Shopify, WooCommerce, Amazon** - E-Commerce
- ✅ **Salesforce, HubSpot, Zoho** - CRM
- ✅ **Healthcare Platforms** - Appointment booking, records
- ✅ **E-Learning Platforms** - Courses, assignments
- ✅ **Banking & Finance** - Transactions, transfers
- ✅ **Gaming Platforms** - Game controls
- ✅ **... dhe miliona platforma të tjera!**

**Një SDK, pafund mundësi!**

---

## 🚀 Quick Start

### Installation

```bash
npm install @voice-actions/sdk
```

### Basic Usage

```javascript
import VoiceActionsSDK from '@voice-actions/sdk'

const sdk = new VoiceActionsSDK({
  apiKey: process.env.VOICE_ACTIONS_API_KEY,
  platform: 'your-platform-name',
  locale: 'en-US',
  onCommand: (command) => {
    // Platforma juaj implementon logjikën
    console.log('Command:', command.action)
    // Your custom logic here
  }
})

sdk.start()
```

---

## ✨ Features

### 🌍 Universal & Platform-Agnostic
- **Nuk ka logjikë hardcoded** për platforma specifike
- **Fleksibël** - çdo platformë mund ta përshtasë
- **E zgjidhshme** - mbështet çdo lloj komande

### 🌐 Multi-Language Support
- Mbështet **English** (gjuhë të tjera do të shtohen gradualisht)
- Ndrysho gjuhën dinamikisht

### 🎯 Custom Commands
- Shto komanda të personalizuara në frontend
- Komanda në çdo gjuhë
- Platforma kontrollon plotësisht veprimet

### 📊 Usage Tracking
- Tracking automatik për billing
- Dashboard për monitoring
- Statistics dhe analytics

### 🔒 Secure
- API key authentication
- Rate limiting
- Secure communication

---

## 📚 Documentation

- **[Universal SDK Guide](./UNIVERSAL_SDK_GUIDE.md)** - Si të përdoret për çdo platformë
- **[YouTube Integration Guide](./YOUTUBE_INTEGRATION_GUIDE.md)** - Shembull specifik për YouTube
- **[SDK Usage Guide](./SDK_USAGE_GUIDE.md)** - Dokumentacion i plotë
- **[Integration Guide](./frontend/src/pages/docs/IntegrationGuide.vue)** - Frontend documentation

---

## 🎯 Examples

### E-Commerce Platform

```javascript
const sdk = new VoiceActionsSDK({
  apiKey: process.env.VOICE_ACTIONS_API_KEY,
  platform: 'my-ecommerce',
  locale: 'en-US',
  onCommand: (command) => {
    switch (command.action) {
      case 'add-to-cart':
        addProductToCart()
        break
      case 'checkout':
        window.location.href = '/checkout'
        break
    }
  }
})

sdk.addCommand({
  id: 'add-to-cart',
  phrases: ['add to cart', 'buy now', 'add product'],
  action: 'add-to-cart'
})

sdk.start()
```

### CRM Platform

```javascript
const sdk = new VoiceActionsSDK({
  apiKey: process.env.VOICE_ACTIONS_API_KEY,
  platform: 'my-crm',
  locale: 'en-US',
  onCommand: (command) => {
    switch (command.action) {
      case 'create-contact':
        openContactForm()
        break
      case 'schedule-meeting':
        openCalendar()
        break
    }
  }
})

sdk.start()
```

### Social Media Platform

```javascript
const sdk = new VoiceActionsSDK({
  apiKey: process.env.VOICE_ACTIONS_API_KEY,
  platform: 'my-social',
  locale: 'en-US',
  onCommand: (command) => {
    switch (command.action) {
      case 'like-post':
        likeCurrentPost()
        break
      case 'share-post':
        openShareModal()
        break
    }
  }
})

sdk.start()
```

---

## 🌐 Multi-Language

```javascript
// Ndrysho gjuhën dinamikisht
sdk.setLocale('sq-AL') // Shqip
sdk.setLocale('es-ES') // Spanjisht
sdk.setLocale('fr-FR') // Frëngjisht
sdk.setLocale('de-DE') // Gjermanisht
// ... 50+ gjuhë të tjera
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
│  • E-commerce: add to cart, checkout    │
│  • CRM: create contact, schedule         │
│  • Social: like, share, follow           │
│  • Healthcare: book appointment          │
│  • E-learning: start course              │
│  • ... çdo platformë tjetër              │
└─────────────────────────────────────────┘
```

---

## 🔑 Get API Key

1. Shko në: https://voiceactions.io/register-platform
2. Regjistro platformën tënde
3. Kopjo API key (vetëm një herë!)

---

## 📈 Usage Tracking

SDK automatikisht track-on:
- Session started/ended
- Commands executed
- Usage statistics

Shiko në dashboard: https://voiceactions.io/platform/dashboard

---

## 🔒 Security

- ✅ API key authentication
- ✅ Rate limiting
- ✅ Secure HTTPS communication
- ✅ No sensitive data stored

---

## 📝 License

MIT License - Përdorim i lirë për çdo platformë!

---

## 🆘 Support

- 📧 Email: support@voiceactions.io
- 📚 Docs: https://voiceactions.io/docs/integration
- 📊 Dashboard: https://voiceactions.io/platform/dashboard

---

## 🎉 Contributing

Contributions janë të mirëpritura! SDK është universale dhe mund të përmirësohet për të mbështetur edhe më shumë platforma.

---

**Një SDK, miliona platforma, pafund mundësi!** 🚀
