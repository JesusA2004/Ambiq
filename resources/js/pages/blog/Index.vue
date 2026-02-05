<script setup lang="ts">
import GuestLayout from '@/layouts/GuestLayout.vue'
import ContenedorCentrado from '@/components/landing/ui/ContenedorCentrado.vue'
import BlogPostCard from '@/components/blog/BlogPostCard.vue'
import { blogPosts } from '@/data/blogPosts'

const posts = [...blogPosts].sort((a, b) => (a.publishedAt < b.publishedAt ? 1 : -1))
</script>

<template>
  <GuestLayout>
    <section class="py-10 sm:py-14">
      <ContenedorCentrado>
        <div class="flex flex-col gap-3">
          <div class="text-xs font-semibold tracking-[0.25em] uppercase text-emerald-700 dark:text-emerald-300">
            Blog
          </div>

          <h1 class="text-3xl sm:text-4xl font-black text-slate-900 dark:text-white">
            Ideas claras para cumplimiento y prevención
          </h1>

          <p class="max-w-2xl text-sm sm:text-base text-slate-600 dark:text-neutral-300">
            Contenido práctico, directo y orientado a decisiones: normatividad, riesgos y continuidad operativa.
          </p>
        </div>

        <div class="mt-8 grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
          <BlogPostCard v-for="p in posts" :key="p.slug" :post="p" />
        </div>
      </ContenedorCentrado>
    </section>
  </GuestLayout>
</template>
