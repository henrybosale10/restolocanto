<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    // Afficher la liste des messages pour l'administrateur
    public function index()
    {
        // Récupérer tous les messages soumis par les utilisateurs
        $messages = ContactMessage::all();

        return view('admin.contact.index', compact('messages'));
    }

    // Afficher la page de réponse d'un message
    public function reply($id)
    {
        // Récupérer le message spécifique par ID
        $message = ContactMessage::findOrFail($id);

        return view('admin.contact.reply', compact('message'));
    }

    // Enregistrer la réponse de l'administrateur
    public function storeReply(Request $request, $id)
    {
        // Valider la réponse
        $request->validate([
            'reply_message' => 'required|string',
        ]);

        // Récupérer le message par ID
        $message = ContactMessage::findOrFail($id);

        // Enregistrer la réponse dans la base de données
        $message->reply_message = $request->reply_message;
        $message->save();

        // Rediriger avec un message de succès
        return redirect()->route('admin.messages.index')->with('success', 'Réponse envoyée.');
    }
}
