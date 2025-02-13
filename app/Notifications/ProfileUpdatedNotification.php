<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ProfileUpdatedNotification extends Notification
{
    // Le modèle de l'utilisateur
    protected $user;

    // Constructeur
    public function __construct($user)
    {
        $this->user = $user;
    }

    // Définir les canaux de notification
    public function via($notifiable)
    {
        return ['mail', 'database']; // Envoi via email et base de données
    }

    // Notification par email
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Mise à jour de votre profil')
            ->line('Bonjour ' . $this->user->name . ',')
            ->line('Votre profil a été mis à jour avec succès.')
            ->action('Voir votre profil', url('/profil'))  // Lien vers la page du profil
            ->line('Merci de faire partie de notre communauté!');
    }

    // Notification via base de données
    public function toDatabase($notifiable)
    {
        return [
            'message' => 'Votre profil a été mis à jour avec succès.',
            'user_id' => $this->user->id,
        ];
    }
}
