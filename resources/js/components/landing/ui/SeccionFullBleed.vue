<script setup lang="ts">
    defineProps<{
      class?: string
    }>()
    </script>
    
    <template>
      <!-- Full-bleed real -->
      <section
        class="relative w-screen left-1/2 right-1/2 -ml-[50vw] -mr-[50vw]"
        :class="$props.class"
      >
        <slot />
      </section>
    </template>
    