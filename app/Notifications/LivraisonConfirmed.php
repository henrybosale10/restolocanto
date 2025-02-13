<?php

// app/Notifications/LivraisonConfirmed.php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;

class LivraisonConfirmed extends Notification
{
    use Queueable;

    protected $livraison;

    public function __construct($livraison)
    {
        $this->livraison = $livraison;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Confirmation de votre livraison')
            ->line("Votre commande #{$this->livraison->commande_id} a été expédiée pour livraison.")
            ->line("L'adresse de livraison : {$this->livraison->adresse}")
            ->line("Statut de la livraison : {$this->livraison->statut}")
            ->action('Voir votre commande', route('orders.show', $this->livraison->commande_id));
    }

    public function toDatabase($notifiable)
    {
        return [
            'livraison_id' => $this->livraison->id,
            'message' => "Votre commande #{$this->livraison->commande_id} a été expédiée pour livraison.",
        ];
    }
}
