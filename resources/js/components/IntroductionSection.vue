<template>
  <section class="py-16 lg:py-24 bg-muted/30">
    <div class="container mx-auto px-4">
      <div class="max-w-3xl mx-auto text-center animate-slide-up">
        <h2 class="text-3xl lg:text-4xl font-bold mb-6">
          Convertimos la regulación en una ventaja competitiva
        </h2>
        <p class="text-lg text-muted-foreground">
          En IESIMA ofrecemos un enfoque integral que combina experiencia ambiental, seguridad laboral, gestión territorial e ingeniería técnica para garantizar proyectos exitosos y libres de sanciones.
        </p>
      </div>
    </div>
  </section>
</template>

<script setup lang="ts">
// No props needed for this component
</script>

<style scoped>
@keyframes slide-up {
  from {
    opacity: 0;
    transform: translateY(30px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.animate-slide-up {
  animation: slide-up 1s ease-out;
}
</style>
