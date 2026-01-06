<script setup lang="ts">
    import ContenedorCentrado from '@/components/landing/ui/ContenedorCentrado.vue'
    import TarjetaFeature from '@/components/landing/ui/TarjetaFeature.vue'
    
    type Feature = { titulo: string; descripcion: string; etiqueta?: string }
    
    const features: Feature[] = [
      { etiqueta: 'Cumplimiento', titulo: 'Feature 1', descripcion: 'Descripción editable del feature.' },
      { etiqueta: 'Riesgo', titulo: 'Feature 2', descripcion: 'Descripción editable del feature.' },
      { etiqueta: 'Operación', titulo: 'Feature 3', descripcion: 'Descripción editable del feature.' },
      { etiqueta: 'Documentación', titulo: 'Feature 4', descripcion: 'Descripción editable del feature.' },
      { etiqueta: 'Auditoría', titulo: 'Feature 5', descripcion: 'Descripción editable del feature.' },
      { etiqueta: 'Ejecución', titulo: 'Feature 6', descripcion: 'Descripción editable del feature.' },
    ]
    </script>
    
    <template>
      <section class="py-12 sm:py-16">
        <ContenedorCentrado>
          <div class="flex flex-col gap-2">
            <div class="text-xs font-semibold tracking-[0.2em] uppercase text-emerald-700 dark:text-emerald-300">
              Servicios
            </div>
            <h2 class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white">Lo que resolvemos</h2>
            <p class="mt-1 max-w-2xl text-sm sm:text-base text-slate-600 dark:text-neutral-300">
              Bloques modulares para que puedas quitar o agregar sin romper el layout.
            </p>
          </div>
    
          <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <TarjetaFeature
              v-for="(f, i) in features"
              :key="i"
              :titulo="f.titulo"
              :descripcion="f.descripcion"
              :etiqueta="f.etiqueta"
            />
          </div>
        </ContenedorCentrado>
      </section>
    </template>
    