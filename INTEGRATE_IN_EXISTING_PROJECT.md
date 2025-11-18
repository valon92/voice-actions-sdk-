# Integrimi i Voice Actions SDK në Projekt Ekzistues (Localhost)

Ky dokument shpjegon si të integrohet Voice Actions SDK në një projekt ekzistues që tashmë ke në localhost.

## 🚀 Quick Integration Steps

### 1. Instalo SDK në projektin tënd

```bash
# Në root directory të projektit tënd
cd /path/to/your-existing-project

# Metoda 1: Nga GitHub (Rekomanduar)
npm install git+https://github.com/valon92/voice-actions-sdk-.git#main:./sdk --save

# Ose Metoda 2: Nga NPM (nëse është publikuar)
npm install @valon92/voice-actions-sdk --save
```

### 2. Sigurohu që Backend është running

```bash
# Në terminal tjetër, start Voice Actions Backend
cd /Users/valonsylejmani/Projekte/VoiceActionsSDK/backend
php artisan serve
# Backend në http://localhost:8000
```

### 3. Integro SDK në projektin tënd

#### Për JavaScript/Vanilla JS:

```javascript
// Në main.js ose app.js të projektit tënd
import VoiceActionsSDK, { VoiceActionsWidget } from '@valon92/voice-actions-sdk';

// Konfigurim
const userId = 'your-user-id'; // ID e user-it në projektin tënd
const apiKey = 'your-api-key'; // API key nga Voice Actions Dashboard
const apiUrl = 'http://localhost:8000/api'; // Për testime lokale

let sdk = null;
let widget = null;

// Initialize Voice Actions
function initVoiceActions() {
  sdk = new VoiceActionsSDK({
    apiKey: apiKey,
    apiUrl: apiUrl,
    platform: 'your-platform-name', // Emri i platformës suaj
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

// Handle voice commands
function handleVoiceCommand(command) {
  console.log('Voice command received:', command);
  
  // Implemento logjikën e projektit tënd bazuar në command
  switch (command.action) {
    case 'navigate-home':
      window.location.href = '/';
      break;
    case 'search':
      // Fokus në search input
      document.getElementById('search')?.focus();
      break;
    case 'go-back':
      window.history.back();
      break;
    // ... shto më shumë commands bazuar në nevojat e projektit tënd
  }
}

// Initialize kur faqja ngarkohet
if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', initVoiceActions);
} else {
  initVoiceActions();
}
```

#### Për React:

```jsx
// VoiceActions.jsx
import { useEffect, useRef } from 'react';
import VoiceActionsSDK, { VoiceActionsWidget } from '@valon92/voice-actions-sdk';

export default function VoiceActions({ userId, apiKey }) {
  const sdkRef = useRef(null);
  const widgetRef = useRef(null);

  useEffect(() => {
    const apiUrl = 'http://localhost:8000/api';

    // Initialize SDK
    sdkRef.current = new VoiceActionsSDK({
      apiKey: apiKey,
      apiUrl: apiUrl,
      platform: 'your-platform',
      userIdentifier: userId,
      locale: 'en-US',
      debug: true,
      onCommand: (command) => {
        console.log('Command:', command);
        // Handle command
      },
      onError: (error) => {
        console.error('SDK Error:', error);
      }
    });

    // Initialize Widget
    widgetRef.current = new VoiceActionsWidget({
      sdk: sdkRef.current,
      position: 'bottom-right',
      autoCheck: true
    });

    return () => {
      widgetRef.current?.destroy();
      sdkRef.current?.destroy();
    };
  }, [userId, apiKey]);

  return null; // Widget shfaqet automatikisht
}
```

#### Për Vue.js:

```vue
<!-- VoiceActions.vue -->
<template>
  <div></div>
</template>

<script setup>
import { onMounted, onUnmounted } from 'vue';
import VoiceActionsSDK, { VoiceActionsWidget } from '@valon92/voice-actions-sdk';

const props = defineProps({
  userId: String,
  apiKey: String
});

let sdk = null;
let widget = null;

onMounted(() => {
  const apiUrl = 'http://localhost:8000/api';

  sdk = new VoiceActionsSDK({
    apiKey: props.apiKey,
    apiUrl: apiUrl,
    platform: 'your-platform',
    userIdentifier: props.userId,
    locale: 'en-US',
    debug: true,
    onCommand: (command) => {
      console.log('Command:', command);
    }
  });

  widget = new VoiceActionsWidget({
    sdk: sdk,
    position: 'bottom-right',
    autoCheck: true
  });
});

onUnmounted(() => {
  widget?.destroy();
  sdk?.destroy();
});
</script>
```

### 4. Shto Platform-Level Settings Toggle (Rekomanduar)

**IMPORTANT:** SDK-ja kontrollon automatikisht platform-level setting. Kur setting-i "Enable Voice Control" është **OFF** në Settings > Voice Control:
- SDK-ja **nuk inicializohet**
- Widget-i (ikona e mikrofonit) **nuk shfaqet**
- Libraria **nuk funksionon** fare

Nëse dëshiron të shtosh toggle për Platform-Level Voice Control në settings page të projektit tënd (si në Stargate):

```javascript
// Në settings component/page (Platform Settings)
async function handlePlatformVoiceControlToggle(enabled) {
  const apiKey = 'your-api-key'; // API key e platformës
  const apiUrl = 'http://localhost:8000/api';

  try {
    const response = await fetch(`${apiUrl}/platforms/settings`, {
      method: 'PUT',
      headers: {
        'Content-Type': 'application/json',
        'X-API-Key': apiKey
      },
      body: JSON.stringify({
        voice_actions_enabled: enabled
      })
    });

    const data = await response.json();
    
    if (data.success || response.ok) {
      if (enabled) {
        alert('Voice Control enabled! Microphone icon will appear.');
        // Reload page ose re-initialize SDK për të shfaqur widget-in menjëherë
        window.location.reload(); // Ose re-initialize SDK manualisht
      } else {
        alert('Voice Control disabled. Microphone icon will disappear.');
        // Widget-i do të fshihet automatikisht pas ~30 sekondave (auto-check interval)
        // Ose reload page për efekt të menjëhershëm
        window.location.reload();
      }
    }
  } catch (error) {
    console.error('Failed to update platform settings:', error);
    alert('Failed to update Voice Control settings');
  }
}

// Për të kontrolluar statusin aktual të platform setting
async function checkPlatformVoiceControlStatus() {
  const apiKey = 'your-api-key';
  const apiUrl = 'http://localhost:8000/api';

  try {
    const response = await fetch(`${apiUrl}/platforms/settings`, {
      headers: {
        'X-API-Key': apiKey
      }
    });

    const data = await response.json();
    return data.settings?.voice_actions_enabled ?? true;
  } catch (error) {
    console.error('Failed to check platform settings:', error);
    return true; // Default to enabled on error
  }
}
```

#### Për Vue.js (si në Stargate):

```vue
<template>
  <div class="settings-section">
    <h3>Voice Control</h3>
    <div class="setting-item">
      <label class="toggle-switch">
        <input
          type="checkbox"
          v-model="voiceControlEnabled"
          @change="handleVoiceControlToggle"
          :disabled="saving"
        />
        <span class="slider"></span>
        <span class="label-text">Enable Voice Control</span>
      </label>
      <p class="description">
        Allow voice commands to control the platform
      </p>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios'; // ose fetch

const voiceControlEnabled = ref(true);
const saving = ref(false);
const apiKey = 'your-api-key'; // Nga environment ose config
const apiUrl = 'http://localhost:8000/api';

onMounted(async () => {
  await loadPlatformSettings();
});

async function loadPlatformSettings() {
  try {
    const response = await axios.get(`${apiUrl}/platforms/settings`, {
      headers: {
        'X-API-Key': apiKey
      }
    });
    
    voiceControlEnabled.value = response.data.settings?.voice_actions_enabled ?? true;
  } catch (error) {
    console.error('Failed to load platform settings:', error);
  }
}

async function handleVoiceControlToggle() {
  saving.value = true;
  
  try {
    const response = await axios.put(
      `${apiUrl}/platforms/settings`,
      {
        voice_actions_enabled: voiceControlEnabled.value
      },
      {
        headers: {
          'X-API-Key': apiKey
        }
      }
    );

    if (response.data.success) {
      // Reload page për efekt të menjëhershëm
      // Ose mund të re-initialize SDK manualisht
      setTimeout(() => {
        window.location.reload();
      }, 500);
    }
  } catch (error) {
    console.error('Failed to update platform settings:', error);
    // Revert toggle on error
    voiceControlEnabled.value = !voiceControlEnabled.value;
    alert('Failed to update Voice Control settings');
  } finally {
    saving.value = false;
  }
}
</script>
```

### 5. User-Level Settings Toggle (Opsionale)

Nëse dëshiron të shtosh edhe user-level toggle (për çdo user individualisht):

```javascript
// Në settings component/page
async function handleUserVoiceControlToggle(enabled) {
  const userId = getCurrentUserId(); // Funksioni i projektit tënd
  const apiKey = 'your-api-key';
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
        alert('Voice Control enabled! Microphone icon will appear.');
      } else {
        alert('Voice Control disabled. Microphone icon will disappear.');
      }
    }
  } catch (error) {
    console.error('Failed to update user settings:', error);
    alert('Failed to update Voice Control settings');
  }
}
```

**Shënim:** Platform-level setting ka prioritet më të lartë. Nëse platforma ka çaktivizuar Voice Control, user-level setting nuk do të funksionojë.

## 🧪 Testimi

### 1. Verifikoni që SDK është instaluar

```bash
# Në projektin tënd
npm list @valon92/voice-actions-sdk
```

### 2. Kontrolloni Console

Hap browser console dhe kontrolloni për:
- ✅ "✅ Voice Actions SDK initialized"
- ✅ "Widget initialized"
- ✅ Nuk ka errors

### 3. Testoni Features

1. **Widget shfaqet:**
   - Duhet të shohësh ikonë të mikrofonit në këndin e faqes
   - Nëse nuk shfaqet, kontrollo që user-i ka aktivizuar Voice Actions

2. **Voice Recognition:**
   - Kliko ikonën e mikrofonit
   - Thuaj një command (p.sh. "go home", "search")
   - Kontrollo console për command received

3. **Platform-Level Settings Toggle:**
   - Toggle OFF → SDK nuk inicializohet, widget nuk shfaqet, libraria nuk funksionon
   - Toggle ON → SDK inicializohet, widget shfaqet, libraria funksionon normalisht
   - Widget-i kontrollon automatikisht çdo 30 sekonda për ndryshime në setting

4. **User-Level Settings Toggle (nëse e ke shtuar):**
   - Toggle OFF → Widget fshihet për atë user specifik
   - Toggle ON → Widget shfaqet për atë user specifik

## 🔧 Troubleshooting

### SDK nuk inicializohet

1. **Kontrollo import:**
   ```javascript
   // Verifikoni që import është i saktë
   import VoiceActionsSDK from '@valon92/voice-actions-sdk';
   ```

2. **Kontrollo backend:**
   ```bash
   # Verifikoni që backend është running
   curl http://localhost:8000/api/commands/demo
   ```

3. **Kontrollo console për errors**

### Widget nuk shfaqet

1. **Kontrollo platform-level setting:**
   ```javascript
   // Në console
   await sdk.checkPlatformEnabled()
   // Duhet të kthejë true
   ```

2. **Kontrollo user-level setting (nëse ke userIdentifier):**
   ```javascript
   // Në console
   await sdk.checkUserEnabled()
   // Duhet të kthejë true
   ```

3. **Kontrollo që SDK është inicializuar:**
   ```javascript
   console.log(sdk.isInitialized); // Duhet të jetë true
   ```

4. **Kontrollo që userIdentifier është vendosur (nëse përdoret):**
   ```javascript
   console.log(sdk.userIdentifier);
   ```

### CORS Errors

1. **Kontrollo backend CORS:**
   ```php
   // backend/config/cors.php
   'allowed_origins' => ['http://localhost:5173', 'http://localhost:3000', ...]
   ```

2. **Shto origin-i i projektit tënd në CORS**

## 📝 Checklist

- [ ] SDK instaluar në projekt
- [ ] Backend running në localhost:8000
- [ ] Platform-level setting është ON në Settings > Voice Control
- [ ] SDK inicializohet pa errors
- [ ] Widget shfaqet (ikona e mikrofonit)
- [ ] Voice recognition funksionon
- [ ] Commands ekzekutohen
- [ ] Platform-level toggle funksionon (OFF → widget fshihet, ON → widget shfaqet)
- [ ] User-level toggle funksionon (nëse e ke shtuar)

## 🎯 Next Steps

Pas testimeve të suksesshme:

1. **Update API URL për production:**
   ```javascript
   const apiUrl = 'https://api.voiceactions.dev/api';
   ```

2. **Remove debug mode:**
   ```javascript
   debug: false
   ```

3. **Test në production environment**

4. **Deploy në production**

## 💡 Tips

- Përdor `debug: true` për testime lokale
- Kontrollo console logs për debugging
- Testoni me user të ndryshëm për të verifikuar user-level settings
- Kontrollo network tab për API requests

## 📞 Support

Për probleme:
- Kontrolloni `TEST_LIBRARY_LOCALHOST.md`
- Kontrolloni console logs
- Kontrolloni network requests
- Kontrolloni backend logs

