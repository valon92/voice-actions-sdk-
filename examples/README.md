# Voice Actions SDK - Integration Examples

This directory contains practical examples of how to integrate the Voice Actions SDK into your platform.

## Files

- `integration-example.html` - Complete standalone example showing:
  - How to load the SDK
  - How to create a voice control button
  - How to handle voice commands
  - How to display command history
  - Visual feedback and animations

## Quick Start

### Option 1: Using the Built SDK

1. Build the SDK first:
```bash
cd sdk
npm run build
```

2. Open `integration-example.html` in your browser
3. Replace `'your-api-key-here'` with your actual API key from the platform dashboard

### Option 2: Using CDN (Production)

Replace the SDK script tag with:
```html
<script src="https://cdn.jsdelivr.net/npm/@voice-actions/sdk@latest/dist/voice-actions-sdk.js"></script>
```

## Integration Steps

### 1. Include the SDK

```html
<!-- Local build -->
<script src="../sdk/dist/voice-actions-sdk.js"></script>

<!-- Or CDN -->
<script src="https://cdn.jsdelivr.net/npm/@voice-actions/sdk@latest/dist/voice-actions-sdk.js"></script>
```

### 2. Initialize the SDK

```javascript
const voiceSDK = new VoiceActionsSDK({
    apiKey: 'your-api-key-here',
    platform: 'your-platform-name',
    locale: 'en-US',
    debug: true,
    onCommand: handleVoiceCommand,
    onError: handleVoiceError
});
```

### 3. Create Voice Button UI

```html
<button class="voice-button" id="voiceButton">
    <svg><!-- Microphone icon --></svg>
</button>
```

### 4. Handle Commands

```javascript
function handleVoiceCommand(command) {
    // Execute your platform-specific logic
    switch (command.action) {
        case 'scroll-down':
            window.scrollBy({ top: 300, behavior: 'smooth' });
            break;
        case 'like':
            // Your like logic
            break;
        // ... more commands
    }
}
```

### 5. Toggle Listening

```javascript
voiceButton.addEventListener('click', () => {
    if (isListening) {
        voiceSDK.stop();
    } else {
        voiceSDK.start();
    }
});
```

## Voice Button Design

The example includes a modern voice button with:

- **Fixed position** (bottom-right corner)
- **Circular design** with gradient background
- **Pulse animation** when listening
- **Ripple effect** for visual feedback
- **Status indicator** showing current state
- **Hover effects** for better UX

## Customization

### Change Button Position

```css
.voice-control-container {
    bottom: 30px;  /* Change vertical position */
    right: 30px;   /* Change horizontal position */
}
```

### Change Button Colors

```css
.voice-button {
    background: linear-gradient(135deg, #your-color-1, #your-color-2);
}

.voice-button.listening {
    background: linear-gradient(135deg, #listening-color-1, #listening-color-2);
}
```

### Change Button Size

```css
.voice-button {
    width: 70px;   /* Change size */
    height: 70px;
}
```

## Platform-Specific Integration

### React Example

```jsx
import { useState, useEffect } from 'react';
import VoiceActionsSDK from '@voice-actions/sdk';

function VoiceButton() {
    const [isListening, setIsListening] = useState(false);
    const [sdk, setSdk] = useState(null);

    useEffect(() => {
        const voiceSDK = new VoiceActionsSDK({
            apiKey: 'your-api-key',
            platform: 'your-platform',
            locale: 'en-US',
            onCommand: (command) => {
                // Handle command
                console.log('Command:', command);
            },
            onError: (error) => {
                console.error('Error:', error);
            }
        });
        setSdk(voiceSDK);

        return () => {
            voiceSDK.destroy();
        };
    }, []);

    const toggleListening = () => {
        if (isListening) {
            sdk.stop();
        } else {
            sdk.start();
        }
        setIsListening(!isListening);
    };

    return (
        <button 
            className={`voice-button ${isListening ? 'listening' : ''}`}
            onClick={toggleListening}
        >
            🎤
        </button>
    );
}
```

### Vue.js Example

```vue
<template>
    <button 
        :class="['voice-button', { listening: isListening }]"
        @click="toggleListening"
    >
        🎤
    </button>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import VoiceActionsSDK from '@voice-actions/sdk';

const isListening = ref(false);
let sdk = null;

onMounted(() => {
    sdk = new VoiceActionsSDK({
        apiKey: 'your-api-key',
        platform: 'your-platform',
        locale: 'en-US',
        onCommand: (command) => {
            console.log('Command:', command);
        },
        onError: (error) => {
            console.error('Error:', error);
        }
    });
});

onUnmounted(() => {
    if (sdk) {
        sdk.destroy();
    }
});

const toggleListening = () => {
    if (isListening.value) {
        sdk.stop();
    } else {
        sdk.start();
    }
    isListening.value = !isListening.value;
};
</script>
```

## Best Practices

1. **Request permission gracefully** - Show clear instructions when microphone permission is needed
2. **Provide visual feedback** - Use animations and status indicators
3. **Handle errors gracefully** - Show user-friendly error messages
4. **Test on different browsers** - Chrome, Edge, and Safari support Web Speech API
5. **Optimize for mobile** - Ensure button is accessible on touch devices
6. **Respect user privacy** - Only request microphone access when needed

## Support

For more information, visit:
- Documentation: `/docs/integration`
- Demo: `/demo`
- Platform Dashboard: `/platform/dashboard`

