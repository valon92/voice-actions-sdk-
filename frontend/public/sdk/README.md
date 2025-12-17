# Voice Actions SDK - Hosted Version

This directory contains the hosted version of Voice Actions SDK that can be used directly from `voiceactions.dev` without npm installation.

## Usage

### Basic Integration

```html
<script src="https://voiceactions.dev/sdk/voice-actions-sdk.min.js"></script>
<script>
  const sdk = new VoiceActionsSDK({
    apiKey: 'va_your-api-key-here',
    platform: 'your-platform-name',
    locale: 'en-US',
    userIdentifier: 'user123', // ⚠️ IMPORTANT: Pass user ID për user-level settings!
    onCommand: (command) => {
      console.log('Command:', command);
    }
  });
  
  // Initialize Widget (do të shfaqet vetëm nëse user ka enabled Voice Actions)
  const widget = new VoiceActionsWidget({
    sdk: sdk,
    position: 'bottom-right',
    autoCheck: true // Auto-check user settings çdo 30 sekonda
  });
  
  sdk.start();
</script>
```

### User-Level Settings Support

**✅ Hosted SDK ka të njëjtin funksionalitet si npm package!**

- ✅ User-level settings (ON/OFF toggle)
- ✅ Widget component (microphone button)
- ✅ Wake word detection
- ✅ Notifications system
- ✅ Usage tracking
- ✅ Të gjitha features të tjera

**Nuk ka ndonjë ndryshim në funksionalitet!**

## Files

- `voice-actions-sdk.min.js` - Minified production build (recommended)
- `voice-actions-sdk.min.js.map` - Source map for debugging
- `voice-actions-sdk.js` - Unminified build (for development)
- `voice-actions-sdk.js.map` - Source map for unminified build

## Documentation

See [HOSTED_SDK_GUIDE.md](../../HOSTED_SDK_GUIDE.md) for complete documentation.

## Updates

These files are automatically updated when SDK is built. To update manually:

```bash
cd sdk
npm run build
cp dist/voice-actions-sdk.min.js ../frontend/public/sdk/
cp dist/voice-actions-sdk.min.js.map ../frontend/public/sdk/
```

