<!-- resources/js/Pages/Blog/Index.vue -->
<script setup lang="ts">
import { computed, onBeforeUnmount, onMounted, watch } from 'vue'
import { Head, usePage } from '@inertiajs/vue3'

import GuestLayout from '@/layouts/GuestLayout.vue'
import ContenedorCentrado from '@/components/landing/ui/ContenedorCentrado.vue'
import BlogPostCard from '@/components/blog/BlogPostCard.vue'
import { blogPosts } from '@/data/blogPosts'

defineOptions({ layout: GuestLayout })

const posts = [...blogPosts].sort((a, b) => {
  const da = a.date ? new Date(a.date).getTime() : 0
  const db = b.date ? new Date(b.date).getTime() : 0
  return db - da
})

const page = usePage<any>()

const siteUrl = 'https://consultoresambiq.com'
const blogPath = '/blog'

// Canonical limpio (sin query/hash)
const canonical = computed(() => {
  const url = (page?.url ?? blogPath) as string
  return `${siteUrl}${url.split('?')[0].split('#')[0]}`
})

// SEO básico
const title = 'Blog'
const description =
  'Artículos prácticos y directos sobre cumplimiento ambiental, protección civil y seguridad laboral en México: riesgos, normatividad y continuidad operativa.'
const ogImage = `${siteUrl}/img/favicon.ico` // ideal 1200x630

// Helpers para JSON-LD
function isoDate(d?: string | null) {
  if (!d) return null
  const t = new Date(d)
  return Number.isNaN(t.getTime()) ? null : t.toISOString()
}

const latestPostIso = computed(() => {
  const first = posts[0]
  return isoDate(first?.date ?? null)
})

/**
 * JSON-LD (CollectionPage + Blog + ItemList)
 * - Evita <script> dentro del template (Vite lo ignora en SFC templates)
 */
const JSONLD_ID = 'ambiq-jsonld-blog-index'

const jsonLd = computed(() => {
  const itemList = posts.map((p, idx) => {
    const url = `${siteUrl}${blogPath}/${p.slug}`
    const published = isoDate(p.date ?? null)

    // Ajusta campos si existen en tu data: p.excerpt, p.image, p.authorName, etc.
    const name = p.title ?? 'Artículo'
    const description = (p.excerpt ?? '').toString()

    return {
      '@type': 'ListItem',
      position: idx + 1,
      url,
      item: {
        '@type': 'BlogPosting',
        headline: name,
        url,
        datePublished: published ?? undefined,
        dateModified: published ?? undefined,
        description: description || undefined,
        mainEntityOfPage: url,
        // image: p.image ? `${siteUrl}${p.image}` : undefined,
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
      },
    }
  })

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
        '@type': 'Blog',
        name: 'Blog - AmbiQ Consultores',
        url: `${siteUrl}${blogPath}`,
        description,
        publisher: {
          '@type': 'Organization',
          name: 'AmbiQ Consultores',
          url: siteUrl,
        },
      },
      {
        '@type': 'CollectionPage',
        name: title,
        url: canonical.value,
        description,
        isPartOf: { '@type': 'WebSite', url: siteUrl },
        about: [
          'Cumplimiento ambiental',
          'Protección civil',
          'Seguridad laboral',
          'Gestión de riesgos',
        ],
        dateModified: latestPostIso.value ?? undefined,
        mainEntity: {
          '@type': 'ItemList',
          itemListOrder: 'http://schema.org/ItemListOrderDescending',
          numberOfItems: posts.length,
          itemListElement: itemList,
        },
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
  // Si el blog es SPA, puedes dejarlo; aquí lo removemos para evitar duplicados.
  removeJsonLd()
})
</script>

<template>
  <Head>
    <title>{{ title }}</title>
    <meta name="description" :content="description" />
    <link rel="canonical" :href="canonical" />

    <!-- Open Graph -->
    <meta property="og:type" content="website" />
    <meta property="og:site_name" content="AmbiQ Consultores" />
    <meta property="og:title" :content="title" />
    <meta property="og:description" :content="description" />
    <meta property="og:url" :content="canonical" />
    <meta property="og:image" :content="ogImage" />
    <meta property="og:image:alt" content="Blog de AmbiQ Consultores" />

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" :content="title" />
    <meta name="twitter:description" :content="description" />
    <meta name="twitter:image" :content="ogImage" />
  </Head>

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
</template>
