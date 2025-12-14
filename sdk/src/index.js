/**
 * Voice Actions SDK
 * Multi-language voice control library for web applications
 * 
 * Usage:
 * import VoiceActionsSDK from '@voice-actions/sdk'
 * 
 * const sdk = new VoiceActionsSDK({
 *   apiKey: 'your-api-key',
 *   platform: 'youtube', // or 'instagram', 'custom', etc.
 *   locale: 'en-US',
 *   onCommand: (command) => { // handle command }
 * })
 */

class VoiceActionsSDK {
  constructor(options = {}) {
    this.apiKey = options.apiKey;
    // API Version support - default to 'v1' or empty string for no version
    this.apiVersion = options.apiVersion || null; // null = no version prefix, 'v1' = /v1 prefix
    // Default to localhost for development, production URL for production
    this.apiUrl = options.apiUrl || this.detectApiUrl();
    this.platform = options.platform || 'custom';
    this.locale = options.locale || 'en-US';
    this.debug = options.debug || false;
    this.onCommand = options.onCommand || null;
    this.onError = options.onError || null;
    this.onListeningStateChange = options.onListeningStateChange || null; // Callback when listening state changes
    this.onPermissionError = options.onPermissionError || null; // Callback for permission errors
    this.userIdentifier = options.userIdentifier || null; // User ID for user-level settings
    
    // Wake word configuration
    this.wakeWords = options.wakeWords || [];
    this.wakeWordEnabled = options.wakeWordEnabled !== false; // default true if wake words provided
    
    this.commands = [];
    this.isListening = false;
    this.recognition = null;
    this.usageCount = 0;
    this.sessionId = null;
    this.isInitialized = false;
    this.wakeWordMode = false; // Wake word detection mode
    this.wakeWordDetected = false; // Track if wake word was detected
    
    this.init();
  }

  /**
   * Detect API URL automatically based on environment
   */
  detectApiUrl() {
    if (typeof window === 'undefined') {
      return 'http://localhost:8000/api';
    }

    const hostname = window.location.hostname;
    const protocol = window.location.protocol;
    const port = window.location.port;

    // Localhost detection
    if (hostname === 'localhost' || hostname === '127.0.0.1' || hostname === '0.0.0.0') {
      return port ? `${protocol}//${hostname}:${port}/api` : 'http://localhost:8000/api';
    }

    // Production - use same origin
    return `${protocol}//${hostname}${port ? `:${port}` : ''}/api`;
  }

  /**
   * Detect browser type for specific error messages
   */
  detectBrowser() {
    if (typeof navigator === 'undefined') {
      return { name: 'unknown', version: 'unknown' };
    }

    const ua = navigator.userAgent;
    let browser = { name: 'unknown', version: 'unknown' };

    if (/Chrome/.test(ua) && !/Edge/.test(ua) && !/OPR/.test(ua)) {
      browser.name = 'chrome';
      const match = ua.match(/Chrome\/(\d+)/);
      browser.version = match ? match[1] : 'unknown';
    } else if (/Safari/.test(ua) && !/Chrome/.test(ua)) {
      browser.name = 'safari';
      const match = ua.match(/Version\/(\d+)/);
      browser.version = match ? match[1] : 'unknown';
    } else if (/Firefox/.test(ua)) {
      browser.name = 'firefox';
      const match = ua.match(/Firefox\/(\d+)/);
      browser.version = match ? match[1] : 'unknown';
    } else if (/Edge/.test(ua)) {
      browser.name = 'edge';
      const match = ua.match(/Edge\/(\d+)/);
      browser.version = match ? match[1] : 'unknown';
    }

    return browser;
  }

  /**
   * Get permission instructions based on browser
   */
  getPermissionInstructions(browser) {
    const instructions = {
      chrome: '1. Click the lock (🔒) or microphone (🎤) icon in the address bar\n' +
              '2. Select "Allow" for microphone access\n' +
              '3. Refresh the page and try again\n\n' +
              'Or go to: Settings > Privacy and security > Site settings > Microphone',
      safari: '1. Click Safari in the menu bar\n' +
              '2. Go to Settings > Websites > Microphone\n' +
              '3. Select "Allow" for this website\n' +
              '4. Refresh the page and try again',
      firefox: '1. Click the lock icon in the address bar\n' +
               '2. Click "Permissions" > "Use the Microphone" > "Allow"\n' +
               '3. Refresh the page and try again\n\n' +
               'Or go to: Settings > Privacy & Security > Permissions > Microphone',
      edge: '1. Click the lock (🔒) or microphone (🎤) icon in the address bar\n' +
            '2. Select "Allow" for microphone access\n' +
            '3. Refresh the page and try again\n\n' +
            'Or go to: Settings > Privacy, search, and services > Site permissions > Microphone',
      unknown: '1. Check your browser settings for microphone permissions\n' +
               '2. Allow microphone access for this website\n' +
               '3. Refresh the page and try again'
    };

    return instructions[browser.name] || instructions.unknown;
  }

  /**
   * Initialize the SDK
   */
  async init() {
    if (!this.isSupported()) {
      this.handleError(new Error('Web Speech API not supported'));
      return;
    }

    // Always check platform-level setting first (even without userIdentifier)
    const platformEnabled = await this.checkPlatformEnabled();
    if (!platformEnabled) {
      if (this.debug) {
        console.log('⚠️ Voice Actions is disabled at platform level. SDK will not initialize.');
      }
      this.isInitialized = false;
      return;
    }

    // Check if voice actions is enabled for this user (if userIdentifier is provided)
    if (this.userIdentifier) {
      const isEnabled = await this.checkUserEnabled();
      if (!isEnabled) {
        if (this.debug) {
          console.log('⚠️ Voice Actions is disabled for this user. SDK will not initialize.');
        }
        // Don't initialize if user has disabled
        this.isInitialized = false;
        return;
      }
    }

    // Initialize speech recognition
    this.initRecognition();
    
    // Load commands from API
    await this.loadCommands();
    
    // Start usage tracking
    this.startSession();
    
    this.isInitialized = true;
    
    // Start wake word detection if Voice Control is enabled
    // This allows users to activate voice control by saying "Hey Stargate", etc.
    this.startWakeWordDetection();
    
    if (this.debug) {
      console.log('✅ Voice Actions SDK initialized', {
        platform: this.platform,
        locale: this.locale,
        commands: this.commands.length,
        userIdentifier: this.userIdentifier
      });
      console.log(`🎤 Wake word detection enabled. Say "Hey ${this.getPlatformDisplayName()}" to activate voice control.`);
    }
  }

  /**
   * Start wake word detection (passive listening)
   */
  startWakeWordDetection() {
    if (!this.recognition || !this.isInitialized) {
      return;
    }

    // Only start wake word detection if not already listening
    if (this.isListening) {
      return;
    }

    try {
      this.wakeWordMode = true;
      this.isListening = false; // Not actively listening, just detecting wake words
      
      // Start recognition in wake word mode
      this.recognition.start();
      
      if (this.debug) {
        console.log(`🎤 Wake word detection started. Listening for "Hey ${this.getPlatformDisplayName()}"...`);
      }
    } catch (error) {
      if (this.debug) {
        console.warn('⚠️ Failed to start wake word detection:', error);
      }
      this.wakeWordMode = false;
    }
  }

  /**
   * Check if voice actions is enabled at platform level
   * @returns {Promise<boolean>}
   */
  async checkPlatformEnabled() {
    if (!this.apiKey) {
      // If no API key, assume enabled (for demo mode)
      return true;
    }

    try {
      const response = await fetch(
        `${this.apiUrl}/platforms/settings`,
        {
          headers: {
            'X-API-Key': this.apiKey
          }
        }
      );

      if (!response.ok) {
        // If API fails, default to enabled
        return true;
      }

      const data = await response.json();
      return data.settings?.voice_actions_enabled === true;
    } catch (error) {
      this.log('Error checking platform settings:', error);
      // Default to enabled on error
      return true;
    }
  }

  /**
   * Check if voice actions is enabled for a specific user
   * This checks both platform-level and user-level settings
   * @param {string} userIdentifier - Optional user identifier (if not provided, uses this.userIdentifier)
   * @returns {Promise<boolean>}
   */
  async checkUserEnabled(userIdentifier = null) {
    const userId = userIdentifier || this.userIdentifier;
    
    if (!userId) {
      // If no user identifier, check only platform-level setting
      return await this.checkPlatformEnabled();
    }

    try {
      const response = await fetch(
        `${this.apiUrl}/user-voice-settings/check?user_identifier=${encodeURIComponent(userId)}`,
        {
          headers: {
            'X-API-Key': this.apiKey
          }
        }
      );

      if (!response.ok) {
        // If API fails, default to enabled
        return true;
      }

      const data = await response.json();
      return data.enabled === true;
    } catch (error) {
      this.log('Error checking user settings:', error);
      // Default to enabled on error
      return true;
    }
  }

  /**
   * Get user voice settings
   * @param {string} userIdentifier - Optional user identifier
   * @returns {Promise<Object>}
   */
  async getUserSettings(userIdentifier = null) {
    const userId = userIdentifier || this.userIdentifier;
    
    if (!userId) {
      throw new Error('User identifier is required');
    }

    try {
      const response = await fetch(
        `${this.apiUrl}/user-voice-settings?user_identifier=${encodeURIComponent(userId)}`,
        {
          headers: {
            'X-API-Key': this.apiKey
          }
        }
      );

      if (!response.ok) {
        throw new Error('Failed to fetch user settings');
      }

      const data = await response.json();
      return data.settings;
    } catch (error) {
      this.log('Error fetching user settings:', error);
      throw error;
    }
  }

  /**
   * Update user voice settings
   * @param {Object} settings - Settings to update
   * @param {boolean} settings.voice_actions_enabled - Enable/disable voice actions
   * @param {string} settings.locale - Optional locale
   * @param {string} userIdentifier - Optional user identifier
   * @returns {Promise<Object>}
   */
  async updateUserSettings(settings, userIdentifier = null) {
    const userId = userIdentifier || this.userIdentifier;
    
    if (!userId) {
      throw new Error('User identifier is required');
    }

    try {
      const response = await fetch(`${this.apiUrl}/user-voice-settings`, {
        method: 'PUT',
        headers: {
          'Content-Type': 'application/json',
          'X-API-Key': this.apiKey
        },
        body: JSON.stringify({
          user_identifier: userId,
          ...settings
        })
      });

      if (!response.ok) {
        throw new Error('Failed to update user settings');
      }

      const data = await response.json();
      
      // Update locale if changed
      if (settings.locale && settings.locale !== this.locale) {
        this.setLocale(settings.locale);
      }

      return data.settings;
    } catch (error) {
      this.log('Error updating user settings:', error);
      throw error;
    }
  }

  /**
   * Check if Web Speech API is supported
   */
  isSupported() {
    return 'webkitSpeechRecognition' in window || 'SpeechRecognition' in window;
  }

  /**
   * Initialize speech recognition
   */
  initRecognition() {
    const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
    this.recognition = new SpeechRecognition();
    this.recognition.continuous = true;
    this.recognition.interimResults = true;
    this.recognition.lang = this.locale;

    this.recognition.onresult = (event) => {
      // Get all results (both interim and final) for wake word detection
      const allResults = Array.from(event.results)
        .map(result => result[0].transcript)
        .join('')
        .toLowerCase()
        .trim();

      // Get only final results for command matching
      const finalResults = Array.from(event.results)
        .filter(result => result.isFinal)
        .map(result => result[0].transcript)
        .join('')
        .toLowerCase()
        .trim();

      if (this.debug) {
        console.log('🎤 Transcript:', allResults);
        if (finalResults) {
          console.log('🎤 Final Transcript:', finalResults);
        }
      }

      // Check for wake word if in wake word mode or not actively listening
      if (this.wakeWordMode || (!this.isListening && !this.wakeWordDetected)) {
        const wakeWordDetected = this.checkWakeWord(allResults);
        if (wakeWordDetected) {
          this.wakeWordDetected = true;
          this.wakeWordMode = false;
          
          if (this.debug) {
            console.log('✅ Wake word detected! Activating voice control...');
          }
          
          // Activate listening mode (same as clicking the microphone button)
          // This ensures the store is synchronized
          if (!this.isListening) {
            this.isListening = true;
            
            if (this.debug) {
              console.log('🎤 Voice control activated via wake word (same as clicking microphone button)');
              console.log('🎤 Calling onListeningStateChange(true)...');
            }
            
            // Notify store about listening state change
            if (this.onListeningStateChange) {
              try {
                this.onListeningStateChange(true);
                if (this.debug) {
                  console.log('✅ onListeningStateChange callback executed successfully');
                }
              } catch (error) {
                console.error('❌ Error in onListeningStateChange callback:', error);
              }
            } else {
              if (this.debug) {
                console.warn('⚠️ onListeningStateChange callback is not set');
              }
            }
            
            // Track usage
            this.trackUsage('listening_started');
          }
          
          // Ensure recognition is running
          if (this.recognition) {
            try {
              if (this.recognition.state === 'stopped' || this.recognition.state === 'inactive') {
                this.recognition.start();
              }
            } catch (e) {
              // Ignore errors - recognition might already be running
            }
          }
          
          // Extract command after wake word
          const commandText = this.extractCommandAfterWakeWord(allResults);
          if (commandText && commandText.trim()) {
            // Process command immediately
            setTimeout(() => {
              this.processCommand(commandText);
              // Reset wake word detection flag after processing
              this.wakeWordDetected = false;
            }, 300);
          } else {
            // No command after wake word, just activate listening
            if (this.debug) {
              console.log('🎤 Voice control activated. Listening for commands...');
            }
            // Continue listening for commands
            this.wakeWordDetected = false;
          }
          
          return;
        }
      }

      // If no final results yet, skip command processing
      if (!finalResults) {
        return;
      }

      // Check for command matches (only if actively listening)
      if (this.isListening && !this.wakeWordMode) {
        const matched = this.matchCommand(finalResults);
        if (matched) {
          // Reset recognition to start fresh for next command
          // This prevents transcript accumulation
          try {
            this.recognition.stop();
            // Restart after a short delay
            setTimeout(() => {
              if (this.isListening && this.recognition) {
                this.recognition.start();
              }
            }, 100);
          } catch (error) {
            // Ignore errors during stop/restart
            if (this.debug) {
              console.warn('⚠️ Error during recognition reset:', error);
            }
          }
          
          this.executeCommand(matched);
        }
      }
    };

    this.recognition.onerror = (event) => {
      // Define error types with metadata
      const errorTypes = {
        'no-speech': {
          message: 'No speech detected',
          type: 'NO_SPEECH',
          retryable: true,
          critical: false
        },
        'aborted': {
          message: 'Recognition aborted',
          type: 'ABORTED',
          retryable: true,
          critical: false
        },
        'audio-capture': {
          message: 'No microphone found. Please check your microphone connection.',
          type: 'MICROPHONE_NOT_FOUND',
          retryable: true,
          critical: true
        },
        'network': {
          message: 'Speech Recognition service is temporarily unavailable. This is usually a temporary issue with Google\'s Speech Recognition service, not your local network connection.',
          type: 'SPEECH_SERVICE_ERROR',
          retryable: true,
          critical: true
        },
        'not-allowed': {
          message: 'Microphone permission denied.',
          type: 'PERMISSION_DENIED',
          retryable: false,
          critical: true
        },
        'service-not-allowed': {
          message: 'Speech recognition service not allowed.',
          type: 'SERVICE_NOT_ALLOWED',
          retryable: false,
          critical: true
        }
      };

      const errorInfo = errorTypes[event.error] || {
        message: `Speech recognition error: ${event.error}`,
        type: 'UNKNOWN_ERROR',
        retryable: true,
        critical: true
      };

      // Skip non-critical errors
      if (!errorInfo.critical) {
        if (this.debug) {
          console.log(`ℹ️ ${errorInfo.message}`);
        }
        return;
      }

      // Handle permission errors with browser-specific instructions
      if (errorInfo.type === 'PERMISSION_DENIED' || errorInfo.type === 'SERVICE_NOT_ALLOWED') {
        const browser = this.detectBrowser();
        const instructions = this.getPermissionInstructions(browser);
        const fullMessage = `${errorInfo.message}\n\n${instructions}`;

        // Call permission error callback if provided
        if (this.onPermissionError) {
          try {
            this.onPermissionError({
              error: event.error,
              type: errorInfo.type,
              browser: browser,
              instructions: instructions,
              message: fullMessage,
              retryable: errorInfo.retryable
            });
          } catch (callbackError) {
            console.error('Error in onPermissionError callback:', callbackError);
            // Fallback to default error handling
            this.handleError(new Error(fullMessage), {
              type: errorInfo.type,
              retryable: errorInfo.retryable,
              originalError: event.error,
              browser: browser
            });
          }
        } else {
          // Default error handling with enhanced message
          this.handleError(new Error(fullMessage), {
            type: errorInfo.type,
            retryable: errorInfo.retryable,
            originalError: event.error,
            browser: browser
          });
        }

        // Stop listening on permission errors
        this.isListening = false;
      } else {
        // Handle other errors
        this.handleError(new Error(errorInfo.message), {
          type: errorInfo.type,
          retryable: errorInfo.retryable,
          originalError: event.error
        });
      }
    };

    this.recognition.onend = () => {
      // Only auto-restart if still listening and recognition is still valid
      if (this.isListening && this.recognition) {
        // Add a small delay to prevent errors
        setTimeout(() => {
          try {
            // Double-check state before restarting
            if (this.isListening && this.recognition) {
              this.recognition.start();
              if (this.debug) {
                console.log('🔄 Auto-restarted recognition');
              }
            }
          } catch (error) {
            // If restart fails, check if it's because it's already running
            if (error.name === 'InvalidStateError') {
              // Recognition is already running, which is fine
              if (this.debug) {
                console.log('ℹ️ Recognition already running');
              }
            } else {
              // Other errors - stop listening
              if (this.debug) {
                console.warn('⚠️ Failed to restart recognition:', error);
              }
              this.isListening = false;
              this.handleError(new Error('Failed to restart speech recognition'));
            }
          }
        }, 200); // Increased delay to prevent rapid restarts
      }
    };
  }

  /**
   * Load commands from API
   */
  async loadCommands() {
    // Use demo endpoint if no API key or if platform is 'demo'
    const isDemo = !this.apiKey || this.apiKey === 'demo-key' || this.platform === 'demo';
    const endpoint = isDemo ? '/commands/demo' : '/commands';

    try {
      const headers = {
        'Content-Type': 'application/json'
      };

      // Only add auth headers if not demo
      if (!isDemo && this.apiKey) {
        headers['Authorization'] = `Bearer ${this.apiKey}`;
        headers['X-API-Key'] = this.apiKey;
      }

      // Build API URL with version prefix if specified
      const versionPrefix = this.apiVersion ? `/${this.apiVersion}` : '';
      const apiUrl = `${this.apiUrl}${versionPrefix}${endpoint}?locale=${this.locale}&platform_name=${this.platform}`;

      if (this.debug) {
        console.log(`📡 Loading commands from: ${apiUrl}`);
      }

      const response = await fetch(apiUrl, {
        method: 'GET',
        headers: headers
      });

      if (response.ok) {
        const data = await response.json();
        if (data.success && data.commands) {
          this.commands = data.commands;
          if (this.debug) {
            console.log(`✅ Loaded ${this.commands.length} commands from API`);
          }
          return;
        }
      }

      // Fallback to default commands if API fails
      if (this.debug) {
        console.warn('⚠️ Failed to load commands from API, using default commands');
      }
      this.commands = this.getDefaultCommands();
    } catch (error) {
      this.handleError(error);
      // Fallback to default commands
      this.commands = this.getDefaultCommands();
    }
  }

  /**
   * Get default commands (fallback)
   */
  getDefaultCommands() {
    return [
      { id: 'scroll-down', phrases: ['scroll down', 'scroll down page'], action: 'scroll-down' },
      { id: 'scroll-up', phrases: ['scroll up', 'scroll up page'], action: 'scroll-up' },
      { id: 'click', phrases: ['click', 'tap'], action: 'click' }
    ];
  }

  /**
   * Get wake words for the current platform
   */
  getWakeWords() {
    const platformName = this.platform.toLowerCase();
    const platformDisplayName = this.getPlatformDisplayName();
    
    return [
      `hey ${platformDisplayName}`,
      `hello ${platformDisplayName}`,
      `hi ${platformDisplayName}`,
      `hiii ${platformDisplayName}`,
      `hey ${platformName}`,
      `hello ${platformName}`,
      `hi ${platformName}`,
      `hiii ${platformName}`
    ];
  }

  /**
   * Get platform display name for wake words
   */
  getPlatformDisplayName() {
    const platformMap = {
      'stargate-ci': 'stargate',
      'stargate': 'stargate',
      'instagram': 'instagram',
      'ig': 'instagram',
      'facebook': 'facebook',
      'fb': 'facebook',
      'amazon': 'amazon',
      'amz': 'amazon',
      'youtube': 'youtube',
      'yt': 'youtube'
    };
    
    const platform = this.platform.toLowerCase();
    return platformMap[platform] || platform;
  }

  /**
   * Get platform-specific colors and styling
   */
  getPlatformTheme() {
    const platform = this.platform.toLowerCase();
    
    const platformThemes = {
      'stargate-ci': {
        name: 'stargate',
        colors: {
          primary: '#6366f1', // Indigo
          secondary: '#8b5cf6', // Purple
          accent: '#a855f7', // Purple accent
          active: '#ef4444', // Red when listening
          gradient: 'linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%)',
          activeGradient: 'linear-gradient(135deg, #ef4444 0%, #dc2626 100%)',
          border: '#8b5cf6',
          hover: 'linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%)'
        }
      },
      'stargate': {
        name: 'stargate',
        colors: {
          primary: '#6366f1',
          secondary: '#8b5cf6',
          accent: '#a855f7',
          active: '#ef4444',
          gradient: 'linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%)',
          activeGradient: 'linear-gradient(135deg, #ef4444 0%, #dc2626 100%)',
          border: '#8b5cf6',
          hover: 'linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%)'
        }
      },
      'instagram': {
        name: 'instagram',
        colors: {
          primary: '#E4405F',
          secondary: '#F56040',
          accent: '#FCAF45',
          active: '#E4405F',
          gradient: 'linear-gradient(135deg, #833ab4 0%, #fd1d1d 50%, #fcb045 100%)',
          activeGradient: 'linear-gradient(135deg, #E4405F 0%, #C13584 100%)',
          border: '#E4405F',
          hover: 'linear-gradient(135deg, #C13584 0%, #E4405F 100%)'
        }
      },
      'ig': {
        name: 'instagram',
        colors: {
          primary: '#E4405F',
          secondary: '#F56040',
          accent: '#FCAF45',
          active: '#E4405F',
          gradient: 'linear-gradient(135deg, #833ab4 0%, #fd1d1d 50%, #fcb045 100%)',
          activeGradient: 'linear-gradient(135deg, #E4405F 0%, #C13584 100%)',
          border: '#E4405F',
          hover: 'linear-gradient(135deg, #C13584 0%, #E4405F 100%)'
        }
      },
      'facebook': {
        name: 'facebook',
        colors: {
          primary: '#1877F2',
          secondary: '#42A5F5',
          accent: '#1DA1F2',
          active: '#1877F2',
          gradient: 'linear-gradient(135deg, #1877F2 0%, #42A5F5 100%)',
          activeGradient: 'linear-gradient(135deg, #1877F2 0%, #1565C0 100%)',
          border: '#1877F2',
          hover: 'linear-gradient(135deg, #1565C0 0%, #1877F2 100%)'
        }
      },
      'fb': {
        name: 'facebook',
        colors: {
          primary: '#1877F2',
          secondary: '#42A5F5',
          accent: '#1DA1F2',
          active: '#1877F2',
          gradient: 'linear-gradient(135deg, #1877F2 0%, #42A5F5 100%)',
          activeGradient: 'linear-gradient(135deg, #1877F2 0%, #1565C0 100%)',
          border: '#1877F2',
          hover: 'linear-gradient(135deg, #1565C0 0%, #1877F2 100%)'
        }
      },
      'amazon': {
        name: 'amazon',
        colors: {
          primary: '#FF9900',
          secondary: '#FFB84D',
          accent: '#FFD700',
          active: '#FF9900',
          gradient: 'linear-gradient(135deg, #FF9900 0%, #FFB84D 100%)',
          activeGradient: 'linear-gradient(135deg, #FF9900 0%, #E68900 100%)',
          border: '#FF9900',
          hover: 'linear-gradient(135deg, #E68900 0%, #FF9900 100%)'
        }
      },
      'amz': {
        name: 'amazon',
        colors: {
          primary: '#FF9900',
          secondary: '#FFB84D',
          accent: '#FFD700',
          active: '#FF9900',
          gradient: 'linear-gradient(135deg, #FF9900 0%, #FFB84D 100%)',
          activeGradient: 'linear-gradient(135deg, #FF9900 0%, #E68900 100%)',
          border: '#FF9900',
          hover: 'linear-gradient(135deg, #E68900 0%, #FF9900 100%)'
        }
      },
      'youtube': {
        name: 'youtube',
        colors: {
          primary: '#FF0000',
          secondary: '#FF4444',
          accent: '#FF6666',
          active: '#FF0000',
          gradient: 'linear-gradient(135deg, #FF0000 0%, #FF4444 100%)',
          activeGradient: 'linear-gradient(135deg, #FF0000 0%, #CC0000 100%)',
          border: '#FF0000',
          hover: 'linear-gradient(135deg, #CC0000 0%, #FF0000 100%)'
        }
      },
      'yt': {
        name: 'youtube',
        colors: {
          primary: '#FF0000',
          secondary: '#FF4444',
          accent: '#FF6666',
          active: '#FF0000',
          gradient: 'linear-gradient(135deg, #FF0000 0%, #FF4444 100%)',
          activeGradient: 'linear-gradient(135deg, #FF0000 0%, #CC0000 100%)',
          border: '#FF0000',
          hover: 'linear-gradient(135deg, #CC0000 0%, #FF0000 100%)'
        }
      }
    };

    // Return platform theme or default theme
    return platformThemes[platform] || {
      name: 'default',
      colors: {
        primary: '#667eea',
        secondary: '#764ba2',
        accent: '#8b5cf6',
        active: '#ef4444',
        gradient: 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)',
        activeGradient: 'linear-gradient(135deg, #ef4444 0%, #dc2626 100%)',
        border: '#764ba2',
        hover: 'linear-gradient(135deg, #5568d3 0%, #6a3d8f 100%)'
      }
    };
  }

  /**
   * Check if wake word is detected in transcript
   */
  checkWakeWord(transcript) {
    const wakeWords = this.getWakeWords();
    const lowerTranscript = transcript.toLowerCase().trim();
    
    if (this.debug) {
      console.log(`🔍 Checking for wake words in: "${lowerTranscript}"`);
      console.log(`🔍 Wake words to check:`, wakeWords);
    }
    
    for (const wakeWord of wakeWords) {
      if (lowerTranscript.includes(wakeWord)) {
        if (this.debug) {
          console.log(`✅ Wake word detected: "${wakeWord}" in transcript: "${lowerTranscript}"`);
        }
        return true;
      }
    }
    
    if (this.debug && lowerTranscript.length > 0) {
      console.log(`❌ No wake word found in: "${lowerTranscript}"`);
    }
    
    return false;
  }

  /**
   * Extract command text after wake word
   */
  extractCommandAfterWakeWord(transcript) {
    const wakeWords = this.getWakeWords();
    const lowerTranscript = transcript.toLowerCase().trim();
    
    for (const wakeWord of wakeWords) {
      const index = lowerTranscript.indexOf(wakeWord);
      if (index !== -1) {
        // Extract text after wake word
        const commandText = transcript.substring(index + wakeWord.length).trim();
        if (commandText) {
          if (this.debug) {
            console.log(`📝 Command after wake word: "${commandText}"`);
          }
          return commandText;
        }
      }
    }
    
    return null;
  }

  /**
   * Process command text (after wake word detection)
   */
  processCommand(commandText) {
    if (!commandText || !commandText.trim()) {
      return;
    }
    
    const matched = this.matchCommand(commandText.trim());
    if (matched) {
      this.executeCommand(matched);
    } else {
      if (this.debug) {
        console.log('⚠️ No command matched:', commandText);
      }
    }
  }

  /**
   * Match transcript to command
   * Returns the most specific (longest) matching command to avoid conflicts
   */
  matchCommand(transcript) {
    let bestMatch = null;
    let longestMatch = 0;

    for (const command of this.commands) {
      for (const phrase of command.phrases || []) {
        const lowerPhrase = phrase.toLowerCase();
        // Check if phrase is in transcript (exact match or contains)
        if (transcript.includes(lowerPhrase)) {
          // Prefer longer/more specific phrases to avoid matching "go" when saying "go to profile"
          if (lowerPhrase.length > longestMatch) {
            longestMatch = lowerPhrase.length;
            bestMatch = command;
          }
        }
      }
    }
    
    return bestMatch;
  }

  /**
   * Execute a command
   */
  async executeCommand(command) {
    if (this.debug) {
      console.log('✅ Executing command:', command);
    }

    // Track usage
    this.usageCount++;
    await this.trackUsage('command_executed', {
      command_id: command.id,
      command_action: command.action
    });

    // Call user's handler
    if (this.onCommand) {
      this.onCommand(command);
    }

    // Execute platform-specific action
    this.executeAction(command.action);
  }

  /**
   * Execute platform-specific action
   * SDK vetëm ekzekuton komanda bazë universale
   * Platformat duhet të implementojnë logjikën e tyre në onCommand callback
   */
  executeAction(action) {
    // Komanda universale bazë - të gjitha komanda të tjera duhet të trajtohen në onCommand
    switch (action) {
      case 'scroll-down':
        window.scrollBy({ top: 300, behavior: 'smooth' });
        break;
      case 'scroll-up':
        window.scrollBy({ top: -300, behavior: 'smooth' });
        break;
      case 'scroll-to-top':
        window.scrollTo({ top: 0, behavior: 'smooth' });
        break;
      case 'scroll-to-bottom':
        window.scrollTo({ top: document.documentElement.scrollHeight, behavior: 'smooth' });
        break;
      case 'go-back':
        window.history.back();
        break;
      case 'go-forward':
        window.history.forward();
        break;
      case 'refresh-page':
        window.location.reload();
        break;
      case 'click':
        // Platform-specific click handler - duhet të implementohet në onCommand
        break;
      default:
        // Të gjitha komanda të tjera duhet të trajtohen në onCommand callback
        // SDK nuk e di çfarë të bëjë me komanda specifike të platformës
        if (this.debug) {
          console.log(`ℹ️ Action '${action}' duhet të trajtohet në onCommand callback`);
        }
    }
  }

  /**
   * Check microphone permission status
   */
  async checkMicrophonePermission() {
    if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
      return { granted: false, error: 'getUserMedia not supported' };
    }

    try {
      // Try to query permission status (if supported)
      if (navigator.permissions && navigator.permissions.query) {
        const result = await navigator.permissions.query({ name: 'microphone' });
        return { 
          granted: result.state === 'granted', 
          state: result.state,
          canPrompt: result.state === 'prompt'
        };
      }
      
      // If permission query is not supported, try to access microphone
      const stream = await navigator.mediaDevices.getUserMedia({ audio: true });
      // Stop the stream immediately - we just wanted to check permission
      stream.getTracks().forEach(track => track.stop());
      return { granted: true, state: 'granted' };
    } catch (error) {
      if (error.name === 'NotAllowedError' || error.name === 'PermissionDeniedError') {
        return { 
          granted: false, 
          error: 'permission_denied', 
          state: 'denied',
          message: error.message,
          canRetry: false // User must manually enable in browser settings
        };
      } else if (error.name === 'NotFoundError' || error.name === 'DevicesNotFoundError') {
        return { 
          granted: false, 
          error: 'no_microphone', 
          message: error.message,
          canRetry: true
        };
      } else {
        return { 
          granted: false, 
          error: error.name, 
          message: error.message,
          canRetry: true
        };
      }
    }
  }

  /**
   * Request microphone permission explicitly
   * Returns a promise that resolves when permission is granted
   */
  async requestMicrophonePermission() {
    if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
      throw new Error('Microphone access is not supported in this browser. Please use Chrome, Edge, or Safari.');
    }

    try {
      // Request permission
      const stream = await navigator.mediaDevices.getUserMedia({ audio: true });
      // Stop the stream immediately - we just wanted to get permission
      stream.getTracks().forEach(track => track.stop());
      return { granted: true, stream: null };
    } catch (error) {
      let errorMessage = 'Failed to access microphone. ';
      
      if (error.name === 'NotAllowedError' || error.name === 'PermissionDeniedError') {
        errorMessage = 'Microphone permission denied. ';
        errorMessage += 'To enable microphone access:\n';
        errorMessage += '1. Click the lock or microphone icon in your browser\'s address bar\n';
        errorMessage += '2. Select "Allow" for microphone access\n';
        errorMessage += '3. Refresh the page and try again\n\n';
        errorMessage += 'Alternatively, go to your browser settings:\n';
        errorMessage += '- Chrome: Settings > Privacy and security > Site settings > Microphone\n';
        errorMessage += '- Firefox: Settings > Privacy & Security > Permissions > Microphone\n';
        errorMessage += '- Safari: Safari > Settings > Websites > Microphone';
      } else if (error.name === 'NotFoundError' || error.name === 'DevicesNotFoundError') {
        errorMessage = 'No microphone found. Please connect a microphone device and try again.';
      } else if (error.name === 'NotReadableError' || error.name === 'TrackStartError') {
        errorMessage = 'Microphone is being used by another application. Please close other applications using the microphone and try again.';
      } else if (error.name === 'OverconstrainedError') {
        errorMessage = 'Microphone constraints could not be satisfied. Please check your microphone settings.';
      } else {
        errorMessage += `Error: ${error.message || error.name}`;
      }
      
      throw new Error(errorMessage);
    }
  }

  /**
   * Start listening
   */
  async start() {
    // Check if SDK is initialized
    if (!this.isInitialized) {
      // Try to re-initialize if user enabled it
      if (this.userIdentifier) {
        const isEnabled = await this.checkUserEnabled();
        if (isEnabled) {
          await this.init();
        } else {
          this.handleError(new Error('Voice Actions is disabled for this user. Please enable it in settings.'));
          return;
        }
      } else {
        this.handleError(new Error('SDK not initialized'));
        return;
      }
    }

    if (!this.recognition) {
      this.handleError(new Error('Recognition not initialized'));
      return;
    }

    if (this.isListening) {
      if (this.debug) {
        console.warn('⚠️ Already listening');
      }
      return;
    }

    try {
      // Check if browser supports speech recognition
      if (!this.isSupported()) {
        this.handleError(new Error('Web Speech API is not supported in this browser. Please use Chrome, Edge, or Safari.'));
        return;
      }

      // Request microphone permission first
      if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
        try {
          // Check permission status first
          const permissionStatus = await this.checkMicrophonePermission();
          
          // If permission is denied, provide detailed instructions
          if (!permissionStatus.granted && permissionStatus.state === 'denied') {
            const errorMessage = 'Microphone permission is denied. ' +
              'To enable microphone access:\n' +
              '1. Click the lock or microphone icon (🔒 or 🎤) in your browser\'s address bar\n' +
              '2. Select "Allow" for microphone access\n' +
              '3. Refresh the page and try again\n\n' +
              'Or go to browser settings:\n' +
              '- Chrome/Edge: Settings > Privacy and security > Site settings > Microphone\n' +
              '- Firefox: Settings > Privacy & Security > Permissions > Microphone\n' +
              '- Safari: Safari > Settings > Websites > Microphone';
            
            this.handleError(new Error(errorMessage));
            this.isListening = false;
            return;
          }
          
          // Request permission (will prompt if needed)
          const stream = await navigator.mediaDevices.getUserMedia({ audio: true });
          
          // Permission granted, stop the test stream and start recognition
          stream.getTracks().forEach(track => track.stop());
          
          // Start recognition
          this.recognition.start();
          this.isListening = true;
          this.trackUsage('listening_started');
          
          // Notify store about listening state change
          if (this.onListeningStateChange) {
            this.onListeningStateChange(true);
          }
          
          if (this.debug) {
            console.log('🎤 Started listening');
          }
        } catch (error) {
          // Handle specific permission errors with detailed messages
          let errorMessage = '';
          
          if (error.name === 'NotAllowedError' || error.name === 'PermissionDeniedError') {
            errorMessage = 'Microphone permission denied.\n\n' +
              'To enable microphone access:\n' +
              '1. Look for the lock (🔒) or microphone (🎤) icon in your browser\'s address bar\n' +
              '2. Click it and select "Allow" for microphone access\n' +
              '3. Refresh this page and try again\n\n' +
              'Browser Settings:\n' +
              '• Chrome/Edge: Settings > Privacy and security > Site settings > Microphone\n' +
              '• Firefox: Settings > Privacy & Security > Permissions > Microphone\n' +
              '• Safari: Safari > Settings > Websites > Microphone';
          } else if (error.name === 'NotFoundError' || error.name === 'DevicesNotFoundError') {
            errorMessage = 'No microphone found. Please connect a microphone device and try again.';
          } else if (error.name === 'NotReadableError' || error.name === 'TrackStartError') {
            errorMessage = 'Microphone is being used by another application. Please close other applications using the microphone and try again.';
          } else if (error.name === 'OverconstrainedError') {
            errorMessage = 'Microphone constraints could not be satisfied. Please check your microphone settings.';
          } else {
            errorMessage = `Microphone access error: ${error.message || error.name}`;
          }
          
          this.handleError(new Error(errorMessage));
          this.isListening = false;
        }
      } else {
        // Fallback for browsers without getUserMedia - try to start recognition directly
        // This will trigger browser's permission prompt
        try {
          this.recognition.start();
          this.isListening = true;
          this.trackUsage('listening_started');
          
          if (this.debug) {
            console.log('🎤 Started listening (fallback mode)');
          }
        } catch (error) {
          // Handle recognition start errors
          if (error.name === 'InvalidStateError') {
            // Recognition might already be running
            this.isListening = true;
            if (this.debug) {
              console.log('ℹ️ Recognition already running');
            }
          } else {
            this.handleError(new Error(`Failed to start speech recognition: ${error.message || error.name}`));
            this.isListening = false;
          }
        }
      }
    } catch (error) {
      // Handle specific errors
      if (error.name === 'InvalidStateError') {
        // Recognition is already running
        if (this.debug) {
          console.warn('⚠️ Recognition already running');
        }
        this.isListening = true;
      } else {
        this.handleError(error);
        this.isListening = false;
      }
    }
  }

  /**
   * Stop listening
   */
  stop() {
    if (!this.isListening && !this.wakeWordMode) {
      if (this.debug) {
        console.log('Not currently listening');
      }
      return;
    }

    if (this.recognition) {
      this.recognition.stop();
    }
    
    const wasListening = this.isListening;
    this.isListening = false;
    this.wakeWordMode = false;
    
    if (wasListening) {
      this.trackUsage('listening_stopped');
      // Notify store about listening state change
      if (this.onListeningStateChange) {
        this.onListeningStateChange(false);
      }
    }
    
    if (this.debug) {
      console.log('🛑 Stopped listening');
    }
    
    // Restart wake word detection after stopping active listening
    setTimeout(() => {
      if (this.isInitialized && !this.isListening) {
        this.startWakeWordDetection();
      }
    }, 1000);
  }

  /**
   * Set locale
   */
  setLocale(locale) {
    this.locale = locale;
    if (this.recognition) {
      this.recognition.lang = locale;
    }
    this.loadCommands(); // Reload commands for new locale
    
    if (this.debug) {
      console.log(`🌍 Locale changed to: ${locale}`);
    }
  }

  /**
   * Add custom command
   */
  addCommand(command) {
    this.commands.push(command);
    if (this.debug) {
      console.log(`➕ Command added: ${command.id} (${this.locale})`);
    }
  }

  /**
   * Remove command
   */
  removeCommand(commandId) {
    this.commands = this.commands.filter(cmd => cmd.id !== commandId);
  }

  /**
   * Start usage tracking session
   */
  startSession() {
    this.sessionId = `session_${Date.now()}_${Math.random().toString(36).substr(2, 9)}`;
    
    if (this.apiKey) {
      this.trackUsage('session_started');
    }
  }

  /**
   * Track API usage
   */
  async trackUsage(event, data = {}) {
    // Skip tracking for demo mode
    if (!this.apiKey || this.apiKey === 'demo-key' || this.platform === 'demo') {
      return;
    }

    try {
      await fetch(`${this.apiUrl}/usage/track`, {
        method: 'POST',
        headers: {
          'Authorization': `Bearer ${this.apiKey}`,
          'X-API-Key': this.apiKey,
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({
          session_id: this.sessionId,
          platform_name: this.platform,
          event: event,
          data: data,
          timestamp: new Date().toISOString()
        })
      });
    } catch (error) {
      // Silent fail for usage tracking
      if (this.debug) {
        console.warn('⚠️ Failed to track usage:', error);
      }
    }
  }

  /**
   * Handle errors
   */
  handleError(error, metadata = {}) {
    // Attach metadata to error object for better error handling
    if (metadata && Object.keys(metadata).length > 0) {
      error.metadata = metadata;
      error.type = metadata.type || 'UNKNOWN_ERROR';
      error.retryable = metadata.retryable !== undefined ? metadata.retryable : true;
    }

    if (this.onError) {
      this.onError(error);
    } else if (this.debug) {
      console.error('❌ Voice Actions SDK Error:', error);
      if (metadata && Object.keys(metadata).length > 0) {
        console.error('Error metadata:', metadata);
      }
    }
  }

  /**
   * Destroy SDK instance
   */
  destroy() {
    this.stop();
    this.recognition = null;
    this.commands = [];
    this.isListening = false;
    
    if (this.apiKey) {
      this.trackUsage('session_ended', {
        usage_count: this.usageCount
      });
    }
    
    if (this.debug) {
      console.log('💥 SDK destroyed');
    }
  }
}

// Export for different module systems
export default VoiceActionsSDK;

// Export Widget class (dynamic import to avoid circular dependencies)
export { default as VoiceActionsWidget } from './widget.js';

if (typeof window !== 'undefined') {
  window.VoiceActionsSDK = VoiceActionsSDK;
  
  // Load widget dynamically for browser
  import('./widget.js').then(module => {
    window.VoiceActionsWidget = module.default;
  });
}

