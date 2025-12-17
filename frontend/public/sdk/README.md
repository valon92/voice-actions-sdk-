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
    onCommand: (command) => {
      console.log('Command:', command);
    }
  });
  
  sdk.start();
</script>
```

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

