<!-- resources/js/Pages/Index.vue -->
<script setup lang="ts">
import { computed, onBeforeUnmount, onMounted, watch, nextTick } from 'vue'
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
const siteUrl = 'https://www.consultoresambiq.com'

const canonical = computed(() => {
  const url = (page?.url ?? '/') as string
  return `${siteUrl}${url.split('?')[0].split('#')[0]}`
})

const title = 'AmbiQ Consultores'
const description =
  'Cumple regulaciones, evita sanciones y ejecuta proyectos sostenibles con consultoría integral en cumplimiento ambiental, protección civil y seguridad laboral en México.'
const ogImage = `${siteUrl}/public/img/logo.svg`

const section = computed(() => (page?.props?.section ?? null) as string | null)

const jsonLd = computed(() => ({
  '@context': 'https://schema.org',
  '@graph': [
    {
      '@type': 'Organization',
      name: 'Ambiq Consultores',
      url: siteUrl,
      logo: `${siteUrl}/favicon.ico`,
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

function scrollToId(id: string) {
  const el = document.getElementById(id) as HTMLElement | null
  if (!el) return

  el.classList.add('ring-2', 'ring-emerald-400/35')
  setTimeout(() => el.classList.remove('ring-2', 'ring-emerald-400/35'), 850)

  el.scrollIntoView({ behavior: 'smooth', block: 'start' })
}

async function handleScrollTarget() {
  await nextTick()

  // 1) prioridad: prop section (viene desde /servicios, /impacto, etc.)
  if (section.value) {
    requestAnimationFrame(() => scrollToId(section.value as string))
    return
  }

  // 2) fallback: hash si alguien entra por /#servicios (por histórico)
  const h = window.location.hash || ''
  if (h.startsWith('#')) {
    const id = h.replace('#', '')
    if (id) requestAnimationFrame(() => scrollToId(id))
  }
}

onMounted(() => {
  upsertJsonLd()
  handleScrollTarget()
})

watch(jsonLd, () => upsertJsonLd())

watch(section, () => {
  handleScrollTarget()
})

onBeforeUnmount(() => {
  removeJsonLd()
})
</script>

<template>
  <Head :title="title">
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

    <link rel="icon" href="/favicon.ico?v=2" />
    <link rel="icon" type="image/svg+xml" href="/favicon.svg?v=2" />
    <link rel="apple-touch-icon" href="/apple-touch-icon.png?v=2" />
  </Head>

  <div class="min-h-screen bg-[#FDFDFC] text-[#1b1b18] dark:bg-[#0a0a0a]">
    <section id="inicio">
      <HeroSection />
    </section>

    <section id="quienes-somos">
      <SplitSection />
    </section>

    <section id="impacto">
      <ImpactSection />
    </section>

    <section id="servicios">
      <FeatureGrid />
    </section>

    <section id="proceso">
      <HiringSection />
    </section>

    <section id="contacto">
      <CTASection />
    </section>

    <section id="faq">
      <FAQSection />
    </section>

    <div class="hidden h-14.5 lg:block"></div>
  </div>
</template>
