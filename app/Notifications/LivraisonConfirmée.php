<?php

// app/Notifications/LivraisonConfirmée.php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LivraisonConfirmée extends Notification
{
    use Queueable;

    private $livraison;

    public function __construct($livraison)
    {
        $this->livraison = $livraison;
    }

    // Définir le canal (par exemple, Mail)
    public function via($notifiable)
    {
        return ['mail']; // Vous pouvez également ajouter des notifications sur d'autres canaux comme 'database', 'broadcast', etc.
    }

    // Construire le message de la notification
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Confirmation de Livraison')
            ->greeting('Bonjour!')
            ->line('Votre commande a été confirmée pour la livraison.')
            ->line('Type de livraison: ' . $this->livraison->type)
            ->line('Adresse de livraison: ' . $this->livraison->adresse)
            ->line('Statut: ' . $this->livraison->statut)
            ->action('Voir la livraison', url('/livraison/' . $this->livraison->id))
            ->line('Merci de votre confiance!');
    }

    // Si vous voulez aussi envoyer des notifications dans la base de données, vous pouvez utiliser `toDatabase`.
    public function toDatabase($notifiable)
    {
        return [
            'livraison_id' => $this->livraison->id,
            'statut' => $this->livraison->statut,
            'adresse' => $this->livraison->adresse,
        ];
    }
}
