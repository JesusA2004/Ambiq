<template>
  <header class="sticky top-0 z-50 w-full border-b bg-background/95 backdrop-blur supports-[backdrop-filter]:bg-background/60">
    <div class="container mx-auto px-4">
      <nav class="flex items-center justify-between h-20">
        <!-- Logo -->
        <div class="flex items-center">
          <Link :href="route('home')" class="flex items-center">
            <img
              :src="logoUrl"
              alt="IÉSIMA Logo"
              class="h-12 w-auto"
            />
          </Link>
        </div>

        <!-- Desktop Navigation -->
        <div class="hidden lg:flex items-center gap-8">
          <Link
            v-for="item in menuItems"
            :key="item.href"
            :href="item.href"
            class="text-sm font-medium transition-colors hover:text-primary relative group"
            :class="{ 'text-primary': isActive(item.href) }"
          >
            {{ item.label }}
            <span
              v-if="item.children"
              class="ml-1 inline-block transition-transform group-hover:rotate-180"
            >
              <svg
                class="w-4 h-4 inline"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M19 9l-7 7-7-7"
                />
              </svg>
            </span>
            <!-- Dropdown Menu -->
            <div
              v-if="item.children"
              class="absolute top-full left-0 mt-2 w-64 bg-background border rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200"
            >
              <div class="py-2">
                <Link
                  v-for="child in item.children"
                  :key="child.href"
                  :href="child.href"
                  class="block px-4 py-2 text-sm hover:bg-accent transition-colors"
                >
                  {{ child.label }}
                </Link>
              </div>
            </div>
          </Link>
        </div>

        <!-- Contact Button -->
        <div class="hidden lg:block">
          <Link
            :href="route('contact')"
            class="px-6 py-2 bg-primary text-primary-foreground rounded-md text-sm font-medium hover:bg-primary/90 transition-colors"
          >
            CONTÁCTANOS
          </Link>
        </div>

        <!-- Mobile Menu Toggle -->
        <button
          @click="mobileMenuOpen = !mobileMenuOpen"
          class="lg:hidden p-2"
          aria-label="Toggle menu"
        >
          <svg
            v-if="!mobileMenuOpen"
            class="w-6 h-6"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M4 6h16M4 12h16M4 18h16"
            />
          </svg>
          <svg
            v-else
            class="w-6 h-6"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
            >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M6 18L18 6M6 6l12 12"
            />
          </svg>
        </button>
      </nav>

      <!-- Mobile Menu -->
      <div
        v-if="mobileMenuOpen"
        class="lg:hidden py-4 border-t"
      >
        <div class="flex flex-col gap-4">
          <Link
            v-for="item in menuItems"
            :key="item.href"
            :href="item.href"
            class="text-sm font-medium"
            :class="{ 'text-primary': isActive(item.href) }"
            @click="mobileMenuOpen = false"
          >
            {{ item.label }}
          </Link>
          <Link
            :href="route('contact')"
            class="px-6 py-2 bg-primary text-primary-foreground rounded-md text-sm font-medium text-center"
            @click="mobileMenuOpen = false"
          >
            CONTÁCTANOS
          </Link>
        </div>
      </div>
    </div>
  </header>
</template>

<script setup lang="ts">
import { Link, usePage } from '@inertiajs/vue3';
import { ref, computed } from 'vue';
import { route } from 'ziggy-js';

defineProps<{
  logoUrl?: string;
}>();

const page = usePage();
const mobileMenuOpen = ref(false);

const menuItems = [
  {
    label: 'Inicio',
    href: route('home'),
  },
  {
    label: 'Nosotros',
    href: route('about'),
  },
  {
    label: 'Soluciones',
    href: route('solutions'),
    children: [
      {
        label: 'Consultoría Ambiental',
        href: route('environmental-consulting'),
      },
      {
        label: 'Protección Civil',
        href: route('civil-protection'),
      },
      {
        label: 'Gestión Territorial y Tramitología',
        href: route('territorial-management'),
      },
      {
        label: 'Ingeniería y Servicios Técnicos',
        href: route('engineering-services'),
      },
    ],
  },
  {
    label: 'Blog',
    href: route('blog'),
  },
  {
    label: 'Contacto',
    href: route('contact'),
  },
];

const isActive = (href: string) => {
  return page.url === href;
};

const logoUrl = '/images/logo-iesima-cabecera.svg';
</script>
