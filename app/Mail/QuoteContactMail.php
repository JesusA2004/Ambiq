<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class QuoteContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public array $data;

    public function __construct(array $data)
    {
        // Normalizamos para evitar "undefined index"
        $this->data = [
            'nombre'   => $data['nombre']   ?? 'Contacto',
            'correo'   => $data['correo']   ?? null,
            'telefono' => $data['telefono'] ?? null,
            'mensaje'  => $data['mensaje']  ?? '',
            'ip'       => $data['ip']       ?? null,
            'url'      => $data['url']      ?? null,
            'fecha'    => $data['fecha']    ?? null,
        ];
    }

    public function build()
    {
        $subject = 'Nueva solicitud de cotización desde el sitio web — ' . ($this->data['nombre'] ?? 'Contacto');

        return $this
            ->subject($subject)
            ->replyTo($this->data['correo'] ?: config('mail.from.address'))
            ->view('emails.quote-contact', [
                'data' => $this->data,
            ]);
    }
}
