<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;
use App\Http\Controllers\QuoteContactController;

Route::get('/', function () {
    return Inertia::render('Index', [
        'canRegister' => Features::enabled(Features::registration()),
    ]);
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::post('/cotizacion/contacto', [QuoteContactController::class, 'store'])
    ->name('cotizacion.contacto');

require __DIR__.'/settings.php';
