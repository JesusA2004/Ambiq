<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" @class(['dark' => ($appearance ?? 'system') == 'dark'])>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- SEO base (global) --}}
    <meta name="application-name" content="Ambiq Consultores">
    <meta name="author" content="Ambiq Consultores">
    <meta name="robots" content="index,follow,max-image-preview:large,max-snippet:-1,max-video-preview:-1">

    {{-- Descripción global (puedes afinarla por página con

    <Head> en Inertia) --}}
        <meta name="description"
            content="Ambiq Consultores: seguridad industrial, salud en el trabajo y cumplimiento ambiental. Análisis de riesgos críticos, NOM STPS, SEMARNAT y evidencia lista para auditoría con acompañamiento técnico.">

        {{-- Keywords (no es el factor #1 de Google, pero sirve como cobertura de variaciones) --}}
        <meta name="keywords"
            content="Ambiq, Ambiq Consultores, AmbiQ Consultores, consultores ambiq, consultoresambiq, consultores ambiq com, consultoresambiq.com, consultores, consultoría, consultoria, seguridad industrial, salud en el trabajo, cumplimiento normativo, cumplimiento ambiental, STPS, SEMARNAT, NOM, NOM STPS, NOM-017-STPS-2024, NOM-035-STPS-2018, NOM-036-STPS-2018, NOM-010-STPS-2014, NOM-020-STPS-2011, NOM-026-STPS-2008, NOM-030-STPS-2009, PASST, EPP, equipo de protección personal, riesgos críticos, auditoría, inspección, evidencia para auditoría, protección civil, PIPC, LAU, COA, COI, MIA, informe preventivo, CRETIB, residuos peligrosos, emisiones, calidad del aire, PM10, COV">

        {{-- Canonical (evita duplicados por query/hash) --}}
        <link rel="canonical" href="{{ rtrim(config('app.url'), '/') . strtok(request()->getRequestUri(), '?') }}">

        {{-- Open Graph / WhatsApp / Facebook --}}
        <meta property="og:site_name" content="Ambiq Consultores">
        <meta property="og:type" content="website">
        <meta property="og:title" content="Ambiq Consultores | Seguridad · Salud · Ambiente">
        <meta property="og:description"
            content="Cumplimiento y prevención con claridad operativa. Seguridad industrial, salud en el trabajo y cumplimiento ambiental con evidencia lista para auditoría.">
        <meta property="og:url" content="{{ rtrim(config('app.url'), '/') . request()->getRequestUri() }}">

        <meta property="og:image" content="{{ asset('favicon.svg') }}">

        {{-- Twitter --}}
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="Ambiq Consultores | Seguridad · Salud · Ambiente">
        <meta name="twitter:description"
            content="Seguridad industrial, salud en el trabajo y cumplimiento ambiental con documentación lista para auditoría.">
        <meta name="twitter:image" content="{{ asset('favicon.svg') }}">

        {{-- Inline script to detect system dark mode preference and apply it immediately --}}
        <script>
            (function () {
                const appearance = '{{ $appearance ?? "system" }}';

                if (appearance === 'system') {
                    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

                    if (prefersDark) {
                        document.documentElement.classList.add('dark');
                    }
                }
            })();
        </script>

        {{-- Inline style to set the HTML background color based on our theme in app.css --}}
        <style>
            html {
                background-color: oklch(1 0 0);
            }

            html.dark {
                background-color: oklch(0.145 0 0);
            }
        </style>

        {{-- Title base (lo ideal: sobrescribir por página con

        <Head title="...">) --}}
            <title inertia>{{ config('app.name') }}</title>

            <link rel="preconnect" href="https://rsms.me">
            <link rel="stylesheet" href="https://rsms.me/inter/inter.css">

            <link rel="icon" href="/favicon.ico?v=2">
            <link rel="icon" type="image/svg" sizes="16x16" href="/favicon.svg?v=2">
            <link rel="apple-touch-icon" href="/apple-touch-icon.png?v=2">

            <link rel="preconnect" href="https://fonts.bunny.net">
            <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

            @vite(['resources/js/app.ts', "resources/js/pages/{$page['component']}.vue"])
            @inertiaHead
        </head>

    <body class="font-sans antialiased">
        @inertia
    </body>

</html>