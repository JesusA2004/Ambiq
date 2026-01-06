<script setup lang="ts">
    import ContenedorCentrado from '@/components/landing/ui/ContenedorCentrado.vue'
    import BotonPrincipal from '@/components/landing/ui/BotonPrincipal.vue'
    </script>
    
    <template>
      <section class="py-12 sm:py-16" id="contacto">
        <ContenedorCentrado>
          <div
            class="grid grid-cols-1 lg:grid-cols-12 gap-10 rounded-3xl bg-slate-950 p-8 sm:p-10
                   ring-1 ring-white/10"
          >
            <div class="lg:col-span-6">
              <div class="text-xs font-semibold tracking-[0.2em] uppercase text-emerald-300/90">
                Contacto
              </div>
              <h2 class="mt-2 text-2xl sm:text-3xl font-black text-white">
                CTA fuerte (editable)
              </h2>
              <p class="mt-3 text-sm sm:text-base text-white/75">
                Texto de cierre. Promesa clara. Cero relleno.
              </p>
    
              <div class="mt-7 flex gap-3">
                <BotonPrincipal label="Agendar llamada" href="#" tipo="primario" />
                <BotonPrincipal label="Ver servicios" href="#servicios" tipo="secundario" />
              </div>
            </div>
    
            <div class="lg:col-span-6">
              <form class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <label class="sm:col-span-1">
                  <span class="text-xs font-semibold text-white/80">Nombre</span>
                  <input
                    type="text"
                    class="mt-2 w-full rounded-xl bg-white/10 px-4 py-3 text-sm text-white placeholder:text-white/40
                           ring-1 ring-white/15 focus:ring-2 focus:ring-emerald-400/60 outline-none"
                    placeholder="Tu nombre"
                  />
                </label>
    
                <label class="sm:col-span-1">
                  <span class="text-xs font-semibold text-white/80">Correo</span>
                  <input
                    type="email"
                    class="mt-2 w-full rounded-xl bg-white/10 px-4 py-3 text-sm text-white placeholder:text-white/40
                           ring-1 ring-white/15 focus:ring-2 focus:ring-emerald-400/60 outline-none"
                    placeholder="correo@empresa.com"
                  />
                </label>
    
                <label class="sm:col-span-2">
                  <span class="text-xs font-semibold text-white/80">Mensaje</span>
                  <textarea
                    rows="4"
                    class="mt-2 w-full rounded-xl bg-white/10 px-4 py-3 text-sm text-white placeholder:text-white/40
                           ring-1 ring-white/15 focus:ring-2 focus:ring-emerald-400/60 outline-none"
                    placeholder="Cuéntanos qué necesitas (editable)"
                  />
                </label>
    
                <div class="sm:col-span-2 flex justify-end">
                  <button
                    type="button"
                    class="inline-flex items-center justify-center rounded-xl bg-emerald-600 px-6 py-3 text-sm font-black text-white
                           hover:bg-emerald-700 transition focus:outline-none focus:ring-2 focus:ring-emerald-400/60"
                  >
                    Enviar
                  </button>
                </div>
              </form>
            </div>
          </div>
        </ContenedorCentrado>
      </section>
    </template>
    