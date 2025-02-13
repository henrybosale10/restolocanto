<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Plat;  // Assurez-vous d'importer le modèle Plat si nécessaire
use App\Models\PlatClient;

class MenuController extends Controller
{
    public function index()
    {
        // Récupérer les plats depuis la base de données
        $menus = PlatClient::all();  // Ou une méthode personnalisée pour récupérer les plats

        // Passer les plats à la vue
        return view('menus.index', compact('menus'));
    }
}
