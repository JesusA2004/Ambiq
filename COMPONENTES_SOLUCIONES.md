# Componentes de la Página de Soluciones

Este documento describe los componentes creados para replicar la interfaz de la página de soluciones de IÉSIMA.

## Componentes Creados

### 1. Header (`resources/js/components/Header.vue`)
Componente de navegación principal con:
- Logo (configurable)
- Menú de navegación con dropdowns
- Botón de contacto
- Menú móvil responsive

**Personalización:**
- Cambiar el logo: Modificar la prop `logoUrl` o la constante `logoUrl` en el script
- Modificar menú: Editar el array `menuItems` con las rutas correspondientes

### 2. HeroSection (`resources/js/components/HeroSection.vue`)
Sección hero con título animado que cambia automáticamente.

**Personalización:**
- Textos animados: Modificar el array `texts` en el script
- Velocidad de animación: Ajustar el intervalo en `onMounted` (actualmente 8000ms)

### 3. IntroductionSection (`resources/js/components/IntroductionSection.vue`)
Sección de introducción con título y descripción.

**Personalización:**
- Editar directamente el contenido HTML del componente

### 4. SolutionsGrid (`resources/js/components/SolutionsGrid.vue`)
Grid de tarjetas de soluciones.

**Personalización:**
- Modificar el array `solutions` con:
  - `icon`: Ruta a la imagen del icono
  - `title`: Título de la solución
  - `description`: Descripción
  - `href`: Ruta de destino

### 5. SolutionCard (`resources/js/components/SolutionCard.vue`)
Tarjeta individual de solución (usado por SolutionsGrid).

### 6. StatisticsSection (`resources/js/components/StatisticsSection.vue`)
Sección de estadísticas con fondo degradado y formas SVG.

**Personalización:**
- Modificar el array `statistics` con:
  - `number`: Número/cifra a mostrar
  - `description`: Descripción completa
  - `highlight`: Texto a resaltar en negrita
  - `prefix`: Texto opcional antes del número

### 7. StatCard (`resources/js/components/StatCard.vue`)
Tarjeta individual de estadística (usado por StatisticsSection).

### 8. Footer (`resources/js/components/Footer.vue`)
Pie de página con información de contacto y enlaces.

**Personalización:**
- Logo: Cambiar la ruta en `src="/images/logo-iesima-cabecera.svg"`
- Información de contacto: Editar directamente en el template
- Enlaces de navegación: Modificar arrays `navigationLinks` y `solutionLinks`

### 9. WhatsAppPopup (`resources/js/components/WhatsAppPopup.vue`)
Popup modal con formulario para redirigir a WhatsApp.

**Personalización:**
- Número de WhatsApp: Cambiar `whatsappNumber` en el script (actualmente '527717958589')
- Campos del formulario: Modificar el objeto `form` y los campos en el template

### 10. Solutions (`resources/js/pages/Solutions.vue`)
Página principal que integra todos los componentes.

## Imágenes Necesarias

Coloca las siguientes imágenes en `public/images/`:

- `logo-iesima-cabecera.svg` - Logo para header y footer
- `icono-consultoria-ambiental.svg` - Icono para consultoría ambiental
- `icono-proteccion-civil.svg` - Icono para protección civil
- `icono-gestion-territorial.svg` - Icono para gestión territorial
- `icono-ingenieria.svg` - Icono para ingeniería

## Rutas Necesarias

Las rutas ya están configuradas en `routes/soluciones.php` y se incluyen automáticamente en `routes/web.php`. 

Si necesitas crear las páginas correspondientes, crea los siguientes componentes Vue en `resources/js/pages/`:
- `About.vue`
- `EnvironmentalConsulting.vue`
- `CivilProtection.vue`
- `TerritorialManagement.vue`
- `EngineeringServices.vue`
- `Blog.vue`
- `Contact.vue`
- `Privacy.vue`

Por ahora, todas las rutas renderizan páginas básicas que puedes personalizar después.

## Uso

Para usar la página de soluciones, simplemente importa y renderiza el componente:

```vue
<template>
  <Solutions />
</template>

<script setup>
import Solutions from '@/pages/Solutions.vue';
</script>
```

O desde un controlador Laravel con Inertia:

```php
return Inertia::render('Solutions');
```

## Estilos

Los componentes usan Tailwind CSS y las variables CSS definidas en `resources/css/app.css`. Los colores y estilos se pueden personalizar modificando las variables CSS en ese archivo.

## Animaciones

Los componentes incluyen animaciones CSS personalizadas:
- `fade-in`: Fade in básico
- `slide-in-left`: Deslizamiento desde la izquierda
- `slide-up`: Deslizamiento desde abajo
- `fade-in-right`: Fade in desde la derecha

Las animaciones se pueden ajustar o desactivar modificando los estilos en cada componente.
