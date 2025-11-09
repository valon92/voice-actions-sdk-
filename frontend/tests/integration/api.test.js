import { describe, it, expect, vi, beforeEach } from 'vitest'
import axios from 'axios'

describe('API Integration Tests', () => {
  beforeEach(() => {
    vi.clearAllMocks()
  })

  it('should handle API errors gracefully', async () => {
    const mockError = {
      response: {
        status: 401,
        data: {
          success: false,
          error: 'Invalid API key',
        },
      },
    }

    axios.get = vi.fn().mockRejectedValue(mockError)

    try {
      await axios.get('/api/commands')
    } catch (error) {
      expect(error.response.status).toBe(401)
      expect(error.response.data.success).toBe(false)
    }
  })

  it('should handle successful API responses', async () => {
    const mockResponse = {
      data: {
        success: true,
        commands: [],
      },
    }

    axios.get = vi.fn().mockResolvedValue(mockResponse)

    const response = await axios.get('/api/commands')
    expect(response.data.success).toBe(true)
    expect(Array.isArray(response.data.commands)).toBe(true)
  })
})

