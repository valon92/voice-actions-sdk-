# @voice-actions/sdk

**Global Voice Control SDK for Web Applications**

Multi-language voice recognition and command processing library that enables voice control for any web platform.

## 📦 Installation

```bash
npm install @valon92/voice-actions-sdk
```

Or via CDN:

```html
<script src="https://unpkg.com/@valon92/voice-actions-sdk/dist/voice-actions-sdk.min.js"></script>
```

## 🚀 Quick Start

### ES Modules

```javascript
import VoiceActionsSDK from '@valon92/voice-actions-sdk';

const sdk = new VoiceActionsSDK({
  apiKey: 'your-api-key', // Optional for demo mode
  platform: 'youtube', // or 'instagram', 'custom', etc.
  locale: 'en-US',
  onCommand: (command) => {
    console.log('Command received:', command);
    // Handle command execution
  },
  onError: (error) => {
    console.error('SDK Error:', error);
  },
  debug: true // Enable debug logging
});

// Start listening
await sdk.start();

// Stop listening
sdk.stop();

// Destroy SDK instance
sdk.destroy();
```

### UMD / Browser

```html
<script src="https://unpkg.com/@voice-actions/sdk/dist/voice-actions-sdk.min.js"></script>
<script>
  const sdk = new VoiceActionsSDK({
    apiKey: 'your-api-key',
    platform: 'youtube',
    locale: 'en-US',
    onCommand: (command) => {
      console.log('Command:', command);
    }
  });
  
  sdk.start();
</script>
```

## 📚 API

### Constructor Options

```javascript
{
  apiKey?: string;           // API key from platform registration (optional for demo)
  apiUrl?: string;           // Custom API URL (defaults to production or localhost)
  platform?: string;        // Platform name (e.g., 'youtube', 'instagram', 'custom')
  locale?: string;          // Language locale (e.g., 'en-US', 'sq-AL', 'es-ES')
  userIdentifier?: string;  // User ID for user-level settings (optional)
  onCommand?: Function;     // Callback when command is detected
  onError?: Function;       // Callback for errors
  debug?: boolean;          // Enable debug logging
}
```

### Methods

#### `start()`
Start listening for voice commands.

```javascript
await sdk.start();
```

#### `stop()`
Stop listening for voice commands.

```javascript
sdk.stop();
```

#### `setLocale(locale: string)`
Change the recognition language.

```javascript
sdk.setLocale('sq-AL');
```

#### `addCommand(command: object)`
Add a custom command.

```javascript
sdk.addCommand({
  id: 'custom-action',
  phrases: ['do something', 'perform action'],
  action: 'custom-action'
});
```

#### `removeCommand(commandId: string)`
Remove a command.

```javascript
sdk.removeCommand('custom-action');
```

#### `checkMicrophonePermission()`
Check microphone permission status.

```javascript
const permission = await sdk.checkMicrophonePermission();
if (permission.granted) {
  await sdk.start();
} else {
  console.error('Permission denied:', permission.error);
  // permission.state can be: 'granted', 'denied', 'prompt'
  // permission.canRetry indicates if user can retry
}
```

#### `requestMicrophonePermission()`
Explicitly request microphone permission with detailed error messages.

```javascript
try {
  await sdk.requestMicrophonePermission();
  await sdk.start();
} catch (error) {
  // Error message includes step-by-step instructions
  console.error(error.message);
}
```

#### `checkUserEnabled(userIdentifier?: string)`
Check if voice actions is enabled for a specific user.

```javascript
const isEnabled = await sdk.checkUserEnabled('user123');
if (isEnabled) {
  await sdk.start();
} else {
  console.log('Voice Actions is disabled for this user');
}
```

#### `getUserSettings(userIdentifier?: string)`
Get user voice settings.

```javascript
const settings = await sdk.getUserSettings('user123');
console.log(settings.voice_actions_enabled); // true or false
console.log(settings.locale); // 'en-US'
```

#### `updateUserSettings(settings, userIdentifier?: string)`
Update user voice settings.

```javascript
await sdk.updateUserSettings({
  voice_actions_enabled: true,
  locale: 'en-US'
}, 'user123');
```

#### `destroy()`
Destroy the SDK instance and clean up resources.

```javascript
sdk.destroy();
```

## 🎨 Widget Component

The SDK includes an automatic microphone icon widget that shows/hides based on user settings.

### Basic Usage

```javascript
import VoiceActionsSDK, { VoiceActionsWidget } from '@valon92/voice-actions-sdk';

const sdk = new VoiceActionsSDK({
  apiKey: 'your-api-key',
  platform: 'stargate',
  userIdentifier: 'user123'
});

const widget = new VoiceActionsWidget({
  sdk: sdk,
  position: 'bottom-right', // 'bottom-right', 'bottom-left', 'top-right', 'top-left'
  size: 'medium', // 'small', 'medium', 'large'
  theme: 'default', // 'default', 'dark', 'light'
  autoCheck: true, // Automatically check user settings
  checkInterval: 30000 // Check every 30 seconds
});
```

### Widget Options

```javascript
{
  sdk: VoiceActionsSDK,      // Required: SDK instance
  container?: HTMLElement,   // Container element (default: document.body)
  position?: string,         // Widget position (default: 'bottom-right')
  size?: string,            // Widget size (default: 'medium')
  theme?: string,           // Widget theme (default: 'default')
  autoCheck?: boolean,       // Auto-check user settings (default: true)
  checkInterval?: number    // Check interval in ms (default: 30000)
}
```

### Widget Methods

```javascript
// Show widget
widget.show();

// Hide widget
widget.hide();

// Check user settings manually
await widget.checkUserSettings();

// Destroy widget
widget.destroy();
```

### Automatic Show/Hide

The widget automatically shows/hides based on user settings:

- **User enables Voice Actions** → Widget appears automatically
- **User disables Voice Actions** → Widget disappears automatically
- **Platform disables Voice Actions** → Widget disappears automatically

### Integration Example (stargate.ci)

```javascript
// In stargate.ci settings page
const userId = getCurrentUserId();
const apiKey = 'stargate-api-key';

const sdk = new VoiceActionsSDK({
  apiKey: apiKey,
  platform: 'stargate',
  userIdentifier: userId
});

const widget = new VoiceActionsWidget({
  sdk: sdk,
  position: 'bottom-right',
  autoCheck: true // Automatically show/hide based on user settings
});

// When user toggles ON/OFF in settings
async function handleToggle(enabled) {
  await sdk.updateUserSettings({
    voice_actions_enabled: enabled
  }, userId);
  
  // Widget will automatically show/hide
  // No need to manually call widget.show() or widget.hide()
}
```

## 🌍 Supported Languages

- English (`en-US`, `en-GB`)
- Albanian (`sq-AL`)
- Spanish (`es-ES`, `es-MX`)
- French (`fr-FR`, `fr-CA`)
- And more...

## 🎯 Features

- ✅ **600+ Universal Commands** - Works across all platforms
- ✅ **Multi-language Support** - 10+ languages
- ✅ **Platform Agnostic** - Works with any web application
- ✅ **Demo Mode** - Test without API key
- ✅ **Usage Tracking** - Automatic usage statistics
- ✅ **Error Handling** - Comprehensive error messages
- ✅ **Microphone Permission** - Built-in permission handling
- ✅ **Automatic Widget** - Microphone icon that shows/hides based on user settings
- ✅ **TypeScript Support** - Full type definitions (coming soon)

## 📋 Command Structure

Commands are loaded from the API and have the following structure:

```javascript
{
  id: 'command-id',
  action: 'action-name',
  phrases: ['phrase 1', 'phrase 2', 'phrase 3'],
  category: 'category-name'
}
```

## 🔧 Platform Integration

### Example: YouTube Integration

```javascript
const sdk = new VoiceActionsSDK({
  apiKey: 'your-youtube-api-key',
  platform: 'youtube',
  locale: 'en-US',
  onCommand: (command) => {
    switch (command.action) {
      case 'play-video':
        // Your YouTube play logic
        playVideo();
        break;
      case 'pause-video':
        pauseVideo();
        break;
      case 'next-video':
        nextVideo();
        break;
      // ... handle other commands
    }
  }
});
```

## 🎨 Demo Mode

Test the SDK without an API key:

```javascript
const sdk = new VoiceActionsSDK({
  platform: 'demo', // or omit apiKey
  locale: 'en-US',
  onCommand: (command) => {
    console.log('Demo command:', command);
  }
});
```

## 🔐 API Key Registration

Get your API key by registering your platform at:
- **Development:** http://localhost:5173/register-platform
- **Production:** https://voiceactions.io/register-platform

## 📊 Usage Tracking

The SDK automatically tracks:
- Session start/end
- Commands executed
- Listening start/stop
- Errors

Usage is sent to the API for billing and analytics.

## ⚠️ Browser Support

- ✅ Chrome/Edge (Chromium) - Full support
- ✅ Safari - Full support
- ⚠️ Firefox - Limited support (Web Speech API not fully supported)
- ❌ Internet Explorer - Not supported

## 🐛 Error Handling

The SDK provides detailed error messages for:
- Microphone permission denied
- No microphone found
- Network errors
- Speech recognition errors
- API errors

## 📝 License

MIT

## 🔗 Links

- [Documentation](https://voiceactions.io/docs)
- [Integration Guide](https://voiceactions.io/docs/integration)
- [GitHub Repository](https://github.com/valon92/voice-actions-sdk-)
- [Issue Tracker](https://github.com/valon92/voice-actions-sdk-/issues)

## 🤝 Contributing

Contributions are welcome! Please read our contributing guidelines first.

## 📄 Changelog

See [CHANGELOG.md](./CHANGELOG.md) for version history.

