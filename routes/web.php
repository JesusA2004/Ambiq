<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;
use App\Http\Controllers\QuoteContactController;
use App\Http\Controllers\BlogController;

Route::get('/', function () {
    return Inertia::render('Index', [
        'canRegister' => false,
    ]);
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/blog', function () {
    return Inertia::render('blog/Index');
})->name('blog.index');

Route::get('/blog/{slug}', fn(string $slug) => Inertia::render('blog/show', ['slug' => $slug]));

Route::post('/cotizacion/contacto', [QuoteContactController::class, 'store'])
    ->name('cotizacion.contacto');

// require __DIR__ . '/settings.php';
