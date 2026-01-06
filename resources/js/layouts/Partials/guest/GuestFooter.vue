<script setup>
</script>

<template>
  <footer class="border-t border-[#19140035] py-10 dark:border-[#3E3E3A]">
    <div class="mx-auto max-w-6xl px-4">
      <div class="flex flex-col gap-6 md:flex-row md:items-center md:justify-between">
        <div class="flex items-center gap-3">
          <img src="/img/logo.svg" class="h-8 w-auto" alt="Logo" />
          <div class="text-sm font-semibold">Brand</div>
        </div>

        <div class="flex flex-wrap gap-4 text-sm text-[#706f6c] dark:text-[#A1A09A]">
          <a href="#inicio" class="hover:opacity-80">Inicio</a>
          <a href="#features" class="hover:opacity-80">Features</a>
          <a href="#about" class="hover:opacity-80">Acerca</a>
          <a href="#cta" class="hover:opacity-80">Contacto</a>
        </div>
      </div>

      <div class="mt-6 text-xs text-[#706f6c] dark:text-[#A1A09A]">
        © {{ new Date().getFullYear() }} Brand. Todos los derechos reservados.
      </div>
    </div>
  </footer>
</template>
