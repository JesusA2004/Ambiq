<script setup lang="ts">
    import { Head } from '@inertiajs/vue3'
    
    import GuestLayout from '@/layouts/GuestLayout.vue'
    
    import HeroSection from '@/components/landing/HeroSection.vue'
    import SplitSection from '@/components/landing/SplitSection.vue'
    import ImpactSection from '@/components/landing/ImpactSection.vue'
    import FeatureGrid from '@/components/landing/FeatureGrid.vue'
    import MethodologySection from '@/components/landing/MethodologySection.vue'
    import LogosStrip from '@/components/landing/LogosStrip.vue'
    import CTASection from '@/components/landing/CTASection.vue'
    
    defineOptions({ layout: GuestLayout })
    
    const siteUrl = 'https://ambiq.com'
    const title = 'Consultoría integral en medio ambiente y seguridad industrial | Tu marca'
    const description =
      'Cumple regulaciones, evita sanciones y ejecuta proyectos sostenibles con consultoría integral en cumplimiento ambiental, protección civil y seguridad laboral en México.'
    const ogImage = `${siteUrl}/img/og/og-cover.jpg`
    </script>
    
    <template>
      <Head :title="title">
        <meta name="description" :content="description" />
        <link rel="canonical" :href="siteUrl" />
    
        <meta property="og:type" content="website" />
        <meta property="og:title" :content="title" />
        <meta property="og:description" :content="description" />
        <meta property="og:url" :content="siteUrl" />
        <meta property="og:image" :content="ogImage" />
    
        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:title" :content="title" />
        <meta name="twitter:description" :content="description" />
        <meta name="twitter:image" :content="ogImage" />
    
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
      </Head>
    
      <div class="min-h-screen bg-[#FDFDFC] text-[#1b1b18] dark:bg-[#0a0a0a]">
        <HeroSection />
        <SplitSection />
        <ImpactSection />
        <FeatureGrid />
        <MethodologySection />
        <LogosStrip />
        <CTASection />
    
        <div class="hidden h-14.5 lg:block"></div>
      </div>
    </template>
    