# Testimi i Voice Actions SDK në Projekt tjetër (Localhost)

Ky dokument shpjegon si të testoni Voice Actions SDK në një projekt tjetër në localhost për të verifikuar që funksionon pa probleme.

## 🚀 Quick Start

### 1. Krijo një projekt test të ri

```bash
# Krijo një directory të ri për testime
mkdir voice-actions-test
cd voice-actions-test

# Krijo një HTML file të thjeshtë
cat > index.html << 'EOF'
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voice Actions SDK Test</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
        }
        .status {
            padding: 15px;
            margin: 20px 0;
            border-radius: 8px;
            background: #f0f0f0;
        }
        .status.success { background: #d4edda; color: #155724; }
        .status.error { background: #f8d7da; color: #721c24; }
        button {
            padding: 10px 20px;
            margin: 5px;
            cursor: pointer;
            border: none;
            border-radius: 5px;
            background: #667eea;
            color: white;
        }
        button:hover { background: #5568d3; }
        .log {
            background: #1e1e1e;
            color: #d4d4d4;
            padding: 15px;
            border-radius: 8px;
            font-family: monospace;
            font-size: 12px;
            max-height: 300px;
            overflow-y: auto;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h1>🎤 Voice Actions SDK Test</h1>
    
    <div id="status" class="status">Initializing...</div>
    
    <div>
        <button onclick="testCheckSettings()">Check User Settings</button>
        <button onclick="testToggleSettings()">Toggle Settings</button>
        <button onclick="testSDKStatus()">Check SDK Status</button>
        <button onclick="clearLog()">Clear Log</button>
    </div>
    
    <div id="log" class="log"></div>

    <script type="module">
        // Import SDK direkt nga local path
        import VoiceActionsSDK from '../VoiceActionsSDK/sdk/src/index.js';
        import VoiceActionsWidget from '../VoiceActionsSDK/sdk/src/widget.js';

        const userId = 'test-user-' + Date.now();
        const apiKey = 'demo-key';
        const apiUrl = 'http://localhost:8000/api';

        let sdk = null;
        let widget = null;
        let settingsEnabled = true;

        window.sdk = sdk; // Për debugging

        async function init() {
            try {
                addLog('Initializing SDK...', 'info');
                
                sdk = new VoiceActionsSDK({
                    apiKey: apiKey,
                    apiUrl: apiUrl,
                    platform: 'test',
                    userIdentifier: userId,
                    locale: 'en-US',
                    debug: true,
                    onCommand: (command) => {
                        addLog(`✅ Command: ${command.action}`, 'success');
                        console.log('Command:', command);
                    },
                    onError: (error) => {
                        addLog(`❌ Error: ${error.message}`, 'error');
                        console.error('SDK Error:', error);
                    }
                });

                addLog('SDK initialized', 'success');

                widget = new VoiceActionsWidget({
                    sdk: sdk,
                    position: 'bottom-right',
                    size: 'medium',
                    theme: 'default',
                    autoCheck: true,
                    checkInterval: 30000
                });

                addLog('Widget initialized', 'success');
                
                // Check initial settings
                const isEnabled = await sdk.checkUserEnabled();
                settingsEnabled = isEnabled;
                updateStatus(isEnabled);

                addLog(`User settings: ${isEnabled ? 'ENABLED' : 'DISABLED'}`, 'info');
            } catch (error) {
                addLog(`Failed to initialize: ${error.message}`, 'error');
                updateStatus(false, error.message);
            }
        }

        function updateStatus(enabled, error = null) {
            const status = document.getElementById('status');
            if (error) {
                status.className = 'status error';
                status.textContent = `❌ Error: ${error}`;
            } else if (enabled) {
                status.className = 'status success';
                status.textContent = '✅ Voice Actions is enabled. Microphone icon should be visible.';
            } else {
                status.className = 'status error';
                status.textContent = '❌ Voice Actions is disabled. Microphone icon will not appear.';
            }
        }

        window.testCheckSettings = async () => {
            if (!sdk) {
                addLog('SDK not initialized', 'error');
                return;
            }
            try {
                const isEnabled = await sdk.checkUserEnabled();
                addLog(`User settings check: ${isEnabled ? 'ENABLED' : 'DISABLED'}`, 'info');
                settingsEnabled = isEnabled;
                updateStatus(isEnabled);
            } catch (error) {
                addLog(`Check failed: ${error.message}`, 'error');
            }
        };

        window.testToggleSettings = async () => {
            if (!sdk) {
                addLog('SDK not initialized', 'error');
                return;
            }
            try {
                settingsEnabled = !settingsEnabled;
                addLog(`Updating settings: ${settingsEnabled ? 'ENABLED' : 'DISABLED'}`, 'info');
                
                await sdk.updateUserSettings({
                    voice_actions_enabled: settingsEnabled
                }, userId);

                addLog(`Settings updated: ${settingsEnabled ? 'ENABLED' : 'DISABLED'}`, 'success');
                updateStatus(settingsEnabled);
            } catch (error) {
                addLog(`Update failed: ${error.message}`, 'error');
            }
        };

        window.testSDKStatus = () => {
            if (!sdk) {
                addLog('SDK not initialized', 'error');
                return;
            }
            addLog(`SDK Initialized: ${sdk.isInitialized}`, 'info');
            addLog(`SDK Listening: ${sdk.isListening}`, 'info');
            addLog(`User ID: ${sdk.userIdentifier}`, 'info');
            addLog(`Commands: ${sdk.commands.length}`, 'info');
            addLog(`Platform: ${sdk.platform}`, 'info');
        };

        window.clearLog = () => {
            document.getElementById('log').innerHTML = '';
        };

        function addLog(message, type = 'info') {
            const log = document.getElementById('log');
            const entry = document.createElement('div');
            entry.style.color = type === 'error' ? '#f48771' : type === 'success' ? '#4ec9b0' : '#569cd6';
            entry.textContent = `[${new Date().toLocaleTimeString()}] ${message}`;
            log.appendChild(entry);
            log.scrollTop = log.scrollHeight;
        }

        // Initialize
        init();
    </script>
</body>
</html>
EOF
```

### 2. Start Backend (Voice Actions API)

```bash
# Në terminal tjetër
cd /Users/valonsylejmani/Projekte/VoiceActionsSDK/backend
php artisan serve
# Backend në http://localhost:8000
```

### 3. Hap test page

```bash
# Në browser, hap file direkt
open index.html
# Ose
# file:///path/to/voice-actions-test/index.html
```

## 📦 Metoda 2: Me npm install nga GitHub

### 1. Krijo projekt test me npm

```bash
mkdir voice-actions-test
cd voice-actions-test
npm init -y
```

### 2. Instalo SDK nga GitHub

```bash
npm install git+https://github.com/valon92/voice-actions-sdk-.git#main:./sdk --save
```

### 3. Krijo test file

```javascript
// test.js
import VoiceActionsSDK, { VoiceActionsWidget } from '@valon92/voice-actions-sdk';

const userId = 'test-user';
const apiKey = 'demo-key';
const apiUrl = 'http://localhost:8000/api';

const sdk = new VoiceActionsSDK({
  apiKey: apiKey,
  apiUrl: apiUrl,
  platform: 'test',
  userIdentifier: userId,
  debug: true,
  onCommand: (command) => {
    console.log('Command:', command);
  }
});

const widget = new VoiceActionsWidget({
  sdk: sdk,
  autoCheck: true
});

console.log('SDK initialized:', sdk.isInitialized);
```

### 4. Run test

```bash
node test.js
```

## 📦 Metoda 3: Me Vite/React/Vue Project

### 1. Krijo projekt

```bash
# Për Vite
npm create vite@latest voice-actions-test -- --template vanilla
cd voice-actions-test
npm install

# Instalo SDK
npm install git+https://github.com/valon92/voice-actions-sdk-.git#main:./sdk
```

### 2. Në main.js

```javascript
import VoiceActionsSDK, { VoiceActionsWidget } from '@valon92/voice-actions-sdk';

const userId = 'test-user';
const apiKey = 'demo-key';
const apiUrl = 'http://localhost:8000/api';

const sdk = new VoiceActionsSDK({
  apiKey: apiKey,
  apiUrl: apiUrl,
  platform: 'test',
  userIdentifier: userId,
  debug: true,
  onCommand: (command) => {
    console.log('Command:', command);
  }
});

const widget = new VoiceActionsWidget({
  sdk: sdk,
  autoCheck: true
});

console.log('SDK Status:', {
  initialized: sdk.isInitialized,
  listening: sdk.isListening,
  commands: sdk.commands.length
});
```

### 3. Run dev server

```bash
npm run dev
```

## 🧪 Test Checklist

### ✅ Basic Tests

- [ ] SDK inicializohet pa errors
- [ ] Widget shfaqet nëse user-i ka aktivizuar
- [ ] Widget fshihet nëse user-i ka çaktivizuar
- [ ] Voice recognition fillon kur klikohet mikrofon
- [ ] Commands ekzekutohen kur thuhen

### ✅ Settings Tests

- [ ] Toggle OFF → Widget fshihet
- [ ] Toggle ON → Widget shfaqet
- [ ] Auto-check funksionon (pris 30 sekonda)

### ✅ API Tests

- [ ] `GET /api/user-voice-settings/check` funksionon
- [ ] `PUT /api/user-voice-settings` funksionon
- [ ] `GET /api/commands/demo` funksionon

### ✅ Error Handling

- [ ] SDK handles missing API key gracefully
- [ ] SDK handles network errors gracefully
- [ ] Widget handles missing SDK gracefully

## 🔍 Debugging

### Console Logs

Kontrolloni browser console për:
- SDK initialization messages
- Widget show/hide messages
- API request/response
- Error messages

### Network Tab

Kontrolloni Network tab për:
- API requests
- Response status codes
- Response data

### Common Issues

1. **CORS Errors:**
   - Kontrolloni që backend ka CORS enabled
   - Kontrolloni `backend/config/cors.php`

2. **Import Errors:**
   - Kontrolloni që path-i i import-it është i saktë
   - Kontrolloni që files ekzistojnë

3. **API Errors:**
   - Kontrolloni që backend është running
   - Kontrolloni API key
   - Kontrolloni user identifier

## 📊 Expected Results

### Kur SDK inicializohet:
- ✅ Console: "✅ Voice Actions SDK initialized"
- ✅ Widget shfaqet (nëse user-i ka aktivizuar)
- ✅ SDK.isInitialized = true
- ✅ SDK.commands.length > 0

### Kur Widget shfaqet:
- ✅ Ikonë e mikrofonit në këndin e faqes
- ✅ Klikueshëm
- ✅ Pulse animation kur listening

### Kur Voice Recognition fillon:
- ✅ Widget pulse animation
- ✅ Console: "🎤 Listening..."
- ✅ SDK.isListening = true

## ✅ Pas Testimeve

Nëse gjithçka funksionon:
1. ✅ SDK është gati për përdorim
2. ✅ Mund të integrohet në projekte të tjera
3. ✅ Mund të publikohet në NPM

Nëse ka probleme:
1. Kontrolloni console logs
2. Kontrolloni network requests
3. Kontrolloni backend logs
4. Kontrolloni CORS settings

