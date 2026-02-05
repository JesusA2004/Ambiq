<!-- resources/js/Pages/Blog/Show.vue -->
<script setup lang="ts">
import { computed } from 'vue'
import GuestLayout from '@/layouts/GuestLayout.vue'
import ContenedorCentrado from '@/components/landing/ui/ContenedorCentrado.vue'
import { getPostBySlug } from '@/data/blogPosts'

const props = defineProps<{ slug: string }>()
const post = computed(() => getPostBySlug(props.slug))
</script>

<template>
  <GuestLayout
    v-if="post"
    :title="`Ambiq | ${post.title}`"
    :description="post.excerpt"
  >
    <section class="py-10 sm:py-14">
      <ContenedorCentrado>
        <!-- Antes: max-w-3xl -->
        <div class="mx-auto w-full max-w-5xl">
          <div class="flex flex-wrap items-center gap-2 text-xs">
            <span
              class="rounded-full bg-emerald-500/10 px-3 py-1 font-semibold text-emerald-700 dark:text-emerald-300"
            >
              Blog
            </span>
            <span v-if="post.readTime" class="text-slate-500 dark:text-neutral-400">
              {{ post.readTime }}
            </span>
            <span v-if="post.date" class="text-slate-400 dark:text-neutral-500">
              · {{ post.date }}
            </span>
          </div>

          <h1 class="mt-3 text-3xl sm:text-4xl font-black text-[#0B2C4A] dark:text-sky-200">
            {{ post.title }}
          </h1>

          <!-- Justificado -->
          <p class="mt-3 text-slate-600 dark:text-neutral-300 text-justify">
            {{ post.excerpt }}
          </p>

          <div
            v-if="post.coverImage"
            class="mt-8 overflow-hidden rounded-3xl border border-slate-200 dark:border-white/10"
          >
            <img :src="post.coverImage" :alt="post.title" class="h-auto w-full object-cover" />
          </div>

          <article class="mt-8 space-y-6">
            <template v-for="(block, i) in post.content" :key="i">
              <h2
                v-if="block.type === 'h2'"
                class="text-xl font-black text-[#0B2C4A] dark:text-sky-200"
              >
                {{ block.text }}
              </h2>

              <!-- Justificado -->
              <p
                v-else-if="block.type === 'p'"
                class="text-slate-700 dark:text-neutral-200 leading-relaxed text-justify"
              >
                {{ block.text }}
              </p>

              <ul
                v-else-if="block.type === 'ul'"
                class="rounded-2xl border border-emerald-500/25 bg-emerald-50/70 p-5 space-y-2
                       dark:bg-emerald-500/10 dark:border-emerald-400/20"
              >
                <li v-for="(item, k) in block.items" :key="k" class="flex gap-3">
                  <span class="mt-2 h-2 w-2 shrink-0 rounded-full bg-emerald-600 dark:bg-emerald-400" />
                  <span class="text-slate-800 dark:text-neutral-200">{{ item }}</span>
                </li>
              </ul>
            </template>
          </article>
        </div>
      </ContenedorCentrado>
    </section>
  </GuestLayout>

  <GuestLayout v-else title="Ambiq | Blog">
    <section class="py-10 sm:py-14">
      <ContenedorCentrado>
        <div class="rounded-2xl border border-slate-200 bg-white p-6 dark:border-white/10 dark:bg-neutral-900/60">
          <h1 class="text-lg font-black text-slate-900 dark:text-white">Artículo no encontrado</h1>
          <p class="mt-2 text-sm text-slate-600 dark:text-neutral-300">
            Revisa el enlace o vuelve al listado del blog.
          </p>
          <a
            href="/blog"
            class="mt-4 inline-flex items-center gap-2 text-sm font-semibold text-[#0B2C4A] dark:text-sky-200"
          >
            Volver al blog →
          </a>
        </div>
      </ContenedorCentrado>
    </section>
  </GuestLayout>
</template>
