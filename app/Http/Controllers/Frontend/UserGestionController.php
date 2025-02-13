<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\SocialProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Notifications\ProfileUpdatedNotification;
use App\Notifications\WelcomeNotification;
use Laravel\Socialite\Facades\Socialite;

class UserGestionController extends Controller
{
    // Affichage du formulaire d'inscription
    public function inscriptionForm()
    {
        return view('frontend.clients.inscription');
    }

    // Gérer l'inscription de l'utilisateur
    public function inscription(Request $request)
    {
        // Validation des données d'inscription
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'password' => 'required|min:4|confirmed',
        ]);

        // Création de l'utilisateur
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'password' => Hash::make($validated['password']),
        ]);

        // Notification de bienvenue après inscription
        $user->notify(new WelcomeNotification($user));

        // Redirection vers la page de connexion avec un message de succès
        return redirect()->route('login')->with('success', 'Inscription réussie. Veuillez vous connecter.');
    }

    // Affichage du formulaire de connexion
    public function connexionForm()
    {
        return view('frontend.clients.connexion');
    }

    // Gérer la connexion de l'utilisateur
    public function connexion(Request $request)
    {
        // Validation des informations de connexion
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:4',
        ]);

        // Vérification de l'utilisateur dans la base de données
        $user = User::where('email', $validated['email'])->first();

        if ($user && Hash::check($validated['password'], $user->password)) {
            // Stockage de l'utilisateur dans la session
            $request->session()->put('user', $user);

            // Redirection vers la page d'accueil
            return redirect()->route('home')->with('success', 'Connexion réussie.');
        }

        // Si l'authentification échoue, retour avec un message d'erreur
        return back()->with('error', 'Email ou mot de passe incorrect.');
    }

    // Affichage du profil de l'utilisateur
    public function detailProfil(Request $request)
    {
        $user = $request->session()->get('user');
        if (!$user) {
            return redirect()->route('connexion.form')->with('error', 'Veuillez vous connecter.');
        }

        // Récupérer les notifications de l'utilisateur
        $notifications = $user->notifications;

        return view('frontend.clients.profile', compact('user', 'notifications'));
    }

    // Affichage du formulaire pour modifier le profil
    public function modifierForm(Request $request)
    {
        $user = $request->session()->get('user');
        if (!$user) {
            return redirect()->route('connexion.form')->with('error', 'Veuillez vous connecter.');
        }

        return view('frontend.clients.modifier', compact('user'));
    }

    // Gérer la modification des données du profil
    public function modifier(Request $request)
    {
        $user = $request->session()->get('user');
        if (!$user) {
            return redirect()->route('connexion.form')->with('error', 'Veuillez vous connecter.');
        }

        // Validation des nouvelles informations
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|',
        ]);

        // Mise à jour de l'image de profil si présente
        if ($request->hasFile('profile_picture')) {
            if ($user->profile_picture) {
                unlink(storage_path('app/public/' . $user->profile_picture));
            }
            $validated['profile_picture'] = $request->file('profile_picture')->store('profile_pictures', 'public');
        }

        // Mise à jour des informations de l'utilisateur
        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'profile_picture' => $validated['profile_picture'] ?? $user->profile_picture,
        ]);

        // Envoi des notifications par email et en base de données
        $user->notify(new ProfileUpdatedNotification($user));

        // Mise à jour de la session de l'utilisateur
        $request->session()->put('user', $user);

        // Redirection avec message de succès
        return redirect()->route('profil')->with('success', 'Votre profil a été mis à jour avec succès.');
    }

    // Déconnexion de l'utilisateur
    public function deconnexion(Request $request)
    {
        $request->session()->forget('user');
        return redirect()->route('connexion.form')->with('success', 'Vous êtes déconnecté.');
    }

    // Redirection vers Google pour l'authentification
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // Gérer le retour de l'authentification Google
    public function handleGoogleCallback()
    {
        try {
            // Récupération de l'utilisateur Google
            $googleUser = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect('/')->with('error', $e->getMessage());
        }

        // Vérification si l'utilisateur existe déjà
        $socialProvider = SocialProvider::where('provider_id', $googleUser->getId())->first();

        if (!$socialProvider) {
            // Si l'utilisateur n'existe pas, créer un nouvel utilisateur
            $user = User::firstOrCreate(
                ['email' => $googleUser->getEmail()],
                ['name' => $googleUser->getName()]
            );

            // Enregistrer la connexion avec le fournisseur (Google)
            $user->socialProviders()->create([
                'provider_id' => $googleUser->getId(),
                'provider' => 'google',
            ]);
        } else {
            // Si l'utilisateur existe déjà, récupérer l'utilisateur
            $user = $socialProvider->user;
        }

        // Connexion de l'utilisateur
        auth()->login($user);

        // Redirection vers la page d'accueil
        return redirect('/home')->with('success', 'Connexion réussie.');
    }
}
