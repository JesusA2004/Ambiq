<script setup lang="ts">
import ContenedorCentrado from '@/components/landing/ui/ContenedorCentrado.vue'
import BotonPrincipal from '@/components/landing/ui/BotonPrincipal.vue'
</script>

<template>
  <section class="py-12 sm:py-16" id="servicios">
    <ContenedorCentrado>
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
        <!-- Visual -->
        <div class="lg:col-span-6">
          <div
  class="relative aspect-[16/10] overflow-hidden rounded-3xl
         ring-1 ring-slate-200/70 dark:ring-white/10"
>
            <img
    src="/img/servicios/visual-1.png"
    alt="Cumplimiento normativo y gestión ambiental"
    class="h-full w-full object-cover"
    loading="lazy"
  />
          </div>
        </div>

        <!-- Contenido -->
        <div class="lg:col-span-6">
          <h2 class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white">
            Cumplimiento normativo sin fricción operativa
          </h2>

          <p class="mt-3 text-sm sm:text-base leading-relaxed text-slate-600 dark:text-neutral-300">
            Integramos seguridad, higiene y medio ambiente en la operación diaria de tu empresa.
            Reducimos riesgos, prevenimos sanciones y dejamos evidencia técnica clara para auditorías
            e inspecciones, sin detener tu operación.
          </p>

          <ul class="mt-6 space-y-3 text-sm text-slate-700 dark:text-neutral-200">
            <li class="flex gap-3">
              <span class="mt-1 h-2.5 w-2.5 rounded-full bg-emerald-500"></span>
              Enfoque preventivo que elimina contingencias antes de convertirse en multas.
            </li>

            <li class="flex gap-3">
              <span class="mt-1 h-2.5 w-2.5 rounded-full bg-emerald-500"></span>
              Documentación técnica trazable, clara y lista para revisión de autoridad.
            </li>

            <li class="flex gap-3">
              <span class="mt-1 h-2.5 w-2.5 rounded-full bg-emerald-500"></span>
              Acompañamiento continuo: diagnóstico, ejecución y control.
            </li>
          </ul>

          <div class="mt-7">
            <BotonPrincipal label="Solicitar diagnóstico" href="#contacto" tipo="primario" />
          </div>
        </div>
      </div>
    </ContenedorCentrado>
  </section>
</template>
