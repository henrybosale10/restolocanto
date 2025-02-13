<?php

// app/Notifications/OrderConfirmed.php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;

class OrderConfirmed extends Notification
{
    use Queueable;

    protected $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    // Définir les canaux (email et base de données)
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Confirmation de votre commande')
            ->line("Votre commande #{$this->order->id} a été confirmée.")
            ->action('Voir votre commande', route('orders.show', $this->order->id))
            ->line('Merci pour votre achat !');
    }

    public function toDatabase($notifiable)
    {
        return [
            'order_id' => $this->order->id,
            'message' => "Votre commande #{$this->order->id} a été confirmée.",
        ];
    }
}
