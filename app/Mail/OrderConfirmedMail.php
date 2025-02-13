<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderConfirmedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function build()
    {
        return $this->subject('Confirmation de votre commande')
                    ->view('emails.orders.confirmed') // Une vue pour le mail
                    ->with([
                        'orderId' => $this->order->id,
                        'totalPrice' => $this->order->total_price,
                    ]);
    }
}
