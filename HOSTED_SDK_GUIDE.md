# 🌐 Hosted SDK Guide - Përdorim pa NPM Installation

**Data:** 2025-01-14  
**Status:** ✅ **READY FOR IMPLEMENTATION**

---

## 📋 Overview

Ky guide shpjegon si të përdorësh Voice Actions SDK direkt nga faqja zyrtare (`voiceactions.dev`) pa e instaluar si npm package. Kjo është ideale për:

- **Quick integration** - Pa nevojë për build process
- **Static websites** - Faqe statike që nuk përdorin npm
- **Testing** - Testim i shpejtë pa setup
- **CDN usage** - Përdorim direkt nga CDN

---

## 🚀 Si Funksionon

### Option 1: Hosted në voiceactions.dev (Recommended)

SDK-ja do të jetë e disponueshme në:
```
https://voiceactions.dev/sdk/voice-actions-sdk.min.js
```

**Përdorim:**

```html
<!DOCTYPE html>
<html>
<head>
    <title>My Platform</title>
</head>
<body>
    <!-- Load SDK direkt nga voiceactions.dev -->
    <script src="https://voiceactions.dev/sdk/voice-actions-sdk.min.js"></script>
    
    <script>
        // Initialize SDK
        const sdk = new VoiceActionsSDK({
            apiKey: 'va_your-api-key-here', // Get from voiceactions.dev dashboard
            platform: 'your-platform-name',
            locale: 'en-US',
            onCommand: (command) => {
                console.log('Command:', command);
                // Your command handling logic
            },
            onError: (error) => {
                console.error('Error:', error);
            }
        });
        
        // Start listening
        sdk.start();
    </script>
</body>
</html>
```

### Option 2: CDN (unpkg/jsdelivr)

```html
<!-- Via unpkg -->
<script src="https://unpkg.com/@valon92/voice-actions-sdk@latest/dist/voice-actions-sdk.min.js"></script>

<!-- Via jsdelivr -->
<script src="https://cdn.jsdelivr.net/npm/@valon92/voice-actions-sdk@latest/dist/voice-actions-sdk.min.js"></script>

<!-- Or directly from voiceactions.dev -->
<script src="https://voiceactions.dev/sdk/voice-actions-sdk.min.js"></script>
```

---

## 💰 Pagesa dhe Usage Tracking

**Pagesa funksionon njësoj si me npm installation:**

### 1. Registration

1. Shkoni në `voiceactions.dev/register-platform`
2. Regjistro platformën tuaj
3. Merrni API key (`va_...`)
4. Përdorni API key në SDK initialization

### 2. Usage Tracking

**Tracking është automatik:**
- Çdo komandë që ekzekutohet dërgon request në `/api/usage/track`
- Backend ruan usage në `usage_counters` table
- Usage përditësohet në real-time

### 3. Billing

**Billing model:**
- **Free Plan:** 9,999 komanda/muaj (falas)
- **Pro Plan:** $99/muaj + $0.01 për komandë mbi 999,999
- **Enterprise:** Custom pricing

**Usage limits:**
- Free plan: Nëse arrihet limit → **Blocked** (kërkon upgrade)
- Pro plan: Nëse arrihet limit → **Allowed** (overage charges)

### 4. Dashboard

- Shkoni në `voiceactions.dev/platform/dashboard`
- Shihni usage aktual
- Shihni billing estimate
- Manage subscription

---

## 🔧 Implementation Steps

### Step 1: Host SDK Files

**Në `frontend/public/sdk/`:**

```bash
# Copy SDK files në public directory
cp sdk/dist/voice-actions-sdk.min.js frontend/public/sdk/
cp sdk/dist/voice-actions-sdk.min.js.map frontend/public/sdk/
```

### Step 2: Create CDN Endpoint (Optional)

**Në backend, krijo route për CDN:**

```php
// routes/web.php
Route::get('/sdk/{file}', function ($file) {
    $path = public_path("sdk/{$file}");
    if (file_exists($path)) {
        return response()->file($path, [
            'Content-Type' => 'application/javascript',
            'Cache-Control' => 'public, max-age=31536000', // 1 year cache
        ]);
    }
    return response()->json(['error' => 'File not found'], 404);
});
```

### Step 3: Update Documentation

- Update README.md me hosted option
- Krijo integration examples
- Update website me hosted SDK info

---

## 📊 Comparison: NPM vs Hosted

| Feature | NPM Installation | Hosted SDK |
|---------|------------------|------------|
| **Setup** | `npm install` + build | Just `<script>` tag |
| **File Size** | Optimized | Same (minified) |
| **Updates** | Manual (`npm update`) | Automatic (latest version) |
| **Caching** | Browser cache | CDN cache |
| **Usage Tracking** | ✅ Same | ✅ Same |
| **Billing** | ✅ Same | ✅ Same |
| **API Key** | ✅ Required | ✅ Required |
| **Dashboard** | ✅ Same | ✅ Same |

---

## 🎯 Best Practices

### 1. Use Latest Version

```html
<!-- Always use latest -->
<script src="https://voiceactions.dev/sdk/voice-actions-sdk.min.js"></script>

<!-- Or specific version -->
<script src="https://voiceactions.dev/sdk/v1.2.0/voice-actions-sdk.min.js"></script>
```

### 2. Error Handling

```javascript
// Check if SDK loaded
if (typeof VoiceActionsSDK === 'undefined') {
    console.error('SDK failed to load. Check network connection.');
    return;
}

// Initialize with error handling
try {
    const sdk = new VoiceActionsSDK({
        apiKey: 'va_...',
        platform: 'your-platform',
        onError: (error) => {
            console.error('SDK Error:', error);
            // Handle error (show notification, etc.)
        }
    });
} catch (error) {
    console.error('Failed to initialize SDK:', error);
}
```

### 3. API Key Security

**⚠️ IMPORTANT:** Never expose API key në client-side code për production!

**Option 1: Environment Variable (Recommended)**
```javascript
const sdk = new VoiceActionsSDK({
    apiKey: process.env.VOICE_ACTIONS_API_KEY, // Server-side only
    // ...
});
```

**Option 2: Backend Proxy**
```javascript
// Client requests your backend
// Backend adds API key dhe forwards to Voice Actions API
```

**Option 3: Public API Key (Demo/Testing Only)**
```javascript
// Only for demo/testing
const sdk = new VoiceActionsSDK({
    apiKey: 'va_demo_key', // Public demo key
    // ...
});
```

---

## 📝 Complete Example

```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Platform with Voice Actions</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
        }
        .voice-button {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }
        .voice-button.listening {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }
    </style>
</head>
<body>
    <h1>My Platform</h1>
    <p>Say "scroll down" or "scroll up" to test voice commands!</p>
    
    <!-- Voice Button -->
    <button class="voice-button" id="voiceBtn" title="Voice Control">
        🎤
    </button>

    <!-- Load SDK from voiceactions.dev -->
    <script src="https://voiceactions.dev/sdk/voice-actions-sdk.min.js"></script>
    
    <script>
        // Initialize SDK
        let sdk = null;
        let isListening = false;
        
        // Replace with your API key from voiceactions.dev dashboard
        const API_KEY = 'va_your-api-key-here';
        
        // Initialize SDK
        if (typeof VoiceActionsSDK !== 'undefined') {
            sdk = new VoiceActionsSDK({
                apiKey: API_KEY,
                platform: 'my-platform', // Your platform name
                locale: 'en-US',
                onCommand: (command) => {
                    console.log('Command received:', command);
                    
                    // Handle commands
                    switch(command.action) {
                        case 'scroll-down':
                            window.scrollBy({ top: 300, behavior: 'smooth' });
                            break;
                        case 'scroll-up':
                            window.scrollBy({ top: -300, behavior: 'smooth' });
                            break;
                        // Add more command handlers
                    }
                },
                onError: (error) => {
                    console.error('SDK Error:', error);
                    alert('Voice control error: ' + error.message);
                }
            });
            
            console.log('✅ Voice Actions SDK initialized');
        } else {
            console.error('❌ SDK failed to load');
        }
        
        // Toggle listening
        document.getElementById('voiceBtn').addEventListener('click', () => {
            if (!sdk) {
                alert('SDK not loaded. Please check your connection.');
                return;
            }
            
            if (isListening) {
                sdk.stop();
                isListening = false;
                document.getElementById('voiceBtn').classList.remove('listening');
            } else {
                sdk.start();
                isListening = true;
                document.getElementById('voiceBtn').classList.add('listening');
            }
        });
    </script>
</body>
</html>
```

---

## 🔐 Security Considerations

1. **API Key Protection:**
   - Never commit API keys në Git
   - Use environment variables
   - Rotate keys periodically

2. **HTTPS Only:**
   - Always use HTTPS për production
   - SDK requires secure context për microphone access

3. **CORS:**
   - Configure CORS në backend për allowed origins
   - Only allow trusted domains

---

## 📊 Usage & Billing Dashboard

**Access dashboard:**
- URL: `voiceactions.dev/platform/dashboard`
- Login me API key
- View usage statistics
- View billing information
- Manage subscription

**Features:**
- Real-time usage tracking
- Billing estimates
- Usage history
- Invoice downloads
- Subscription management

---

## 🚀 Next Steps

1. **Host SDK Files:**
   - Copy `sdk/dist/voice-actions-sdk.min.js` në `frontend/public/sdk/`
   - Configure CDN endpoint (optional)

2. **Update Website:**
   - Add hosted SDK info në website
   - Create integration examples
   - Update documentation

3. **Test:**
   - Test hosted SDK loading
   - Test usage tracking
   - Test billing calculation

---

**Status:** ✅ **READY FOR IMPLEMENTATION**

**Note:** Pagesa dhe usage tracking funksionojnë **njësoj** si me npm installation. Vetëm mënyra e loading-ut është e ndryshme.

