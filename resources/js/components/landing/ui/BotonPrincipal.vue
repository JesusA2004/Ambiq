<script setup lang="ts">
    import { computed } from 'vue'
    
    type Props = {
      label: string
      href?: string
      tipo?: 'primario' | 'secundario'
      as?: 'a' | 'button'
      disabled?: boolean
    }
    
    const props = withDefaults(defineProps<Props>(), {
      href: '#',
      tipo: 'primario',
      as: 'a',
      disabled: false,
    })
    
    const clases = computed(() => {
      const base =
        'inline-flex items-center justify-center rounded-xl px-5 py-3 text-sm font-black transition ' +
        'focus:outline-none focus:ring-2 focus:ring-emerald-400/60 disabled:opacity-60 disabled:cursor-not-allowed'
    
      const variante =
        props.tipo === 'primario'
          ? 'bg-emerald-600 text-white hover:bg-emerald-700'
          : 'bg-white/10 text-white ring-1 ring-white/15 hover:bg-white/15'
    
      return `${base} ${variante}`
    })
    </script>
    
    <template>
      <a v-if="as === 'a'" :href="href" :class="clases" :aria-disabled="disabled">
        {{ label }}
      </a>
    
      <button v-else type="button" :class="clases" :disabled="disabled">
        {{ label }}
      </button>
    </template>
    