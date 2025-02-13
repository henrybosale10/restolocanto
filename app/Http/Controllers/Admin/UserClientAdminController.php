<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class UserClientAdminController extends Controller
{
    // Liste des clients
    public function index(Request $request)
    {
        // Vérification si une recherche est effectuée
        $query = User::query();

        // Si un mot-clé de recherche est présent
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('name', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%")
                  ->orWhere('phone', 'like', "%$search%")
                  ->orWhere('address', 'like', "%$search%");
        }

        $clients = $query->paginate(5); // 5 utilisateurs par page

        return view('admin.clients.index', compact('clients'));
    }

    // Formulaire de création d'un client
    public function create()
    {
        return view('admin.clients.create');
    }

    // Stocker un client dans la base de données
    public function store(Request $request)
    {
        // Validation des données du formulaire
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:4',
            'role' => 'required|in:admin,client',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Log pour vérifier les données avant la création de l'utilisateur
        Log::info('Création d\'un client avec les données suivantes : ', $request->all());

        $imagePath = null;
        if ($request->hasFile('profile_picture')) {
            $imagePath = $request->file('profile_picture')->store('profile_pictures', 'public');
        }

        // Création du client
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'role' => $request->role,
            'profile_picture' => $imagePath,
            'password' => Hash::make($request->password),
        ]);

        // Redirection après création avec message de succès
        return redirect()->route('admin.clients.index')->with('success', 'Client créé avec succès.');
    }

    // Formulaire d'édition d'un client
    public function edit(User $client)
    {
        return view('admin.clients.edit', compact('client'));
    }

    // Mise à jour d'un client
    public function update(Request $request, User $user)
    {
        // Validation des données du formulaire
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|confirmed|min:8', // Validation du mot de passe
            'role' => 'required|in:admin,client',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Traitement de la photo (si elle est téléchargée)
        if ($request->hasFile('profile_picture')) {
            // Si l'utilisateur a téléchargé une nouvelle image, on supprime l'ancienne
            if ($user->profile_picture && Storage::exists('public/' . $user->profile_picture)) {
                Storage::delete('public/' . $user->profile_picture);
            }

            $imagePath = $request->file('profile_picture')->store('profile_pictures', 'public');
        } else {
            // Si aucune nouvelle photo n'est téléchargée, conserver l'ancienne photo
            $imagePath = $user->profile_picture;
        }

        // Mise à jour du client
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'role' => $request->role,
            'profile_picture' => $imagePath, // Mise à jour de la photo
            'password' => $request->password ? Hash::make($request->password) : $user->password, // Mise à jour du mot de passe si fourni
        ]);

        return redirect()->route('admin.clients.index')->with('success', 'Client mis à jour avec succès.');
    }

    // Suppression d'un client
    public function destroy(User $user)
{
    Log::info('Suppression de l\'utilisateur : ', [$user->id]);

    // Suppression de la photo de profil, si elle existe
    if ($user->profile_picture && Storage::exists('public/' . $user->profile_picture)) {
        Storage::delete('public/' . $user->profile_picture);
    }

    // Suppression du client de la base de données
    $user->delete();

    return redirect()->route('admin.clients.index')->with('success', 'Client supprimé avec succès.');
}
}
