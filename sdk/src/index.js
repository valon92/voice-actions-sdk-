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
      : 'https://api.voiceactions.io');
    this.platform = options.platform || 'custom';
    this.locale = options.locale || 'en-US';
    this.debug = options.debug || false;
    this.onCommand = options.onCommand || null;
    this.onError = options.onError || null;
    
    this.commands = [];
    this.isListening = false;
    this.recognition = null;
    this.usageCount = 0;
    this.sessionId = null;
    
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

    // Initialize speech recognition
    this.initRecognition();
    
    // Load commands from API
    await this.loadCommands();
    
    // Start usage tracking
    this.startSession();
    
    if (this.debug) {
      console.log('✅ Voice Actions SDK initialized', {
        platform: this.platform,
        locale: this.locale,
        commands: this.commands.length
      });
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
      const transcript = Array.from(event.results)
        .map(result => result[0].transcript)
        .join('')
        .toLowerCase()
        .trim();

      if (this.debug) {
        console.log('🎤 Transcript:', transcript);
      }

      // Check for command matches
      const matched = this.matchCommand(transcript);
      if (matched) {
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
          errorMessage = 'Microphone permission denied. Please allow microphone access in your browser settings.';
          break;
        case 'service-not-allowed':
          errorMessage = 'Speech recognition service not allowed. Please check your browser settings.';
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
   */
  matchCommand(transcript) {
    for (const command of this.commands) {
      for (const phrase of command.phrases || []) {
        if (transcript.includes(phrase.toLowerCase())) {
          return command;
        }
      }
    }
    return null;
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
    // Vetëm komanda universale bazë - të gjitha komanda të tjera duhet të trajtohen në onCommand
    switch (action) {
      case 'scroll-down':
        window.scrollBy({ top: 300, behavior: 'smooth' });
        break;
      case 'scroll-up':
        window.scrollBy({ top: -300, behavior: 'smooth' });
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
   * Start listening
   */
  start() {
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
        this.handleError(new Error('Web Speech API is not supported in this browser'));
        return;
      }

      // Request microphone permission first
      if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
        navigator.mediaDevices.getUserMedia({ audio: true })
          .then(() => {
            // Permission granted, start recognition
            this.recognition.start();
            this.isListening = true;
            this.trackUsage('listening_started');
            
            if (this.debug) {
              console.log('🎤 Started listening');
            }
          })
          .catch((error) => {
            this.handleError(new Error('Microphone permission denied. Please allow microphone access.'));
          });
      } else {
        // Fallback for browsers without getUserMedia
        this.recognition.start();
        this.isListening = true;
        this.trackUsage('listening_started');
        
        if (this.debug) {
          console.log('🎤 Started listening');
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

if (typeof window !== 'undefined') {
  window.VoiceActionsSDK = VoiceActionsSDK;
}

