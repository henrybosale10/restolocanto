<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AvisCommentaire;
use Illuminate\Http\Request;

class AvisCommentaireController extends Controller
{
    // Afficher les avis et commentaires
    public function index()
    {
        // Récupérer tous les avis et commentaires
        $avisCommentaires = AvisCommentaire::with('user', 'commentaires')->get();
        return view('admin.avis_commentaires.index', compact('avisCommentaires'));
    }

    // Afficher un formulaire pour créer un avis ou un commentaire
    public function create()
    {
        return view('admin.avis_commentaires.create');
    }

    // Enregistrer un nouvel avis ou un commentaire
    public function store(Request $request)
    {
        $request->validate([
            'contenu' => 'required|string|max:500',
            'note' => 'nullable|integer|between:1,5',
        ]);

        AvisCommentaire::create([
            'user_id' => auth()->id(),
            'contenu' => $request->contenu,
            'note' => $request->note,
            'avis_commentaire_id' => $request->avis_commentaire_id, // Pour les commentaires
        ]);

        return redirect()->route('admin.avis_commentaires.index')->with('success', 'Avis ou commentaire ajouté avec succès!');
    }

    // Afficher un formulaire pour éditer un avis/commentaire
    public function edit(AvisCommentaire $avisCommentaire)
    {
        return view('admin.avis_commentaires.edit', compact('avisCommentaire'));
    }

    // Mettre à jour un avis/commentaire
    public function update(Request $request, AvisCommentaire $avisCommentaire)
    {
        $request->validate([
            'contenu' => 'required|string|max:500',
            'note' => 'nullable|integer|between:1,5',
        ]);

        $avisCommentaire->update([
            'contenu' => $request->contenu,
            'note' => $request->note,
        ]);

        return redirect()->route('admin.avis_commentaires.index')->with('success', 'Avis ou commentaire mis à jour avec succès!');
    }

    // Supprimer un avis/commentaire
    public function destroy(AvisCommentaire $avisCommentaire)
    {
        $avisCommentaire->delete();

        return redirect()->route('admin.avis_commentaires.index')->with('success', 'Avis ou commentaire supprimé avec succès!');
    }
}
