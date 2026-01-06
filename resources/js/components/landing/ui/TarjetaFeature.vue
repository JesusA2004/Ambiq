<script setup lang="ts">
    defineProps<{
      titulo: string
      descripcion: string
      etiqueta?: string
    }>()
    </script>
    
    <template>
      <article
        class="group rounded-2xl border border-slate-200/70 bg-white p-6 shadow-sm transition
               hover:-translate-y-0.5 hover:shadow-lg
               dark:border-white/10 dark:bg-neutral-900/60"
      >
        <div class="flex items-start justify-between gap-3">
          <div>
            <div v-if="etiqueta" class="text-xs font-semibold text-emerald-700 dark:text-emerald-300">
              {{ etiqueta }}
            </div>
            <h3 class="mt-1 text-lg font-black text-slate-900 dark:text-white">
              {{ titulo }}
            </h3>
          </div>
    
          <div
            class="h-10 w-10 shrink-0 rounded-xl bg-emerald-600/10 ring-1 ring-emerald-600/15
                   dark:bg-emerald-400/10 dark:ring-emerald-300/20"
          />
        </div>
    
        <p class="mt-3 text-sm leading-relaxed text-slate-600 dark:text-neutral-300">
          {{ descripcion }}
        </p>
      </article>
    </template>
    