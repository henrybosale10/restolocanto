<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class ConversationController extends Controller
{
    //
    public function index()
{
    $userId = auth()->id();

    // Charger les messages de l'utilisateur
    $messages = Message::where('user_id', $userId)
        ->orWhere('admin_id', $userId) // Si admin est connecté
        ->orderBy('created_at', 'asc')
        ->get();

    return view('frontend.conversation.index', compact('messages'));
}
public function sendMessage(Request $request)
{
    $request->validate([
        'message' => 'required|string',
    ]);

    Message::create([
        'user_id' => auth()->id(),
        'message' => $request->message,
        'is_admin' => auth()->user()->is_admin, // Vérifier si c'est un admin
    ]);

    return back()->with('success', 'Message envoyé.');
}
public function showMessages()
{
    $messages = Message::where('user_id', auth()->id())->get(); // Exemple de récupération des messages

    return view('conversations.index', compact('messages'));
}
public function deleteMessage($id)
{
    $message = Message::find($id);

    if (!$message || ($message->user_id !== auth()->id() && !auth()->user()->is_admin)) {
        return back()->withErrors('Action non autorisée.');
    }

    $message->delete();

    return back()->with('success', 'Message supprimé avec succès.');
}



}
