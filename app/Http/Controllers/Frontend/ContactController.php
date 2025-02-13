<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\ContactMessageMail;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    // Afficher le formulaire de contact
    public function showForm()
    {
        return view('frontend.contact.contact');
    }

    // Traiter la soumission du formulaire de contact
    public function store(Request $request)
{
    $request->validate([
        'motif' => 'required|string|max:255',
        'message' => 'required|string',
    ]);

    // Enregistrer le message dans la base de données
    $contactMessage = ContactMessage::create([
        'user_id' => Auth::id(), // Associer l'utilisateur connecté
        'motif' => $request->motif,
        'message' => $request->message,
    ]);

    // Envoyer un email avec les détails
    //Mail::to('henrybosale10@gmail.com')->send(new ContactMessageMail(
    //    $contactMessage->motif,
    //    $contactMessage->message
    //));

    // Rediriger vers l'accueil avec un message de succès
    return redirect('/')->with('success', 'Votre message a été envoyé avec succès.');
}

}
