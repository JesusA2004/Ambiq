<template>
  <section class="relative py-20 lg:py-32 overflow-hidden">
    <div class="container mx-auto px-4">
      <div class="max-w-4xl">
        <h3 class="text-sm uppercase tracking-wider text-muted-foreground mb-4 animate-fade-in">
          soluciones
        </h3>
        <h1 class="text-4xl lg:text-6xl font-bold mb-6 animate-slide-in-left">
          <span class="inline-block relative">
            <span
              ref="animatedText"
              class="relative inline-block"
            >
              {{ currentText }}
            </span>
            <span class="absolute bottom-0 left-0 w-full h-1 bg-primary/30"></span>
          </span>
          <br />
          <span class="text-muted-foreground">en cumplimiento ambiental, protección y tramitación</span>
        </h1>
      </div>
    </div>
  </section>
</template>

<script setup lang="ts">
import { ref, onMounted, onUnmounted } from 'vue';

const animatedText = ref<HTMLElement | null>(null);
const currentText = ref('Soluciones integrales');
const texts = ['Soluciones integrales', 'Consultoría especializada', 'Asesoría profesional'];
let currentIndex = 0;
let intervalId: number | null = null;

onMounted(() => {
  intervalId = window.setInterval(() => {
    currentIndex = (currentIndex + 1) % texts.length;
    currentText.value = texts[currentIndex];
  }, 8000);
});

onUnmounted(() => {
  if (intervalId) {
    clearInterval(intervalId);
  }
});
</script>

<style scoped>
@keyframes fade-in {
  from {
    opacity: 0;
    transform: translateY(10px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

@keyframes slide-in-left {
  from {
    opacity: 0;
    transform: translateX(-30px);
  }
  to {
    opacity: 1;
    transform: translateX(0);
  }
}

.animate-fade-in {
  animation: fade-in 1s ease-out;
}

.animate-slide-in-left {
  animation: slide-in-left 1s ease-out 0.3s both;
}
</style>
