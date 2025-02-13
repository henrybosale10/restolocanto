<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMessageMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $motif;
    public string $message;

    public function __construct(string $motif, string $message)
    {
        $this->motif = $motif;
        $this->message = $message;
    }

    public function build()
    {
        return $this->subject('Nouveau message de contact')
                    ->view('emails.contact')
                    ->with([
                        'motif' => $this->motif,
                        'message' => $this->message,
                    ]);
    }
}
