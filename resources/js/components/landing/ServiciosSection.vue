<script setup lang="ts">
import { computed, onBeforeUnmount, onMounted, ref } from 'vue'
import ContenedorCentrado from '@/components/landing/ui/ContenedorCentrado.vue'
import ServicioCard, { type ServicioItem } from '@/components/landing/ServicioCard.vue'

/**
 * ServiciosSection
 * - Carrusel (scroll-snap) con flechas
 * - Desktop: flip 3D (hover/focus)
 * - Móvil: desplegable por card (sin hover)
 * - Botón "Agregar a mi cotización" => precarga textarea de Contacto
 */

const servicios: ServicioItem[] = [
  // ======== AMBIENTAL / NORMATIVO ========
  {
    id: 'ambiental',
    shape: 'rounded',
    title: 'Gestión ambiental',
    image: '/img/servicios/ambiental.png',
    subtitle: 'Trámites y cumplimiento normativo',
    bullets: [
      'Residuos: CRIT, RP/RME, planes de minimización y bitácoras',
      'Agua: registro y regularización de descargas de aguas residuales',
      'LAU, COA/COI, MIA e Informes Preventivos',
    ],
  },
  {
    id: 'licencias',
    shape: 'rounded',
    title: 'Licencias y autorizaciones',
    image: '/img/servicios/licencias.png',
    subtitle: 'Expedientes listos para autoridad',
    bullets: [
      'Licencia Ambiental Única (LAU), COA/COI y anexos',
      'Licencias de uso de suelo y funcionamiento (ambiental/mercantil)',
      'Seguimiento y respuesta a requerimientos de autoridad',
    ],
  },

  // ======== AUDITORÍAS ========
  {
    id: 'auditorias',
    shape: 'rounded',
    title: 'Auditorías y certificaciones',
    image: '/img/servicios/auditorias.png',
    subtitle: 'Ambiental, seguridad y protección civil',
    bullets: [
      'Auditorías internas y externas (ambiental, STPS y PC)',
      'Hallazgos, plan de acción y evidencia documental',
      'Certificación para industria limpia (estatal y federal)',
    ],
  },

  // ======== STPS (RIESGOS / PROGRAMAS) ========
  {
    id: 'stps',
    shape: 'rounded',
    title: 'Seguridad y Salud (STPS)',
    image: '/img/servicios/stps.png',
    subtitle: 'Riesgos críticos y evidencia',
    bullets: [
      'Incendio/explosión, maquinaria e instalaciones eléctricas',
      'Químicos peligrosos, estiba y manejo de materiales',
      'Planes y programas de seguridad y salud en el trabajo',
    ],
  },

  // ======== SALUD Y FACTORES DE RIESGO ========
  {
    id: 'salud-factores',
    shape: 'rounded',
    title: 'Salud y factores de riesgo',
    image: '/img/servicios/salud.png',
    subtitle: 'Evaluación y controles conforme a NOM',
    bullets: [
      'EPP: identificación de riesgos y selección (NOM-017-STPS-2024)',
      'Factores ergonómicos (NOM-036-STPS-2018)',
      'Factores psicosociales (NOM-035-STPS-2018)',
      'Muestreo de contaminantes químicos (NOM-010-STPS-2014)',
    ],
  },

  // ======== EQUIPOS CRÍTICOS Y CUMPLIMIENTO ========
  {
    id: 'equipos-criticos',
    shape: 'rounded',
    title: 'Equipos críticos y cumplimiento',
    image: '/img/servicios/equipos.png',
    subtitle: 'Gestión técnica y cumplimiento STPS',
    bullets: [
      'Recipientes a presión y calderas (NOM-020-STPS-2011)',
      'Señalización de fluidos y áreas de riesgo (NOM-026-STPS-2008)',
      'Diagnóstico integral (NOM-030-STPS-2009)',
      'PASST: asesoría para instauración y seguimiento',
    ],
  },

  // ======== AGENTES FÍSICOS ========
  {
    id: 'agentes',
    shape: 'rounded',
    title: 'Agentes físicos',
    image: '/img/servicios/agentes.png',
    subtitle: 'Monitoreo bajo NOM vigente',
    bullets: [
      'Ruido, iluminación, vibraciones y condiciones térmicas',
      'Radiaciones (UV, láser, infrarrojo) según aplique',
      'Tierras físicas: continuidad y resistencia',
    ],
  },

  // ======== PROTECCIÓN CIVIL ========
  {
    id: 'pc',
    shape: 'rounded',
    title: 'Protección civil y emergencias',
    image: '/img/servicios/proteccion-civil.png',
    subtitle: 'Gestión municipal/estatal',
    bullets: [
      'Programas Internos de Protección Civil (PIPC) y registro',
      'Vistos buenos ante autoridades municipales/estatales',
      'Coordinación de simulacros evaluados',
      'Dictámenes estructurales y dictámenes de gas',
    ],
  },

  // ======== CAPACITACIÓN (CURSOS) ========
  {
    id: 'capacitacion',
    shape: 'rounded',
    title: 'Capacitación especializada (Cursos)',
    image: '/img/servicios/capacitacion.png',
    subtitle: 'Teoría-práctica con validez oficial',
    bullets: [
      'Trabajos de altura, corte y soldadura, montacargas',
      'Brigadas: 1) Primeros auxilios 2) Contraincendios 3) Búsqueda y rescate 4) Evacuación',
      'Comisiones mixtas (NOM-019-STPS-2011)',
      'Residuos y sustancias químicas + EPP + LOTO',
      'Sistemas de Gestión Ambiental y cumplimiento normativo',
    ],
  },

  // ======== EMISIONES / AIRE ========
  {
    id: 'aire',
    shape: 'rounded',
    title: 'Emisiones y calidad del aire',
    image: '/img/servicios/aire.png',
    subtitle: 'Partículas y compuestos',
    bullets: [
      'PST en fuentes fijas (NOM-043-SEMARNAT-1993)',
      'COV (cromatografía de gases e ionización de flama)',
      'PM10 y partículas condensables (grasas y aceites)',
    ],
  },
]

const trackRef = ref<HTMLElement | null>(null)
const activeIndex = ref(0)

const items = computed(() => servicios)
const count = computed(() => items.value.length)

function clamp(i: number) {
  const n = count.value
  if (n <= 0) return 0
  return (i % n + n) % n
}

function scrollToIndex(i: number, behavior: ScrollBehavior = 'smooth') {
  const el = trackRef.value
  if (!el) return
  const idx = clamp(i)
  activeIndex.value = idx
  const target = el.querySelector<HTMLElement>(`[data-card-index="${idx}"]`)
  if (!target) return
  target.scrollIntoView({ behavior, inline: 'center', block: 'nearest' })
}

function next() {
  scrollToIndex(activeIndex.value + 1)
}
function prev() {
  scrollToIndex(activeIndex.value - 1)
}

function onKey(e: KeyboardEvent) {
  if (e.key === 'ArrowLeft') prev()
  if (e.key === 'ArrowRight') next()
}

onMounted(() => {
  window.addEventListener('keydown', onKey)
})
onBeforeUnmount(() => {
  window.removeEventListener('keydown', onKey)
})

function handleAddToQuote(serviceTitle: string) {
  // 1) precarga el mensaje del formulario (igual que tus otros casos)
  window.dispatchEvent(
    new CustomEvent('ambiq:add-to-quote', {
      detail: {
        message: `¡Hola!, me interesa obtener más información sobre el servicio ${serviceTitle}.`,
      },
    })
  )

  // 2) scroll al formulario de cotización/contacto
  const contacto = document.getElementById('contacto')
  contacto?.scrollIntoView({ behavior: 'smooth', block: 'start' })
}
</script>

<template>
  <section id="servicios" class="py-12 sm:py-16">
    <ContenedorCentrado>
      <!-- Header -->
      <div class="flex items-end justify-between gap-6">
        <div class="flex flex-col gap-2">
          <div class="text-xs font-semibold tracking-[0.2em] uppercase text-emerald-700 dark:text-emerald-300">
            Servicios
          </div>
          <h2 class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white">
            Explora el portafolio
          </h2>
          <p class="mt-1 max-w-2xl text-sm sm:text-base text-slate-600 dark:text-neutral-300">
            Primero ves la propuesta (imagen + nombre). Al interactuar, aparece el detalle y puedes agregarlo a tu cotización.
          </p>
        </div>

        <!-- Flechas (desktop/tablet) -->
        <div class="hidden sm:flex items-center gap-2">
          <button
            type="button"
            class="rounded-2xl px-3 py-2 ring-1 ring-black/10 bg-white/70 backdrop-blur
                   hover:bg-white transition dark:bg-neutral-900/60 dark:ring-white/10 dark:hover:bg-neutral-900"
            @click="prev"
            aria-label="Anterior"
          >
            ‹
          </button>
          <button
            type="button"
            class="rounded-2xl px-3 py-2 ring-1 ring-black/10 bg-white/70 backdrop-blur
                   hover:bg-white transition dark:bg-neutral-900/60 dark:ring-white/10 dark:hover:bg-neutral-900"
            @click="next"
            aria-label="Siguiente"
          >
            ›
          </button>
        </div>
      </div>

      <!-- Carrusel -->
      <div class="relative mt-8">
        <!-- Track -->
        <div
          ref="trackRef"
          class="services-track flex gap-6 overflow-x-auto pb-2
                 snap-x snap-mandatory scroll-smooth
                 [scrollbar-width:none] [-ms-overflow-style:none]"
        >
          <ServicioCard
            v-for="(s, i) in items"
            :key="s.id"
            :item="s"
            :index="i"
            @add="handleAddToQuote"
            class="snap-center"
          />
        </div>

        <!-- Flechas flotantes (móvil) -->
        <div class="sm:hidden pointer-events-none absolute inset-y-0 left-0 right-0 flex items-center justify-between">
          <button
            type="button"
            class="pointer-events-auto ml-1 rounded-2xl px-3 py-3 text-white
                   bg-black/25 ring-1 ring-white/15 backdrop-blur
                   active:scale-95 transition"
            @click="prev"
            aria-label="Anterior"
          >
            ‹
          </button>
          <button
            type="button"
            class="pointer-events-auto mr-1 rounded-2xl px-3 py-3 text-white
                   bg-black/25 ring-1 ring-white/15 backdrop-blur
                   active:scale-95 transition"
            @click="next"
            aria-label="Siguiente"
          >
            ›
          </button>
        </div>

        <!-- Dots -->
        <div class="mt-5 flex items-center justify-center gap-2">
          <button
            v-for="(_, i) in count"
            :key="i"
            type="button"
            class="h-2.5 w-2.5 rounded-full ring-1 ring-black/15 dark:ring-white/15 transition
                   focus:outline-none focus:ring-2 focus:ring-emerald-400/60"
            :class="i === activeIndex ? 'bg-emerald-600' : 'bg-slate-300 dark:bg-neutral-700 hover:bg-slate-400'"
            @click="scrollToIndex(i)"
            :aria-label="`Ir al servicio ${i + 1}`"
          />
        </div>
      </div>

      <p class="mt-4 text-xs text-slate-500 dark:text-neutral-400">
        Tip: En escritorio pasa el mouse por encima para ver el reverso; en móvil toca “Ver detalles”.
      </p>
    </ContenedorCentrado>
  </section>
</template>

<style scoped>
.services-track::-webkit-scrollbar {
  display: none;
}
.services-track {
  scrollbar-width: none;
  -ms-overflow-style: none;
}
</style>
