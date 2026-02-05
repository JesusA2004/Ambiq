<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class BlogController extends Controller
{
    public function index(): Response
    {
        // Hardcodeado: el listado lo arma Vue con blogPosts.ts
        return Inertia::render('Blog/Index');
    }

    public function show(string $slug): Response
    {
        // Hardcodeado: Vue buscará el post por slug
        return Inertia::render('Blog/Show', [
            'slug' => $slug,
        ]);
    }
}
