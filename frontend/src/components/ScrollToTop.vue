<template>
  <Transition name="fade-slide">
    <button
      v-if="isVisible"
      @click="scrollToTop"
      class="fixed bottom-6 right-6 z-50 group"
      aria-label="Scroll to top"
    >
      <div class="relative w-14 h-14 sm:w-16 sm:h-16">
        <!-- Black background circle -->
        <div class="absolute inset-0 bg-black rounded-full shadow-2xl shadow-black/50 group-hover:shadow-black/70 transition-all duration-300 group-hover:scale-110 border-2 border-gray-800 group-hover:border-gray-700"></div>
        
        <!-- Subtle glow effect on hover -->
        <div class="absolute inset-0 bg-white/10 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
        
        <!-- Arrow icon - white -->
        <div class="relative w-full h-full flex items-center justify-center">
          <svg
            class="w-7 h-7 sm:w-8 sm:h-8 text-white transform group-hover:-translate-y-1 group-active:translate-y-0 transition-all duration-300"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2.5"
              d="M5 10l7-7m0 0l7 7m-7-7v18"
            />
          </svg>
        </div>
        
        <!-- Tooltip on hover -->
        <div class="absolute right-full mr-3 top-1/2 -translate-y-1/2 opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">
          <div class="bg-black text-white text-xs font-semibold px-3 py-1.5 rounded-lg whitespace-nowrap shadow-lg border border-gray-800">
            Scroll to Top
            <div class="absolute left-full top-1/2 -translate-y-1/2 border-4 border-transparent border-l-black"></div>
          </div>
        </div>
      </div>
    </button>
  </Transition>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue'

const isVisible = ref(false)

const handleScroll = () => {
  // Show button when user scrolls down more than 300px
  const scrollPosition = window.scrollY || document.documentElement.scrollTop
  isVisible.value = scrollPosition > 300
}

const scrollToTop = () => {
  window.scrollTo({
    top: 0,
    behavior: 'smooth'
  })
}

onMounted(() => {
  window.addEventListener('scroll', handleScroll)
  // Check initial scroll position
  handleScroll()
})

onUnmounted(() => {
  window.removeEventListener('scroll', handleScroll)
})
</script>

<style scoped>
.fade-slide-enter-active,
.fade-slide-leave-active {
  transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

.fade-slide-enter-from {
  opacity: 0;
  transform: translateY(30px) scale(0.7) rotate(-10deg);
}

.fade-slide-leave-to {
  opacity: 0;
  transform: translateY(30px) scale(0.7) rotate(10deg);
}

.fade-slide-enter-to,
.fade-slide-leave-from {
  opacity: 1;
  transform: translateY(0) scale(1) rotate(0deg);
}

/* Smooth scroll indicator animation */
@keyframes bounce-subtle {
  0%, 100% {
    transform: translateY(0);
  }
  50% {
    transform: translateY(-3px);
  }
}

.group:hover svg {
  animation: bounce-subtle 1s ease-in-out infinite;
}
</style>

