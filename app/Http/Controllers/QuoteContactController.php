<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\QuoteContactMail;

class QuoteContactController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => ['required', 'string', 'max:120'],
            'correo' => ['required', 'email', 'max:190'],
            'mensaje' => ['required', 'string', 'max:2000'],
        ]);

        // Destino configurable por .env
        $to = config('mail.quote_to');

        if (!$to) {
            return response()->json([
                'message' => 'No hay correo destino configurado (MAIL_QUOTE_TO).',
            ], 500);
        }

        Mail::to($to)->send(new QuoteContactMail($data));

        return response()->json(['ok' => true], 200);
    }
}