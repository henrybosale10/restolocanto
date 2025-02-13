<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class OrderConfirmedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $order;

    /**
     * Créer une nouvelle instance de notification.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
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
            'order_id' => $this->order->id,
            'status' => 'confirmed',
            'message' => 'Votre commande #' . $this->order->id . ' a été confirmée.',
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
    ->subject('Confirmation de votre commande chez Heno Food')
    ->greeting('Bonjour ' . $notifiable->name . ',')
    ->line('Nous avons le plaisir de vous informer que votre commande #' . $this->order->id . ' a été confirmée avec succès.')
    ->line('Détails de la commande :')

    ->line('- Date de commande : ' . $this->order->created_at->format('d/m/Y H:i'))
    ->action('Voir les détails de la commande', url('/orders/' . $this->order->id))
    ->line('Merci de faire confiance à Heno Food pour vos repas. Nous espérons vous servir à nouveau bientôt!')
    ->line('Si vous avez des questions ou des préoccupations, n’hésitez pas à nous contacter.');

    }
}
