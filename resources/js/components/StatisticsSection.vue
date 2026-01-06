<template>
  <section class="py-16 lg:py-24 relative overflow-hidden">
    <!-- Gradient Background with Shapes -->
    <div class="absolute inset-0 bg-gradient-to-br from-primary/10 via-primary/5 to-background">
      <!-- Top Shape -->
      <svg
        class="absolute top-0 left-0 w-full h-20"
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 1000 100"
        preserveAspectRatio="none"
      >
        <path
          class="fill-background"
          d="M0,6V0h1000v100L0,6z"
        />
      </svg>
      <!-- Bottom Shape -->
      <svg
        class="absolute bottom-0 left-0 w-full h-20 rotate-180"
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 1000 100"
        preserveAspectRatio="none"
      >
        <path
          class="fill-background"
          d="M0,6V0h1000v100L0,6z"
        />
      </svg>
    </div>

    <div class="container mx-auto px-4 relative z-10">
      <div class="text-center mb-12">
        <h3 class="text-sm uppercase tracking-wider text-muted-foreground mb-2">CIFRAS</h3>
        <h2 class="text-3xl lg:text-4xl font-bold">Impacto Generado</h2>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <StatCard
          v-for="(stat, index) in statistics"
          :key="index"
          :stat="stat"
          :delay="index * 100"
        />
      </div>
    </div>
  </section>
</template>

<script setup lang="ts">
import StatCard from './StatCard.vue';

interface Statistic {
  number: string;
  description: string;
  highlight?: string;
  prefix?: string;
}

const statistics: Statistic[] = [
  {
    number: '+ 100',
    description: 'organizaciones aseguradas con éxito, incluyendo sectores como industria, construcción, energía, e infraestructura pública.',
    highlight: 'organizaciones aseguradas con éxito',
  },
  {
    number: '+ 500',
    description: 'estudios ambientales aprobados sin rechazos por parte de autoridades federales o estatales.',
    highlight: 'estudios ambientales aprobados',
  },
  {
    number: '+ 500',
    description: 'proyectos de obra pública, garantizando cumplimiento normativo y viabilidad ambiental.',
    highlight: 'proyectos de obra pública',
    prefix: 'Participación en',
  },
  {
    number: '100%',
    description: 'de multas evitadas a empresas asesoradas, siempre que han seguido nuestras recomendaciones.',
    highlight: 'de multas evitadas a empresas asesoradas',
  },
];
</script>
