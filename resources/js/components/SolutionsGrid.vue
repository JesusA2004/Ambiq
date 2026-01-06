<template>
  <section class="py-16 lg:py-24">
    <div class="container mx-auto px-4">
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <SolutionCard
          v-for="(solution, index) in solutions"
          :key="index"
          :solution="solution"
          :delay="index * 100"
        />
      </div>
    </div>
  </section>
</template>

<script setup lang="ts">
import SolutionCard from './SolutionCard.vue';

interface Solution {
  icon: string;
  title: string;
  description: string;
  href: string;
}

const solutions: Solution[] = [
  {
    icon: '/images/icono-consultoria-ambiental.svg',
    title: 'Consultoría ambiental',
    description: 'Estudios de impacto ambiental, trámites ante SEMARNAT y estrategias de reducción de huella ecológica para empresas y gobiernos.',
    href: '/consultoria-ambiental',
  },
  {
    icon: '/images/icono-proteccion-civil.svg',
    title: 'Protección civil y seguridad laboral',
    description: 'Implementamos planes de emergencia, capacitación STPS y cumplimiento de normas de protección civil e higiene industrial.',
    href: '/proteccion-civil-y-seguridad-laboral',
  },
  {
    icon: '/images/icono-gestion-territorial.svg',
    title: 'Gestión territorial y tramitología',
    description: 'Permisos de uso de suelo, licencias de construcción y ordenamiento territorial para proyectos sostenibles.',
    href: '/gestion-territorial-y-tramitologia',
  },
  {
    icon: '/images/icono-ingenieria.svg',
    title: 'Ingeniería y servicios técnicos',
    description: 'Estudios geotécnicos, estructurales e infraestructura vial e hidráulica con respaldo normativo para empresas y gobiernos.',
    href: '/ingenieria-y-servicios-tecnicos',
  },
];
</script>
