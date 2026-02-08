<script setup lang="ts">
import { computed, onBeforeUnmount, onMounted, watch } from 'vue'
import { Head, usePage } from '@inertiajs/vue3'
import GuestLayout from '@/layouts/GuestLayout.vue'
import ContenedorCentrado from '@/components/landing/ui/ContenedorCentrado.vue'
import { getPostBySlug } from '@/data/blogPosts'

const props = defineProps<{ slug: string }>()
const post = computed(() => getPostBySlug(props.slug))

const page = usePage<any>()

const siteUrl = 'https://consultoresambiq.com'
const blogPath = '/blog'

// Canonical limpio (sin query/hash)
const canonical = computed(() => {
  const url = (page?.url ?? `${blogPath}/${props.slug}`) as string
  return `${siteUrl}${url.split('?')[0].split('#')[0]}`
})

// Title/description por post (fallbacks sólidos)
const title = computed(() => (post.value ? `Ambiq | ${post.value.title}` : 'Ambiq | Blog'))
const description = computed(() => post.value?.excerpt ?? 'Artículo del blog de AmbiQ Consultores.')

// NO cambiaste imagen: default favicon.
// Si el post tiene coverImage, se usa como OG (mejor CTR). Si no, favicon.
const ogImage = computed(() => {
  const cover = post.value?.coverImage
  if (cover && typeof cover === 'string') {
    // Soporta rutas relativas tipo "/img/..." o absolutas
    return cover.startsWith('http') ? cover : `${siteUrl}${cover.startsWith('/') ? '' : '/'}${cover}`
  }
  return `${siteUrl}/img/favicon.ico`
})

// Helpers fecha ISO
function isoDate(d?: string | null) {
  if (!d) return null
  const t = new Date(d)
  return Number.isNaN(t.getTime()) ? null : t.toISOString()
}

const publishedIso = computed(() => isoDate(post.value?.date ?? null))

// Robots: si no existe el post, NOINDEX (para que no indexe 404s bonitos)
const robots = computed(() => (post.value ? 'index,follow' : 'noindex,follow'))

/**
 * JSON-LD injector (sin <script> en template)
 */
const JSONLD_ID = 'ambiq-jsonld-blog-show'

const jsonLd = computed(() => {
  const p = post.value
  if (!p) {
    return {
      '@context': 'https://schema.org',
      '@graph': [
        {
          '@type': 'WebPage',
          name: title.value,
          url: canonical.value,
          description: description.value,
        },
      ],
    }
  }

  const url = canonical.value

  return {
    '@context': 'https://schema.org',
    '@graph': [
      {
        '@type': 'Organization',
        name: 'AmbiQ Consultores',
        url: siteUrl,
        logo: `${siteUrl}/img/favicon.ico`,
        email: 'contacto@consultoresambiq.com',
        telephone: '+52 425 102 6034',
        sameAs: [
          'https://www.facebook.com/share/1GnU9fFoTy/?mibextid=wwXIfr',
          'https://www.linkedin.com/in/consultoresambiq',
        ],
      },
      {
        '@type': 'WebSite',
        name: 'AmbiQ Consultores',
        url: siteUrl,
      },
      {
        '@type': 'BreadcrumbList',
        itemListElement: [
          {
            '@type': 'ListItem',
            position: 1,
            name: 'Inicio',
            item: siteUrl,
          },
          {
            '@type': 'ListItem',
            position: 2,
            name: 'Blog',
            item: `${siteUrl}${blogPath}`,
          },
          {
            '@type': 'ListItem',
            position: 3,
            name: p.title ?? 'Artículo',
            item: url,
          },
        ],
      },
      {
        '@type': 'BlogPosting',
        headline: p.title ?? 'Artículo',
        description: p.excerpt ?? undefined,
        url,
        mainEntityOfPage: url,
        image: ogImage.value,
        datePublished: publishedIso.value ?? undefined,
        dateModified: publishedIso.value ?? undefined,
        author: {
          '@type': 'Organization',
          name: 'AmbiQ Consultores',
          url: siteUrl,
        },
        publisher: {
          '@type': 'Organization',
          name: 'AmbiQ Consultores',
          url: siteUrl,
          logo: {
            '@type': 'ImageObject',
            url: `${siteUrl}/img/favicon.ico`,
          },
        },
        isPartOf: {
          '@type': 'Blog',
          name: 'Blog - AmbiQ Consultores',
          url: `${siteUrl}${blogPath}`,
        },
        keywords: Array.isArray((p as any)?.tags) ? (p as any).tags.join(', ') : undefined,
      },
    ],
  }
})

function upsertJsonLd() {
  const head = document.head
  if (!head) return

  let el = document.getElementById(JSONLD_ID) as HTMLScriptElement | null
  if (!el) {
    el = document.createElement('script')
    el.id = JSONLD_ID
    el.type = 'application/ld+json'
    head.appendChild(el)
  }
  el.text = JSON.stringify(jsonLd.value)
}

function removeJsonLd() {
  const el = document.getElementById(JSONLD_ID)
  if (el?.parentNode) el.parentNode.removeChild(el)
}

onMounted(() => upsertJsonLd())
watch(jsonLd, () => upsertJsonLd())

onBeforeUnmount(() => {
  removeJsonLd()
})
</script>

<template>
  <Head>
    <title>{{ title }}</title>
    <meta name="description" :content="description" />
    <meta name="robots" :content="robots" />
    <link rel="canonical" :href="canonical" />

    <!-- Open Graph -->
    <meta property="og:type" :content="post ? 'article' : 'website'" />
    <meta property="og:site_name" content="AmbiQ Consultores" />
    <meta property="og:title" :content="title" />
    <meta property="og:description" :content="description" />
    <meta property="og:url" :content="canonical" />
    <meta property="og:image" :content="ogImage" />
    <meta property="og:image:alt" :content="post?.title ?? 'Blog de AmbiQ Consultores'" />
    <meta v-if="post?.date" property="article:published_time" :content="publishedIso ?? undefined" />

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" :content="title" />
    <meta name="twitter:description" :content="description" />
    <meta name="twitter:image" :content="ogImage" />
  </Head>

  <GuestLayout
    v-if="post"
    :title="`Ambiq | ${post.title}`"
    :description="post.excerpt"
  >
    <section class="py-10 sm:py-14">
      <ContenedorCentrado>
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
