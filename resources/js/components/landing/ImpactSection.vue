<script setup lang="ts">
import SeccionFullBleed from '@/components/landing/ui/SeccionFullBleed.vue'
import ContenedorCentrado from '@/components/landing/ui/ContenedorCentrado.vue'
import EncabezadoSeccion from '@/components/landing/ui/EncabezadoSeccion.vue'
import TarjetaMetrica from '@/components/landing/ui/TarjetaMetrica.vue'

type Metrica = {
  valor: string
  titulo?: string
  descripcion: string
}

const metricas: Metrica[] = [
  {
    valor: '95%',
    titulo: 'Aceptación en primera revisión*',
    descripcion:
      'Expedientes y entregables aceptados sin requerimientos adicionales cuando se aplican los lineamientos técnicos.',
  },
  {
    valor: '0',
    titulo: 'Sanciones en proyectos acompañados',
    descripcion:
      'Cero sanciones ambientales en proyectos donde llevamos el proceso y el control documental durante la gestión.',
  },
  {
    valor: '+ 10',
    titulo: 'Normas y criterios cubiertos',
    descripcion:
      'Cobertura activa en cumplimiento STPS/SEMARNAT y requerimientos locales, según el alcance del proyecto.',
  },
  {
    valor: '100%',
    titulo: 'Acompañamiento técnico directo',
    descripcion:
      'Atención por especialistas con evidencia documentada y trazable para auditoría e inspección.',
  },
]
</script>

<template>
  <SeccionFullBleed class="my-10 sm:my-14">
    <div class="relative overflow-hidden [clip-path:polygon(0_8%,100%_0,100%_92%,0_100%)]">
      <!-- Fondo -->
      <div class="absolute inset-0 bg-gradient-to-br from-slate-950 via-slate-900 to-slate-950" />

      <!-- Brillos sutiles -->
      <div
        class="absolute inset-0 opacity-20
               bg-[radial-gradient(circle_at_20%_50%,rgba(56,189,248,.35),transparent_55%)]"
      />
      <div
        class="absolute inset-0 opacity-12
               bg-[radial-gradient(circle_at_75%_45%,rgba(34,197,94,.18),transparent_55%)]"
      />

      <!-- Círculos (marca de agua) -->
      <div
        class="pointer-events-none absolute -left-40 top-1/2 h-[560px] w-[560px]
               -translate-y-1/2 rounded-full bg-sky-400/15"
      />
      <div
        class="pointer-events-none absolute -left-10 top-1/2 h-[420px] w-[420px]
               -translate-y-1/2 rounded-full bg-white/6"
      />

      <ContenedorCentrado class="relative py-14 sm:py-20">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-12 items-start">
          <!-- Texto -->
          <div class="lg:col-span-4">
            <div class="text-white">
              <EncabezadoSeccion
                etiqueta="CIFRAS"
                titulo="Impacto generado"
                subtitulo="Indicadores claros para tomar decisiones y reducir riesgo operativo sin inflar números."
                alineacion="izquierda"
              />
            </div>

            <p class="mt-4 text-xs text-white/70">
              *El resultado puede variar según la correcta implementación de las recomendaciones técnicas.
            </p>
          </div>

          <!-- Cards -->
          <div class="lg:col-span-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
              <TarjetaMetrica
                :valor="metricas[0].valor"
                :titulo="metricas[0].titulo"
                :descripcion="metricas[0].descripcion"
                class="transition-all duration-300 ease-out hover:-translate-y-1 hover:shadow-xl
                       hover:shadow-sky-500/10 hover:ring-1 hover:ring-white/15"
              />
              <TarjetaMetrica
                :valor="metricas[1].valor"
                :titulo="metricas[1].titulo"
                :descripcion="metricas[1].descripcion"
                class="transition-all duration-300 ease-out hover:-translate-y-1 hover:shadow-xl
                       hover:shadow-emerald-500/10 hover:ring-1 hover:ring-white/15"
              />
              <TarjetaMetrica
                :valor="metricas[2].valor"
                :titulo="metricas[2].titulo"
                :descripcion="metricas[2].descripcion"
                class="transition-all duration-300 ease-out hover:-translate-y-1 hover:shadow-xl
                       hover:shadow-sky-500/10 hover:ring-1 hover:ring-white/15"
              />
              <TarjetaMetrica
                :valor="metricas[3].valor"
                :titulo="metricas[3].titulo"
                :descripcion="metricas[3].descripcion"
                class="transition-all duration-300 ease-out hover:-translate-y-1 hover:shadow-xl
                       hover:shadow-emerald-500/10 hover:ring-1 hover:ring-white/15"
              />
            </div>
          </div>
        </div>
      </ContenedorCentrado>
    </div>
  </SeccionFullBleed>
</template>

<style scoped>
:deep(h2),
:deep(h3) {
  color: #fff !important;
}
:deep(p) {
  color: rgba(255, 255, 255, 0.75) !important;
}

:deep(.etiqueta),
:deep(.label),
:deep(.kicker) {
  color: rgba(52, 211, 153, 0.95) !important;
}
</style>
