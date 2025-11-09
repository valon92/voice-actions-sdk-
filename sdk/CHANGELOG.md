# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [1.0.0] - 2025-01-08

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

