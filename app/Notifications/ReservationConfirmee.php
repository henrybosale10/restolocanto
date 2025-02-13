<?php

// app/Notifications/ReservationConfirmee.php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ReservationConfirmee extends Notification
{
    use Queueable;

    protected $reservation;

    public function __construct($reservation)
    {
        $this->reservation = $reservation;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Confirmation de votre réservation')
            ->line("Votre réservation pour le {$this->reservation->date_reservation} a été confirmée.")
            ->action('Voir les détails', route('reservations.show', $this->reservation->id))
            ->line('Merci de votre confiance.');
    }
}
