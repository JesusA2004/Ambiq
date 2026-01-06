<script setup lang="ts">
    import ContenedorCentrado from '@/components/landing/ui/ContenedorCentrado.vue'
    import BotonPrincipal from '@/components/landing/ui/BotonPrincipal.vue'
    </script>
    
    <template>
      <section class="py-12 sm:py-16" id="servicios">
        <ContenedorCentrado>
          <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
            <div class="lg:col-span-6">
              <div class="aspect-[16/10] rounded-3xl bg-slate-100 ring-1 ring-slate-200/70
                          dark:bg-neutral-900/60 dark:ring-white/10" />
            </div>
    
            <div class="lg:col-span-6">
              <h2 class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white">
                Sección dividida (editable)
              </h2>
              <p class="mt-3 text-sm sm:text-base leading-relaxed text-slate-600 dark:text-neutral-300">
                Texto de apoyo. Aquí explicas el “cómo” y el “por qué”.
              </p>
    
              <ul class="mt-6 space-y-3 text-sm text-slate-700 dark:text-neutral-200">
                <li class="flex gap-3">
                  <span class="mt-1 h-2.5 w-2.5 rounded-full bg-emerald-500"></span>
                  Punto 1 (editable)
                </li>
                <li class="flex gap-3">
                  <span class="mt-1 h-2.5 w-2.5 rounded-full bg-emerald-500"></span>
                  Punto 2 (editable)
                </li>
                <li class="flex gap-3">
                  <span class="mt-1 h-2.5 w-2.5 rounded-full bg-emerald-500"></span>
                  Punto 3 (editable)
                </li>
              </ul>
    
              <div class="mt-7">
                <BotonPrincipal label="Conoce más" href="#contacto" tipo="primario" />
              </div>
            </div>
          </div>
        </ContenedorCentrado>
      </section>
    </template>
    