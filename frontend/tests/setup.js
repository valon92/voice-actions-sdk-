import { vi } from 'vitest'

// Mock window.SpeechRecognition
global.SpeechRecognition = class SpeechRecognition {
  constructor() {
    this.lang = 'en-US'
    this.continuous = false
    this.interimResults = false
    this.onstart = null
    this.onresult = null
    this.onerror = null
    this.onend = null
  }

  start() {
    if (this.onstart) this.onstart()
  }

  stop() {
    if (this.onend) this.onend()
  }

  abort() {
    if (this.onend) this.onend()
  }
}

global.webkitSpeechRecognition = global.SpeechRecognition

// Mock axios
vi.mock('axios', () => ({
  default: {
    get: vi.fn(),
    post: vi.fn(),
    create: vi.fn(() => ({
      get: vi.fn(),
      post: vi.fn(),
    })),
  },
}))

