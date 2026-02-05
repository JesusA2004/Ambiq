<!-- resources/js/components/landing/FaqSection.vue -->
<script setup lang="ts">
import { ref } from 'vue'
import ContenedorCentrado from '@/components/landing/ui/ContenedorCentrado.vue'

type Faq = { q: string; a: string }

const faqs: Faq[] = [
  {
    q: '¿Por qué somos un aliado estratégico para tu empresa?',
    a: 'Porque integramos seguridad industrial, salud en el trabajo y cumplimiento ambiental en un enfoque técnico orientado a la prevención de riesgos, el cumplimiento legal y la continuidad operativa.',
  },
  {
    q: '¿Qué nivel de experiencia ofrecemos?',
    a: 'Contamos con experiencia técnica especializada, conocimiento actualizado de la normatividad vigente y aplicación de mejores prácticas del sector.',
  },
  {
    q: '¿Qué nos diferencia de otras consultorías?',
    a: 'Un enfoque preventivo, práctico y personalizado, enfocado en implementar soluciones reales en campo, más allá de la elaboración documental.',
  },
  {
    q: '¿Cómo se garantiza el cumplimiento normativo?',
    a: 'Mediante diagnósticos técnicos, desarrollo de programas y procedimientos alineados a NOM-STPS y legislación ambiental, así como seguimiento a su correcta implementación.',
  },
  {
    q: '¿Las soluciones se adaptan a cada empresa?',
    a: 'Sí. Cada proyecto se diseña considerando el giro, tamaño, nivel de riesgo y requerimientos específicos de la organización.',
  },
  {
    q: '¿Se brinda acompañamiento durante inspecciones?',
    a: 'Sí. Se ofrece acompañamiento técnico y asesoría especializada durante inspecciones, auditorías y procesos de verificación por parte de la autoridad.',
  },
  {
    q: '¿Qué valor aporta la capacitación?',
    a: 'Capacitación orientada a la gestión del riesgo, el factor humano y la operación segura, con impacto directo en la reducción de incidentes y el fortalecimiento de la cultura preventiva.',
  },
  {
    q: '¿Cómo se contribuye a la reducción de riesgos y costos?',
    a: 'Previniendo accidentes, sanciones, paros operativos y contingencias legales, lo que protege a las personas, los activos y la reputación corporativa.',
  },
  {
    q: '¿Cuál es el tiempo que se tardan en entregar el estudio de daño ambiental?',
    a: 'Depende de cada solicitud, pero aproximadamente 10 días hábiles posteriores al envío de toda la información solicitada.',
  },
  {
    q: '¿Cuáles son los medios de pago que aceptan?',
    a: 'Efectivo, tarjeta de crédito o débito y transferencia.',
  },
]

// acordeón controlado (mejor UX que <details> en móviles)
const openIndex = ref<number | null>(0)

function toggle(i: number) {
  openIndex.value = openIndex.value === i ? null : i
}
</script>

<template>
  <section class="py-12 sm:py-16" id="faq">
    <ContenedorCentrado>
      <!-- Marco verde (logo) + fondo limpio -->
      <div
        class="relative overflow-hidden rounded-3xl bg-white p-6 sm:p-10"
      >
        <!-- decor suave (como la referencia) -->
        <div
          class="pointer-events-none absolute -left-24 -top-24 h-[340px] w-[340px] rounded-full
                 bg-emerald-400/10 blur-2xl"
          aria-hidden="true"
        />
        <div
          class="pointer-events-none absolute -right-28 top-16 h-[420px] w-[420px] rounded-full
                 bg-sky-400/10 blur-2xl"
          aria-hidden="true"
        />

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 relative">
          <!-- Columna izquierda (título) -->
          <div class="lg:col-span-4">
            <div class="text-xs font-semibold tracking-[0.2em] uppercase text-slate-500">
              FAQ
            </div>

            <h2 class="mt-2 text-3xl sm:text-4xl font-black text-slate-900 leading-tight">
              Preguntas frecuentes
            </h2>

            <p class="mt-4 text-sm sm:text-base text-slate-600">
              Respuestas claras, enfoque técnico y cero relleno. Si tu caso es específico, te
              recomendamos enviarnos tu solicitud desde el formulario.
            </p>

            <!-- mini card inferior como la referencia -->
            <div class="mt-8 rounded-2xl bg-slate-50 p-5 ring-1 ring-slate-200/70">
              <div class="text-sm font-black text-slate-900">
                ¿Aún tienes dudas?
              </div>
              <p class="mt-2 text-sm text-slate-600">
                Envíanos tu solicitud desde el formulario de contacto y te respondemos con una ruta clara.
              </p>

              <a
                href="#contacto"
                class="mt-4 inline-flex items-center justify-center rounded-2xl px-5 py-3
                       text-sm font-black text-white
                       bg-[#0B2C4A] hover:bg-[#09243D] transition
                       focus:outline-none focus:ring-2 focus:ring-sky-400/60"
              >
                Ir al formulario de contacto
              </a>
            </div>
          </div>

          <!-- Columna derecha (acordeón) -->
          <div class="lg:col-span-8">
            <div class="flex flex-col gap-4">
              <div
                v-for="(f, i) in faqs"
                :key="i"
                class="rounded-2xl bg-white ring-1 ring-[#0B2C4A]/35"
              >
                <button
                  type="button"
                  class="w-full px-5 sm:px-6 py-4 text-left flex items-center justify-between gap-4"
                  @click="toggle(i)"
                  :aria-expanded="openIndex === i"
                >
                  <!-- Pregunta (azul) -->
                  <div class="min-w-0">
                    <div class="text-sm sm:text-base font-black text-[#0B2C4A]">
                      {{ f.q }}
                    </div>
                  </div>

                  <!-- icono -->
                  <span
                    class="shrink-0 h-9 w-9 rounded-full grid place-items-center
                           bg-slate-100 text-slate-700 ring-1 ring-slate-200/70 transition"
                    :class="openIndex === i ? 'rotate-180' : 'rotate-0'"
                    aria-hidden="true"
                  >
                    <span class="text-lg leading-none">⌄</span>
                  </span>
                </button>

                <!-- Respuesta -->
                <div
                  class="grid transition-[grid-template-rows] duration-300 ease-out"
                  :class="openIndex === i ? 'grid-rows-[1fr]' : 'grid-rows-[0fr]'"
                >
                  <div class="overflow-hidden">
                    <div class="px-5 sm:px-6 pb-5 text-sm sm:text-base text-slate-600">
                      <div class="h-px bg-slate-100 mb-4" />
                      <p class="leading-relaxed">
                        {{ f.a }}
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- nota inferior (opcional y sutil) -->
            <p class="mt-5 text-xs text-slate-500">
              Nota: Los tiempos pueden variar según el giro y la complejidad del cumplimiento requerido.
            </p>
          </div>
        </div>
      </div>
    </ContenedorCentrado>
  </section>
</template>