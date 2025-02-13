<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'description' => 'required',
            'prix' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',  // Suppression de la validation max pour l'image
            'categories' => 'required|array',  // Assurer que des catégories sont envoyées
            'categories.*' => 'exists:categories,id' // Vérifie que chaque catégorie existe dans la base
        ];
    }

    public function messages()
    {
        return [
            'image.required' => 'Une image est requise pour le menu.',
            'image.image' => 'Le fichier doit être une image valide.',
            'image.mimes' => 'L\'image doit être de type jpeg, png, jpg, gif ou svg.',
            'categories.required' => 'Veuillez sélectionner au moins une catégorie.',
        ];
    }
}
