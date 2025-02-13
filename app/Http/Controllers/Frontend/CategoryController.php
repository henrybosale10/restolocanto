<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Plat;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
{
    // Assurez-vous de récupérer les plats depuis la base de données
    $plats = Plat::all(); // ou une méthode similaire pour récupérer les plats

    // Passez la variable $plats à la vue
    return view('categories.index', compact('plats'));
}
public function show(Plat $plat)
{
    return view('categories.show',compact('plat'));
}

}
