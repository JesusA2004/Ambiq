<script setup>
    import { ref } from 'vue'
    import { Link } from '@inertiajs/vue3'
    
    const open = ref(false)
</script>
    
<template>
    <header class="sticky top-0 z-40 border-b border-[#19140035] bg-white/80 backdrop-blur dark:border-[#3E3E3A] dark:bg-[#0a0a0a]/70">
        <div class="mx-auto flex max-w-6xl items-center justify-between px-4 py-3">
            <a href="/" class="flex items-center gap-3">
                <!-- Cambia el logo -->
                <img src="/img/logo.svg" class="h-9 w-auto" alt="Logo" />
            </a>
        
            <nav class="hidden items-center gap-6 md:flex">
                <a href="#inicio" class="text-sm font-medium hover:opacity-80">Inicio</a>
                <a href="#features" class="text-sm font-medium hover:opacity-80">Features</a>
                <a href="#about" class="text-sm font-medium hover:opacity-80">Acerca</a>
                <a href="#cta" class="text-sm font-medium hover:opacity-80">Contacto</a>
            </nav>
        
            <div class="hidden items-center gap-2 md:flex">
                <Link
                href="/login"
                class="inline-flex rounded-sm border border-transparent px-4 py-2 text-sm font-semibold hover:border-[#19140035] dark:hover:border-[#3E3E3A]"
                >
                Log in
                </Link>
        
                <Link
                href="/register"
                class="inline-flex rounded-sm border border-[#19140035] px-4 py-2 text-sm font-semibold hover:border-[#1915014a] dark:border-[#3E3E3A] dark:hover:border-[#62605b]"
                >
                Register
                </Link>
            </div>
        
            <button
                type="button"
                class="inline-flex items-center gap-2 rounded-sm border border-[#19140035] px-3 py-2 text-sm font-semibold dark:border-[#3E3E3A] md:hidden"
                @click="open = !open"
            >
                Menú
            </button>
        </div>
    
        <div v-if="open" class="mx-auto max-w-6xl px-4 pb-4 md:hidden">
            <div class="rounded-lg border border-[#19140035] bg-white p-2 dark:border-[#3E3E3A] dark:bg-[#161615]">
                <a href="#inicio" class="block rounded-md px-3 py-2 text-sm hover:bg-black/5 dark:hover:bg-white/5">Inicio</a>
                <a href="#features" class="block rounded-md px-3 py-2 text-sm hover:bg-black/5 dark:hover:bg-white/5">Features</a>
                <a href="#about" class="block rounded-md px-3 py-2 text-sm hover:bg-black/5 dark:hover:bg-white/5">Acerca</a>
                <a href="#cta" class="block rounded-md px-3 py-2 text-sm hover:bg-black/5 dark:hover:bg-white/5">Contacto</a>
                <div class="mt-2 grid grid-cols-2 gap-2">
                <Link href="/login" class="rounded-md border border-[#19140035] px-3 py-2 text-center text-sm font-semibold dark:border-[#3E3E3A]">Log in</Link>
                <Link href="/register" class="rounded-md bg-[#1b1b18] px-3 py-2 text-center text-sm font-semibold text-white dark:bg-[#eeeeec] dark:text-[#1C1C1A]">Register</Link>
                </div>
            </div>
        </div>
    </header>
</template>
    