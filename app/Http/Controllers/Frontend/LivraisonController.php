<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Livraison;
use App\Models\Livreur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\LivraisonConfirmed;

class LivraisonController extends Controller
{
    // Afficher le formulaire de livraison
    public function create($orderId)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Vous devez être connecté.');
        }

        $order = Order::with('orderItems')
            ->where('id', $orderId)
            ->where('user_id', Auth::id())
            ->first();

        if (!$order) {
            return redirect()->route('home')->with('error', 'Commande introuvable.');
        }

        $livreurs = Livreur::all();
        return view('frontend.livraisons.create', compact('order', 'livreurs'));
    }

    // Enregistrer une nouvelle livraison
    public function store(Request $request, $orderId)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Vous devez être connecté.');
        }

        $validated = $request->validate([
            'delivery_type' => 'required|in:livraison,retrait',
            'address' => $request->input('delivery_type') === 'livraison' ? 'required|string|max:255' : 'nullable',
            'livreur_id' => 'required|exists:livreurs,id',
            'heure_livraison' => 'required|date_format:H:i',
        ]);

        $order = Order::where('id', $orderId)->where('user_id', Auth::id())->first();
        if (!$order) {
            return redirect()->route('home')->with('error', 'Commande introuvable.');
        }

        $now = now();
        $heureLivraison = $now->setTimeFromTimeString($validated['heure_livraison']);

        $livraison = Livraison::create([
            'commande_id' => $order->id,
            'adresse' => $validated['address'] ?? null,
            'type' => $validated['delivery_type'],
            'livreur_id' => $validated['livreur_id'],
            'heure_livraison' => $heureLivraison,
            'statut' => 'en attente',
            'prix' => 4000,  // Vous pouvez ajuster le prix ici
        ]);

        Auth::user()->notify(new LivraisonConfirmed($livraison));
        return redirect()->route('livraisons.confirmation', ['orderId' => $order->id])
            ->with('success', 'Mode de livraison sélectionné avec succès.');
    }

    // Afficher la confirmation de livraison
    public function confirmation($orderId)
    {
        $order = Order::where('id', $orderId)
            ->where('user_id', Auth::id())
            ->first();

        if (!$order) {
            return redirect()->route('home')->with('error', 'Commande introuvable.');
        }

        $livraison = Livraison::where('commande_id', $order->id)->first();
        return view('frontend.livraisons.confirmation', compact('order', 'livraison'));
    }

    // Mettre à jour le statut de la livraison
    public function updateStatus(Request $request, $livraisonId)
    {
        $validated = $request->validate([
            'statut' => 'required|string|in:en attente,expédiée,livrée,annulée',
        ]);

        $livraison = Livraison::find($livraisonId);
        if (!$livraison) {
            return redirect()->route('home')->with('error', 'Livraison introuvable.');
        }

        $livraison->update(['statut' => $validated['statut']]);
        return back()->with('success', 'Statut mis à jour.');
    }

    // Afficher les détails d'une livraison
    public function show($livraisonId)
    {
        $livraison = Livraison::find($livraisonId);
        if (!$livraison) {
            return redirect()->route('home')->with('error', 'Livraison introuvable.');
        }
        return view('frontend.livraisons.details', compact('livraison'));
    }
}
