<template>
  <div class="min-h-screen">
    <Header />
    <main>
      <HeroSection />
      <Breadcrumbs :breadcrumbs="breadcrumbs" />
      <IntroductionSection />
      <SolutionsGrid />
      <StatisticsSection />
    </main>
    <Footer />
    <WhatsAppPopup ref="whatsappPopup" />
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { route } from 'ziggy-js';
import Header from '@/components/Header.vue';
import HeroSection from '@/components/HeroSection.vue';
import Breadcrumbs from '@/components/Breadcrumbs.vue';
import IntroductionSection from '@/components/IntroductionSection.vue';
import SolutionsGrid from '@/components/SolutionsGrid.vue';
import StatisticsSection from '@/components/StatisticsSection.vue';
import Footer from '@/components/Footer.vue';
import WhatsAppPopup from '@/components/WhatsAppPopup.vue';

const whatsappPopup = ref<InstanceType<typeof WhatsAppPopup> | null>(null);

const breadcrumbs = [
  { title: 'Home', href: route('home') },
  { title: 'Soluciones' },
];

onMounted(() => {
  // Abrir popup de WhatsApp después de un delay (opcional)
  // setTimeout(() => {
  //   whatsappPopup.value?.openPopup();
  // }, 5000);
});
</script>
