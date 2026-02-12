<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\QuoteContactController;

/*
|--------------------------------------------------------------------------
| Public Landing
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return Inertia::render('Index', [
        'canRegister' => false,
        'section' => null,
    ]);
})->name('home');

/*
|--------------------------------------------------------------------------
| “Páginas” SEO para secciones (sin #)
| Reutilizan Index.vue y mandan un target para scroll
|--------------------------------------------------------------------------
| IMPORTANTE:
| 'section' debe coincidir con los IDs en Index.vue:
| inicio, quienes-somos, impacto, proceso, servicios, contacto, faq
*/

Route::get('/quienes-somos', function () {
    return Inertia::render('Index', [
        'canRegister' => false,
        'section' => 'quienes-somos',
    ]);
})->name('quienes-somos');

Route::get('/impacto', function () {
    return Inertia::render('Index', [
        'canRegister' => false,
        'section' => 'impacto',
    ]);
})->name('impacto');

Route::get('/proceso', function () {
    return Inertia::render('Index', [
        'canRegister' => false,
        'section' => 'proceso',
    ]);
})->name('proceso');

Route::get('/servicios', function () {
    return Inertia::render('Index', [
        'canRegister' => false,
        'section' => 'servicios',
    ]);
})->name('servicios');

Route::get('/contacto', function () {
    return Inertia::render('Index', [
        'canRegister' => false,
        'section' => 'contacto',
    ]);
})->name('contacto');

Route::get('/preguntas-frecuentes', function () {
    return Inertia::render('Index', [
        'canRegister' => false,
        'section' => 'faq',
    ]);
})->name('faq');

/*
|--------------------------------------------------------------------------
| Blog
|--------------------------------------------------------------------------
*/

Route::get('/blog', function () {
    return Inertia::render('blog/Index', [
        'canRegister' => false,
    ]);
})->name('blog.index');

Route::get('/blog/{slug}', function (string $slug) {
    return Inertia::render('blog/show', [
        'slug' => $slug,
        'canRegister' => false,
    ]);
})->where('slug', '[A-Za-z0-9\-]+')->name('blog.show');

/*
|--------------------------------------------------------------------------
| Cotización / contacto
|--------------------------------------------------------------------------
*/

Route::post('/cotizacion/contacto', [QuoteContactController::class, 'store'])
    ->name('cotizacion.contacto');

/*
|--------------------------------------------------------------------------
| Dashboard (privado)
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Settings / extra routes
|--------------------------------------------------------------------------
*/

require __DIR__ . '/settings.php';
