<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\PlatClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Afficher le contenu du panier
    public function __construct()
    {
        // Partage global de la variable $cartCount avec toutes les vues
        view()->share('cartCount', $this->getCartCount());
    }

    /**
     * Afficher le panier de l'utilisateur.
     */
    public function index()
    {
        // Récupérer le panier de l'utilisateur connecté
        $cart = Cart::where('user_id', Auth::id())->get();

        // Calculer le total du panier et le nombre d'articles
        $total = 0;  // Initialisation de la variable $total pour éviter l'erreur
        $cartCount = 0;  // Initialisation de la variable $cartCount pour éviter l'erreur

        if ($cart->isNotEmpty()) {
            // Calculer le total du panier
            $total = $cart->sum(function ($item) {
                return $item->platClient->prix * $item->quantity;
            });

            // Calculer le nombre total d'articles dans le panier
            $cartCount = $cart->sum('quantity');  // Somme des quantités des articles
        }

        // Vérifier si le panier contient des articles
        $cartCount = $cartCount > 0 ? $cartCount : 0;

        // Retourner la vue avec les données du panier
        return view('frontend.cart.index', compact('cart', 'total', 'cartCount'));
    }

    /**
     * Récupérer le nombre d'articles dans le panier de l'utilisateur.
     */
    private function getCartCount()
{
    if (Auth::check()) {
        $count = Cart::where('user_id', Auth::id())->sum('quantity');
        dd($count);  // Ajoutez cette ligne pour inspecter la valeur
        return $count;
    }

    return 0;
}


    /**
     * Ajouter un article au panier.
     */
    public function addToCart(Request $request)
    {
        $validated = $request->validate([
            'platclient_id' => 'required|exists:plat_clients,id',
        ]);

        // Ajout au panier
        Cart::create([
            'user_id' => Auth::id(),
            'platclient_id' => $validated['platclient_id'],
            'quantity' => 1,
        ]);

        // Mise à jour du nombre d'articles
        $cartCount = $this->getCartCount();

        // Retour de la réponse JSON avec le nouveau compte du panier
        return response()->json([
            'cartCount' => $cartCount,
            'message' => 'Article ajouté au panier.'
        ]);
    }


    /**
     * Supprimer un article du panier.
     */
    public function removeFromCart($cartItemId)
    {
        // Trouver l'élément du panier
        $cartItem = Cart::where('user_id', Auth::id())->where('id', $cartItemId)->firstOrFail();

        // Supprimer l'élément
        $cartItem->delete();

        // Rediriger avec un message de succès
        return redirect()->route('cart.index')->with('success', 'Article supprimé du panier');
    }

    /**
     * Ajouter un article au panier via un autre chemin (utilise 'platclient_id')
     */
    public function add(Request $request)
    {
        // Récupérer les données envoyées dans la requête
        $platclientId = $request->input('platclient_id');  // Utilisation de 'platclient_id' en minuscules
        $quantity = $request->input('quantity', 1);  // Valeur par défaut si non précisé

        // Chercher ou créer l'élément du panier
        $cartItem = Cart::firstOrCreate(
            ['platclient_id' => $platclientId, 'user_id' => Auth::id()],
            ['quantity' => $quantity]
        );

        // Si l'élément existe déjà, mettre à jour la quantité
        if (!$cartItem->wasRecentlyCreated) {
            $cartItem->quantity += $quantity;
            $cartItem->save();
        }

        // Afficher un message flash de succès et rester sur la même page
        return redirect()->back()->with('success', 'Article ajouté au panier.');
    }


    /**
     * Supprimer un article du panier par son ID.
     */
    public function remove($id)
    {
        // Chercher l'élément du panier avec l'ID donné
        $cartItem = Cart::find($id);

        // Vérifier si l'élément appartient à l'utilisateur
        if ($cartItem && $cartItem->user_id == Auth::id()) {
            $cartItem->delete();
            return redirect()->route('cart.index')->with('success', 'Article supprimé du panier.');
        }

        return redirect()->route('cart.index')->with('error', 'Article non trouvé.');
    }

    /**
     * Mettre à jour la quantité d'un article dans le panier.
     */
    public function update(Request $request, $id)
    {
        // Chercher l'élément du panier avec l'ID donné
        $cartItem = Cart::find($id);

        // Vérifier si l'élément appartient à l'utilisateur
        if ($cartItem && $cartItem->user_id == Auth::id()) {
            // Mettre à jour la quantité
            $cartItem->quantity = $request->input('quantity');
            $cartItem->save();
            return redirect()->route('cart.index')->with('success', 'Quantité mise à jour.');
        }

        return redirect()->route('cart.index')->with('error', 'Article non trouvé.');
    }

    /**
     * Vider le panier de l'utilisateur.
     */
    public function clear()
    {
        // Récupérer tous les articles du panier pour l'utilisateur connecté
        $cartItems = Cart::where('user_id', Auth::id())->get();

        // Supprimer chaque article du panier
        foreach ($cartItems as $item) {
            $item->delete();
        }

        return redirect()->route('cart.index')->with('success', 'Panier vidé.');
    }
}
