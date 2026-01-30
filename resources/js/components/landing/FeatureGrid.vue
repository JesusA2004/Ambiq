<script setup lang="ts">
import ContenedorCentrado from '@/components/landing/ui/ContenedorCentrado.vue'

type IconKey = 'leaf' | 'book' | 'helmet' | 'waves' | 'shield' | 'wind'

type Servicio = {
  etiqueta: string
  titulo: string
  descripcion: string
  bullets: string[]
  icon: IconKey
}

const servicios: Servicio[] = [
  {
    etiqueta: 'Ambiental',
    titulo: 'Gestión ambiental y trámites',
    descripcion: 'Regularizamos, gestionamos y dejamos evidencia lista para autoridad.',
    bullets: [
      'Residuos: CRIT, RP/RME, minimización y bitácoras',
      'Agua: registro/regularización de descargas',
      'LAU, COA/COI, MIA e Informes Preventivos',
    ],
    icon: 'leaf',
  },
  {
    etiqueta: 'Licencias',
    titulo: 'Licencias y autorizaciones',
    descripcion: 'Expedientes completos y alineados a requisitos municipales, estatales y federales.',
    bullets: [
      'Uso de suelo y funcionamiento (ambiental/mercantil)',
      'Estructuración de anexos y documentación soporte',
      'Seguimiento y respuesta a requerimientos',
    ],
    icon: 'book',
  },
  {
    etiqueta: 'STPS',
    titulo: 'Seguridad industrial y salud',
    descripcion: 'Análisis de riesgos críticos y cumplimiento STPS con enfoque preventivo.',
    bullets: [
      'Incendio/explosión, maquinaria e instalaciones eléctricas',
      'Manejo de sustancias químicas y control operativo',
      'Programas y planes de seguridad y salud',
    ],
    icon: 'helmet',
  },
  {
    etiqueta: 'Agentes físicos',
    titulo: 'Evaluación de agentes físicos',
    descripcion: 'Monitoreo y evaluación bajo NOM vigente para decisiones técnicas.',
    bullets: [
      'Ruido, iluminación, vibraciones y térmicas extremas',
      'Radiaciones (UV, láser, infrarrojo) según aplique',
      'Tierras físicas: continuidad y resistencia',
    ],
    icon: 'waves',
  },
  {
    etiqueta: 'Protección civil',
    titulo: 'Emergencias y protección civil',
    descripcion: 'Programas internos, vistos buenos y simulacros evaluados.',
    bullets: [
      'Programas internos y gestión con autoridades',
      'Coordinación de simulacros y evidencia',
      'Dictámenes estructurales y de gas',
    ],
    icon: 'shield',
  },
  {
    etiqueta: 'Aire',
    titulo: 'Emisiones y calidad del aire',
    descripcion: 'Monitoreo de partículas y compuestos con trazabilidad técnica.',
    bullets: [
      'PST en fuentes fijas (NOM-043-SEMARNAT-1993)',
      'COV por cromatografía e ionización de flama',
      'PM10 y partículas condensables (grasas/aceites)',
    ],
    icon: 'wind',
  },
]

function iconSize() {
  return 'h-6 w-6 sm:h-7 sm:w-7'
}
</script>

<template>
  <section class="py-12 sm:py-16" id="servicios">
    <ContenedorCentrado>
      <!-- Header -->
      <div class="flex flex-col gap-2">
        <div class="text-xs font-semibold tracking-[0.2em] uppercase text-emerald-700 dark:text-emerald-300">
          Servicios
        </div>

        <h2 class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white">
          Lo que resolvemos
        </h2>

        <p class="mt-1 max-w-2xl text-sm sm:text-base text-slate-600 dark:text-neutral-300">
          Portafolio integral en Seguridad, Higiene y Medio Ambiente. Entregables claros, evidencia lista y cumplimiento verificable.
        </p>
      </div>

      <!-- Grid -->
      <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <article
          v-for="(s, i) in servicios"
          :key="i"
          class="group rounded-3xl bg-white/80 p-6 ring-1 ring-black/5 shadow-sm backdrop-blur
                 transition-all duration-300 ease-out
                 hover:-translate-y-1 hover:shadow-xl hover:shadow-emerald-500/10
                 dark:bg-neutral-900/60 dark:ring-white/10"
        >
          <!-- Top row: icon + etiqueta -->
          <div class="flex items-start justify-between gap-4">
            <div
              class="inline-flex items-center justify-center rounded-2xl p-3
                     bg-emerald-600/10 ring-1 ring-emerald-500/20
                     text-emerald-700
                     transition
                     group-hover:bg-emerald-600/15 group-hover:ring-emerald-500/30
                     dark:bg-emerald-400/10 dark:ring-emerald-300/20 dark:text-emerald-300"
              aria-hidden="true"
            >
              <!-- leaf -->
              <svg v-if="s.icon === 'leaf'" :class="iconSize()" viewBox="0 0 24 24" fill="none">
                <path
                  d="M20 4s-7.5 0-12 4.5S4 20 4 20s7.5 0 12-4.5S20 4 20 4Z"
                  stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                />
                <path
                  d="M8 16c2-2 5-5 10-8"
                  stroke="currentColor" stroke-width="2" stroke-linecap="round"
                />
              </svg>

              <!-- book -->
              <svg v-else-if="s.icon === 'book'" :class="iconSize()" viewBox="0 0 24 24" fill="none">
                <path
                  d="M4 19.5V6a2 2 0 0 1 2-2h12v16H6a2 2 0 0 1-2-2Z"
                  stroke="currentColor" stroke-width="2" stroke-linejoin="round"
                />
                <path
                  d="M8 8h6M8 12h6M8 16h6"
                  stroke="currentColor" stroke-width="2" stroke-linecap="round"
                />
              </svg>

              <!-- helmet -->
              <svg v-else-if="s.icon === 'helmet'" :class="iconSize()" viewBox="0 0 24 24" fill="none">
                <path
                  d="M4 14a8 8 0 0 1 16 0v3a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2v-3Z"
                  stroke="currentColor" stroke-width="2" stroke-linejoin="round"
                />
                <path d="M12 6v6" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                <path d="M4 14h7m2 0h7" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
              </svg>

              <!-- waves -->
              <svg v-else-if="s.icon === 'waves'" :class="iconSize()" viewBox="0 0 24 24" fill="none">
                <path
                  d="M3 8c2 2 4 2 6 0s4-2 6 0 4 2 6 0"
                  stroke="currentColor" stroke-width="2" stroke-linecap="round"
                />
                <path
                  d="M3 13c2 2 4 2 6 0s4-2 6 0 4 2 6 0"
                  stroke="currentColor" stroke-width="2" stroke-linecap="round"
                />
                <path
                  d="M3 18c2 2 4 2 6 0s4-2 6 0 4 2 6 0"
                  stroke="currentColor" stroke-width="2" stroke-linecap="round"
                />
              </svg>

              <!-- shield -->
              <svg v-else-if="s.icon === 'shield'" :class="iconSize()" viewBox="0 0 24 24" fill="none">
                <path
                  d="M12 3l8 4v6c0 5-3 8-8 9-5-1-8-4-8-9V7l8-4Z"
                  stroke="currentColor" stroke-width="2" stroke-linejoin="round"
                />
                <path
                  d="M9 12l2 2 4-5"
                  stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                />
              </svg>

              <!-- wind -->
              <svg v-else :class="iconSize()" viewBox="0 0 24 24" fill="none">
                <path
                  d="M3 8h10a2 2 0 1 0-2-2"
                  stroke="currentColor" stroke-width="2" stroke-linecap="round"
                />
                <path
                  d="M3 12h14a2 2 0 1 1-2 2"
                  stroke="currentColor" stroke-width="2" stroke-linecap="round"
                />
                <path
                  d="M3 16h8a2 2 0 1 0-2 2"
                  stroke="currentColor" stroke-width="2" stroke-linecap="round"
                />
              </svg>
            </div>

            <span
              class="shrink-0 rounded-full px-3 py-1 text-xs font-semibold tracking-wide
                     bg-emerald-600/10 text-emerald-800 ring-1 ring-emerald-500/20
                     dark:bg-emerald-400/10 dark:text-emerald-200 dark:ring-emerald-300/20"
            >
              {{ s.etiqueta }}
            </span>
          </div>

          <h3 class="mt-4 text-lg font-black text-slate-900 dark:text-white">
            {{ s.titulo }}
          </h3>

          <p class="mt-2 text-sm leading-relaxed text-slate-600 dark:text-neutral-300">
            {{ s.descripcion }}
          </p>

          <ul class="mt-4 space-y-2 text-sm text-slate-700 dark:text-neutral-200">
            <li v-for="(b, bi) in s.bullets" :key="bi" class="flex gap-3">
              <span class="mt-2 h-2.5 w-2.5 shrink-0 rounded-full bg-emerald-500/90" aria-hidden="true" />
              <span class="leading-relaxed">{{ b }}</span>
            </li>
          </ul>
        </article>
      </div>
    </ContenedorCentrado>
  </section>
</template>
