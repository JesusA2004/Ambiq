<script setup lang="ts">
    import ContenedorCentrado from '@/components/landing/ui/ContenedorCentrado.vue'
    
    type Paso = { titulo: string; descripcion: string }
    const pasos: Paso[] = [
      { titulo: 'Diagnóstico', descripcion: 'Levantamiento y brecha contra normativas (editable).' },
      { titulo: 'Plan', descripcion: 'Ruta de cumplimiento con hitos y responsables (editable).' },
      { titulo: 'Ejecución', descripcion: 'Implementación y evidencia lista para auditoría (editable).' },
      { titulo: 'Seguimiento', descripcion: 'Control y mejora continua (editable).' },
    ]
    </script>
    
    <template>
      <section class="py-12 sm:py-16">
        <ContenedorCentrado>
          <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
            <div class="lg:col-span-4">
              <div class="text-xs font-semibold tracking-[0.2em] uppercase text-emerald-700 dark:text-emerald-300">
                Método
              </div>
              <h2 class="mt-2 text-2xl sm:text-3xl font-black text-slate-900 dark:text-white">
                Metodología clara, entregables claros
              </h2>
              <p class="mt-3 text-sm sm:text-base text-slate-600 dark:text-neutral-300">
                Sección lista para que cambies textos, pasos o agregues/quites tarjetas.
              </p>
            </div>
    
            <div class="lg:col-span-8">
              <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div
                  v-for="(p, i) in pasos"
                  :key="i"
                  class="rounded-2xl border border-slate-200/70 bg-white p-6 shadow-sm
                         dark:border-white/10 dark:bg-neutral-900/60"
                >
                  <div class="text-xs font-black text-emerald-700 dark:text-emerald-300">
                    Paso {{ i + 1 }}
                  </div>
                  <div class="mt-2 text-lg font-black text-slate-900 dark:text-white">
                    {{ p.titulo }}
                  </div>
                  <p class="mt-2 text-sm leading-relaxed text-slate-600 dark:text-neutral-300">
                    {{ p.descripcion }}
                  </p>
                </div>
              </div>
            </div>
          </div>
        </ContenedorCentrado>
      </section>
    </template>
    