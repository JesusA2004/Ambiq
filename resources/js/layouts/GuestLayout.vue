<script setup>
import GuestNavbar from '@/layouts/Partials/guest/GuestNavbar.vue'
import GuestFooter from '@/layouts/Partials/guest/GuestFooter.vue'
import FloatingActions from '@/components/ui/FloatingActions.vue'
</script>

<template>
  <div
    class="min-h-screen bg-[#FDFDFC] text-[#1b1b18]
           dark:bg-[#0a0a0a] dark:text-[#EDEDEC]"
  >
    <GuestNavbar />

    <main>
      <slot />
    </main>

    <GuestFooter />

    <!-- Acciones flotantes globales -->
    <FloatingActions />
  </div>
</template>
