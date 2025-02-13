<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    /**
     * Afficher les détails d'un article de commande spécifique.
     */
    public function show($id)
    {
        // Récupérer l'article de commande
        $orderItem = OrderItem::findOrFail($id);

        // Retourner une vue avec les détails de l'article
        return view('order_items.show', compact('orderItem'));
    }

    /**
     * Mettre à jour la quantité d'un article de commande.
     */
    public function update(Request $request, $id)
    {
        // Récupérer l'article de commande
        $orderItem = OrderItem::findOrFail($id);

        // Mettre à jour la quantité
        $orderItem->update([
            'quantity' => $request->input('quantity'),
        ]);

        return redirect()->route('orders.show', $orderItem->order_id)->with('success', 'Quantité mise à jour.');
    }

    /**
     * Supprimer un article de commande.
     */
    public function destroy($id)
    {
        // Récupérer et supprimer l'article de commande
        $orderItem = OrderItem::findOrFail($id);
        $orderItem->delete();

        return redirect()->route('orders.show', $orderItem->order_id)->with('success', 'Article supprimé de la commande.');
    }
}
