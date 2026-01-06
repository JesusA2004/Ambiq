<script setup lang="ts">
    defineProps<{ class?: string }>()
    </script>
    
    <template>
      <div class="mx-auto w-full max-w-6xl px-6 lg:px-8" :class="$props.class">
        <slot />
      </div>
    </template>
    