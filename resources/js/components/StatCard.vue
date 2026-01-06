<template>
  <div
    class="bg-gradient-to-br from-primary/5 to-background border rounded-lg p-6 text-center"
    :style="{ animationDelay: `${delay}ms` }"
  >
    <p
      v-if="stat.prefix"
      class="text-sm text-muted-foreground mb-2"
    >
      {{ stat.prefix }}
    </p>
    <h3 class="text-4xl font-bold mb-4">{{ stat.number }}</h3>
    <p class="text-sm text-muted-foreground">
      <template v-if="stat.highlight">
        <strong class="text-foreground">{{ stat.highlight }}</strong>
        <span v-if="stat.description.includes(stat.highlight)">
          {{ stat.description.split(stat.highlight)[1] }}
        </span>
        <span v-else>{{ stat.description }}</span>
      </template>
      <span v-else>{{ stat.description }}</span>
    </p>
  </div>
</template>

<script setup lang="ts">
interface Statistic {
  number: string;
  description: string;
  highlight?: string;
  prefix?: string;
}

defineProps<{
  stat: Statistic;
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
