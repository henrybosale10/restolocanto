<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlatStoreRequest;
use App\Models\Plat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PlatController extends Controller
{
    public function index(Request $request)
{
    // Get the search keyword from the request
    $search = $request->input('search');

    // Apply search filter if provided
    $plats = Plat::when($search, function ($query, $search) {
        return $query->where('nom', 'like', '%' . $search . '%');
    })->paginate(5); // Paginate results

    return view('admin.plats.index', compact('plats'));
}



    // Afficher le formulaire de création d'un plat
    public function create()
    {
        return view('admin.plats.create');
    }

    // Enregistrer un nouveau plat dans la base de données
    public function store(PlatStoreRequest $request)
{
    // Vérifier si un plat avec le même nom existe déjà
    $existingPlat = Plat::where('nom', $request->nom)->first();
    if ($existingPlat) {
        return redirect()->back()->with('error', 'Un plat avec ce nom existe déjà.');
    }

    // Créer un nouveau plat
    $plat = Plat::create([
        'nom' => $request->nom,
        'description' => $request->description,
        'image' => $request->file('image') ? $request->file('image')->store('plat', 'public') : null,
    ]);

    // Rediriger avec un message de succès
    return redirect()->route('admin.plats.index')->with('success', 'Plat créé avec succès!');
}


    // Afficher le formulaire d'édition d'un plat
    public function edit($id)
    {
        $plat = Plat::findOrFail($id); // Trouver le plat par ID
        return view('admin.plats.edit', compact('plat')); // Retourner la vue d'édition avec le plat
    }

    // Mettre à jour un plat existant
    public function update(PlatStoreRequest $request, $id)
{
    $plat = Plat::findOrFail($id); // Trouver le plat par ID

    // Vérifier si un autre plat avec le même nom existe déjà (en excluant le plat en cours)
    $existingPlat = Plat::where('nom', $request->nom)->where('id', '!=', $id)->first();
    if ($existingPlat) {
        return redirect()->back()->with('error', 'Un plat avec ce nom existe déjà.');
    }

    // Mettre à jour les informations du plat
    $plat->update([
        'nom' => $request->nom,
        'description' => $request->description,
        'image' => $request->file('image') ? $request->file('image')->store('plats') : $plat->image,
    ]);

    // Rediriger avec un message de succès
    return redirect()->route('admin.plats.index')->with('success', 'Plat mis à jour avec succès !');
}


    // Supprimer un plat
    public function destroy($id)
    {
        $plat = Plat::findOrFail($id); // Trouver le plat par ID

        // Si une image est associée au plat, la supprimer du stockage
        if ($plat->image) {
            Storage::delete($plat->image); // Supprimer l'image du stockage
        }

        // Supprimer le plat
        $plat->delete();

        // Rediriger avec un message de succès
        return redirect()->route('admin.plats.index')->with('success', 'Plat supprimé avec succès !');
    }
}
