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
}
```

#### `destroy()`
Destroy the SDK instance and clean up resources.

```javascript
sdk.destroy();
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

