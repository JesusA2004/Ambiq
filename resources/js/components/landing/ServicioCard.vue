<!-- resources/js/components/landing/ServicioCard.vue -->
<script setup lang="ts">
import { computed, ref } from 'vue'

export type ServicioItem = {
  id: string
  title: string
  subtitle?: string
  image: string
  bullets: string[]
  shape?: 'circle' | 'rounded'
}

const props = defineProps<{
  item: ServicioItem
  index: number
  class?: string
}>()

const emit = defineEmits<{
  (e: 'add', title: string): void
}>()

const openMobile = ref(false)

// ✅ Cliente ya no quiere círculos: forzamos rectángulo premium
const shapeClass = computed(() => 'rounded-[28px]')

// Tamaño estilo “galería”
const cardBase = computed(
  () =>
    'relative shrink-0 ' +
    'w-[78vw] max-w-[360px] sm:w-[360px] lg:w-[390px] ' +
    'h-[420px] sm:h-[440px] lg:h-[470px]'
)

function addToQuote() {
  emit('add', props.item.title)
}
</script>

<template>
  <article class="group" :class="[cardBase, $props.class]" :data-card-index="index">
    <!-- Desktop flip -->
    <div class="hidden sm:block h-full w-full">
      <div class="flip-wrap h-full w-full">
        <div class="flip-inner h-full w-full">
          <!-- FRONT -->
          <div class="flip-face flip-front h-full w-full">
            <div
              class="relative h-full w-full overflow-hidden ring-1 ring-black/10 dark:ring-white/10"
              :class="shapeClass"
            >
              <img
                :src="item.image"
                :alt="item.title"
                class="absolute inset-0 h-full w-full object-cover"
                draggable="false"
                loading="lazy"
              />

              <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/15 to-black/10" />
              <div class="absolute inset-0 bg-black/10" />

              <div class="absolute inset-x-0 bottom-0 p-6">
                <div class="text-xs font-semibold tracking-[0.22em] uppercase text-emerald-300/90">
                  Servicio
                </div>

                <h3 class="mt-2 text-3xl font-black leading-tight text-white">
                  {{ item.title }}
                </h3>

                <p v-if="item.subtitle" class="mt-2 text-sm text-white/80">
                  {{ item.subtitle }}
                </p>

                <div class="mt-4 inline-flex items-center gap-2 text-xs text-white/80">
                  <span class="h-2 w-2 rounded-full bg-emerald-400/90" aria-hidden="true" />
                  Pasa el mouse para ver detalles
                </div>
              </div>
            </div>
          </div>

          <!-- BACK -->
          <div class="flip-face flip-back h-full w-full">
            <div
              class="relative h-full w-full overflow-hidden ring-1 ring-black/10 dark:ring-white/10"
              :class="shapeClass"
            >
              <div class="absolute inset-0 bg-gradient-to-br from-slate-950 via-slate-900 to-slate-950" />
              <div
                class="absolute inset-0 opacity-20
                       bg-[radial-gradient(circle_at_30%_35%,rgba(56,189,248,.35),transparent_55%)]"
              />
              <div
                class="absolute inset-0 opacity-14
                       bg-[radial-gradient(circle_at_70%_65%,rgba(34,197,94,.22),transparent_55%)]"
              />

              <div class="relative h-full flex flex-col min-h-0 p-6">
                <div class="flex items-start justify-between gap-3">
                  <div class="min-w-0">
                    <div class="text-xs font-semibold tracking-[0.22em] uppercase text-emerald-300/90 truncate">
                      {{ item.title }}
                    </div>
                    <p v-if="item.subtitle" class="mt-2 text-sm text-white/80 line-clamp-2">
                      {{ item.subtitle }}
                    </p>
                  </div>

                  <div class="shrink-0 rounded-full bg-white/10 px-3 py-1 text-xs text-white/75 ring-1 ring-white/15">
                    Detalle
                  </div>
                </div>

                <div class="mt-4 min-h-0 overflow-hidden">
                  <ul class="space-y-2 text-sm text-white/90">
                    <li v-for="(b, bi) in item.bullets" :key="bi" class="flex gap-3">
                      <span class="mt-2 h-2.5 w-2.5 shrink-0 rounded-full bg-emerald-400/90" />
                      <span class="leading-relaxed line-clamp-3">
                        {{ b }}
                      </span>
                    </li>
                  </ul>
                </div>

                <div class="mt-auto pt-4">
                  <button
                    type="button"
                    class="w-full rounded-2xl bg-emerald-600 px-5 py-3 text-sm font-black text-white
                           hover:bg-emerald-700 transition
                           focus:outline-none focus:ring-2 focus:ring-emerald-400/60"
                    @click="addToQuote"
                  >
                    Agregar a mi cotización
                  </button>

                  <p class="mt-2 text-xs text-white/60">
                    Se precargará el mensaje y te llevará al formulario.
                  </p>
                </div>
              </div>
            </div>
          </div>
          <!-- /BACK -->
        </div>
      </div>
    </div>

    <!-- ✅ Mobile: overlay de detalles (NO se recorta + tiene cerrar visible) -->
    <div class="sm:hidden h-full w-full">
      <div
        class="relative h-full w-full overflow-hidden ring-1 ring-black/10 dark:ring-white/10"
        :class="shapeClass"
      >
        <img
          :src="item.image"
          :alt="item.title"
          class="absolute inset-0 h-full w-full object-cover"
          draggable="false"
          loading="lazy"
        />

        <!-- overlay base -->
        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/25 to-black/10" />
        <div class="absolute inset-0 bg-black/10" />

        <!-- FRONT (cuando NO está abierto) -->
        <div v-if="!openMobile" class="absolute inset-x-0 bottom-0 p-5">
          <div class="rounded-2xl bg-black/30 p-4 ring-1 ring-white/15 backdrop-blur">
            <div class="text-[11px] font-semibold tracking-[0.22em] uppercase text-emerald-300/90">
              Servicio
            </div>

            <h3 class="mt-2 text-white font-black leading-tight break-words text-2xl">
              <span class="line-clamp-2">{{ item.title }}</span>
            </h3>

            <p v-if="item.subtitle" class="mt-2 text-sm text-white/80 break-words">
              <span class="line-clamp-2">{{ item.subtitle }}</span>
            </p>

            <button
              type="button"
              class="mt-4 w-full rounded-2xl bg-white/10 px-4 py-3 text-sm font-semibold text-white
                     ring-1 ring-white/15 backdrop-blur
                     active:scale-[0.99] transition"
              @click="openMobile = true"
              aria-label="Ver detalles"
            >
              <span class="inline-flex items-center justify-center gap-2">
                Ver detalles
                <span class="text-lg leading-none" aria-hidden="true">▾</span>
              </span>
            </button>
          </div>
        </div>

        <!-- DETAILS OVERLAY (cuando está abierto) -->
        <div
          v-else
          class="absolute inset-0 p-4"
        >
          <div
            class="h-full rounded-2xl bg-black/45 ring-1 ring-white/15 backdrop-blur
                   flex flex-col min-h-0"
          >
            <!-- Header fijo -->
            <div class="flex items-start justify-between gap-3 p-4">
              <div class="min-w-0">
                <div class="text-[11px] font-semibold tracking-[0.22em] uppercase text-emerald-300/90">
                  {{ item.title }}
                </div>
                <p v-if="item.subtitle" class="mt-2 text-sm text-white/80 break-words line-clamp-2">
                  {{ item.subtitle }}
                </p>
              </div>

              <button
                type="button"
                class="shrink-0 rounded-xl bg-white/10 px-3 py-2 text-sm font-semibold text-white
                       ring-1 ring-white/15 active:scale-95 transition"
                @click="openMobile = false"
                aria-label="Ocultar detalles"
              >
                <span class="inline-flex items-center gap-2">
                  Cerrar <span aria-hidden="true">▴</span>
                </span>
              </button>
            </div>

            <!-- Contenido scrolleable (para que no se corte) -->
            <div class="px-4 pb-4 min-h-0 flex-1 overflow-auto">
              <ul class="space-y-3 text-sm text-white/90">
                <li v-for="(b, bi) in item.bullets" :key="bi" class="flex gap-3">
                  <span class="mt-2 h-2.5 w-2.5 shrink-0 rounded-full bg-emerald-400/90" />
                  <span class="leading-relaxed break-words">{{ b }}</span>
                </li>
              </ul>
            </div>

            <!-- CTA fijo abajo -->
            <div class="p-4 pt-0">
              <button
                type="button"
                class="w-full rounded-2xl bg-emerald-600 px-5 py-3 text-sm font-black text-white
                       hover:bg-emerald-700 transition
                       focus:outline-none focus:ring-2 focus:ring-emerald-400/60"
                @click="addToQuote"
              >
                Agregar a mi cotización
              </button>

              <p class="mt-2 text-xs text-white/60 text-center">
                Se precargará el mensaje y te llevará al formulario.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </article>
</template>

<style scoped>
/* Flip 3D (desktop) */
.flip-wrap {
  perspective: 1200px;
}

.flip-inner {
  position: relative;
  transform-style: preserve-3d;
  transition: transform 1100ms cubic-bezier(0.16, 1, 0.3, 1);
}

.group:hover .flip-inner,
.group:focus-within .flip-inner {
  transform: rotateY(180deg);
}

.flip-face {
  position: absolute;
  inset: 0;
  backface-visibility: hidden;
}

.flip-back {
  transform: rotateY(180deg);
}
</style>
