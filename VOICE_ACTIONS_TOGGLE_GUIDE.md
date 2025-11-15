# Voice Actions Toggle Guide

Ky dokument shpjegon si të përdoret feature-i i toggle ON/OFF për Voice Actions SDK në platformat tuaja.

## 📋 Përmbledhje

Platformat mund të aktivizojnë ose çaktivizojnë Voice Actions SDK përmes Settings page në dashboard. Kur është **ON**, SDK është aktiv dhe i dukshëm. Kur është **OFF**, SDK është i padukshëm dhe i çaktivizuar.

## 🎯 Si të Përdoret

### 1. Nga Dashboard

1. Hyni në **Platform Dashboard** (`/platform/dashboard`)
2. Klikoni butonin **⚙️ Settings** në Quick Actions
3. Në faqen e Settings, gjeni toggle-in **Voice Actions SDK**
4. Aktivizoni ose çaktivizoni sipas nevojës
5. Ndryshimet ruhen automatikisht

### 2. Nga API

#### Kontrollo Status

```javascript
const response = await fetch('https://api.voiceactions.dev/api/platforms/settings', {
  headers: {
    'X-API-Key': 'your-api-key'
  }
});

const data = await response.json();
console.log(data.settings.voice_actions_enabled); // true ose false
```

#### Update Status

```javascript
const response = await fetch('https://api.voiceactions.dev/api/platforms/settings', {
  method: 'PUT',
  headers: {
    'Content-Type': 'application/json',
    'X-API-Key': 'your-api-key'
  },
  body: JSON.stringify({
    voice_actions_enabled: true // ose false
  })
});

const data = await response.json();
console.log(data.message); // "Settings updated successfully"
```

## 💻 Integrimi në Kod

### JavaScript/TypeScript

```javascript
// Kontrollo nëse Voice Actions është aktiv para se të inicializosh SDK
async function initVoiceActions() {
  const response = await fetch('https://api.voiceactions.dev/api/platforms/settings', {
    headers: {
      'X-API-Key': 'your-api-key'
    }
  });

  const data = await response.json();
  
  if (data.settings.voice_actions_enabled) {
    // Initialize SDK
    const sdk = new VoiceActionsSDK({
      apiKey: 'your-api-key',
      platform: 'your-platform',
      locale: 'en-US',
      onCommand: handleCommand
    });
    
    // Show SDK UI
    document.getElementById('voice-actions-widget').style.display = 'block';
  } else {
    // Hide SDK UI
    document.getElementById('voice-actions-widget').style.display = 'none';
  }
}
```

### React Example

```jsx
import { useState, useEffect } from 'react';
import VoiceActionsSDK from '@valon92/voice-actions-sdk';

function App() {
  const [sdk, setSdk] = useState(null);
  const [enabled, setEnabled] = useState(true);

  useEffect(() => {
    async function checkSettings() {
      const response = await fetch('https://api.voiceactions.dev/api/platforms/settings', {
        headers: {
          'X-API-Key': process.env.REACT_APP_API_KEY
        }
      });
      
      const data = await response.json();
      setEnabled(data.settings.voice_actions_enabled);
      
      if (data.settings.voice_actions_enabled) {
        const voiceSDK = new VoiceActionsSDK({
          apiKey: process.env.REACT_APP_API_KEY,
          platform: 'your-platform',
          onCommand: handleCommand
        });
        setSdk(voiceSDK);
      }
    }
    
    checkSettings();
  }, []);

  if (!enabled) {
    return null; // Don't render SDK
  }

  return (
    <div>
      {/* Your app content */}
      {sdk && <VoiceActionsWidget sdk={sdk} />}
    </div>
  );
}
```

### Vue.js Example

```vue
<template>
  <div>
    <VoiceActionsWidget v-if="voiceActionsEnabled" :sdk="sdk" />
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import VoiceActionsSDK from '@valon92/voice-actions-sdk';

const sdk = ref(null);
const voiceActionsEnabled = ref(false);

onMounted(async () => {
  const response = await fetch('https://api.voiceactions.dev/api/platforms/settings', {
    headers: {
      'X-API-Key': import.meta.env.VITE_API_KEY
    }
  });
  
  const data = await response.json();
  voiceActionsEnabled.value = data.settings.voice_actions_enabled;
  
  if (voiceActionsEnabled.value) {
    sdk.value = new VoiceActionsSDK({
      apiKey: import.meta.env.VITE_API_KEY,
      platform: 'your-platform',
      onCommand: handleCommand
    });
  }
});
</script>
```

## 🔄 Real-time Updates

Nëse dëshironi të monitoroni ndryshimet në real-time, mund të përdorni polling:

```javascript
// Check settings every 30 seconds
setInterval(async () => {
  const response = await fetch('https://api.voiceactions.dev/api/platforms/settings', {
    headers: {
      'X-API-Key': 'your-api-key'
    }
  });
  
  const data = await response.json();
  const isEnabled = data.settings.voice_actions_enabled;
  
  if (isEnabled && !sdk) {
    // Initialize SDK if it was disabled
    sdk = new VoiceActionsSDK({...});
  } else if (!isEnabled && sdk) {
    // Destroy SDK if it was disabled
    sdk.destroy();
    sdk = null;
  }
}, 30000);
```

## 📝 API Endpoints

### GET /api/platforms/settings
Kthen settings aktuale për platformën.

**Headers:**
- `X-API-Key`: Your API key

**Response:**
```json
{
  "success": true,
  "settings": {
    "voice_actions_enabled": true
  }
}
```

### PUT /api/platforms/settings
Update settings për platformën.

**Headers:**
- `X-API-Key`: Your API key
- `Content-Type`: application/json

**Body:**
```json
{
  "voice_actions_enabled": true
}
```

**Response:**
```json
{
  "success": true,
  "message": "Settings updated successfully",
  "platform": {
    "id": 1,
    "name": "My Platform",
    "voice_actions_enabled": true
  }
}
```

## ⚠️ Shënime të Rëndësishme

1. **Default Value:** Platformat e reja kanë `voice_actions_enabled = true` si default
2. **API Key Required:** Të gjitha requests për settings kërkojnë API key
3. **Immediate Effect:** Ndryshimet merren efekt menjëherë pas update
4. **Backward Compatibility:** Nëse kolona nuk ekziston, default është `true`

## 🚀 Migration

Për të aktivizuar këtë feature në database, ekzekutoni migration:

```bash
cd backend
php artisan migrate
```

Kjo do të shtojë kolonën `voice_actions_enabled` në tabelën `platforms`.

## 📞 Support

Nëse keni pyetje ose probleme, kontaktoni:
- **Email:** support@voiceactions.io
- **Website:** https://voiceactions.dev

