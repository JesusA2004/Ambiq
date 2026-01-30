<!-- resources/js/components/landing/PasosContratarSection.vue -->
<script setup lang="ts">
import ContenedorCentrado from '@/components/landing/ui/ContenedorCentrado.vue'

type Paso = {
  titulo: string
  descripcion: string
}

const pasos: Paso[] = [
  {
    titulo: 'Solicitud de información',
    descripcion:
      'El primer paso es enviarnos tu solicitud a través del formulario de contacto, indicando el servicio de tu interés.',
  },
  {
    titulo: 'Análisis y diagnóstico',
    descripcion:
      'Nuestro equipo revisa tu caso, identifica obligaciones normativas y evalúa el nivel de riesgo aplicable.',
  },
  {
    titulo: 'Propuesta y cotización',
    descripcion:
      'Recibes una propuesta formal con alcance definido, tiempos, entregables y costos claros.',
  },
  {
    titulo: 'Ejecución y entrega',
    descripcion:
      'Implementamos el servicio, generamos la documentación correspondiente y entregamos evidencia lista para auditoría.',
  },
]
</script>

<template>
  <section class="py-12 sm:py-16" id="pasos-para-contratar">
    <ContenedorCentrado>
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
        <!-- Texto principal -->
        <div class="lg:col-span-4">
          <div
            class="text-xs font-semibold tracking-[0.2em] uppercase
                   text-emerald-700 dark:text-emerald-300"
          >
            Proceso de contratación
          </div>

          <h2
            class="mt-2 text-2xl sm:text-3xl font-black
                   text-slate-900 dark:text-white"
          >
            Contratar nuestros servicios es así de simple, en 4 pasos
          </h2>

          <p
            class="mt-3 text-sm sm:text-base
                   text-slate-600 dark:text-neutral-300"
          >
            Un proceso estructurado, transparente y enfocado en cumplimiento normativo,
            diseñado para reducir riesgos y facilitar la toma de decisiones.
          </p>

          <div class="mt-6">
            <a
              href="#contacto"
              class="inline-flex items-center justify-center
                     rounded-2xl bg-[#0B2C4A] px-5 py-3
                     text-sm font-black text-white
                     hover:bg-slate-800 transition
                     focus:outline-none focus:ring-2 focus:ring-slate-400/60"
            >
              Ir al formulario de contacto
            </a>
          </div>
        </div>

        <!-- Cards -->
        <div class="lg:col-span-8">
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div
              v-for="(p, i) in pasos"
              :key="i"
              class="rounded-2xl border border-slate-200/70 bg-white p-6 shadow-sm
                     transition-all duration-300 ease-out
                     hover:-translate-y-1 hover:shadow-lg
                     dark:border-white/10 dark:bg-neutral-900/60"
            >
              <div
                class="text-xs font-black
                       text-emerald-700 dark:text-emerald-300"
              >
                Paso {{ i + 1 }}
              </div>

              <div
                class="mt-2 text-lg font-black
                       text-slate-900 dark:text-white"
              >
                {{ p.titulo }}
              </div>

              <p
                class="mt-2 text-sm leading-relaxed
                       text-slate-600 dark:text-neutral-300"
              >
                {{ p.descripcion }}
              </p>

              <div v-if="i === 0" class="mt-4">
                <a
                  href="#contacto"
                  class="inline-flex items-center gap-2
                         text-sm font-semibold
                         text-slate-900 hover:text-slate-700
                         dark:text-slate-200 dark:hover:text-white"
                >
                  Enviar solicitud de cotización
                  <span aria-hidden="true">→</span>
                </a>
              </div>
            </div>
          </div>

          <p class="mt-4 text-xs text-slate-500 dark:text-neutral-400">
            Nota: Si seleccionaste un servicio previamente, este se cargará automáticamente en el mensaje del formulario.
          </p>
        </div>
      </div>
    </ContenedorCentrado>
  </section>
</template>