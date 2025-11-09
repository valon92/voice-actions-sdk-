import { describe, it, expect } from 'vitest'
import { mount } from '@vue/test-utils'
import App from '@/App.vue'

describe('App.vue', () => {
  it('renders the app component', () => {
    const wrapper = mount(App)
    expect(wrapper.exists()).toBe(true)
  })

  it('has router view', () => {
    const wrapper = mount(App)
    expect(wrapper.find('router-view').exists()).toBe(true)
  })
})

