<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AvisCommentaire;
use App\Models\Plat; // Importation de la classe Plat
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
{
    // Récupérer les 4 plats spéciaux aléatoires
    $special = Plat::where('nom', 'special')->first();
    $platClients = $special->platClients->random(4);  // Sélectionner aléatoirement 4 plats

    // Récupérer les commentaires de manière aléatoire et paginer (3 par page)
    $comments = AvisCommentaire::inRandomOrder()->paginate(3);

    // Retourner la vue avec les données
    return view('welcome', compact('platClients', 'comments'));
}


    public function thankYou()
    {
        return view('thankyou');
    }
}
