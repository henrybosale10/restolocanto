<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InscriptionStoreRequest extends FormRequest
{
    /**
     * Détermine si l'utilisateur est autorisé à effectuer cette requête.
     *
     * @return bool
     */
    public function authorize()
    {
        // Par défaut, nous permettons cette requête
        return true;
    }

    /**
     * Récupère les règles de validation pour la requête.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'password' => 'required|string|confirmed',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|',
        ];
    }

    /**
     * Personnalisez les messages de validation.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Le nom est requis.',
            'email.required' => 'L\'email est requis.',
            'email.email' => 'L\'email doit être une adresse email valide.',
            'email.unique' => 'L\'email est déjà utilisé.',
            'phone.required' => 'Le numéro de téléphone est requis.',
            'address.required' => 'L\'adresse est requise.',
            'password.required' => 'Le mot de passe est requis.',
            'password.confirmed' => 'Les mots de passe ne correspondent pas.',
            'profile_picture.image' => 'La photo de profil doit être une image valide.',
            'profile_picture.mimes' => 'La photo de profil doit être au format jpeg, png ou jpg.',
        ];
    }
}
