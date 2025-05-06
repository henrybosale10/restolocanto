<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Paiement;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    /**
     * Affiche la page de checkout.
     *
     * @param int $order_id
     * @return \Illuminate\View\View    
     */
    public function showCheckout($order_id)
    {
        // Récupérer la commande
        $order = Order::find($order_id);

        if (!$order) {
            Log::error("Erreur : commande ID {$order_id} non trouvée.");
            return redirect()->route('home')->with('error', 'Commande non trouvée.');
        }

        // Afficher la vue de checkout
        return view('payment.checkout', compact('order'));
    }

    /**
     * Traite la soumission du formulaire de paiement.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function processCheckout(Request $request)
    {
        // Valider les données de la requête
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'payment_method' => 'required|string',
        ]);

        // Récupérer les données de la requête
        $orderId = $request->input('order_id');
        $paymentMethod = $request->input('payment_method');

        // Logique de traitement du paiement
        try {
            // Créer un paiement
            $paiement = Paiement::create([
                'order_id' => $orderId,
                'payment_method' => $paymentMethod,
                'status' => 'pending',
            ]);

            // Rediriger vers la page de succès
            return redirect()->route('payment.success')->with('success', 'Paiement en cours de traitement.');

        } catch (\Exception $e) {
            Log::error("Erreur lors du traitement du paiement : " . $e->getMessage());
            return redirect()->route('checkout.show', ['order_id' => $orderId])->with('error', 'Erreur lors du traitement du paiement.');
        }
    }

    /**
     * Callback après paiement.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function callback(Request $request)
    {
        // Logique de callback
        Log::info("Callback reçu : " . json_encode($request->all()));

        // Rediriger vers la page de succès
        return redirect()->route('payment.success')->with('success', 'Paiement effectué avec succès.');
    }

    /**
     * Affiche la page de succès de paiement.
     *
     * @return \Illuminate\View\View
     */
    public function success()
    {
        return view('payment.success');
    }
}
