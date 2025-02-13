<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\InscriptionStoreRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Laravel\Socialite\Facades\Socialite;

class UserController extends Controller
{
    // Affiche le formulaire d'inscription
    public function showRegistrationForm()
    {
        return view('frontend.clients.inscription');
    }

    // Enregistre un nouvel utilisateur
    public function register(InscriptionStoreRequest $request)
    {
        $profilePicturePath = null;
        if ($request->hasFile('profile_picture')) {
            $profilePicturePath = $request->file('profile_picture')->store('profile_pictures', 'public');
        }

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
            'password' => Hash::make($request->input('password')),
            'profile_picture' => $profilePicturePath,
        ]);

        return redirect()->route('login')->with('success', 'Votre compte a été créé avec succès.');
    }

    // Affiche le formulaire de connexion
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Traite la connexion
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Vérifier si l'utilisateur a un rôle
            if ($user->role === 'admin') {
                // Si l'utilisateur est un admin, redirige vers la page admin
                return redirect()->route('admin.index')->with('success', 'Connexion réussie.');
            } elseif ($user->role === 'client') {
                // Si l'utilisateur est un client, redirige vers la page d'accueil
                return redirect()->route('home')->with('success', 'Connexion réussie.');
            }

            // Si l'utilisateur n'a pas un rôle spécifique
            Auth::logout();
            return redirect()->route('login')->withErrors('Votre rôle ne vous autorise pas à accéder à cette page.');
        }

        // Si les informations de connexion sont incorrectes
        return redirect()->back()->withErrors('Les informations de connexion sont incorrectes.');
    }

    // Connexion via Google : redirection vers Google
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // Gérer la réponse du callback de Google
    public function handleGoogleCallback()
{
    try {
        $googleUser = Socialite::driver('google')->user();

        // Vérifie si l'utilisateur existe déjà dans la base de données avec l'email Google
        $user = User::where('email', $googleUser->getEmail())->first();

        // Si l'utilisateur n'existe pas, crée un nouvel utilisateur
        if (!$user) {
            $user = User::create([
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'google_id' => $googleUser->getId(),
                // Autres champs à ajouter si nécessaire
            ]);
        }

        // Authentifier l'utilisateur (créer une session)
        Auth::login($user, true);

        // Vérifier le rôle de l'utilisateur et rediriger en conséquence
        if ($user->role === 'admin') {
            return redirect()->route('admin.index');
        } elseif ($user->role === 'client') {
            return redirect()->route('home');
        }

        // Si aucun rôle spécifique, redirige vers l'accueil
        return redirect()->route('home');

    } catch (\Exception $e) {
        Log::error('Erreur lors de la connexion avec Google', ['error' => $e->getMessage()]);
        return redirect()->route('login')->with('error', 'Une erreur est survenue lors de la connexion avec Google, veuillez réessayer.');
    }
}


    // Affiche le profil de l'utilisateur connecté
    public function showProfile()
    {
        return view('frontend.profile.show');
    }

    // Affiche le formulaire pour éditer le profil
    public function editProfile()
    {
        return view('frontend.profile.edit');
    }

    // Met à jour le profil de l'utilisateur
    public function updateProfile(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png,gif',
            'password' => 'nullable|string|confirmed',
        ]);

        $user = Auth::user();

        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->phone = $validatedData['phone'] ?? $user->phone;
        $user->address = $validatedData['address'] ?? $user->address;

        if ($request->hasFile('profile_picture')) {
            if ($user->profile_picture) {
                Storage::delete('public/' . $user->profile_picture);
            }

            $profilePicture = $request->file('profile_picture');
            $profilePicturePath = $profilePicture->store('profile_pictures', 'public');
            $user->profile_picture = $profilePicturePath;
        }

        if ($request->filled('password')) {
            $user->password = Hash::make($validatedData['password']);
        }

        $user->save();

        return redirect()->route('profile.show')->with('success', 'Profil mis à jour avec succès.');
    }

    // Supprime le compte utilisateur
    public function destroy()
    {
        $user = Auth::user();

        if ($user) {
            DB::beginTransaction();

            try {
                if ($user->profile_picture) {
                    Storage::delete('public/' . $user->profile_picture);
                }

                $user->delete();

                Auth::logout();

                DB::commit();

                return redirect()->route('home')->with('success', 'Votre compte a été supprimé.');
            } catch (\Exception $e) {
                DB::rollBack();
                Log::error('Erreur lors de la suppression du compte utilisateur', ['error' => $e->getMessage()]);

                return redirect()->route('profile.show')->withErrors('Une erreur est survenue lors de la suppression de votre compte.');
            }
        }

        return redirect()->route('login')->withErrors('Utilisateur non trouvé.');
    }

    // Déconnecte l'utilisateur
    public function logout()
    {
        if (Auth::check()) {
            Auth::logout();
        }
        return redirect()->route('login');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('frontend.clients.edit', compact('user'));
    }

    // Méthode pour mettre à jour un utilisateur
    public function update(Request $request, $id)
    {
        // Validation des données
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'password' => 'nullable|string|confirmed|min:8',
        ]);

        // Récupération de l'utilisateur à mettre à jour
        $user = User::findOrFail($id);

        // Traitement de la photo de profil, si elle est téléchargée
        $imagePath = $user->profile_picture; // Garde l'ancienne image si aucune nouvelle image n'est téléchargée
        if ($request->hasFile('profile_picture')) {
            // Si une nouvelle photo est téléchargée, supprime l'ancienne photo et enregistre la nouvelle
            if ($user->profile_picture && Storage::exists('public/' . $user->profile_picture)) {
                Storage::delete('public/' . $user->profile_picture);
            }
            $imagePath = $request->file('profile_picture')->store('profile_pictures', 'public');
        }

        // Mise à jour de l'utilisateur
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'profile_picture' => $imagePath,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        // Redirection avec un message de succès
        return redirect()->route('profile.show', $user->id)->with('success', 'Profil mis à jour avec succès.');
    }
}
