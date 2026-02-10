<script setup lang="ts">
import TextLink from '@/components/TextLink.vue'
import { Button } from '@/components/ui/button'
import AuthBase from '@/layouts/AuthLayout.vue'
import { login } from '@/routes'
import { Head, usePage } from '@inertiajs/vue3'
import { computed } from 'vue'

const page = usePage<any>()

const siteUrl = import.meta.env.VITE_SITE_URL || 'https://consultoresambiq.com'
const currentPath = computed(() => (page?.url ? String(page.url).split('?')[0] : '/register'))
const canonical = computed(() => `${siteUrl}${currentPath.value}`)

// Solo imagen permitida
const ogImage = `${siteUrl}/img/favicon.ico`
</script>

<template>
  <AuthBase
    title="Registro temporalmente deshabilitado"
    description="El acceso se habilita únicamente por invitación del equipo de Ambiq."
  >
    <Head title="Registro deshabilitado">
      <meta name="robots" content="noindex,nofollow">
    </Head>

    <div class="space-y-4">
      <div class="rounded-xl border p-4 text-sm">
        <p class="font-medium">¿Necesitas acceso?</p>
        <p class="mt-1 opacity-80">
          Por ahora no hay registro público. Si tu acceso es legítimo, el equipo te lo habilita.
        </p>
      </div>

      <Button as-child class="w-full">
        <a :href="login().url">Ir a iniciar sesión</a>
      </Button>

      <div class="text-center text-sm text-muted-foreground">
        ¿Ya tienes una cuenta?
        <TextLink :href="login()" class="underline underline-offset-4">
          Inicia sesión
        </TextLink>
      </div>
    </div>
  </AuthBase>
</template>
