<template>
  <footer class="bg-muted/50 border-t">
    <div class="container mx-auto px-4 py-12">
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
        <!-- Logo and Description -->
        <div class="space-y-4">
          <img
            src="/images/logo-iesima-cabecera.svg"
            alt="IÉSIMA Logo"
            class="h-12 w-auto mb-4"
          />
          <p class="text-sm text-muted-foreground">
            Consultoría ambiental y de seguridad industrial para empresas y gobiernos en México.
          </p>
          <div class="space-y-2">
            <div class="flex items-center gap-2 text-sm">
              <svg
                class="w-4 h-4"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"
                />
              </svg>
              <span>+52 771 795 8589</span>
            </div>
            <div class="flex items-center gap-2 text-sm">
              <svg
                class="w-4 h-4"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                />
              </svg>
              <span>administrativo@iesima.mx</span>
            </div>
            <div class="flex items-center gap-2 text-sm">
              <svg
                class="w-4 h-4"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"
                />
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"
                />
              </svg>
              <span class="text-xs">
                Benigno Peláez Aladro #259, Rinconada del Venado II, Mineral de la Reforma, Estado de Hidalgo
              </span>
            </div>
          </div>
        </div>

        <!-- Navigation Links -->
        <div class="hidden md:block space-y-2">
          <h3 class="font-semibold mb-4">Navegación</h3>
          <Link
            v-for="link in navigationLinks"
            :key="link.href"
            :href="link.href"
            class="block text-sm text-muted-foreground hover:text-foreground transition-colors"
          >
            {{ link.label }}
          </Link>
        </div>

        <!-- Solutions Links -->
        <div class="hidden md:block space-y-2">
          <h3 class="font-semibold mb-4">Soluciones</h3>
          <Link
            v-for="link in solutionLinks"
            :key="link.href"
            :href="link.href"
            class="block text-sm text-muted-foreground hover:text-foreground transition-colors"
          >
            {{ link.label }}
          </Link>
        </div>
      </div>

      <!-- Copyright -->
      <div class="border-t pt-6 text-center">
        <p class="text-sm text-muted-foreground">
          <strong>IÉSIMA 2025 ©</strong> Todos los derechos reservados
        </p>
      </div>
    </div>
  </footer>
</template>

<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { route } from 'ziggy-js';

const navigationLinks = [
  { label: 'Inicio', href: route('home') },
  { label: 'Nosotros', href: route('about') },
  { label: 'Soluciones', href: route('solutions') },
  { label: 'Blog', href: route('blog') },
  { label: 'Contacto', href: route('contact') },
  { label: 'Aviso de privacidad', href: route('privacy') },
];

const solutionLinks = [
  { label: 'Consultoría ambiental', href: route('environmental-consulting') },
  { label: 'Protección civil y seguridad ambiental', href: route('civil-protection') },
  { label: 'Gestión territorial y tramitología', href: route('territorial-management') },
  { label: 'Ingeniería y servicios técnicos', href: route('engineering-services') },
];
</script>
