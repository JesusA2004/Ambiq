<!-- resources/js/components/landing/HeroSection.vue -->
<script setup lang="ts">
import { computed, onBeforeUnmount, onMounted, ref } from 'vue'
import ContenedorCentrado from '@/components/landing/ui/ContenedorCentrado.vue'
import BotonPrincipal from '@/components/landing/ui/BotonPrincipal.vue'

type Slide = {
  id: string
  src: string
  alt: string
  kicker?: string
  title: string
  subtitle: string
  ctaPrimary?: { label: string; href: string }
  ctaSecondary?: { label: string; href: string }
}

const props = withDefaults(
  defineProps<{
    slides?: Slide[]
    autoplay?: boolean
    intervalMs?: number
    heightClass?: string
  }>(),
  {
    autoplay: true,
    intervalMs: 5000,
    heightClass: 'h-[520px] sm:h-[600px] lg:h-[680px]',
    slides: () => [
      {
        id: 's1',
        src: '/img/hero/slide-1.png',
        alt: 'Gestión Ambiental y Trámites Normativos',
        kicker: 'Ambiq Consultores',
        title: 'Gestión Ambiental y Trámites Normativos',
        subtitle:
          'LAU, COA/COI, MIA e informes preventivos. Residuos (CRIT/RP/RME) y regularización de descargas. Cumplimiento sin fricción.',
        ctaPrimary: { label: 'Solicitar diagnóstico', href: '#contacto' },
        ctaSecondary: { label: 'Ver servicios', href: '#servicios' },
      },
      {
        id: 's2',
        src: '/img/hero/slide-2.png',
        alt: 'Seguridad Industrial y Salud en el Trabajo',
        kicker: 'Seguridad e Higiene (STPS)',
        title: 'Seguridad industrial y salud en el trabajo',
        subtitle:
          'Análisis de riesgos críticos, EPP, NOM-002/004/005/006/017/029/030/035/036. Programas y evidencia lista para auditoría.',
        ctaPrimary: { label: 'Agendar visita', href: '#contacto' },
        ctaSecondary: { label: 'Capacitación', href: '#capacitacion' },
      },
      {
        id: 's3',
        src: '/img/hero/slide-3.png',
        alt: 'Protección Civil y Gestión de Emergencias',
        kicker: 'Protección Civil',
        title: 'Protección civil y gestión de emergencias',
        subtitle:
          'Programas Internos, vistos buenos, simulacros evaluados, dictámenes estructurales y de gas. Operación segura y controlada.',
        ctaPrimary: { label: 'Cotizar', href: '#contacto' },
        ctaSecondary: { label: 'Metodología', href: '#metodologia' },
      },
    ],
  }
)

const active = ref(0)
const isPaused = ref(false)
let timer: number | null = null

const slides = computed(() => props.slides ?? [])
const count = computed(() => slides.value.length)
const current = computed(() => slides.value[active.value])

function clamp(i: number) {
  const n = count.value
  if (n <= 0) return 0
  return (i % n + n) % n
}

function goTo(i: number) {
  active.value = clamp(i)
}

function next() {
  goTo(active.value + 1)
}

function prev() {
  goTo(active.value - 1)
}

function stop() {
  if (timer) {
    window.clearInterval(timer)
    timer = null
  }
}

function start() {
  stop()
  if (!props.autoplay || count.value <= 1) return
  timer = window.setInterval(() => {
    if (!isPaused.value) next()
  }, props.intervalMs)
}

function onKey(e: KeyboardEvent) {
  if (e.key === 'ArrowLeft') prev()
  if (e.key === 'ArrowRight') next()
}

onMounted(() => {
  start()
  window.addEventListener('keydown', onKey)
})

onBeforeUnmount(() => {
  stop()
  window.removeEventListener('keydown', onKey)
})
</script>

<template>
  <section
    id="inicio"
    class="relative w-full overflow-hidden"
    @mouseenter="isPaused = true"
    @mouseleave="isPaused = false"
    @focusin="isPaused = true"
    @focusout="isPaused = false"
  >
    <div class="relative w-full" :class="heightClass">
      <!-- Track -->
      <div
        class="absolute inset-0 flex transition-transform duration-700 ease-out will-change-transform"
        :style="{ transform: `translateX(-${active * 100}%)` }"
      >
        <div v-for="s in slides" :key="s.id" class="relative h-full w-full shrink-0">
          <img
            :src="s.src"
            :alt="s.alt"
            class="h-full w-full object-cover select-none"
            draggable="false"
            loading="eager"
          />
          <!-- Overlay -->
          <div class="absolute inset-0 bg-gradient-to-t from-black/75 via-black/30 to-black/10"></div>
          <div class="absolute inset-0 bg-black/10"></div>
        </div>
      </div>

      <!-- Content -->
      <div class="absolute inset-0">
        <ContenedorCentrado class="h-full">
          <!-- Más aire abajo en mobile para que NO choque con dots -->
          <div class="flex h-full items-end pb-24 sm:pb-14 lg:pb-16">
            <!-- Padding lateral para que el texto no se acerque a las flechas -->
            <div class="max-w-2xl px-12 sm:px-0">
              <div class="text-xs font-semibold tracking-[0.22em] uppercase text-emerald-300/90">
                {{ current?.kicker ?? 'Ambiq' }}
              </div>

              <h1 class="mt-3 text-3xl sm:text-4xl lg:text-5xl font-black text-white leading-tight">
                {{ current?.title ?? 'Título' }}
              </h1>

              <p class="mt-4 text-sm sm:text-base text-white/80">
                {{ current?.subtitle ?? 'Subtítulo' }}
              </p>

              <div class="mt-7 flex flex-wrap gap-3">
                <BotonPrincipal
                  v-if="current?.ctaPrimary"
                  :label="current.ctaPrimary.label"
                  :href="current.ctaPrimary.href"
                  tipo="primario"
                />
                <BotonPrincipal
                  v-if="current?.ctaSecondary"
                  :label="current.ctaSecondary.label"
                  :href="current.ctaSecondary.href"
                  tipo="secundario"
                />
              </div>
            </div>
          </div>
        </ContenedorCentrado>
      </div>

      <!-- Arrows (estilo como tu 2da imagen: laterales, centradas) -->
      <button
        type="button"
        class="absolute left-3 sm:left-4 top-1/2 -translate-y-1/2 rounded-2xl bg-white/10 px-3 py-3 text-white
               ring-1 ring-white/20 backdrop-blur hover:bg-white/15 transition
               focus:outline-none focus:ring-2 focus:ring-emerald-400/60"
        @click="prev"
        aria-label="Anterior"
      >
        <span class="text-lg font-black">‹</span>
      </button>

      <button
        type="button"
        class="absolute right-3 sm:right-4 top-1/2 -translate-y-1/2 rounded-2xl bg-white/10 px-3 py-3 text-white
               ring-1 ring-white/20 backdrop-blur hover:bg-white/15 transition
               focus:outline-none focus:ring-2 focus:ring-emerald-400/60"
        @click="next"
        aria-label="Siguiente"
      >
        <span class="text-lg font-black">›</span>
      </button>

      <!-- Dots (abajo, cápsula con blur) -->
      <div class="absolute bottom-4 left-1/2 -translate-x-1/2">
        <div class="flex items-center gap-2 rounded-full bg-black/25 px-4 py-2 ring-1 ring-white/15 backdrop-blur">
          <button
            v-for="(_, i) in count"
            :key="i"
            type="button"
            class="h-2.5 w-2.5 rounded-full ring-1 ring-white/30 transition
                   focus:outline-none focus:ring-2 focus:ring-emerald-400/60"
            :class="i === active ? 'bg-white' : 'bg-white/35 hover:bg-white/55'"
            @click="goTo(i)"
            :aria-label="`Ir al slide ${i + 1}`"
          />
        </div>
      </div>
    </div>
  </section>
</template>
