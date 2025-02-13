<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Livreur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LivreurController extends Controller
{
    // Affiche le formulaire de création d'un livreur
    public function create()
    {
        return view('admin.livreurs.create');
    }

    // Enregistre un nouveau livreur
    public function store(Request $request)
    {
        // Validation des données
        $request->validate([
            'prenom' => 'required|string|max:255',
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:livreurs,email',
            'telephone' => 'nullable|string|max:15',
            'photo_profil' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'adresse' => 'nullable|string|max:255',
            'statut' => 'required|in:disponible,occupé,en pause',
            'date_embauche' => 'nullable|date',
        ]);

        // Gestion de la photo de profil (si elle est uploadée)
        $photo_profil_path = null;
        if ($request->hasFile('photo_profil')) {
            $photo_profil_path = $request->file('photo_profil')->store('photos_profil', 'public');
        }

        // Création du livreur
        Livreur::create([
            'prenom' => $request->prenom,
            'nom' => $request->nom,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'photo_profil' => $photo_profil_path,
            'adresse' => $request->adresse,
            'statut' => $request->statut,
            'date_embauche' => $request->date_embauche,
        ]);

        return redirect()->route('admin.livreurs.index')->with('success', 'Livreur ajouté avec succès.');
    }

    // Affiche le formulaire de modification d'un livreur
    public function edit(Livreur $livreur)
    {
        return view('admin.livreurs.edit', compact('livreur'));
    }

    // Met à jour les informations d'un livreur
    public function update(Request $request, Livreur $livreur)
    {
        // Validation des données
        $request->validate([
            'prenom' => 'required|string|max:255',
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:livreurs,email,' . $livreur->id,
            'telephone' => 'nullable|string|max:15',
            'photo_profil' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'adresse' => 'nullable|string|max:255',
            'statut' => 'required|in:disponible,occupé,en pause',
            'date_embauche' => 'nullable|date',
        ]);

        // Gestion de la photo de profil (si elle est uploadée)
        if ($request->hasFile('photo_profil')) {
            // Supprimer l'ancienne photo si elle existe
            if ($livreur->photo_profil && Storage::exists('public/' . $livreur->photo_profil)) {
                Storage::delete('public/' . $livreur->photo_profil);
            }
            // Enregistrer la nouvelle photo
            $photo_profil_path = $request->file('photo_profil')->store('photos_profil', 'public');
        } else {
            $photo_profil_path = $livreur->photo_profil; // Conserver l'ancienne photo si pas de mise à jour
        }

        // Mise à jour du livreur
        $livreur->update([
            'prenom' => $request->prenom,
            'nom' => $request->nom,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'photo_profil' => $photo_profil_path,
            'adresse' => $request->adresse,
            'statut' => $request->statut,
            'date_embauche' => $request->date_embauche,
        ]);

        return redirect()->route('admin.livreurs.index')->with('success', 'Livreur mis à jour avec succès.');
    }

    // Affiche les détails d'un livreur
    public function show(Livreur $livreur)
    {
        return view('admin.livreurs.show', compact('livreur'));
    }

    // Liste de tous les livreurs (si nécessaire, à ajouter pour la gestion des livreurs)
    public function index(Request $request)
{
    $query = Livreur::query();

    // Filtrer par nom
    if ($request->has('nom') && $request->nom != '') {
        $query->where('nom', 'like', '%' . $request->nom . '%');
    }

    // Filtrer par statut
    if ($request->has('statut') && $request->statut != '') {
        $query->where('statut', $request->statut);
    }

    // Filtrer par date d'embauche
    if ($request->has('date_embauche') && $request->date_embauche != '') {
        $query->whereDate('date_embauche', '=', $request->date_embauche);
    }

    // Récupérer les livreurs filtrés avec pagination
    $livreurs = $query->paginate(5);

    return view('admin.livreurs.index', compact('livreurs'));
}



    // Supprimer un livreur (si nécessaire)
    public function destroy(Livreur $livreur)
    {
        if ($livreur->photo_profil && Storage::exists('public/' . $livreur->photo_profil)) {
            Storage::delete('public/' . $livreur->photo_profil);
        }

        $livreur->delete();

        return redirect()->route('admin.livreurs.index')->with('success', 'Livreur supprimé avec succès.');
    }
}
