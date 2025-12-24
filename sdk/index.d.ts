/**
 * Voice Actions SDK - TypeScript Type Definitions
 * 
 * This file provides TypeScript type definitions for the Voice Actions SDK.
 * 
 * Usage:
 * import VoiceActionsSDK from '@valon92/voice-actions-sdk';
 * 
 * const sdk = new VoiceActionsSDK({ ... });
 */

export interface VoiceActionsSDKOptions {
  /** API key from platform registration (optional for demo) */
  apiKey?: string;
  
  /** Custom API URL (defaults to auto-detected URL) */
  apiUrl?: string;
  
  /** API version prefix (e.g., 'v1' for /v1/commands, null for no prefix) */
  apiVersion?: string | null;
  
  /** Platform name (e.g., 'youtube', 'instagram', 'custom') */
  platform?: string;
  
  /** Language locale (e.g., 'en-US', 'sq-AL', 'es-ES') */
  locale?: string;
  
  /** User ID for user-level settings (optional) */
  userIdentifier?: string;
  
  /** Wake words for voice activation (e.g., ['hey stargate', 'hello stargate']) */
  wakeWords?: string[];
  
  /** Enable wake word detection (default: true if wakeWords provided) */
  wakeWordEnabled?: boolean;
  
  /** Callback when command is detected */
  onCommand?: (command: VoiceCommand) => void;
  
  /** Callback for errors (receives error with metadata) */
  onError?: (error: Error & { 
    type?: string; 
    retryable?: boolean; 
    metadata?: any;
    originalError?: string;
    browser?: BrowserInfo;
  }) => void;
  
  /** Callback when listening state changes (isListening: boolean) */
  onListeningStateChange?: (isListening: boolean) => void;
  
  /** Callback for permission errors (receives error details) */
  onPermissionError?: (errorDetails: PermissionErrorDetails) => void;
  
  /** Enable debug logging */
  debug?: boolean;
  
  /** Enable notification system (default: true) */
  notificationsEnabled?: boolean;
  
  /** Notification check interval in milliseconds (default: 300000 = 5 minutes) */
  notificationCheckInterval?: number;
}

export interface VoiceCommand {
  /** Unique command identifier */
  id: string;
  
  /** Command name (optional) */
  name?: string;
  
  /** Command category (optional) */
  category?: string;
  
  /** Phrases that trigger this command */
  phrases: string[];
  
  /** Action identifier */
  action: string;
  
  /** Command description (optional) */
  description?: string;
}

export interface PermissionErrorDetails {
  /** Error code from Speech Recognition API */
  error: string;
  
  /** Browser information */
  browser: BrowserInfo;
  
  /** Browser-specific instructions */
  instructions: string;
  
  /** Error type */
  type: 'PERMISSION_DENIED' | 'SERVICE_NOT_ALLOWED';
  
  /** Full error message */
  message: string;
  
  /** Whether the error is retryable */
  retryable: boolean;
}

export interface BrowserInfo {
  /** Browser name (e.g., 'chrome', 'safari', 'firefox', 'edge') */
  name: string;
  
  /** Browser version */
  version: string;
}

export interface MicrophonePermission {
  /** Whether permission is granted */
  granted: boolean;
  
  /** Error message if permission denied */
  error?: string;
}

export interface UserSettings {
  /** Whether voice actions are enabled for this user */
  enabled?: boolean;
  
  /** User's preferred locale */
  locale?: string;
  
  /** Additional user preferences */
  [key: string]: any;
}

export interface Notification {
  /** Notification ID */
  id: number;
  
  /** Notification type */
  type: 'info' | 'update' | 'feature' | 'warning' | 'success';
  
  /** Notification title */
  title: string;
  
  /** Notification message */
  message: string;
  
  /** Optional action URL */
  action_url?: string;
  
  /** Optional action text */
  action_text?: string;
  
  /** Whether notification is dismissible */
  is_dismissible?: boolean;
  
  /** Notification priority (higher = more important) */
  priority?: number;
}

/**
 * Speech Recognition API interface
 * 
 * Note: This is a browser API that may not be available in all browsers.
 * Use VoiceActionsSDK.isSupported() to check if the browser supports speech recognition.
 */
export interface SpeechRecognition extends EventTarget {
  /** Whether to continuously listen for speech */
  continuous: boolean;
  
  /** Whether to return interim results */
  interimResults: boolean;
  
  /** Language for speech recognition */
  lang: string;
  
  /** Maximum number of alternative transcripts */
  maxAlternatives: number;
  
  /** Service URI (Chrome-specific) */
  serviceURI?: string;
  
  /** Grammars (Chrome-specific) */
  grammars?: SpeechGrammarList;
  
  /** Start speech recognition */
  start(): void;
  
  /** Stop speech recognition */
  stop(): void;
  
  /** Abort speech recognition */
  abort(): void;
  
  /** Event handler for recognition results */
  onresult: ((event: SpeechRecognitionEvent) => void) | null;
  
  /** Event handler for recognition errors */
  onerror: ((event: SpeechRecognitionErrorEvent) => void) | null;
  
  /** Event handler for recognition end */
  onend: (() => void) | null;
  
  /** Event handler for recognition start */
  onstart: (() => void) | null;
  
  /** Event handler for audio start */
  onaudiostart: (() => void) | null;
  
  /** Event handler for audio end */
  onaudioend: (() => void) | null;
  
  /** Event handler for sound start */
  onsoundstart: (() => void) | null;
  
  /** Event handler for sound end */
  onsoundend: (() => void) | null;
  
  /** Event handler for speech start */
  onspeechstart: (() => void) | null;
  
  /** Event handler for speech end */
  onspeechend: (() => void) | null;
  
  /** Event handler for no speech */
  onnomatch: ((event: SpeechRecognitionEvent) => void) | null;
}

export interface SpeechRecognitionEvent {
  /** Recognition results */
  results: SpeechRecognitionResultList;
  
  /** Result index */
  resultIndex: number;
  
  /** Emulated time */
  emma?: Document | null;
  
  /** Interpretation */
  interpretation?: any;
}

export interface SpeechRecognitionResultList {
  /** Length of results */
  readonly length: number;
  
  /** Get result at index */
  item(index: number): SpeechRecognitionResult;
  
  /** Get result at index (array access) */
  [index: number]: SpeechRecognitionResult;
}

export interface SpeechRecognitionResult {
  /** Whether this is a final result */
  readonly isFinal: boolean;
  
  /** Length of alternatives */
  readonly length: number;
  
  /** Get alternative at index */
  item(index: number): SpeechRecognitionAlternative;
  
  /** Get alternative at index (array access) */
  [index: number]: SpeechRecognitionAlternative;
}

export interface SpeechRecognitionAlternative {
  /** Transcript text */
  readonly transcript: string;
  
  /** Confidence score (0-1) */
  readonly confidence: number;
}

export interface SpeechRecognitionErrorEvent {
  /** Error type */
  readonly error: 'no-speech' | 'aborted' | 'audio-capture' | 'network' | 'not-allowed' | 'service-not-allowed';
  
  /** Error message */
  readonly message: string;
}

export interface SpeechGrammarList {
  /** Length of grammars */
  readonly length: number;
  
  /** Add grammar from string */
  addFromString(string: string, weight?: number): void;
  
  /** Add grammar from URI */
  addFromURI(src: string, weight?: number): void;
  
  /** Get grammar at index */
  item(index: number): SpeechGrammar;
  
  /** Get grammar at index (array access) */
  [index: number]: SpeechGrammar;
}

export interface SpeechGrammar {
  /** Grammar source */
  src: string;
  
  /** Grammar weight */
  weight: number;
}

/**
 * Voice Actions SDK Main Class
 */
export default class VoiceActionsSDK {
  /** Whether SDK is currently listening */
  readonly isListening: boolean;
  
  /** Whether SDK is initialized */
  readonly isInitialized: boolean;
  
  /** Loaded commands */
  readonly commands: VoiceCommand[];
  
  /** Current session ID */
  readonly sessionId: string | null;
  
  /** Usage count for current session */
  readonly usageCount: number;
  
  constructor(options?: VoiceActionsSDKOptions);
  
  /**
   * Initialize the SDK
   */
  init(): Promise<void>;
  
  /**
   * Start listening for voice commands
   */
  start(): Promise<void>;
  
  /**
   * Stop listening for voice commands
   */
  stop(): void;
  
  /**
   * Change the recognition language
   */
  setLocale(locale: string): void;
  
  /**
   * Add a custom command
   */
  addCommand(command: VoiceCommand): void;
  
  /**
   * Remove a command
   */
  removeCommand(commandId: string): void;
  
  /**
   * Check microphone permission status
   */
  checkMicrophonePermission(): Promise<MicrophonePermission>;
  
  /**
   * Check if user has enabled voice actions
   */
  checkUserEnabled(): Promise<boolean>;
  
  /**
   * Get user settings
   */
  getUserSettings(): Promise<UserSettings>;
  
  /**
   * Update user settings
   */
  updateUserSettings(settings: Partial<UserSettings>): Promise<void>;
  
  /**
   * Load notifications from API
   */
  loadNotifications(): Promise<void>;
  
  /**
   * Display notifications
   */
  displayNotifications(): void;
  
  /**
   * Dismiss a notification
   */
  dismissNotification(notificationId: number): void;
  
  /**
   * Destroy the SDK instance
   */
  destroy(): void;
  
  /**
   * Check if browser supports speech recognition
   */
  static isSupported(): boolean;
  
  /**
   * Detect API URL automatically
   */
  detectApiUrl(): string;
  
  /**
   * Detect browser type
   */
  detectBrowser(): BrowserInfo;
  
  /**
   * Get permission instructions for browser
   */
  getPermissionInstructions(browser: BrowserInfo): string;
  
  /**
   * Get wake words for platform
   */
  getWakeWords(): string[];
  
  /**
   * Get platform display name
   */
  getPlatformDisplayName(): string;
  
  /**
   * Get platform theme colors
   */
  getPlatformTheme(): {
    colors: {
      primary: string;
      secondary: string;
      border: string;
    };
    gradient: string;
  };
  
  /**
   * Check if wake word is detected
   */
  checkWakeWord(transcript: string): boolean;
  
  /**
   * Extract command text after wake word
   */
  extractCommandAfterWakeWord(transcript: string): string;
}

/**
 * Global window extensions for Speech Recognition API
 */
declare global {
  interface Window {
    SpeechRecognition: typeof SpeechRecognition;
    webkitSpeechRecognition: typeof SpeechRecognition;
    SpeechGrammarList: typeof SpeechGrammarList;
    webkitSpeechGrammarList: typeof SpeechGrammarList;
  }
}

