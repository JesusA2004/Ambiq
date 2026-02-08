<!-- resources/js/Pages/Index.vue -->
<script setup lang="ts">
import { computed, onBeforeUnmount, onMounted, watch } from 'vue'
import { Head, usePage } from '@inertiajs/vue3'
import GuestLayout from '@/layouts/GuestLayout.vue'

import HeroSection from '@/components/landing/HeroSection.vue'
import SplitSection from '@/components/landing/SplitSection.vue'
import ImpactSection from '@/components/landing/ImpactSection.vue'
import FeatureGrid from '@/components/landing/ServiciosSection.vue'
import HiringSection from '@/components/landing/HiringSection.vue'
import CTASection from '@/components/landing/CTASection.vue'
import FAQSection from '@/components/landing/FAQSection.vue'

defineOptions({ layout: GuestLayout })

const page = usePage<any>()
const siteUrl = 'https://consultoresambiq.com'

const canonical = computed(() => {
  const url = (page?.url ?? '/') as string
  return `${siteUrl}${url.split('?')[0].split('#')[0]}`
})

const title = 'AmbiQ Consultores'
const description =
  'Cumple regulaciones, evita sanciones y ejecuta proyectos sostenibles con consultoría integral en cumplimiento ambiental, protección civil y seguridad laboral en México.'
const ogImage = `${siteUrl}/img/logo.svg`

const jsonLd = computed(() => ({
  '@context': 'https://schema.org',
  '@graph': [
    {
      '@type': 'Organization',
      name: 'Ambiq Consultores',
      url: siteUrl,
      logo: `${siteUrl}/img/favicon.ico`,
      email: 'contacto@consultoresambiq.com',
      telephone: '+52 425 102 6034',
      sameAs: [
        'https://www.facebook.com/share/1GnU9fFoTy/?mibextid=wwXIfr',
        'https://www.linkedin.com/in/consultoresambiq',
      ],
    },
    { '@type': 'WebSite', name: 'Ambiq Consultores', url: siteUrl },
  ],
}))

/**
 * JSON-LD injector (no <script> en template)
 */
const JSONLD_ID = 'ambiq-jsonld'

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

onMounted(() => {
  upsertJsonLd()
})

watch(jsonLd, () => {
  upsertJsonLd()
})

onBeforeUnmount(() => {
  // En SPA navigation no siempre quieres removerlo, pero en landing es ok.
  // Si luego lo haces global, lo quitas.
  removeJsonLd()
})
</script>

<template>
  <Head>
    <meta name="description" :content="description" />
    <link rel="canonical" :href="canonical" />

    <meta property="og:type" content="website" />
    <meta property="og:title" :content="title" />
    <meta property="og:description" :content="description" />
    <meta property="og:url" :content="canonical" />
    <meta property="og:image" :content="ogImage" />

    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" :content="title" />
    <meta name="twitter:description" :content="description" />
    <meta name="twitter:image" :content="ogImage" />
  </Head>

  <div class="min-h-screen bg-[#FDFDFC] text-[#1b1b18] dark:bg-[#0a0a0a]">
    <HeroSection />
    <SplitSection />
    <ImpactSection />
    <FeatureGrid />
    <HiringSection />
    <CTASection />
    <FAQSection />

    <div class="hidden h-14.5 lg:block"></div>
  </div>
</template>
