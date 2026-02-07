<!-- resources/js/layouts/Partials/guest/GuestFooter.vue -->
<script setup lang="ts">
import { computed } from 'vue'
import { usePage } from '@inertiajs/vue3'
import { Facebook, Linkedin, Mail, Phone } from 'lucide-vue-next'

/**
 * Footer “rutas dinámicas”:
 * - En home (/) usa #anchors normales.
 * - En cualquier otra ruta, apunta a "/#anchor" para que siempre funcione.
 * - Blog: usa route('blog.index') si Ziggy está disponible; si no, cae a "/blog".
 */

const year = new Date().getFullYear()

const email = 'contacto@consultoresambiq.com'
const phoneDisplay = '+52 425 102 6034'

// Si quieres link tel real:
const phoneE164 = '+524251026034'

const social = {
  facebook: 'https://www.facebook.com/share/1GnU9fFoTy/?mibextid=wwXIfr',
  linkedin: 'https://www.linkedin.com/in/consultoresambiq',
}

const page = usePage<any>()

// Detecta si estamos en home.
const isHome = computed(() => {
  const component = page?.component ?? ''
  // Ajusta si tu página home se llama distinto
  return component === 'Index'
})

/**
 * Helper para armar href:
 * - Si estamos en home: "#seccion"
 * - Si NO: "/#seccion" (o ruta('home') + "#seccion" si tienes Ziggy)
 */
const homeBase = computed(() => {
  // Si Ziggy está, úsalo. Si no, cae a "/"
  // @ts-ignore
  const hasRoute = typeof route === 'function'
  if (hasRoute) {
    try {
      // @ts-ignore
      return route('home')
    } catch {
      return '/'
    }
  }
  return '/'
})

function sectionHref(anchor: string) {
  const clean = anchor.startsWith('#') ? anchor : `#${anchor}`
  return isHome.value ? clean : `${homeBase.value}${clean}`
}

const navLinks = computed(() => [
  { label: 'Inicio', href: sectionHref('#inicio') },
  { label: '¿Quiénes somos?', href: sectionHref('#quienes-somos') },
  { label: 'Impacto', href: sectionHref('#impacto') },
  { label: 'Proceso', href: sectionHref('#proceso') },
  { label: 'Servicios', href: sectionHref('#servicios') },
  { label: 'Preguntas frecuentes', href: sectionHref('#faq') },
  { label: 'Contacto', href: sectionHref('#contacto') },
])

const blogHref = computed(() => {
  // @ts-ignore
  const hasRoute = typeof route === 'function'
  if (hasRoute) {
    try {
      // @ts-ignore
      return route('blog.index')
    } catch {
      return '/blog'
    }
  }
  return '/blog'
})
</script>

<template>
  <footer
    class="relative mt-16 border-t border-white/10
           bg-gradient-to-b from-emerald-500/10 via-white/70 to-white
           dark:from-emerald-400/10 dark:via-neutral-950/55 dark:to-neutral-950"
  >
    <!-- glow sutil -->
    <div
      class="pointer-events-none absolute inset-0 opacity-60
             [background:radial-gradient(900px_280px_at_50%_0%,rgba(16,185,129,.18),transparent_60%)]"
    />

    <div class="relative mx-auto max-w-6xl px-4 py-10 sm:py-12">
      <div class="grid grid-cols-1 gap-8 md:grid-cols-12 md:gap-6">
        <!-- Brand -->
        <div class="md:col-span-4">
          <a :href="homeBase" class="inline-flex items-center gap-3">
            <img src="/img/logo.svg" class="h-9 w-auto" alt="Ambiq Consultores" draggable="false" />
            <div class="leading-tight">
              <div class="text-sm font-black text-slate-900 dark:text-white">Ambiq Consultores</div>
              <div class="mt-0.5 text-xs text-slate-500 dark:text-neutral-400">
                Seguridad · Salud · Ambiente
              </div>
            </div>
          </a>

          <!-- Contacto -->
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
            <a
              v-for="l in navLinks"
              :key="l.href"
              :href="l.href"
              class="text-slate-600 hover:text-slate-900 transition
                     dark:text-neutral-300 dark:hover:text-white"
            >
              {{ l.label }}
            </a>

            <a
              :href="blogHref"
              class="text-slate-600 hover:text-slate-900 transition
                     dark:text-neutral-300 dark:hover:text-white"
            >
              Blog
            </a>
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
              <Facebook
                class="h-5 w-5 text-[#0B2C4A] dark:text-emerald-300 opacity-90 group-hover:opacity-100 transition"
              />
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
              <Linkedin
                class="h-5 w-5 text-[#0B2C4A] dark:text-emerald-300 opacity-90 group-hover:opacity-100 transition"
              />
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
