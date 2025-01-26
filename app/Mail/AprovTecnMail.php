<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AprovTecnMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Nueva Solicitud de Mantenimiento - REBRETEC',
        );
    }

    /**
     * Get the message content definition.
     */
    public function build()
    {
        return $this->view('emails.admin.solicitud_recibida')
                    ->with([
                        'data' => $this->data,  
                    ]);
    }
    // public function content(): Content
    // {
    //     return new Content(
    //         view: 'emails.admin.solicitud_recibida',
    //     );
    // }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }

    // public function build()
    // {
    //     return $this
    //         ->subject('Nueva Solicitud de Mantenimiento - REBRETEC')
    //         ->view('emails.admin.solicitud_recibida')
    //         ->with('data', $this->data);
    // }
}
