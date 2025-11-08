# 🎤 Voice Actions SDK

**Global Voice Control SDK for Web Applications**

Enable voice commands in multiple languages for your platform. Easy integration, powerful features.

---

## 🚀 Quick Start

### Installation

```bash
npm install @voice-actions/sdk
```

Or include via CDN:

```html
<script src="https://cdn.voiceactions.io/sdk/v1/voice-actions-sdk.min.js"></script>
```

### Basic Usage

```javascript
import VoiceActionsSDK from '@voice-actions/sdk'

const sdk = new VoiceActionsSDK({
  apiKey: 'your-api-key-here',
  platform: 'your-platform-name',
  locale: 'en-US',
  onCommand: (command) => {
    console.log('Command executed:', command)
  }
})

// Start listening
sdk.start()
```

---

## 📚 Documentation

- [Integration Guide](/docs/integration) - Complete integration instructions
- [API Reference](/docs/api) - Full API documentation
- [Examples](/docs/examples) - Code examples and use cases

---

## 🌍 Features

- ✅ **Multi-language Support** - 50+ languages and locales
- ✅ **Easy Integration** - Simple API, get started in minutes
- ✅ **Secure** - API key authentication
- ✅ **Scalable** - Usage tracking and rate limiting
- ✅ **Customizable** - Add your own voice commands

---

## 🏗️ Project Structure

```
VoiceActionsSDK/
├── backend/          # Laravel API backend
├── frontend/         # Vue.js frontend portal
├── sdk/              # Voice Actions SDK (npm package)
└── docs/             # Documentation
```

---

## 🛠️ Development

### Backend (Laravel)

```bash
cd backend
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
```

### Frontend (Vue.js)

```bash
cd frontend
npm install
npm run dev
```

### SDK

```bash
cd sdk
npm install
npm run build
```

---

## 📝 License

MIT License - see [LICENSE](LICENSE) file for details.

---

## 🤝 Contributing

Contributions are welcome! Please read our contributing guidelines first.

---

## 📧 Contact

- Website: https://voiceactions.io
- Email: support@voiceactions.io
- GitHub: https://github.com/voice-actions/sdk

---

**Made with ❤️ by Voice Actions SDK Team**

