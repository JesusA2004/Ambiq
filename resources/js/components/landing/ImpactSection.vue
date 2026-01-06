<script setup lang="ts">
    import SeccionFullBleed from '@/components/landing/ui/SeccionFullBleed.vue'
    import ContenedorCentrado from '@/components/landing/ui/ContenedorCentrado.vue'
    import EncabezadoSeccion from '@/components/landing/ui/EncabezadoSeccion.vue'
    import TarjetaMetrica from '@/components/landing/ui/TarjetaMetrica.vue'
    
    type Metrica = {
      valor: string
      titulo?: string
      descripcion: string
    }
    
    const metricas: Metrica[] = [
      {
        valor: '+ 100',
        descripcion: 'Organizaciones aseguradas con éxito, incluyendo sectores como industria, construcción, energía e infraestructura pública.',
      },
      {
        valor: '+ 500',
        descripcion: 'Estudios ambientales aprobados sin rechazos por parte de autoridades federales o estatales.',
      },
      {
        valor: '+ 500',
        titulo: 'Participación en',
        descripcion: 'Proyectos de obra pública, garantizando cumplimiento normativo y viabilidad ambiental.',
      },
      {
        valor: '100%',
        descripcion: 'De multas evitadas a empresas asesoradas, siempre que han seguido nuestras recomendaciones.',
      },
    ]
    </script>
    
    <template>
      <SeccionFullBleed
        class="my-10 sm:my-14"
      >
        <!-- Fondo full + diagonales -->
        <div
          class="relative overflow-hidden
                 [clip-path:polygon(0_8%,100%_0,100%_92%,0_100%)]"
        >
          <!-- Background -->
          <div class="absolute inset-0 bg-gradient-to-br from-slate-950 via-slate-900 to-slate-950" />
          <div class="absolute inset-0 opacity-25 bg-[radial-gradient(circle_at_20%_50%,rgba(16,185,129,.25),transparent_55%)]" />
          <div class="absolute inset-0 opacity-15 bg-[radial-gradient(circle_at_70%_40%,rgba(34,197,94,.22),transparent_55%)]" />
    
          <!-- Marca de agua tipo hoja (simple, sin assets) -->
          <div class="pointer-events-none absolute -left-40 top-1/2 h-[560px] w-[560px] -translate-y-1/2 rounded-full bg-emerald-500/10 blur-0" />
          <div class="pointer-events-none absolute -left-10 top-1/2 h-[420px] w-[420px] -translate-y-1/2 rounded-full bg-white/5" />
    
          <ContenedorCentrado class="relative py-14 sm:py-20">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-12 items-start">
              <!-- Columna texto -->
              <div class="lg:col-span-4">
                <EncabezadoSeccion
                  etiqueta="CIFRAS"
                  titulo="Impacto Generado"
                  subtitulo="Resultados medibles que sostienen decisiones y reducen riesgo operativo."
                  alineacion="izquierda"
                />
              </div>
    
              <!-- Columna cards -->
              <div class="lg:col-span-8">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                  <!-- para replicar el feeling del screenshot: dos arriba, dos abajo -->
                  <TarjetaMetrica
                    :valor="metricas[0].valor"
                    :titulo="metricas[0].titulo"
                    :descripcion="metricas[0].descripcion"
                    class="sm:translate-y-0"
                  />
                  <TarjetaMetrica
                    :valor="metricas[1].valor"
                    :titulo="metricas[1].titulo"
                    :descripcion="metricas[1].descripcion"
                    class="sm:translate-y-6"
                  />
                  <TarjetaMetrica
                    :valor="metricas[2].valor"
                    :titulo="metricas[2].titulo"
                    :descripcion="metricas[2].descripcion"
                  />
                  <TarjetaMetrica
                    :valor="metricas[3].valor"
                    :titulo="metricas[3].titulo"
                    :descripcion="metricas[3].descripcion"
                    class="sm:-translate-y-2"
                  />
                </div>
              </div>
            </div>
          </ContenedorCentrado>
        </div>
      </SeccionFullBleed>
    </template>
    