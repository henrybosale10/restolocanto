<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class ConversationController extends Controller
{
    // Afficher tous les messages (admin peut voir tous les messages des utilisateurs)
    public function index()
    {
        // Récupérer tous les messages dans l'ordre
        $messages = Message::orderBy('created_at', 'asc')->get();

        // Retourner la vue avec tous les messages
        return view('admin.conversation.index', compact('messages'));
    }

    // Afficher la conversation d'un utilisateur spécifique
    public function show($userId)
    {
        // Récupérer les messages de cet utilisateur et les messages de l'admin
        $messages = Message::where('user_id', $userId)
            ->orWhere('admin_id', $userId) // Si admin est connecté
            ->orderBy('created_at', 'asc')
            ->get();

        // Retourner la vue de la conversation spécifique à cet utilisateur
        return view('admin.conversation.show', compact('messages', 'userId'));
    }

    // Envoyer une réponse en tant qu'admin
    public function sendMessage(Request $request, $userId)
    {
        // Validation du message
        $request->validate([
            'message' => 'required|string',
        ]);

        // Création d'un nouveau message
        Message::create([
            'user_id' => $userId,  // ID de l'utilisateur à qui on répond
            'admin_id' => auth()->id(), // ID de l'admin connecté
            'message' => $request->message,
            'is_admin' => true, // Message de l'admin
        ]);

        // Retourner vers la conversation avec un message de succès
        return back()->with('success', 'Message envoyé.');
    }
}
