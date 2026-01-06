<template>
  <div
    class="bg-card border rounded-lg p-6 hover:shadow-lg transition-all duration-300 hover:-translate-y-1 flex flex-col h-full"
    :style="{ animationDelay: `${delay}ms` }"
  >
    <div class="mb-4">
      <img
        :src="solution.icon"
        :alt="solution.title"
        class="w-12 h-12"
      />
    </div>
    <h2 class="text-xl font-bold mb-3">{{ solution.title }}</h2>
    <p class="text-muted-foreground mb-6 flex-grow">{{ solution.description }}</p>
    <Link
      :href="solution.href"
      class="flex items-center gap-2 text-sm font-medium text-primary hover:gap-3 transition-all group"
    >
      <span>más detalles</span>
      <svg
        class="w-5 h-5 transition-transform group-hover:translate-x-1"
        fill="none"
        stroke="currentColor"
        viewBox="0 0 24 24"
      >
        <path
          stroke-linecap="round"
          stroke-linejoin="round"
          stroke-width="2"
          d="M9 5l7 7-7 7"
        />
      </svg>
    </Link>
  </div>
</template>

<script setup lang="ts">
import { Link } from '@inertiajs/vue3';

interface Solution {
  icon: string;
  title: string;
  description: string;
  href: string;
}

defineProps<{
  solution: Solution;
  delay?: number;
}>();
</script>

<style scoped>
@keyframes fade-in {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

div {
  animation: fade-in 0.6s ease-out both;
}
</style>
