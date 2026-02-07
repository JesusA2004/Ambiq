<script setup lang="ts">
import { onMounted, onBeforeUnmount, ref } from 'vue'
import { ArrowUp } from 'lucide-vue-next'

// WhatsApp
const whatsappNumber = '4251026034'
const whatsappMessage =
  'Hola Ambiq, me interesa recibir información. ¿Me pueden ayudar?'

// Scroll top
const showTop = ref(false)

function onScroll() {
  showTop.value = window.scrollY > 300
}

function scrollTop() {
  window.scrollTo({ top: 0, behavior: 'smooth' })
}

onMounted(() => {
  onScroll()
  window.addEventListener('scroll', onScroll, { passive: true })
})

onBeforeUnmount(() => {
  window.removeEventListener('scroll', onScroll)
})
</script>

<template>
  <!-- Botón subir arriba (izquierda) -->
  <transition
    enter-active-class="transition duration-200 ease-out"
    enter-from-class="opacity-0 translate-y-2"
    enter-to-class="opacity-100 translate-y-0"
    leave-active-class="transition duration-150 ease-in"
    leave-from-class="opacity-100 translate-y-0"
    leave-to-class="opacity-0 translate-y-2"
  >
    <button
      v-if="showTop"
      @click="scrollTop"
      aria-label="Volver arriba"
      class="fixed bottom-6 left-6 z-40
             flex h-12 w-12 items-center justify-center rounded-full
             bg-[#0B2C4A] text-white shadow-lg shadow-slate-900/20
             hover:bg-[#09243D] transition
             focus:outline-none focus:ring-2 focus:ring-emerald-400/60"
    >
      <ArrowUp class="h-5 w-5" />
    </button>
  </transition>

  <!-- WhatsApp (derecha, siempre visible) -->
  <a
    :href="`https://wa.me/${whatsappNumber}?text=${encodeURIComponent(whatsappMessage)}`"
    target="_blank"
    rel="noopener noreferrer"
    aria-label="WhatsApp"
    class="fixed bottom-6 right-6 z-40
           flex h-14 w-14 items-center justify-center rounded-full
           bg-[#25D366] shadow-lg shadow-green-900/30
           hover:scale-105 transition
           focus:outline-none focus:ring-2 focus:ring-green-400/60"
  >
    <!-- Logo oficial WhatsApp -->
    <img
      src="/img/whatsapp.png"
      alt="WhatsApp"
      class="h-7 w-7"
      draggable="false"
    />
  </a>
</template>
