<!-- resources/js/components/landing/CTASection.vue -->
<script setup lang="ts">
import { computed, onBeforeUnmount, onMounted, reactive, ref } from 'vue'
import ContenedorCentrado from '@/components/landing/ui/ContenedorCentrado.vue'
import BotonPrincipal from '@/components/landing/ui/BotonPrincipal.vue'

type FormState = {
  nombre: string
  correo: string
  telefono: string
  mensaje: string
}

const form = reactive<FormState>({
  nombre: '',
  correo: '',
  telefono: '',
  mensaje: '',
})

const mensajeRef = ref<HTMLTextAreaElement | null>(null)

const sending = ref(false)
const sentOk = ref(false)
const submitError = ref<string | null>(null)

function onAddToQuote(e: Event) {
  const ce = e as CustomEvent<{ message?: string }>
  const msg = ce.detail?.message?.trim()
  if (!msg) return

  form.mensaje = msg

  requestAnimationFrame(() => {
    mensajeRef.value?.focus()
  })
}

onMounted(() => {
  window.addEventListener('ambiq:add-to-quote', onAddToQuote)
})
onBeforeUnmount(() => {
  window.removeEventListener('ambiq:add-to-quote', onAddToQuote)
})

// Solo números (para mantener el input limpio)
function sanitizePhone(v: string) {
  return (v ?? '').replace(/\D+/g, '').slice(0, 10)
}
function onPhoneInput(e: Event) {
  const el = e.target as HTMLInputElement | null
  if (!el) return
  const cleaned = sanitizePhone(el.value)
  el.value = cleaned
  form.telefono = cleaned
}

const canSubmit = computed(() => {
  return (
    !!form.nombre.trim() &&
    !!form.correo.trim() &&
    form.telefono.trim().length === 10 &&
    !!form.mensaje.trim() &&
    !sending.value
  )
})

function getCsrfToken(): string {
  const el = document.querySelector('meta[name="csrf-token"]') as HTMLMetaElement | null
  return el?.content ?? ''
}

async function submit() {
  sentOk.value = false
  submitError.value = null

  // Validación UI (rápida y sin rodeos)
  const tel = sanitizePhone(form.telefono)

  if (!form.nombre.trim() || !form.correo.trim() || !form.mensaje.trim()) {
    submitError.value = 'Completa tu nombre, correo y mensaje para poder enviar.'
    return
  }

  if (tel.length !== 10) {
    submitError.value = 'El teléfono debe tener exactamente 10 dígitos.'
    return
  }

  sending.value = true
  try {
    const res = await fetch('/cotizacion/contacto', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        Accept: 'application/json',
        'X-CSRF-TOKEN': getCsrfToken(),
      },
      body: JSON.stringify({
        nombre: form.nombre,
        correo: form.correo,
        telefono: tel,
        mensaje: form.mensaje,
      }),
    })

    if (!res.ok) {
      let payload: any = null
      try {
        payload = await res.json()
      } catch (_) {}

      if (res.status === 422 && payload?.errors) {
        const firstKey = Object.keys(payload.errors)[0]
        const firstMsg = payload.errors[firstKey]?.[0]
        submitError.value = firstMsg || 'Revisa los campos e intenta de nuevo.'
      } else {
        submitError.value = payload?.message || 'No se pudo enviar. Intenta de nuevo.'
      }
      return
    }

    sentOk.value = true
    form.nombre = ''
    form.correo = ''
    form.telefono = ''
    form.mensaje = ''

    requestAnimationFrame(() => {
      mensajeRef.value?.blur()
    })
  } catch (err) {
    submitError.value = 'Error de red. Verifica tu conexión e intenta de nuevo.'
  } finally {
    sending.value = false
  }
}
</script>

<template>
  <section class="py-12 sm:py-16" id="contacto">
    <ContenedorCentrado>
      <div
        class="grid grid-cols-1 lg:grid-cols-12 gap-10 rounded-3xl bg-[#0B2C4A] p-8 sm:p-10
               ring-1 ring-white/10"
      >
        <!-- Texto -->
        <div class="lg:col-span-6">
          <div class="text-xs font-semibold tracking-[0.2em] uppercase text-sky-300/90">
            Cotización y asesoría
          </div>

          <h2 class="mt-2 text-2xl sm:text-3xl font-black text-white">
            Solicita tu cotización en minutos
          </h2>

          <p class="mt-3 text-sm sm:text-base text-white/75">
            Cuéntanos qué servicio necesitas y te respondemos con una propuesta clara: alcance, tiempos y entregables.
          </p>

          <div class="mt-7 flex flex-wrap gap-3">
            <BotonPrincipal
              label="Iniciar conversación en WhatsApp"
              href="https://wa.me/524251026034?text=Hola%20Ambiq,%20me%20interesa%20una%20asesor%C3%ADa.%20%C2%BFMe%20pueden%20ayudar%3F"
              tipo="primario"
              target="_blank"
            />
            <BotonPrincipal label="Ver servicios" href="#servicios" tipo="secundario" />
          </div>

          <p class="mt-4 text-xs text-white/55">
            Tip: Si agregaste un servicio desde la sección anterior, tu mensaje ya viene precargado.
          </p>
        </div>

        <!-- Form -->
        <div class="lg:col-span-6">
          <form class="grid grid-cols-1 sm:grid-cols-2 gap-4" @submit.prevent="submit">
            <label class="sm:col-span-1">
              <span class="text-xs font-semibold text-white/80">Nombre completo</span>
              <input
                v-model="form.nombre"
                type="text"
                class="mt-2 w-full rounded-xl bg-white/10 px-4 py-3 text-sm text-white placeholder:text-white/40
                       ring-1 ring-white/15 outline-none
                       focus:ring-2 focus:ring-sky-400/60"
                placeholder="Ej. Juan Pérez"
                autocomplete="name"
              />
            </label>

            <label class="sm:col-span-1">
              <span class="text-xs font-semibold text-white/80">Correo</span>
              <input
                v-model="form.correo"
                type="email"
                class="mt-2 w-full rounded-xl bg-white/10 px-4 py-3 text-sm text-white placeholder:text-white/40
                       ring-1 ring-white/15 outline-none
                       focus:ring-2 focus:ring-sky-400/60"
                placeholder="correo@empresa.com"
                autocomplete="email"
              />
            </label>

            <!-- NUEVO: Teléfono -->
            <label class="sm:col-span-2">
              <span class="text-xs font-semibold text-white/80">Teléfono (10 dígitos)</span>
              <input
                :value="form.telefono"
                @input="onPhoneInput"
                type="tel"
                inputmode="numeric"
                pattern="[0-9]*"
                maxlength="10"
                class="mt-2 w-full rounded-xl bg-white/10 px-4 py-3 text-sm text-white placeholder:text-white/40
                       ring-1 ring-white/15 outline-none
                       focus:ring-2 focus:ring-sky-400/60"
                placeholder="Ej. 7293819074"
                autocomplete="tel"
              />
              <p class="mt-1 text-[11px] text-white/55">
                Solo números. Ejemplo: 7293819074
              </p>
            </label>

            <label class="sm:col-span-2">
              <span class="text-xs font-semibold text-white/80">Mensaje</span>
              <textarea
                ref="mensajeRef"
                v-model="form.mensaje"
                rows="5"
                class="mt-2 w-full rounded-xl bg-white/10 px-4 py-3 text-sm text-white placeholder:text-white/40
                       ring-1 ring-white/15 outline-none
                       focus:ring-2 focus:ring-sky-400/60"
                placeholder="Ej. ¡Hola!, me interesa cotizar Gestión ambiental para mi planta. ¿Qué necesitan para iniciar?"
              />
            </label>

            <!-- Feedback -->
            <div v-if="submitError" class="sm:col-span-2 rounded-xl bg-white/10 p-3 ring-1 ring-white/15">
              <p class="text-sm text-white/85">{{ submitError }}</p>
            </div>

            <div v-if="sentOk" class="sm:col-span-2 rounded-xl bg-sky-500/15 p-3 ring-1 ring-sky-400/30">
              <p class="text-sm text-white">
                 Hemos recibido tu solicitud y te contactaremos a la brevedad para brindarte la información correspondiente.
                 Gracias por contactarte con AmbiQ Consultores.
              </p>
            </div>

            <div class="sm:col-span-2 flex justify-end">
              <button
                type="submit"
                :disabled="!canSubmit"
                class="inline-flex items-center justify-center rounded-xl px-6 py-3 text-sm font-black text-white
                       transition focus:outline-none focus:ring-2 focus:ring-sky-400/60
                       disabled:opacity-60 disabled:cursor-not-allowed
                       bg-[#0B2C4A] hover:bg-[#09243D]"
              >
                {{ sending ? 'Enviando…' : 'Enviar solicitud' }}
              </button>
            </div>
          </form>
        </div>
      </div>
    </ContenedorCentrado>
  </section>
</template>
