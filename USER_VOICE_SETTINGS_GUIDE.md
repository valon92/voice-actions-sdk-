# User Voice Settings Integration Guide

Ky dokument shpjegon si platformat (si stargate.ci) mund të integrojnë user-level settings për Voice Actions SDK.

## 📋 Përmbledhje

Çdo platform që ka instaluar Voice Actions SDK mund të ofrojë përdoruesve të tyre mundësinë të aktivizojnë ose çaktivizojnë Voice Actions në settings e platformës së tyre. Kjo është një user-level setting, jo platform-level.

## 🎯 Si Funksionon

1. **Platform Level:** Platforma duhet të ketë Voice Actions SDK aktiv (në platform settings)
2. **User Level:** Çdo user i platformës mund të zgjedhë ON/OFF në settings e tyre
3. **Default:** Nëse user-i nuk ka zgjedhur, default është **ON**

## 🔌 API Endpoints

### 1. Check if User has Voice Actions Enabled

**Endpoint:** `GET /api/user-voice-settings/check`

**Query Parameters:**
- `user_identifier` (required): ID ose email i user-it

**Headers:**
- `X-API-Key`: API key e platformës

**Response:**
```json
{
  "success": true,
  "enabled": true,
  "reason": "enabled" // ose "user_disabled" ose "platform_disabled"
}
```

**Example:**
```javascript
const response = await fetch(
  'https://api.voiceactions.dev/api/user-voice-settings/check?user_identifier=user123',
  {
    headers: {
      'X-API-Key': 'your-platform-api-key'
    }
  }
);

const data = await response.json();
if (data.enabled) {
  // Initialize Voice Actions SDK
} else {
  // Hide Voice Actions UI
}
```

### 2. Get User Settings

**Endpoint:** `GET /api/user-voice-settings`

**Query Parameters:**
- `user_identifier` (required): ID ose email i user-it

**Headers:**
- `X-API-Key`: API key e platformës

**Response:**
```json
{
  "success": true,
  "settings": {
    "voice_actions_enabled": true,
    "locale": "en-US",
    "preferences": null
  },
  "is_new": false
}
```

### 3. Update User Settings

**Endpoint:** `PUT /api/user-voice-settings`

**Headers:**
- `X-API-Key`: API key e platformës
- `Content-Type`: application/json

**Body:**
```json
{
  "user_identifier": "user123",
  "voice_actions_enabled": true,
  "locale": "en-US",
  "preferences": {}
}
```

**Response:**
```json
{
  "success": true,
  "message": "User settings updated successfully",
  "settings": {
    "voice_actions_enabled": true,
    "locale": "en-US",
    "preferences": null
  }
}
```

## 💻 Integrimi në Platformat

### Shembull: stargate.ci Settings Page

```javascript
// Në settings page të stargate.ci
class StargateSettings {
  constructor(userId, apiKey) {
    this.userId = userId;
    this.apiKey = apiKey;
    this.apiUrl = 'https://api.voiceactions.dev/api';
  }

  async loadVoiceActionsSetting() {
    const response = await fetch(
      `${this.apiUrl}/user-voice-settings?user_identifier=${this.userId}`,
      {
        headers: {
          'X-API-Key': this.apiKey
        }
      }
    );
    
    const data = await response.json();
    return data.settings.voice_actions_enabled;
  }

  async updateVoiceActionsSetting(enabled) {
    const response = await fetch(`${this.apiUrl}/user-voice-settings`, {
      method: 'PUT',
      headers: {
        'Content-Type': 'application/json',
        'X-API-Key': this.apiKey
      },
      body: JSON.stringify({
        user_identifier: this.userId,
        voice_actions_enabled: enabled
      })
    });
    
    return await response.json();
  }
}

// Në UI
const settings = new StargateSettings('user123', 'stargate-api-key');

// Load current setting
const isEnabled = await settings.loadVoiceActionsSetting();
document.getElementById('voice-actions-toggle').checked = isEnabled;

// Handle toggle change
document.getElementById('voice-actions-toggle').addEventListener('change', async (e) => {
  const enabled = e.target.checked;
  await settings.updateVoiceActionsSetting(enabled);
  
  // Notify user
  if (enabled) {
    showNotification('Voice Actions activated!');
    // Initialize SDK
    initVoiceActionsSDK();
  } else {
    showNotification('Voice Actions disabled');
    // Destroy SDK
    destroyVoiceActionsSDK();
  }
});
```

### React Example

```jsx
import { useState, useEffect } from 'react';
import VoiceActionsSDK from '@valon92/voice-actions-sdk';

function StargateSettingsPage({ userId, apiKey }) {
  const [voiceEnabled, setVoiceEnabled] = useState(true);
  const [loading, setLoading] = useState(true);
  const [sdk, setSdk] = useState(null);

  useEffect(() => {
    loadSettings();
  }, []);

  useEffect(() => {
    if (voiceEnabled && !sdk) {
      initSDK();
    } else if (!voiceEnabled && sdk) {
      sdk.destroy();
      setSdk(null);
    }
  }, [voiceEnabled]);

  async function loadSettings() {
    try {
      const response = await fetch(
        `https://api.voiceactions.dev/api/user-voice-settings/check?user_identifier=${userId}`,
        {
          headers: {
            'X-API-Key': apiKey
          }
        }
      );
      
      const data = await response.json();
      setVoiceEnabled(data.enabled);
    } catch (error) {
      console.error('Failed to load settings:', error);
    } finally {
      setLoading(false);
    }
  }

  async function handleToggle(enabled) {
    try {
      const response = await fetch('https://api.voiceactions.dev/api/user-voice-settings', {
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
      if (data.success) {
        setVoiceEnabled(enabled);
      }
    } catch (error) {
      console.error('Failed to update settings:', error);
    }
  }

  function initSDK() {
    const voiceSDK = new VoiceActionsSDK({
      apiKey: apiKey,
      platform: 'stargate',
      locale: 'en-US',
      onCommand: handleVoiceCommand
    });
    setSdk(voiceSDK);
  }

  if (loading) {
    return <div>Loading settings...</div>;
  }

  return (
    <div className="settings-page">
      <h2>Voice Actions Settings</h2>
      
      <label>
        <input
          type="checkbox"
          checked={voiceEnabled}
          onChange={(e) => handleToggle(e.target.checked)}
        />
        Enable Voice Actions
      </label>
      
      {voiceEnabled && (
        <div className="voice-actions-active">
          🎤 Voice Actions is active! You can now use voice commands.
        </div>
      )}
    </div>
  );
}
```

### Vue.js Example

```vue
<template>
  <div class="settings-page">
    <h2>Voice Actions Settings</h2>
    
    <div class="setting-item">
      <label class="toggle-switch">
        <input
          type="checkbox"
          v-model="voiceEnabled"
          @change="handleToggle"
          :disabled="saving"
        />
        <span class="slider"></span>
        <span class="label-text">Enable Voice Actions</span>
      </label>
      
      <p v-if="voiceEnabled" class="status-message">
        🎤 Voice Actions is active! You can now use voice commands.
      </p>
      <p v-else class="status-message">
        Voice Actions is disabled. Enable it to use voice commands.
      </p>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, watch } from 'vue';
import VoiceActionsSDK from '@valon92/voice-actions-sdk';

const props = defineProps({
  userId: String,
  apiKey: String
});

const voiceEnabled = ref(true);
const saving = ref(false);
const sdk = ref(null);

onMounted(async () => {
  await loadSettings();
});

watch(voiceEnabled, (enabled) => {
  if (enabled && !sdk.value) {
    initSDK();
  } else if (!enabled && sdk.value) {
    sdk.value.destroy();
    sdk.value = null;
  }
});

async function loadSettings() {
  try {
    const response = await fetch(
      `https://api.voiceactions.dev/api/user-voice-settings/check?user_identifier=${props.userId}`,
      {
        headers: {
          'X-API-Key': props.apiKey
        }
      }
    );
    
    const data = await response.json();
    voiceEnabled.value = data.enabled;
  } catch (error) {
    console.error('Failed to load settings:', error);
  }
}

async function handleToggle() {
  saving.value = true;
  try {
    const response = await fetch('https://api.voiceactions.dev/api/user-voice-settings', {
      method: 'PUT',
      headers: {
        'Content-Type': 'application/json',
        'X-API-Key': props.apiKey
      },
      body: JSON.stringify({
        user_identifier: props.userId,
        voice_actions_enabled: voiceEnabled.value
      })
    });
    
    const data = await response.json();
    if (!data.success) {
      // Revert on error
      voiceEnabled.value = !voiceEnabled.value;
    }
  } catch (error) {
    console.error('Failed to update settings:', error);
    voiceEnabled.value = !voiceEnabled.value;
  } finally {
    saving.value = false;
  }
}

function initSDK() {
  sdk.value = new VoiceActionsSDK({
    apiKey: props.apiKey,
    platform: 'stargate',
    locale: 'en-US',
    onCommand: handleVoiceCommand
  });
}

function handleVoiceCommand(command) {
  // Handle voice command
  console.log('Voice command:', command);
}
</script>
```

## 🔄 Flow i Komplet

1. **User hyn në Settings** të platformës (stargate.ci)
2. **Platforma kontrollon** nëse Voice Actions është aktiv për këtë user
3. **Shfaq toggle** ON/OFF në settings
4. **User toggle-on** → Platforma dërgon PUT request për të aktivizuar
5. **SDK inicializohet** automatikisht në platformë
6. **User toggle-off** → Platforma dërgon PUT request për të çaktivizuar
7. **SDK fshihet** ose fshihet nga UI

## 📝 Shënime të Rëndësishme

1. **user_identifier** mund të jetë:
   - User ID (123, "user_abc")
   - Email address
   - Çdo identifier unik që platforma përdor

2. **Platform Level Check:** Para se të kontrolloni user settings, kontrolloni nëse platforma ka Voice Actions aktiv:
   ```javascript
   // First check platform level
   const platformResponse = await fetch('/api/platforms/settings', {
     headers: { 'X-API-Key': apiKey }
   });
   const platformData = await platformResponse.json();
   
   if (!platformData.settings.voice_actions_enabled) {
     // Platform has disabled Voice Actions
     return;
   }
   
   // Then check user level
   const userResponse = await fetch(`/api/user-voice-settings/check?user_identifier=${userId}`, {
     headers: { 'X-API-Key': apiKey }
   });
   ```

3. **Caching:** Mund të cache-oni user settings për të reduktuar API calls

4. **Real-time Updates:** Nëse dëshironi real-time updates, mund të përdorni polling ose WebSockets

## 🚀 Migration

Për të aktivizuar këtë feature:

```bash
cd backend
php artisan migrate
```

Kjo do të krijojë tabelën `user_voice_settings`.

## 📞 Support

Për pyetje ose probleme:
- **Email:** support@voiceactions.io
- **Website:** https://voiceactions.dev

