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
    // Default to localhost for development, production URL for production
    this.apiUrl = options.apiUrl || (typeof window !== 'undefined' && window.location.hostname === 'localhost' 
      ? 'http://localhost:8000/api' 
      : 'https://api.voiceactions.dev/api');
    this.platform = options.platform || 'custom';
    this.locale = options.locale || 'en-US';
    this.debug = options.debug || false;
    this.onCommand = options.onCommand || null;
    this.onError = options.onError || null;
    this.userIdentifier = options.userIdentifier || null; // User ID for user-level settings
    
    this.commands = [];
    this.isListening = false;
    this.recognition = null;
    this.usageCount = 0;
    this.sessionId = null;
    this.isInitialized = false;
    
    this.init();
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
    
    if (this.debug) {
      console.log('✅ Voice Actions SDK initialized', {
        platform: this.platform,
        locale: this.locale,
        commands: this.commands.length,
        userIdentifier: this.userIdentifier
      });
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
      // Get only final results (not interim) to avoid duplicate commands
      const finalResults = Array.from(event.results)
        .filter(result => result.isFinal)
        .map(result => result[0].transcript)
        .join('')
        .toLowerCase()
        .trim();

      // If no final results yet, skip
      if (!finalResults) {
        return;
      }

      if (this.debug) {
        console.log('🎤 Final Transcript:', finalResults);
      }

      // Check for command matches
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
    };

    this.recognition.onerror = (event) => {
      // Handle specific error types
      let errorMessage = `Speech recognition error: ${event.error}`;
      
      switch (event.error) {
        case 'no-speech':
          // No speech detected - this is normal, don't treat as error
          if (this.debug) {
            console.log('ℹ️ No speech detected');
          }
          return;
        case 'aborted':
          // Recognition was aborted - this is normal when stopping
          if (this.debug) {
            console.log('ℹ️ Recognition aborted');
          }
          return;
        case 'audio-capture':
          errorMessage = 'No microphone found. Please check your microphone connection.';
          break;
        case 'network':
          errorMessage = 'Network error. Please check your internet connection.';
          break;
        case 'not-allowed':
          errorMessage = 'Microphone permission denied.\n\n' +
            'To enable microphone access:\n' +
            '1. Click the lock (🔒) or microphone (🎤) icon in your browser\'s address bar\n' +
            '2. Select "Allow" for microphone access\n' +
            '3. Refresh the page and try again';
          break;
        case 'service-not-allowed':
          errorMessage = 'Speech recognition service not allowed.\n\n' +
            'Please check your browser settings and enable speech recognition services.';
          break;
        default:
          errorMessage = `Speech recognition error: ${event.error}`;
      }
      
      // Only show error for critical issues
      if (event.error !== 'no-speech' && event.error !== 'aborted') {
        this.handleError(new Error(errorMessage));
        
        // If it's a permission error, stop listening
        if (event.error === 'not-allowed' || event.error === 'service-not-allowed') {
          this.isListening = false;
        }
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

      const response = await fetch(`${this.apiUrl}${endpoint}?locale=${this.locale}&platform_name=${this.platform}`, {
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
    if (!this.isListening) {
      if (this.debug) {
        console.log('Not currently listening');
      }
      return;
    }

    if (this.recognition) {
      this.recognition.stop();
    }
    
    this.isListening = false;
    this.trackUsage('listening_stopped');
    
    if (this.debug) {
      console.log('🛑 Stopped listening');
    }
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
  handleError(error) {
    if (this.onError) {
      this.onError(error);
    } else if (this.debug) {
      console.error('❌ Voice Actions SDK Error:', error);
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

