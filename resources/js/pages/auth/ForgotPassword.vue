<script setup lang="ts">
import TextLink from '@/components/TextLink.vue'
import { Button } from '@/components/ui/button'
import AuthLayout from '@/layouts/AuthLayout.vue'
import { login } from '@/routes'
import { Head } from '@inertiajs/vue3'

defineProps<{
  status?: string
}>()
</script>

<template>
  <AuthLayout
    title="Recuperar contraseña"
    description="Por el momento este servicio no está disponible."
  >
    <Head title="Recuperar contraseña" />

    <div
      v-if="status"
      class="mb-4 text-center text-sm font-medium text-green-600"
    >
      {{ status }}
    </div>

    <div class="space-y-6">
      <div
        class="rounded-lg border border-border bg-muted/40 p-4 text-sm text-muted-foreground"
      >
        <p class="font-medium text-foreground">
          Por el momento la recuperación de contraseña está fuera de servicio.
        </p>
        <p class="mt-1">
          Intenta más tarde. Si es urgente, solicita apoyo con tu administrador o soporte.
        </p>
      </div>

      <div class="flex flex-col gap-3">
        <Button as-child class="w-full">
          <TextLink :href="login()">Volver a iniciar sesión</TextLink>
        </Button>

        <div class="text-center text-sm text-muted-foreground">
          ¿No recuerdas tus accesos? Pide a soporte que te restablezca la cuenta.
        </div>
      </div>
    </div>
  </AuthLayout>
</template>
