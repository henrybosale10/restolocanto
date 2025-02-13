<?php
namespace App\Notifications;

use App\Models\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ReservationConfirmed extends Notification implements ShouldQueue
{
    use Queueable;

    protected $reservation;

    /**
     * Créer une nouvelle instance de notification.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return void
     */
    public function __construct(Reservation $reservation)
    {
        $this->reservation = $reservation;
    }

    /**
     * Méthode pour spécifier les canaux de notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'mail'];
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
            'reservation_id' => $this->reservation->id,
            'status' => 'confirmed',
            'message' => 'Votre réservation #' . $this->reservation->id . ' a été confirmée.',
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
            ->subject('Confirmation de votre réservation')
            ->greeting('Bonjour ' . $notifiable->name)
            ->line('Votre réservation #' . $this->reservation->id . ' a été confirmée.')
            ->action('Voir la réservation', url('/reservations/' . $this->reservation->id))
            ->line('Merci de faire affaire avec nous.');
    }
}
