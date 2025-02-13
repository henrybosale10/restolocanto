<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AvisCommentaire;
use Illuminate\Http\Request;

class Avis_CommentaController extends Controller
{
    // Afficher tous les avis
    public function index()
{
    // Récupérer les commentaires avec pagination (10 éléments par page)
    $avisCommentaires = AvisCommentaire::with('user', 'likes', 'dislikes')->paginate(4);

    return view('frontend.avis_commenta.index', compact('avisCommentaires'));
}


    // Afficher le formulaire de création d'avis
    public function create()
    {
        return view('frontend.avis_commenta.create');
    }

    // Enregistrer un nouvel avis
    public function store(Request $request)
    {
        // Validation des champs
        $request->validate([
            'contenu' => 'required|string',
            'note' => 'required|integer|min:1|max:5',
        ]);

        // Vérification si l'utilisateur est connecté
        if (!auth()->check()) {
            return redirect()->route('login')->withErrors(['Vous devez être connecté pour ajouter un commentaire.']);
        }

        // Vérifier si l'utilisateur a déjà posté 3 avis
        $userAvisCount = AvisCommentaire::where('user_id', auth()->id())->count();

        if ($userAvisCount >= 3) {
            return redirect()->route('avis_commentaire.index')->withErrors(['Vous avez déjà laissé 3 avis, vous ne pouvez pas en ajouter davantage.']);
        }

        // Créer le commentaire
        AvisCommentaire::create([
            'contenu' => $request->contenu,
            'note' => $request->note,
            'user_id' => auth()->id(), // Associe l'avis à l'utilisateur connecté
        ]);

        return redirect()->route('avis_commentaire.index')
            ->with('success', 'Votre commentaire a été ajouté avec succès.');
    }

    // Modifier un avis existant
    public function edit($id)
    {
        $avisCommentaire = AvisCommentaire::findOrFail($id);

        return view('frontend.avis_commenta.edit', compact('avisCommentaire'));
    }

    // Méthode pour mettre à jour un commentaire
    public function update(Request $request, $id)
    {
        $avisCommentaire = AvisCommentaire::findOrFail($id);

        // Vérifier si l'utilisateur est le propriétaire de l'avis
        if ($avisCommentaire->user_id != auth()->id()) {
            return redirect()->route('avis_commentaire.index')
                ->withErrors(['Vous n\'êtes pas autorisé à modifier cet avis.']);
        }

        // Validation des champs de la requête
        $request->validate([
            'contenu' => 'required|string',
            'note' => 'required|integer|min:1|max:5',
        ]);

        // Si le contenu a changé, mettez à jour l'avis, sinon, ne modifiez pas l'avis
        if ($avisCommentaire->contenu != $request->contenu || $avisCommentaire->note != $request->note) {
            $avisCommentaire->update([
                'contenu' => $request->contenu,
                'note' => $request->note,
            ]);
            return redirect()->route('avis_commentaire.index')->with('success', 'Commentaire mis à jour avec succès.');
        }

        return redirect()->route('avis_commentaire.index')->with('info', 'Aucune modification n\'a été effectuée.');
    }

    // Supprimer un avis
    public function destroy($id)
    {
        $avisCommentaire = AvisCommentaire::findOrFail($id);
        $avisCommentaire->delete();

        return redirect()->route('avis_commentaire.index')
            ->with('success', 'Le commentaire a été supprimé.');
    }
    public function like($id)
    {
        $avis = AvisCommentaire::findOrFail($id);
        $user = auth()->user();

        // Vérifiez si l'utilisateur a déjà interagi avec cet avis
        $existingInteraction = $avis->likes()
            ->where('user_id', $user->id)
            ->first();

        if ($existingInteraction) {
            if ($existingInteraction->pivot->is_like) {
                // L'utilisateur a déjà liké, donc on supprime le like
                $avis->likes()->detach($user->id);
                return back()->with('message', 'Votre like a été retiré.');
            }

            // L'utilisateur a disliké, on remplace par un like
            $avis->likes()->updateExistingPivot($user->id, ['is_like' => true]);
            return back()->with('message', 'Vous avez changé votre dislike en like.');
        }

        // Si aucune interaction, on ajoute un like
        $avis->likes()->attach($user->id, ['is_like' => true]);
        return back()->with('message', 'Votre like a été ajouté.');
    }

    public function dislike($id)
    {
        $avis = AvisCommentaire::findOrFail($id);
        $user = auth()->user();

        // Vérifiez si l'utilisateur a déjà interagi avec cet avis
        $existingInteraction = $avis->likes()
            ->where('user_id', $user->id)
            ->first();

        if ($existingInteraction) {
            if (!$existingInteraction->pivot->is_like) {
                // L'utilisateur a déjà disliké, donc on supprime le dislike
                $avis->likes()->detach($user->id);
                return back()->with('message', 'Votre dislike a été retiré.');
            }

            // L'utilisateur a liké, on remplace par un dislike
            $avis->likes()->updateExistingPivot($user->id, ['is_like' => false]);
            return back()->with('message', 'Vous avez changé votre like en dislike.');
        }

        // Si aucune interaction, on ajoute un dislike
        $avis->likes()->attach($user->id, ['is_like' => false]);
        return back()->with('message', 'Votre dislike a été ajouté.');
    }
    public function show($id)
{
    $avis = AvisCommentaire::findOrFail($id);
    return response()->json(['contenu_complet' => $avis->contenu]);
}





}
