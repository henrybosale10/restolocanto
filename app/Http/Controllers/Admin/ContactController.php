<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactMessage; // Si vous avez une table pour les messages

class ContactController extends Controller
{
    // Afficher la liste des messages reçus
    public function index()
    {
        // Vous pouvez récupérer les messages depuis une base de données ou utiliser un tableau
        $messages = ContactMessage::all();  // Si vous enregistrez les messages dans la BDD

        return view('admin.messages.index', compact('messages'));
    }
}
