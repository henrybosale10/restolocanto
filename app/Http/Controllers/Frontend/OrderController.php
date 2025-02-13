<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\OrderConfirmedNotification;

class OrderController extends Controller
{
    /**
     * Afficher la page de création de commande.
     */
    public function create()
    {
        // Vérifier si l'utilisateur est authentifié
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Vous devez être connecté pour passer une commande.');
        }

        // Récupérer les éléments du panier
        $cartItems = Cart::where('user_id', Auth::id())->get();

        // Vérifier si le panier est vide
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Votre panier est vide.');
        }

        // Calculer le prix total de la commande
        $totalPrice = $cartItems->sum(function ($item) {
            return $item->platClient->prix * $item->quantity;
        });

        return view('frontend.orders.create', compact('cartItems', 'totalPrice'));
    }

    /**
     * Stocker une nouvelle commande.
     */
    public function store(Request $request)
    {
        // Vérifier si l'utilisateur est authentifié
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Vous devez être connecté pour passer une commande.');
        }

        // Récupérer les éléments du panier
        $cartItems = Cart::where('user_id', Auth::id())->get();

        // Vérifier si le panier est vide
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Votre panier est vide.');
        }

        // Calculer le prix total de la commande
        $totalPrice = $cartItems->sum(function ($item) {
            return $item->platClient->prix * $item->quantity;
        });

        // Créer la commande
        $order = $this->createOrder($totalPrice, $cartItems);

        // Vider le panier
        $cartItems->each->delete();

        // Envoi de la notification
        $this->sendOrderConfirmationNotification($order);

        // Retourner la page de remerciement avec un message de succès
        return redirect()->route('thankyou.page', ['orderId' => $order->id])
            ->with('success', 'Votre commande a été confirmée.');
    }

    /**
     * Créer la commande.
     */
    private function createOrder($totalPrice, $cartItems)
    {
        // Créer la commande
        $order = Order::create([
            'user_id' => Auth::id(),
            'total_price' => $totalPrice,
            'status' => 'pending', // Statut initial
        ]);

        // Enregistrer les éléments de la commande
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'platclient_id' => $item->platClient->id,
                'nom' => $item->platClient->nom,
                'price' => $item->platClient->prix,
                'quantity' => $item->quantity,
            ]);
        }

        return $order;
    }

    /**
     * Fonction pour envoyer la notification de confirmation de commande.
     */
  private function sendOrderConfirmationNotification($order)
{
    $user = Auth::user();
    $user->notify(new OrderConfirmedNotification($order));
}


    /**
     * Afficher les détails d'une commande.
     */
    public function show($orderId)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Vous devez être connecté pour voir cette commande.');
        }

        // Récupérer la commande avec ses éléments
        $order = Order::with('orderItems')->where('id', $orderId)->where('user_id', Auth::id())->first();

        // Vérifier si la commande existe
        if (!$order) {
            return redirect()->route('home')->with('error', 'Commande non trouvée.');
        }

        return view('frontend.orders.show', compact('order'));
    }

    /**
     * Afficher la page de remerciement.
     */
    public function thankYou($orderId)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Vous devez être connecté pour voir cette page.');
        }

        $order = Order::with('orderItems')->where('id', $orderId)->where('user_id', Auth::id())->firstOrFail();

        return view('frontend.orders.thankyou', compact('order'));
    }

    /**
     * Afficher les notifications de l'utilisateur.
     */
    public function showNotifications()
    {
        // Récupérer toutes les notifications de l'utilisateur connecté
        $notifications = auth()->user()->notifications;

        // Afficher les notifications
        return view('notifications.index', compact('notifications'));
    }
}
