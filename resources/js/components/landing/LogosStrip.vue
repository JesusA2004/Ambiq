<script setup lang="ts">
    import ContenedorCentrado from '@/components/landing/ui/ContenedorCentrado.vue'
    
    const logos = Array.from({ length: 6 }, (_, i) => `Logo ${i + 1}`)
    </script>
    
    <template>
      <section class="py-10 sm:py-12">
        <ContenedorCentrado>
          <div class="rounded-2xl border border-slate-200/70 bg-white/70 p-6
                      dark:border-white/10 dark:bg-neutral-900/40">
            <div class="text-center text-xs font-semibold tracking-[0.2em] uppercase text-slate-500 dark:text-neutral-300">
              Confían en nosotros
            </div>
    
            <div class="mt-6 grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4">
              <div
                v-for="(l, i) in logos"
                :key="i"
                class="h-12 rounded-xl bg-slate-100 ring-1 ring-slate-200/70
                       dark:bg-neutral-900 dark:ring-white/10"
                :title="l"
              />
            </div>
          </div>
        </ContenedorCentrado>
      </section>
    </template>
    