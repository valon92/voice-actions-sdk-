import { describe, it, expect, vi, beforeEach } from 'vitest'

describe('Voice Actions SDK', () => {
  beforeEach(() => {
    vi.clearAllMocks()
  })

  it('should initialize SDK with API key', async () => {
    // Mock fetch for commands endpoint
    global.fetch = vi.fn().mockResolvedValue({
      ok: true,
      json: async () => ({
        success: true,
        commands: [
          {
            id: 'test-command',
            phrases: ['test'],
            action: 'test',
            category: 'test',
          },
        ],
      }),
    })

    // Dynamic import of SDK
    const { default: VoiceActionsSDK } = await import('../src/index.js')
    
    const sdk = new VoiceActionsSDK({
      apiKey: 'test-api-key',
      apiUrl: 'http://localhost:8000',
    })

    expect(sdk).toBeDefined()
    expect(sdk.apiKey).toBe('test-api-key')
  })

  it('should handle initialization without API key (demo mode)', async () => {
    global.fetch = vi.fn().mockResolvedValue({
      ok: true,
      json: async () => ({
        success: true,
        commands: [],
      }),
    })

    const { default: VoiceActionsSDK } = await import('../src/index.js')
    
    const sdk = new VoiceActionsSDK({
      apiUrl: 'http://localhost:8000',
    })

    expect(sdk).toBeDefined()
    expect(sdk.apiKey).toBeNull()
  })

  it('should match commands correctly', async () => {
    const { default: VoiceActionsSDK } = await import('../src/index.js')
    
    const sdk = new VoiceActionsSDK({
      apiKey: 'test-key',
      apiUrl: 'http://localhost:8000',
    })

    // Mock commands
    sdk.commands = [
      {
        id: 'like',
        phrases: ['like', 'thumbs up'],
        action: 'like',
      },
      {
        id: 'scroll-down',
        phrases: ['scroll down', 'go down'],
        action: 'scroll-down',
      },
    ]

    const command1 = sdk.matchCommand('like this post')
    expect(command1).toBeDefined()
    expect(command1.id).toBe('like')

    const command2 = sdk.matchCommand('scroll down')
    expect(command2).toBeDefined()
    expect(command2.id).toBe('scroll-down')
  })

  it('should handle errors gracefully', async () => {
    global.fetch = vi.fn().mockRejectedValue(new Error('Network error'))

    const { default: VoiceActionsSDK } = await import('../src/index.js')
    
    const sdk = new VoiceActionsSDK({
      apiKey: 'test-key',
      apiUrl: 'http://localhost:8000',
    })

    // Should fallback to default commands on error
    await sdk.loadCommands()
    expect(sdk.commands.length).toBeGreaterThan(0)
  })
})

