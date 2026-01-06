<script setup lang="ts">
    import ContenedorCentrado from '@/components/landing/ui/ContenedorCentrado.vue'
    import BotonPrincipal from '@/components/landing/ui/BotonPrincipal.vue'
    </script>
    
    <template>
      <section class="pt-10 sm:pt-14">
        <ContenedorCentrado>
          <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
            <div class="lg:col-span-7">
    
              <h1 class="mt-5 text-4xl sm:text-5xl font-black tracking-tight text-slate-900 dark:text-white">
                Título principal de impacto (editable)
              </h1>
    
              <p class="mt-4 text-base sm:text-lg leading-relaxed text-slate-600 dark:text-neutral-300">
                Descripción corta. Aquí va tu propuesta de valor. (Editable)
              </p>
    
              <div class="mt-7 flex flex-col sm:flex-row gap-3">
                <BotonPrincipal label="Acción principal" href="#contacto" tipo="primario" />
                <BotonPrincipal label="Acción secundaria" href="#servicios" tipo="secundario" />
              </div>
            </div>
    
            <div class="lg:col-span-5">
              <!-- Imagen/video después: por ahora bloque -->
              <div class="aspect-[4/3] rounded-3xl border border-slate-200/70 bg-gradient-to-br from-slate-100 to-white shadow-sm
                          dark:border-white/10 dark:from-neutral-900 dark:to-neutral-950" />
            </div>
          </div>
        </ContenedorCentrado>
      </section>
    </template>
    