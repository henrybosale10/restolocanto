<?php

<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LivraisonNotification extends Notification
{
    use Queueable;

    protected $livraison;

    /**
     * Crée une nouvelle instance de notification.
     *
     * @param $livraison
     */
    public function __construct($livraison)
    {
        $this->livraison = $livraison;
    }

    /**
     * Détermine les canaux de notification.
     */
    public function via($notifiable)
    {
        return ['mail', 'database']; // Envoi par email et sauvegarde en base de données
    }

    /**
     * Contenu de l'email.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Mise à jour de votre livraison')
            ->greeting('Bonjour ' . $notifiable->name . ',')
            ->line('Votre commande sera livrée dans environ 1 heure.')
            ->line('Détails de la livraison :')
            ->line('Adresse : ' . $this->livraison->adresse)
            ->line('Type : ' . ucfirst($this->livraison->type))
            ->line('Statut : ' . ucfirst($this->livraison->statut))
            ->action('Voir les détails', url('/livraisons/' . $this->livraison->id))
            ->line('Merci de votre confiance !');
    }

    /**
     * Sauvegarder dans la base de données.
     */
    public function toDatabase($notifiable)
    {
        return [
            'message' => 'Votre commande sera livrée dans environ 1 heure.',
            'livraison_id' => $this->livraison->id,
            'adresse' => $this->livraison->adresse,
            'type' => $this->livraison->type,
        ];
    }
}
