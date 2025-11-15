# Stargate.ci - Localhost Integration Guide

Ky dokument shpjegon si të integrohet Voice Actions SDK direkt nga GitHub në projektin stargate.ci për testime lokale, para publikimit në NPM.

## 🎯 Qëllimi

Testimi i ndryshimeve të reja (user-level settings, automatic widget) në stargate.ci në localhost, pa pasur nevojë për publikim në NPM.

## 📦 Metoda 1: Import direkt nga GitHub (Rekomanduar)

### 1. Në projektin stargate.ci

```bash
# Në root directory të stargate.ci
cd /path/to/stargate.ci
```

### 2. Instalo SDK direkt nga GitHub

```bash
npm install git+https://github.com/valon92/voice-actions-sdk-.git#main --save
```

Ose nëse dëshiron të instalosh nga një branch specifik:

```bash
npm install git+https://github.com/valon92/voice-actions-sdk-.git#main:./sdk --save
```

### 3. Import në stargate.ci

```javascript
// Në main.js ose app.js
import VoiceActionsSDK, { VoiceActionsWidget } from '@valon92/voice-actions-sdk';

const userId = getCurrentUserId(); // Funksioni i stargate.ci
const apiKey = 'stargate-api-key';
const apiUrl = 'http://localhost:8000/api'; // Për testime lokale

let sdk = null;
let widget = null;

function initVoiceActions() {
  sdk = new VoiceActionsSDK({
    apiKey: apiKey,
    apiUrl: apiUrl,
    platform: 'stargate',
    userIdentifier: userId,
    locale: 'en-US',
    debug: true, // Enable për testime
    onCommand: handleVoiceCommand,
    onError: (error) => {
      console.error('Voice Actions Error:', error);
    }
  });

  widget = new VoiceActionsWidget({
    sdk: sdk,
    position: 'bottom-right',
    size: 'medium',
    theme: 'default',
    autoCheck: true,
    checkInterval: 30000
  });
}

function handleVoiceCommand(command) {
  console.log('Voice command:', command);
  // Handle commands
}

// Initialize
initVoiceActions();
```

## 📦 Metoda 2: Clone dhe Link Lokal (Për development)

### 1. Clone Voice Actions SDK

```bash
cd /path/to/workspace
git clone https://github.com/valon92/voice-actions-sdk-.git
cd voice-actions-sdk/sdk
npm install
npm run build
```

### 2. Link në stargate.ci

```bash
# Në stargate.ci project
cd /path/to/stargate.ci
npm link /path/to/voice-actions-sdk/sdk
```

### 3. Import në stargate.ci

```javascript
import VoiceActionsSDK, { VoiceActionsWidget } from '@valon92/voice-actions-sdk';
// ... rest of code same as above
```

## 📦 Metoda 3: Copy Source Files (Më e thjeshtë për testime)

### 1. Kopjo SDK source files

```bash
# Në stargate.ci project
mkdir -p src/lib/voice-actions-sdk
cp -r /path/to/voice-actions-sdk/sdk/src/* src/lib/voice-actions-sdk/
```

### 2. Import në stargate.ci

```javascript
// Në main.js ose app.js
import VoiceActionsSDK from './src/lib/voice-actions-sdk/index.js';
import VoiceActionsWidget from './src/lib/voice-actions-sdk/widget.js';

// ... rest of code same as above
```

## ⚙️ Settings Page Integration

Në settings page të stargate.ci, shtoni toggle për Voice Control:

```javascript
// Në settings component
async function handleVoiceControlToggle(enabled) {
  const userId = getCurrentUserId();
  const apiKey = 'stargate-api-key';
  const apiUrl = 'http://localhost:8000/api';

  try {
    const response = await fetch(`${apiUrl}/user-voice-settings`, {
      method: 'PUT',
      headers: {
        'Content-Type': 'application/json',
        'X-API-Key': apiKey
      },
      body: JSON.stringify({
        user_identifier: userId,
        voice_actions_enabled: enabled
      })
    });

    const data = await response.json();
    
    if (data.success || response.ok) {
      if (enabled) {
        showNotification('Voice Control enabled! Microphone icon will appear.');
      } else {
        showNotification('Voice Control disabled. Microphone icon will disappear.');
      }
    }
  } catch (error) {
    console.error('Failed to update settings:', error);
    showError('Failed to update Voice Control settings');
  }
}
```

## 🧪 Test Scenarios

### Test 1: Toggle OFF
1. Hapni stargate.ci në localhost
2. Shkoni në Settings
3. Toggle "Enable Voice Control" OFF
4. **Expected:** Mikrofon duhet të fshihet automatikisht
5. **Expected:** SDK nuk duhet të funksionojë

### Test 2: Toggle ON
1. Toggle "Enable Voice Control" ON
2. **Expected:** Mikrofon duhet të shfaqet automatikisht
3. **Expected:** SDK duhet të inicializohet automatikisht

### Test 3: Voice Recognition
1. Toggle ON
2. Klikoni ikonën e mikrofonit
3. **Expected:** Voice recognition duhet të fillojë
4. **Expected:** Widget duhet të pulse (animation)

### Test 4: Auto-check
1. Toggle ON
2. Në një tab tjetër, toggle OFF
3. Pritni 30 sekonda
4. **Expected:** Widget duhet të fshihet automatikisht

## 🔧 Requirements

### Backend (Voice Actions API)
```bash
cd /path/to/VoiceActionsSDK/backend
php artisan migrate
php artisan serve
# Backend në http://localhost:8000
```

### Frontend (Voice Actions Dashboard) - Opsionale
```bash
cd /path/to/VoiceActionsSDK/frontend
npm run dev
# Frontend në http://localhost:5173
```

## 📝 Environment Variables

Në stargate.ci, sigurohuni që keni:

```javascript
const config = {
  voiceActionsApiUrl: 'http://localhost:8000/api', // Për testime lokale
  voiceActionsApiKey: 'stargate-api-key', // API key e stargate.ci
  voiceActionsPlatform: 'stargate'
};
```

## 🔍 Debugging

### Console Logs
Kontrolloni browser console për:
- SDK initialization messages
- Widget show/hide messages
- User settings check results
- API request/response

### Network Tab
Kontrolloni Network tab për:
- `GET /api/user-voice-settings/check`
- `PUT /api/user-voice-settings`
- `GET /api/commands/demo`

### Common Issues

1. **SDK nuk ngarkohet:**
   - Kontrolloni që import path është i saktë
   - Kontrolloni që files janë kopjuar saktë
   - Kontrolloni console për errors

2. **Widget nuk shfaqet:**
   - Kontrolloni që `userIdentifier` është vendosur
   - Kontrolloni që backend është running
   - Kontrolloni që user-i ka aktivizuar Voice Actions

3. **API nuk funksionon:**
   - Kontrolloni që backend është running në `localhost:8000`
   - Kontrolloni CORS settings
   - Kontrolloni API key

## ✅ Pas Testimeve të Suksesshme

Kur të keni testuar dhe gjithçka funksionon:

1. **Update version në SDK:**
   ```bash
   cd /path/to/voice-actions-sdk/sdk
   npm version patch  # ose minor, major
   ```

2. **Publiko në NPM:**
   ```bash
   npm run build
   npm publish
   ```

3. **Update stargate.ci për të përdorur NPM version:**
   ```bash
   cd /path/to/stargate.ci
   npm install @valon92/voice-actions-sdk@latest
   ```

## 📞 Support

Për probleme:
- Kontrolloni GitHub: https://github.com/valon92/voice-actions-sdk-
- Kontrolloni console logs
- Kontrolloni network requests

