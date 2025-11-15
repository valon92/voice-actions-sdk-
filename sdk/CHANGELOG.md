# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [1.2.0] - 2025-12-15

### Added
- **User-level Voice Settings** - Users can now enable/disable Voice Actions in their platform settings
- **Automatic Widget Component** - Microphone icon widget that automatically shows/hides based on user settings
- **User Settings API** - New methods: `checkUserEnabled()`, `getUserSettings()`, `updateUserSettings()`
- **Widget Auto-Check** - Widget automatically checks user settings every 30 seconds
- **Platform Integration Guide** - Complete documentation for integrating user settings in platforms

### Features
- `VoiceActionsWidget` class for automatic microphone icon widget
- Widget automatically appears when user enables Voice Actions
- Widget automatically disappears when user disables Voice Actions
- Customizable widget position, size, and theme
- Click widget to start/stop voice recognition
- Real-time settings synchronization

### API Changes
- Added `userIdentifier` option to SDK constructor
- Added `checkUserEnabled(userIdentifier)` method
- Added `getUserSettings(userIdentifier)` method
- Added `updateUserSettings(settings, userIdentifier)` method
- SDK automatically checks user settings during initialization if `userIdentifier` is provided

### Documentation
- Added `USER_VOICE_SETTINGS_GUIDE.md` - Complete guide for user-level settings
- Added `WIDGET_INTEGRATION_GUIDE.md` - Widget integration examples
- Updated README with widget documentation
- Added widget example HTML file

## [1.1.0] - 2025-01-08

### Added
- Initial release of Voice Actions SDK
- Multi-language voice recognition support (English, Albanian, Spanish, French)
- 600+ universal voice commands
- Platform-agnostic command system
- Demo mode (works without API key)
- Usage tracking and analytics
- Microphone permission handling
- Comprehensive error handling
- UMD and ES module builds
- Source maps for debugging
- Browser compatibility (Chrome, Edge, Safari)

### Features
- `start()` - Start listening for voice commands
- `stop()` - Stop listening
- `setLocale()` - Change recognition language
- `addCommand()` - Add custom commands
- `removeCommand()` - Remove commands
- `checkMicrophonePermission()` - Check microphone access
- `destroy()` - Clean up SDK instance

### Supported Platforms
- Social Media (Facebook, Instagram, TikTok, X, Snapchat, LinkedIn)
- E-Commerce (Amazon, eBay, Shopify)
- Gaming (Steam, Epic, Xbox, PlayStation)
- Technology (Windows, macOS, Android, iOS, AWS, GitHub)
- Education (Coursera, Udemy, Khan Academy)
- Communication (Slack, Discord, Teams, Zoom)
- Development (GitHub, GitLab, Vercel, Netlify)
- AI Platforms (ChatGPT, Gemini, Claude, Midjourney)

## [1.1.0] - 2025-01-29

### Added
- Added 40+ Stargate.ci platform-specific commands
- Navigation commands: navigate-home, navigate-about, navigate-events, navigate-news, navigate-faq, navigate-contact, navigate-subscribe, navigate-search, navigate-disclaimer, navigate-signin, navigate-signup
- Enhanced scroll commands: scroll-to-top, scroll-to-bottom
- Video interactions: like-video, comment-video, share-video, play-video, pause-video
- News interactions: like-article, read-article, share-article
- Event interactions: register-event, view-event-details
- Search commands: open-search, clear-search
- UI controls: close-modal, open-menu, close-menu, toggle-theme
- Subscription: subscribe, unsubscribe
- Account management: logout, view-profile
- Browser navigation: go-back, go-forward, refresh-page
- Content actions: expand-content, collapse-content
- Filter & sort: filter-events, sort-content
- Form actions: submit-form, clear-form
- Multi-language support for all Stargate.ci commands (English, Albanian, Spanish, French)

### Improved
- SDK now handles browser navigation actions (back, forward, refresh) directly
- Enhanced scroll functionality with scroll-to-top and scroll-to-bottom

## [1.0.2] - 2025-01-08

### Improved
- Enhanced microphone permission handling with detailed error messages
- Added `requestMicrophonePermission()` method for explicit permission requests
- Improved `checkMicrophonePermission()` to return more detailed status information
- Better error messages with step-by-step instructions for enabling microphone access
- Added browser-specific instructions (Chrome, Firefox, Safari, Edge)
- Improved permission state detection (granted, denied, prompt)
- Better handling of permission denied state with clear user guidance

### Fixed
- Permission errors now provide actionable instructions instead of generic messages
- Fixed permission check to detect denied state before attempting to start recognition

## [1.0.1] - 2025-01-08

### Fixed
- Fixed `@rollup/plugin-terser` version constraint (changed from ^2.0.0 to ^0.4.4)
- Updated devDependencies to use correct package versions

## [Unreleased]

### Planned
- TypeScript type definitions
- Additional language support
- Command suggestions
- Voice feedback
- Offline mode
- React/Vue/Angular wrappers

