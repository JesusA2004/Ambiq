<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Rutas para la página de soluciones y sus subpáginas
Route::get('/soluciones', function () {
    return Inertia::render('Solutions');
})->name('solutions');

Route::get('/nosotros', function () {
    return Inertia::render('About');
})->name('about');

Route::get('/consultoria-ambiental', function () {
    return Inertia::render('EnvironmentalConsulting');
})->name('environmental-consulting');

Route::get('/proteccion-civil-y-seguridad-laboral', function () {
    return Inertia::render('CivilProtection');
})->name('civil-protection');

Route::get('/gestion-territorial-y-tramitologia', function () {
    return Inertia::render('TerritorialManagement');
})->name('territorial-management');

Route::get('/ingenieria-y-servicios-tecnicos', function () {
    return Inertia::render('EngineeringServices');
})->name('engineering-services');

Route::get('/blog', function () {
    return Inertia::render('Blog');
})->name('blog');

Route::get('/contacto', function () {
    return Inertia::render('Contact');
})->name('contact');

Route::get('/aviso-de-privacidad', function () {
    return Inertia::render('Privacy');
})->name('privacy');
