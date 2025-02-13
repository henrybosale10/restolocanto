<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\SocialProvider;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SocialAuthController extends Controller
{
    /**
     * Rediriger l'utilisateur vers la page de connexion Google.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Gérer le retour de Google et connecter/créer un utilisateur.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleGoogleCallback()
    {
        try {
            // Récupérer l'utilisateur Google
            $googleUser = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            // En cas d'erreur, nous redirigeons avec le message d'erreur
            Log::error('Google login error: ' . $e->getMessage()); // Log d'erreur
            return redirect()->route('home')->with('error', 'Erreur lors de la connexion avec Google.');
        }

        // Log de l'utilisateur récupéré de Google
        Log::info('Google User: ' . print_r($googleUser, true));

        // Vérification si l'utilisateur est déjà associé à ce compte Google
        $socialProvider = SocialProvider::where('provider_id', $googleUser->getId())->first();

        if ($socialProvider) {
            $user = $socialProvider->user; // Utilisateur trouvé
        } else {
            // Si aucun utilisateur n'existe, créer un nouvel utilisateur
            $user = User::firstOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    'name' => $googleUser->getName(),
                    'profile_picture' => $googleUser->getAvatar(),
                    'password' => bcrypt(uniqid())  // Mot de passe aléatoire
                ]
            );

            // Log des données utilisateur créées
            Log::info('Created User: ' . print_r($user, true));

            // Associer le fournisseur social à l'utilisateur
            $user->socialProviders()->create([
                'provider_id' => $googleUser->getId(),
                'provider' => 'google',
            ]);
        }

        // Connecter l'utilisateur
        Auth::login($user);

        // Log utilisateur connecté
        Log::info('Logged in User: ' . print_r($user, true));

        return redirect()->route('home')->with('success', 'Connexion réussie avec Google.');
    }


}
