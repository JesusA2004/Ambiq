<script setup lang="ts">
    type Props = {
      etiqueta?: string
      titulo: string
      subtitulo?: string
      alineacion?: 'izquierda' | 'centro'
      tono?: 'claro' | 'oscuro'
    }
    
    const props = withDefaults(defineProps<Props>(), {
      etiqueta: '',
      subtitulo: '',
      alineacion: 'izquierda',
      tono: 'oscuro',
    })
    </script>
    
    <template>
      <header
        :class="[
          alineacion === 'centro' ? 'text-center items-center' : 'text-left items-start',
          'flex flex-col gap-3',
        ]"
      >
        <p
          v-if="etiqueta"
          :class="[
            'text-xs font-black tracking-[0.25em] uppercase',
            tono === 'claro' ? 'text-emerald-200/90' : 'text-emerald-400/90',
          ]"
        >
          {{ etiqueta }}
        </p>
    
        <h2
          :class="[
            'text-3xl sm:text-4xl font-black leading-tight',
            tono === 'claro' ? 'text-white' : 'text-slate-900 dark:text-white',
          ]"
        >
          {{ titulo }}
        </h2>
    
        <p
          v-if="subtitulo"
          :class="[
            'max-w-2xl text-sm sm:text-base leading-relaxed',
            tono === 'claro' ? 'text-white/80' : 'text-slate-600 dark:text-white/70',
          ]"
        >
          {{ subtitulo }}
        </p>
      </header>
    </template>
    