<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PlatClient;
use App\Http\Requests\PlatClientStoreRequest;
use App\Models\Menu;
use App\Models\Plat;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;


class PlatClientController extends Controller
{
    /**
     * Affiche la liste des plats clients.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
{
    // Récupérer les filtres de prix depuis la requête
    $prixMin = $request->input('prix_min');
    $prixMax = $request->input('prix_max');
    $search = $request->input('search'); // Récupérer la recherche

    // Appliquer les filtres si présents
    $platClients = PlatClient::query();

    if ($prixMin) {
        $platClients->where('prix', '>=', $prixMin);
    }

    if ($prixMax) {
        $platClients->where('prix', '<=', $prixMax);
    }

    if ($search) {
        $platClients->where(function ($query) use ($search) {
            $query->where('nom', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
        });
    }

    // Récupérer les plats clients avec pagination
    $platClients = $platClients->paginate(5);

    return view('admin.Plat_clients.index', compact('platClients'));
}


    /**
     * Affiche le formulaire pour créer un nouveau plat client.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
{
    $plats = Plat::all(); // Récupère tous les plats
    return view('admin.Plat_clients.create', compact('plats')); // Passe les plats à la vue
}

    /**
     * Enregistre un nouveau plat client.
     *
     * @param  \App\Http\Requests\PlatClientStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    // Validation des données
    $request->validate([
        'nom' => 'required|string|max:255',
        'description' => 'nullable|string',
        'prix' => 'required|numeric',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        'plat_id' => 'required|exists:plats,id', // Relation avec Plat
    ]);

    // Vérification des doublons
    $existingPlatClient = PlatClient::where('nom', $request->nom)
                                     ->where('plat_id', $request->plat_id)
                                     ->first();
    if ($existingPlatClient) {
        return redirect()->back()->with('error', 'Un plat client avec ce nom pour ce plat existe déjà.');
    }

    // Enregistrer l'image dans 'public/platclients' si elle est présente
    $imagePath = $request->hasFile('image') ? $request->file('image')->store('platclients', 'public') : null;

    // Créer un nouveau PlatClient
    PlatClient::create([
        'nom' => $request->nom,
        'description' => $request->description,
        'prix' => $request->prix,
        'image' => $imagePath,
        'plat_id' => $request->plat_id, // Associer le Plat sélectionné
    ]);

    // Rediriger avec succès
    return redirect()->route('admin.platclients.index')->with('success', 'PlatClient créé avec succès!');
}



    /**
 * Affiche le formulaire pour modifier un plat client.
 *
 * @param  \App\Models\PlatClient  $platClient
 * @return \Illuminate\Http\Response
 */
public function edit($id)
{
    $platClient = PlatClient::findOrFail($id);
    $plats = Plat::all(); // Récupère tous les plats pour l'association
    return view('admin.Plat_clients.edit', compact('platClient', 'plats'));
}

    /**
     * Met à jour les informations d'un plat client existant.
     *
     * @param  \App\Http\Requests\PlatClientStoreRequest  $request
     * @param  \App\Models\PlatClient  $platClient
     * @return \Illuminate\Http\Response
     */
    public function update(PlatClientStoreRequest $request, $id)
    {
        // Trouver le PlatClient par ID
        $platClient = PlatClient::findOrFail($id);

        // Vérifier si un autre plat client avec le même nom et plat_id existe déjà (en excluant l'élément actuel)
        $existingPlatClient = PlatClient::where('nom', $request->nom)
            ->where('plat_id', $request->plat_id)
            ->where('id', '!=', $id)
            ->first();

        if ($existingPlatClient) {
            return redirect()->back()->with('error', 'Un plat client avec ce nom pour ce plat existe déjà.');
        }

        // Gérer le téléchargement de l'image
        $imagePath = $platClient->image; // Image actuelle par défaut
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image si elle existe
            if ($platClient->image && Storage::exists($platClient->image)) {
                Storage::delete($platClient->image);
            }

            // Stocker la nouvelle image
            $imagePath = $request->file('image')->store('platclients', 'public');
        }

        // Mettre à jour les informations du plat client
        $platClient->update([
            'nom' => $request->nom,
            'description' => $request->description,
            'prix' => $request->prix,
            'image' => $imagePath,
            'plat_id' => $request->plat_id,
        ]);

        // Rediriger avec un message de succès
        return redirect()->route('admin.platclients.index')->with('success', 'Plat client mis à jour avec succès!');
    }







    /**
     * Supprime un plat client.
     *
     * @param  \App\Models\PlatClient  $platClient
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
{
    // Recherche explicite par ID
    $platClient = PlatClient::findOrFail($id);

    // Vérification et suppression de l'image
    if ($platClient->image && Storage::exists($platClient->image)) {
        Storage::delete($platClient->image);
    }

    // Suppression de l'enregistrement
    $platClient->delete();

    // Redirection avec un message de succès
    return redirect()->route('admin.platclients.index')->with('success', 'Plat client supprimé avec succès !');
}


}
