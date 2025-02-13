<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class RépondreController extends Controller
{
    // Afficher tous les messages
    public function index()
    {
        $messages = Message::orderBy('created_at', 'asc')->get();
        return view('admin.repondre.index', compact('messages'));
    }

    // Afficher la conversation d'un utilisateur spécifique
    public function show($userId)
    {
        $messages = Message::where('user_id', $userId)
            ->orWhere('admin_id', $userId)
            ->orderBy('created_at', 'asc')
            ->get();

        return view('admin.repondre.show', compact('messages', 'userId'));
    }

    // Répondre à un message en tant qu'admin
    public function respond(Request $request, $userId)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        Message::create([
            'user_id' => $userId,
            'admin_id' => auth()->id(),
            'message' => $request->message,
            'is_admin' => true,
        ]);

        return back()->with('success', 'Votre réponse a été envoyée.');
    }

    // Supprimer un message
    public function destroy($id)
    {
        $message = Message::findOrFail($id);
        $message->delete();

        return back()->with('success', 'Message supprimé avec succès.');
    }
}
