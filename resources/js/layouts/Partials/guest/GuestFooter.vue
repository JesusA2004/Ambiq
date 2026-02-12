<!-- resources/js/layouts/Partials/guest/GuestFooter.vue -->
<script setup lang="ts">
import { computed } from 'vue'
import { Link } from '@inertiajs/vue3'
import { Facebook, Linkedin, Mail, Phone } from 'lucide-vue-next'

const year = new Date().getFullYear()

const email = 'contacto@consultoresambiq.com'
const phoneDisplay = '+52 425 102 6034'
const phoneE164 = '+524251026034'

const social = {
  facebook: 'https://www.facebook.com/share/1GnU9fFoTy/?mibextid=wwXIfr',
  linkedin: 'https://www.linkedin.com/in/consultoresambiq',
}

const routes = {
  home: '/',
  quienes: '/quienes-somos',
  impacto: '/impacto',
  proceso: '/proceso',
  servicios: '/servicios',
  faq: '/preguntas-frecuentes',
  contacto: '/contacto',
  blog: '/blog',
}

const navLinks = computed(() => [
  { label: 'Inicio', href: routes.home },
  { label: '¿Quiénes somos?', href: routes.quienes },
  { label: 'Impacto', href: routes.impacto },
  { label: 'Proceso', href: routes.proceso },
  { label: 'Servicios', href: routes.servicios },
  { label: 'Preguntas frecuentes', href: routes.faq },
  { label: 'Contacto', href: routes.contacto },
])
</script>

<template>
  <footer
    class="relative mt-16 border-t border-white/10
           bg-gradient-to-b from-emerald-500/10 via-white/70 to-white
           dark:from-emerald-400/10 dark:via-neutral-950/55 dark:to-neutral-950"
  >
    <div
      class="pointer-events-none absolute inset-0 opacity-60
             [background:radial-gradient(900px_280px_at_50%_0%,rgba(16,185,129,.18),transparent_60%)]"
    />

    <div class="relative mx-auto max-w-6xl px-4 py-10 sm:py-12">
      <div class="grid grid-cols-1 gap-8 md:grid-cols-12 md:gap-6">
        <!-- Brand -->
        <div class="md:col-span-4">
          <Link :href="routes.home" class="inline-flex items-center gap-3">
            <img src="/img/logo.svg" class="h-9 w-auto" alt="Ambiq Consultores" draggable="false" />
            <div class="leading-tight">
              <div class="text-sm font-black text-slate-900 dark:text-white">Ambiq Consultores</div>
              <div class="mt-0.5 text-xs text-slate-500 dark:text-neutral-400">
                Seguridad · Salud · Ambiente
              </div>
            </div>
          </Link>

          <div class="mt-5 space-y-2 text-sm text-slate-600 dark:text-neutral-300">
            <div class="flex items-center gap-2">
              <Mail class="h-4 w-4 text-[#0B2C4A] dark:text-emerald-300 opacity-90" />
              <a
                :href="`mailto:${email}`"
                class="font-medium hover:text-slate-900 dark:hover:text-white transition"
              >
                {{ email }}
              </a>
            </div>

            <div class="flex items-center gap-2">
              <Phone class="h-4 w-4 text-[#0B2C4A] dark:text-emerald-300 opacity-90" />
              <a
                :href="`tel:${phoneE164}`"
                class="font-medium hover:text-slate-900 dark:hover:text-white transition"
              >
                {{ phoneDisplay }}
              </a>
            </div>
          </div>
        </div>

        <!-- Links -->
        <div class="md:col-span-5">
          <div class="text-xs font-semibold tracking-[0.18em] uppercase text-slate-500 dark:text-neutral-400">
            Navegación
          </div>

          <nav class="mt-3 grid grid-cols-2 gap-x-6 gap-y-2 text-sm">
            <Link
              v-for="l in navLinks"
              :key="l.href"
              :href="l.href"
              class="text-slate-600 hover:text-slate-900 transition
                     dark:text-neutral-300 dark:hover:text-white"
            >
              {{ l.label }}
            </Link>

            <Link
              :href="routes.blog"
              class="text-slate-600 hover:text-slate-900 transition
                     dark:text-neutral-300 dark:hover:text-white"
            >
              Blog
            </Link>
          </nav>
        </div>

        <!-- Social -->
        <div class="md:col-span-3 md:flex md:flex-col md:items-end">
          <div class="text-xs font-semibold tracking-[0.18em] uppercase text-slate-500 dark:text-neutral-400">
            Redes
          </div>

          <div class="mt-3 flex items-center gap-3 md:justify-end">
            <a
              :href="social.facebook"
              target="_blank"
              rel="noopener noreferrer"
              class="group inline-flex h-10 w-10 items-center justify-center rounded-full
                     bg-white/70 ring-1 ring-slate-900/10 backdrop-blur
                     hover:bg-white transition
                     dark:bg-white/5 dark:ring-white/10 dark:hover:bg-white/10"
              aria-label="Facebook"
              title="Facebook"
            >
              <Facebook class="h-5 w-5 text-[#0B2C4A] dark:text-emerald-300 opacity-90 group-hover:opacity-100 transition" />
            </a>

            <a
              :href="social.linkedin"
              target="_blank"
              rel="noopener noreferrer"
              class="group inline-flex h-10 w-10 items-center justify-center rounded-full
                     bg-white/70 ring-1 ring-slate-900/10 backdrop-blur
                     hover:bg-white transition
                     dark:bg-white/5 dark:ring-white/10 dark:hover:bg-white/10"
              aria-label="LinkedIn"
              title="LinkedIn"
            >
              <Linkedin class="h-5 w-5 text-[#0B2C4A] dark:text-emerald-300 opacity-90 group-hover:opacity-100 transition" />
            </a>
          </div>

          <div class="mt-4 max-w-xs text-xs text-slate-500 dark:text-neutral-500 md:text-right">
            Cumplimiento y prevención, con claridad operativa.
          </div>
        </div>
      </div>

      <div class="my-8 h-px bg-slate-900/10 dark:bg-white/10" />

      <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
        <div class="text-xs text-slate-500 dark:text-neutral-500">
          © {{ year }} Ambiq Consultores. Todos los derechos reservados.
        </div>

        <div class="text-xs text-slate-500 dark:text-neutral-500">
          <span class="opacity-80">Desarrollado por DASTI</span>
        </div>
      </div>
    </div>
  </footer>
</template>
