<!-- resources/js/components/blog/BlogPostCard.vue -->
<script setup lang="ts">
import { Link } from '@inertiajs/vue3'
import type { BlogPost } from '@/data/blogPosts'

defineProps<{ post: BlogPost }>()
</script>

<template>
  <Link
    :href="`/blog/${post.slug}`"
    class="group block overflow-hidden rounded-2xl border border-slate-200 bg-white
           hover:shadow-lg hover:-translate-y-0.5 transition
           focus:outline-none focus:ring-2 focus:ring-emerald-400/60
           dark:border-white/10 dark:bg-neutral-900/60"
  >
    <div class="relative aspect-[16/9] bg-slate-100 dark:bg-neutral-800">
      <img
        v-if="post.coverImage"
        :src="post.coverImage"
        :alt="post.title"
        class="h-full w-full object-cover"
        loading="lazy"
        draggable="false"
      />
      <div
        v-else
        class="h-full w-full bg-gradient-to-br from-[#0B2C4A]/15 via-emerald-500/10 to-slate-200 dark:to-neutral-900"
      />
      <div
        class="absolute inset-0 bg-gradient-to-t from-black/45 via-black/0 to-black/0
               opacity-0 group-hover:opacity-100 transition"
      />
    </div>

    <div class="p-6">
      <div class="flex flex-wrap items-center gap-2 text-xs">
        <span class="rounded-full bg-emerald-500/10 px-3 py-1 font-semibold text-emerald-700 dark:text-emerald-300">
          Blog
        </span>

        <span v-if="post.readTime" class="text-slate-500 dark:text-neutral-400">
          {{ post.readTime }}
        </span>

        <span v-if="post.date" class="text-slate-400 dark:text-neutral-500">
          · {{ post.date }}
        </span>
      </div>

      <h3 class="mt-3 text-lg font-black text-slate-900 dark:text-white line-clamp-2">
        {{ post.title }}
      </h3>

      <p v-if="post.excerpt" class="mt-2 text-sm text-slate-600 dark:text-neutral-300 line-clamp-3">
        {{ post.excerpt }}
      </p>

      <div class="mt-4 inline-flex items-center gap-2 text-sm font-semibold text-[#0B2C4A] dark:text-sky-200">
        Leer artículo <span aria-hidden="true" class="transition group-hover:translate-x-0.5">→</span>
      </div>
    </div>
  </Link>
</template>
