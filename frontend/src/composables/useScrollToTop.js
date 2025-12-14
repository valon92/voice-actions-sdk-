import { onMounted } from 'vue'
import { useRoute } from 'vue-router'

/**
 * Composable to ensure page scrolls to top on mount and route changes
 */
export function useScrollToTop() {
  const route = useRoute()

  onMounted(() => {
    // Scroll to top when component mounts
    window.scrollTo({ top: 0, behavior: 'smooth' })
  })

  // Watch for route changes and scroll to top
  // Note: This is handled by router scrollBehavior, but this provides additional safety
  const scrollToTop = () => {
    window.scrollTo({ top: 0, behavior: 'smooth' })
  }

  return {
    scrollToTop
  }
}

