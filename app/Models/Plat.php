<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plat extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom', 'description', 'image',
    ];

    // Optionnel : ajouter une méthode pour définir une relation avec PlatClient si nécessaire
    public function platClients()
     {
         return $this->hasMany(PlatClient::class);
     }
}

