<!-- resources/js/layouts/Partials/guest/GuestNavbar.vue -->
<script setup lang="ts">
import { computed, onBeforeUnmount, onMounted, ref, nextTick } from 'vue'
import { Link, usePage, router } from '@inertiajs/vue3'
import {
  Menu as MenuIcon,
  Home,
  Users,
  BarChart3,
  ClipboardList,
  Briefcase,
  BookOpen,
  Mail,
  ChevronDown,
  LogIn,
  HelpCircle,
} from 'lucide-vue-next'

const open = ref(false)
const whoOpenDesktop = ref(false)
const whoOpenMobile = ref(false)

const page = usePage()
const currentPath = computed(() => {
  const raw = (page.url as unknown as string) || '/'
  return raw.startsWith('http') ? new URL(raw).pathname : raw.split('?')[0]
})

type NavItem =
  | { label: string; kind: 'hash'; hash: string; icon: any }
  | { label: string; kind: 'route'; href: string; icon: any }

type NavGroup = {
  label: string
  icon: any
  items: Array<{ label: string; hash: string; icon: any }>
}

const whoGroup: NavGroup = {
  label: '¿Quiénes somos?',
  icon: Users,
  items: [
    { label: 'Pilares de nuestro trabajo', hash: '#quienes-somos', icon: Users },
    { label: 'Impacto generado', hash: '#impacto', icon: BarChart3 },
    { label: 'Proceso de contratación', hash: '#proceso', icon: ClipboardList },
  ],
}

const nav: NavItem[] = [
  { label: 'Inicio', kind: 'hash', hash: '#inicio', icon: Home },
  { label: 'Servicios', kind: 'hash', hash: '#servicios', icon: Briefcase },
  { label: 'Blog', kind: 'route', href: '/blog', icon: BookOpen },
  { label: 'Contacto', kind: 'hash', hash: '#contacto', icon: Mail },
  { label: 'Preguntas frecuentes', kind: 'hash', hash: '#faq', icon: HelpCircle }
]

function closeMenu() {
  open.value = false
  whoOpenMobile.value = false
}

function smoothScrollTo(hash: string) {
  const el = document.querySelector(hash) as HTMLElement | null
  if (!el) {
    window.location.hash = hash
    return
  }

  el.classList.add('ring-2', 'ring-emerald-400/35')
  setTimeout(() => el.classList.remove('ring-2', 'ring-emerald-400/35'), 850)

  el.scrollIntoView({ behavior: 'smooth', block: 'start' })
}

/**
 * HOME via Inertia (evita “zoom”/reflow raro por full reload en móvil)
 */
async function goHome() {
  closeMenu()
  whoOpenDesktop.value = false

  // ya estás en home: scroll top suave
  if (currentPath.value === '/' || currentPath.value === '') {
    window.scrollTo({ top: 0, behavior: 'smooth' })
    return
  }

  router.visit('/', {
    preserveScroll: false,
    preserveState: false,
    onFinish: async () => {
      await nextTick()
      // doble “reset” para que el viewport no quede “escalado” en algunos móviles
      window.scrollTo(0, 0)
      requestAnimationFrame(() => window.scrollTo(0, 0))
    },
  })
}

async function goToHash(hash: string) {
  // Si ya estás en home: scroll suave
  if (currentPath.value === '/' || currentPath.value === '') {
    smoothScrollTo(hash)
    closeMenu()
    return
  }

  // Desde /blog u otra ruta: navega a home con Inertia y luego scrollea
  closeMenu()

  router.visit('/', {
    preserveScroll: true,
    preserveState: false,
    onFinish: async () => {
      await nextTick()
      requestAnimationFrame(() => smoothScrollTo(hash))
    },
  })
}

// cerrar dropdown desktop al click fuera / Esc
function onDocClick(e: MouseEvent) {
  const target = e.target as HTMLElement | null
  if (!target) return
  if (!target.closest('[data-who-dropdown]')) whoOpenDesktop.value = false
}
function onKey(e: KeyboardEvent) {
  if (e.key === 'Escape') whoOpenDesktop.value = false
}

onMounted(() => {
  document.addEventListener('click', onDocClick)
  document.addEventListener('keydown', onKey)
})
onBeforeUnmount(() => {
  document.removeEventListener('click', onDocClick)
  document.removeEventListener('keydown', onKey)
})
</script>

<template>
  <header class="fixed inset-x-0 top-0 z-50">
    <div class="mx-auto max-w-6xl px-4 pt-3 sm:pt-4">
      <!-- Barra tipo pill -->
      <div
        class="flex items-center justify-between gap-3 rounded-full
               border border-white/20 bg-white/30 px-4 py-3 shadow-lg
               backdrop-blur-xl transition-all duration-300
               dark:border-white/10 dark:bg-neutral-900/30"
      >
        <!-- Logo (IMPORTANTE: NO <a href="/">) -->
        <button
          type="button"
          class="flex items-center gap-3 focus:outline-none"
          @click="goHome"
          aria-label="Ir al inicio"
        >
          <img
            src="/img/logo.svg"
            class="h-10 w-auto sm:h-11 transition-transform duration-300 hover:scale-[1.02]"
            alt="Ambiq Consultores"
            draggable="false"
          />
        </button>

        <!-- Nav desktop -->
        <nav class="hidden items-center gap-1 md:flex">
          <!-- Inicio -->
          <button
            type="button"
            class="group inline-flex items-center gap-2 rounded-full px-4 py-2 text-sm font-medium
                   text-slate-800 hover:text-slate-900 hover:bg-white/30 transition-all duration-200
                   dark:text-neutral-100 dark:hover:text-white dark:hover:bg-white/10"
            @click="goToHash('#inicio')"
          >
            <Home class="h-4 w-4 opacity-80 group-hover:opacity-100 transition" />
            Inicio
          </button>

          <!-- Dropdown: ¿Quiénes somos? -->
          <div class="relative" data-who-dropdown>
            <button
              type="button"
              class="group inline-flex items-center gap-2 rounded-full px-4 py-2 text-sm font-medium
                     text-slate-800 hover:text-slate-900 hover:bg-white/30 transition-all duration-200
                     dark:text-neutral-100 dark:hover:text-white dark:hover:bg-white/10"
              :aria-expanded="whoOpenDesktop"
              @click="whoOpenDesktop = !whoOpenDesktop"
            >
              <Users class="h-4 w-4 opacity-80 group-hover:opacity-100 transition" />
              {{ whoGroup.label }}
              <ChevronDown
                class="h-4 w-4 opacity-80 transition-transform duration-200"
                :class="whoOpenDesktop ? 'rotate-180' : ''"
                aria-hidden="true"
              />
            </button>

            <transition
              enter-active-class="transition duration-200 ease-out"
              enter-from-class="opacity-0 translate-y-1 scale-[0.98]"
              enter-to-class="opacity-100 translate-y-0 scale-100"
              leave-active-class="transition duration-150 ease-in"
              leave-from-class="opacity-100 translate-y-0 scale-100"
              leave-to-class="opacity-0 translate-y-1 scale-[0.98]"
            >
              <div
                v-if="whoOpenDesktop"
                class="absolute left-0 mt-2 w-72 overflow-hidden rounded-2xl
                       border border-white/25 bg-white/70 shadow-xl backdrop-blur-xl
                       dark:border-white/10 dark:bg-neutral-900/55"
              >
                <div class="px-3 pt-3 pb-2">
                  <div class="text-[11px] font-semibold tracking-[0.18em] uppercase text-slate-500 dark:text-neutral-300">
                    Sección
                  </div>
                </div>

                <button
                  v-for="it in whoGroup.items"
                  :key="it.hash"
                  type="button"
                  class="group w-full px-4 py-3 text-left text-sm font-medium
                         text-slate-900 hover:bg-white/40 transition
                         dark:text-neutral-100 dark:hover:bg-white/10
                         inline-flex items-center gap-3"
                  @click="
                    goToHash(it.hash);
                    whoOpenDesktop = false
                  "
                >
                  <span
                    class="inline-flex h-9 w-9 items-center justify-center rounded-xl
                           bg-slate-900/5 ring-1 ring-slate-900/10
                           dark:bg-white/5 dark:ring-white/10"
                  >
                    <component :is="it.icon" class="h-4 w-4 text-[#0B2C4A] dark:text-emerald-300" />
                  </span>

                  <span class="flex-1">{{ it.label }}</span>

                  <span class="text-slate-400 group-hover:text-slate-500 transition dark:text-neutral-500">
                    →
                  </span>
                </button>

                <div class="px-4 pb-4 pt-2">
                  <div class="h-px bg-slate-900/10 dark:bg-white/10" />
                </div>
              </div>
            </transition>
          </div>

          <!-- Resto -->
          <template v-for="(item, i) in nav.slice(1)" :key="i">
            <button
              v-if="item.kind === 'hash'"
              type="button"
              class="group inline-flex items-center gap-2 rounded-full px-4 py-2 text-sm font-medium
                     text-slate-800 hover:text-slate-900 hover:bg-white/30 transition-all duration-200
                     dark:text-neutral-100 dark:hover:text-white dark:hover:bg-white/10"
              @click="goToHash(item.hash)"
            >
              <component :is="item.icon" class="h-4 w-4 opacity-80 group-hover:opacity-100 transition" />
              {{ item.label }}
            </button>

            <Link
              v-else
              :href="item.href"
              class="group inline-flex items-center gap-2 rounded-full px-4 py-2 text-sm font-medium
                     text-slate-800 hover:text-slate-900 hover:bg-white/30 transition-all duration-200
                     dark:text-neutral-100 dark:hover:text-white dark:hover:bg-white/10"
            >
              <component :is="item.icon" class="h-4 w-4 opacity-80 group-hover:opacity-100 transition" />
              {{ item.label }}
            </Link>
          </template>
        </nav>

        <!-- CTA desktop -->
        <div class="hidden items-center gap-2 md:flex">
        </div>

        <!-- Burger mobile -->
        <button
          type="button"
          class="md:hidden inline-flex items-center justify-center gap-2 rounded-full
                 border border-white/20 bg-white/30 px-4 py-2 text-sm font-semibold
                 hover:bg-white/45 transition-all duration-200
                 backdrop-blur-xl
                 dark:border-white/10 dark:bg-neutral-900/30 dark:hover:bg-neutral-900/45"
          @click="open = !open"
          :aria-expanded="open"
          aria-label="Abrir menú"
        >
          <MenuIcon class="h-4 w-4" />
          Menú
        </button>
      </div>

      <!-- Panel mobile -->
      <transition
        enter-active-class="transition duration-200 ease-out"
        enter-from-class="opacity-0 translate-y-2"
        enter-to-class="opacity-100 translate-y-0"
        leave-active-class="transition duration-150 ease-in"
        leave-from-class="opacity-100 translate-y-0"
        leave-to-class="opacity-0 translate-y-2"
      >
        <div v-if="open" class="mt-3 md:hidden">
          <div
            class="rounded-2xl border border-white/20 bg-white/55 p-2 shadow-lg backdrop-blur-xl
                   dark:border-white/10 dark:bg-neutral-900/45"
          >
            <div class="grid gap-1">
              <!-- Inicio -->
              <button
                type="button"
                class="group w-full rounded-xl px-4 py-3 text-left text-sm font-medium
                       text-slate-900 hover:bg-white/35 transition
                       dark:text-neutral-100 dark:hover:bg-white/10
                       inline-flex items-center gap-3"
                @click="goToHash('#inicio')"
              >
                <span
                  class="inline-flex h-9 w-9 items-center justify-center rounded-xl
                         bg-slate-900/5 ring-1 ring-slate-900/10
                         dark:bg-white/5 dark:ring-white/10"
                >
                  <Home class="h-4 w-4 text-[#0B2C4A] dark:text-emerald-300" />
                </span>
                Inicio
              </button>

              <!-- Acordeón ¿Quiénes somos? -->
              <button
                type="button"
                class="group w-full rounded-xl px-4 py-3 text-left text-sm font-medium
                       text-slate-900 hover:bg-white/35 transition
                       dark:text-neutral-100 dark:hover:bg-white/10
                       inline-flex items-center justify-between"
                @click="whoOpenMobile = !whoOpenMobile"
                :aria-expanded="whoOpenMobile"
              >
                <span class="inline-flex items-center gap-3">
                  <span
                    class="inline-flex h-9 w-9 items-center justify-center rounded-xl
                           bg-slate-900/5 ring-1 ring-slate-900/10
                           dark:bg-white/5 dark:ring-white/10"
                  >
                    <Users class="h-4 w-4 text-[#0B2C4A] dark:text-emerald-300" />
                  </span>
                  {{ whoGroup.label }}
                </span>

                <ChevronDown class="h-4 w-4 transition-transform duration-200" :class="whoOpenMobile ? 'rotate-180' : ''" />
              </button>

              <transition
                enter-active-class="transition duration-200 ease-out"
                enter-from-class="opacity-0 -translate-y-1"
                enter-to-class="opacity-100 translate-y-0"
                leave-active-class="transition duration-150 ease-in"
                leave-from-class="opacity-100 translate-y-0"
                leave-to-class="opacity-0 -translate-y-1"
              >
                <div v-if="whoOpenMobile" class="grid gap-1 pl-2">
                  <button
                    v-for="it in whoGroup.items"
                    :key="it.hash"
                    type="button"
                    class="group w-full rounded-xl px-4 py-2 text-left text-sm
                           text-slate-800 hover:bg-white/35 transition
                           dark:text-neutral-200 dark:hover:bg-white/10
                           inline-flex items-center gap-3"
                    @click="goToHash(it.hash)"
                  >
                    <span
                      class="inline-flex h-8 w-8 items-center justify-center rounded-xl
                             bg-slate-900/5 ring-1 ring-slate-900/10
                             dark:bg-white/5 dark:ring-white/10"
                    >
                      <component :is="it.icon" class="h-4 w-4 text-[#0B2C4A] dark:text-emerald-300" />
                    </span>
                    {{ it.label }}
                  </button>
                </div>
              </transition>

              <!-- Servicios / Blog / Contacto -->
              <template v-for="(item, i) in nav.slice(1)" :key="i">
                <button
                  v-if="item.kind === 'hash'"
                  type="button"
                  class="group w-full rounded-xl px-4 py-3 text-left text-sm font-medium
                         text-slate-900 hover:bg-white/35 transition
                         dark:text-neutral-100 dark:hover:bg-white/10
                         inline-flex items-center gap-3"
                  @click="goToHash(item.hash)"
                >
                  <span
                    class="inline-flex h-9 w-9 items-center justify-center rounded-xl
                           bg-slate-900/5 ring-1 ring-slate-900/10
                           dark:bg-white/5 dark:ring-white/10"
                  >
                    <component :is="item.icon" class="h-4 w-4 text-[#0B2C4A] dark:text-emerald-300" />
                  </span>
                  {{ item.label }}
                </button>

                <Link
                  v-else
                  :href="item.href"
                  class="group w-full rounded-xl px-4 py-3 text-left text-sm font-medium
                         text-slate-900 hover:bg-white/35 transition
                         dark:text-neutral-100 dark:hover:bg-white/10
                         inline-flex items-center gap-3"
                  @click="closeMenu"
                >
                  <span
                    class="inline-flex h-9 w-9 items-center justify-center rounded-xl
                           bg-slate-900/5 ring-1 ring-slate-900/10
                           dark:bg-white/5 dark:ring-white/10"
                  >
                    <component :is="item.icon" class="h-4 w-4 text-[#0B2C4A] dark:text-emerald-300" />
                  </span>
                  {{ item.label }}
                </Link>
              </template>
            </div>

            <div class="mt-2 grid grid-cols-2 gap-2">
              <button
                type="button"
                class="rounded-xl border border-slate-900/10 bg-white/40 px-3 py-3 text-center text-sm font-semibold
                       text-slate-900 hover:bg-white/60 transition
                       dark:border-white/10 dark:bg-white/5 dark:text-neutral-100 dark:hover:bg-white/10"
                @click="closeMenu"
              >
                Cerrar
              </button>
            </div>
          </div>
        </div>
      </transition>
    </div>
  </header>
</template>

<style scoped>
:global(html) {
  scroll-behavior: smooth;
}

:global(#inicio),
:global(#quienes-somos),
:global(#impacto),
:global(#proceso),
:global(#servicios),
:global(#faq),
:global(#contacto) {
  scroll-margin-top: 92px;
}
</style>
