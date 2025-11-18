/**
 * Voice Actions SDK Widget
 * Automatic microphone icon widget that shows/hides based on user settings
 */

class VoiceActionsWidget {
  constructor(options = {}) {
    this.sdk = options.sdk;
    this.container = options.container || document.body;
    this.position = options.position || 'bottom-right'; // 'bottom-right', 'bottom-left', 'top-right', 'top-left'
    this.size = options.size || 'medium'; // 'small', 'medium', 'large'
    this.theme = options.theme || 'default'; // 'default', 'dark', 'light'
    this.autoCheck = options.autoCheck !== false; // Auto-check user settings
    this.checkInterval = options.checkInterval || 30000; // Check every 30 seconds
    
    this.widget = null;
    this.isVisible = false;
    this.checkIntervalId = null;
    
    this.init();
  }

  async init() {
    // Always check platform-level setting first
    if (this.sdk) {
      const platformEnabled = await this.sdk.checkPlatformEnabled();
      if (!platformEnabled) {
        // Platform has disabled, don't show widget
        if (this.sdk.debug) {
          console.log('⚠️ Voice Actions disabled at platform level. Widget will not be shown.');
        }
        this.isVisible = false;
        return;
      }
    }

    // Check user settings if userIdentifier is provided
    if (this.sdk && this.sdk.userIdentifier) {
      const isEnabled = await this.sdk.checkUserEnabled();
      if (!isEnabled) {
        // User has disabled, don't show widget
        if (this.sdk.debug) {
          console.log('⚠️ Voice Actions disabled for user. Widget will not be shown.');
        }
        this.isVisible = false;
        return;
      }
    }

    // Check if SDK is initialized
    if (this.sdk && !this.sdk.isInitialized) {
      // Try to initialize SDK
      await this.sdk.init();
      
      // Check again if initialization was successful
      if (!this.sdk.isInitialized) {
        if (this.sdk.debug) {
          console.log('⚠️ SDK not initialized. Widget will not be shown.');
        }
        this.isVisible = false;
        return;
      }
    }

    this.createWidget();
    this.attachEventListeners();
    
    if (this.autoCheck) {
      this.startAutoCheck();
    }
  }

  createWidget() {
    // Remove existing widget if any
    this.destroy();

    this.widget = document.createElement('div');
    this.widget.id = 'voice-actions-widget';
    this.widget.className = `voice-actions-widget voice-actions-widget-${this.position} voice-actions-widget-${this.size} voice-actions-widget-${this.theme}`;
    
    // Widget styles
    const styles = {
      position: 'fixed',
      zIndex: '9999',
      cursor: 'pointer',
      transition: 'all 0.3s ease',
      display: 'flex',
      alignItems: 'center',
      justifyContent: 'center',
      borderRadius: '50%',
      boxShadow: '0 4px 12px rgba(0, 0, 0, 0.15)',
      background: this.getBackgroundColor(),
      border: 'none',
      outline: 'none',
    };

    // Position styles
    const positionStyles = this.getPositionStyles();
    Object.assign(styles, positionStyles);

    // Size styles
    const sizeStyles = this.getSizeStyles();
    Object.assign(styles, sizeStyles);

    // Apply styles
    Object.assign(this.widget.style, styles);

    // Microphone icon
    const icon = document.createElement('div');
    icon.innerHTML = '🎤';
    icon.style.fontSize = this.getIconSize();
    icon.style.userSelect = 'none';
    icon.style.pointerEvents = 'none';
    
    this.widget.appendChild(icon);

    // Add to container
    this.container.appendChild(this.widget);
    this.isVisible = true;

    // Add hover effect
    this.widget.addEventListener('mouseenter', () => {
      this.widget.style.transform = 'scale(1.1)';
      this.widget.style.boxShadow = '0 6px 16px rgba(0, 0, 0, 0.2)';
    });

    this.widget.addEventListener('mouseleave', () => {
      this.widget.style.transform = 'scale(1)';
      this.widget.style.boxShadow = '0 4px 12px rgba(0, 0, 0, 0.15)';
    });
  }

  getPositionStyles() {
    const margin = '20px';
    switch (this.position) {
      case 'bottom-right':
        return { bottom: margin, right: margin };
      case 'bottom-left':
        return { bottom: margin, left: margin };
      case 'top-right':
        return { top: margin, right: margin };
      case 'top-left':
        return { top: margin, left: margin };
      default:
        return { bottom: margin, right: margin };
    }
  }

  getSizeStyles() {
    switch (this.size) {
      case 'small':
        return { width: '48px', height: '48px' };
      case 'medium':
        return { width: '64px', height: '64px' };
      case 'large':
        return { width: '80px', height: '80px' };
      default:
        return { width: '64px', height: '64px' };
    }
  }

  getIconSize() {
    switch (this.size) {
      case 'small':
        return '24px';
      case 'medium':
        return '32px';
      case 'large':
        return '40px';
      default:
        return '32px';
    }
  }

  getBackgroundColor() {
    switch (this.theme) {
      case 'dark':
        return 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)';
      case 'light':
        return 'linear-gradient(135deg, #f093fb 0%, #f5576c 100%)';
      default:
        return 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)';
    }
  }

  attachEventListeners() {
    if (!this.widget || !this.sdk) return;

    this.widget.addEventListener('click', async () => {
      // Check if user has enabled voice actions before starting
      if (this.sdk.userIdentifier) {
        const isEnabled = await this.sdk.checkUserEnabled();
        if (!isEnabled) {
          alert('Voice Actions is disabled. Please enable it in your settings.');
          return;
        }
      }

      // Ensure SDK is initialized
      if (!this.sdk.isInitialized) {
        await this.sdk.init();
        if (!this.sdk.isInitialized) {
          alert('Voice Actions is not available. Please check your settings.');
          return;
        }
      }

      if (!this.sdk.isListening) {
        try {
          await this.sdk.start();
          this.updateWidgetState(true);
        } catch (error) {
          console.error('Failed to start voice recognition:', error);
          alert('Failed to start voice recognition: ' + error.message);
        }
      } else {
        this.sdk.stop();
        this.updateWidgetState(false);
      }
    });

    // Listen to SDK state changes
    if (this.sdk) {
      // Monitor SDK listening state
      const checkListening = () => {
        if (this.sdk && this.sdk.isListening !== this.isListening) {
          this.updateWidgetState(this.sdk.isListening);
        }
      };
      
      setInterval(checkListening, 500);
    }
  }

  updateWidgetState(isListening) {
    if (!this.widget) return;
    
    this.isListening = isListening;
    
    if (isListening) {
      this.widget.style.background = 'linear-gradient(135deg, #f093fb 0%, #f5576c 100%)';
      this.widget.style.animation = 'pulse 2s infinite';
      
      // Add pulse animation if not exists
      if (!document.getElementById('voice-actions-widget-styles')) {
        const style = document.createElement('style');
        style.id = 'voice-actions-widget-styles';
        style.textContent = `
          @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
          }
        `;
        document.head.appendChild(style);
      }
    } else {
      this.widget.style.background = this.getBackgroundColor();
      this.widget.style.animation = 'none';
    }
  }

  async startAutoCheck() {
    if (!this.sdk) return;

    // Check immediately
    await this.checkUserSettings();

    // Then check periodically
    this.checkIntervalId = setInterval(async () => {
      await this.checkUserSettings();
    }, this.checkInterval);
  }

  async checkUserSettings() {
    if (!this.sdk) return;

    try {
      // First check platform-level setting
      const platformEnabled = await this.sdk.checkPlatformEnabled();
      if (!platformEnabled) {
        // Platform disabled - hide widget
        if (this.isVisible) {
          this.hide();
        }
        // Stop SDK if it's listening
        if (this.sdk && this.sdk.isListening) {
          this.sdk.stop();
        }
        return;
      }

      // Then check user-level setting if userIdentifier is provided
      if (this.sdk.userIdentifier) {
        const isEnabled = await this.sdk.checkUserEnabled();
        
        if (isEnabled) {
          // User enabled
          if (!this.sdk.isInitialized) {
            // Re-initialize SDK if it wasn't initialized
            await this.sdk.init();
          }
          
          if (this.sdk.isInitialized && !this.isVisible) {
            // Show widget if SDK is initialized
            this.show();
          }
        } else {
          // User disabled
          if (this.isVisible) {
            // Hide widget
            this.hide();
          }
          
          // Stop SDK if it's listening
          if (this.sdk && this.sdk.isListening) {
            this.sdk.stop();
          }
        }
      } else {
        // No userIdentifier - just check platform setting
        if (!this.sdk.isInitialized) {
          await this.sdk.init();
        }
        
        if (this.sdk.isInitialized && !this.isVisible) {
          this.show();
        }
      }
    } catch (error) {
      console.error('Error checking settings:', error);
    }
  }

  async show() {
    if (this.isVisible) return;
    
    // Check platform-level setting first
    if (this.sdk) {
      const platformEnabled = await this.sdk.checkPlatformEnabled();
      if (!platformEnabled) {
        // Don't show if platform has disabled
        return;
      }
      
      // Check user-level setting if userIdentifier is provided
      if (this.sdk.userIdentifier) {
        const isEnabled = await this.sdk.checkUserEnabled();
        if (!isEnabled) {
          // Don't show if user has disabled
          return;
        }
      }
      
      // Ensure SDK is initialized
      if (!this.sdk.isInitialized) {
        await this.sdk.init();
        if (!this.sdk.isInitialized) {
          // SDK failed to initialize, don't show widget
          return;
        }
      }
    }
    
    if (!this.widget) {
      this.createWidget();
    } else {
      this.widget.style.display = 'flex';
      this.isVisible = true;
    }
  }

  hide() {
    if (!this.isVisible || !this.widget) return;
    
    this.widget.style.display = 'none';
    this.isVisible = false;
    
    // Stop SDK if listening
    if (this.sdk && this.sdk.isListening) {
      this.sdk.stop();
    }
  }

  destroy() {
    if (this.checkIntervalId) {
      clearInterval(this.checkIntervalId);
      this.checkIntervalId = null;
    }

    if (this.widget && this.widget.parentNode) {
      this.widget.parentNode.removeChild(this.widget);
    }

    this.widget = null;
    this.isVisible = false;
  }
}

export default VoiceActionsWidget;

