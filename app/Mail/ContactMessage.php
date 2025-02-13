<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMessage extends Mailable
{
    use Queueable, SerializesModels;

    public $motif;
    public $messageContent;

    public function __construct($motif, $messageContent)
    {
        $this->motif = $motif;
        $this->messageContent = $messageContent;
    }

    public function build()
    {
        return $this->subject('Nouveau Message de Contact')
                    ->view('emails.contact');
    }
}
