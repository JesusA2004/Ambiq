<script setup lang="ts">
    defineProps<{
      valor: string
      titulo?: string
      descripcion: string
    }>()
    </script>
    
    <template>
      <article
        class="rounded-2xl bg-emerald-600/90 shadow-[0_20px_80px_-40px_rgba(16,185,129,.55)] ring-1 ring-white/10"
      >
        <div class="p-6 sm:p-7">
          <div class="text-3xl sm:text-4xl font-black tracking-tight text-white">
            {{ valor }}
          </div>
    
          <div v-if="titulo" class="mt-3 text-sm font-semibold text-white/90">
            {{ titulo }}
          </div>
    
          <p class="mt-3 text-sm leading-relaxed text-white/90">
            {{ descripcion }}
          </p>
        </div>
      </article>
    </template>
    