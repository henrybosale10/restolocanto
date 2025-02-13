<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderAdminController extends Controller
{
    // Afficher toutes les commandes
    public function index(Request $request)
{
    $query = Order::query();

    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    if ($request->filled('date')) {
        $query->whereDate('created_at', $request->date);
    }

    $orders = $query->paginate(5);

    return view('admin.orders.index', compact('orders'));
}



    // Afficher les détails d'une commande
    public function show($orderId)
    {
        $order = Order::with('orderItems')->findOrFail($orderId);
        return view('admin.orders.show', compact('order'));
    }

    // Mettre à jour le statut de la commande
    public function updateStatus(Request $request, $orderId)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled',
        ]);

        $order = Order::findOrFail($orderId);
        $order->status = $request->status;
        $order->save();

        return redirect()->route('admin.orders.index')->with('success', 'Le statut de la commande a été mis à jour avec succès.');
    }
}
