<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class WelcomeNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $user;

    /**
     * Créer une nouvelle instance de notification.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Méthode pour spécifier les canaux de notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'mail']; // Envoi via base de données et email
    }

    /**
     * Méthode pour envoyer la notification via la base de données.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'user_id' => $this->user->id,
            'message' => 'Bienvenue ' . $this->user->name . ' sur notre plateforme !',
        ];
    }

    /**
     * Méthode pour envoyer la notification par email.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Bienvenue chez nous !')
            ->greeting('Bonjour ' . $this->user->name)
            ->line('Merci de vous être inscrit sur notre plateforme.')
            ->line('Nous sommes heureux de vous accueillir parmi nous.')
            ->line('Vous pouvez maintenant explorer notre site et profiter de nos services.')
            ->action('Explorer maintenant', url('/'))
            ->line('Merci de faire partie de notre communauté !');
    }
}
