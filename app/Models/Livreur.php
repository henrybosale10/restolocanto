<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livreur extends Model
{
    use HasFactory;

    // Spécifie la table associée au modèle
    protected $table = 'livreurs';

    // Indique les champs qui peuvent être remplis en masse
    protected $fillable = [
        'prenom',
        'nom',
        'email',
        'telephone',
        'photo_profil',
        'adresse',
        'statut',
        'date_embauche',
        'user_id'

    ];

    // Indique les champs qui devraient être des timestamps
    public $timestamps = true;

    // Vous pouvez définir des relations ici si nécessaire (par exemple, une relation avec les livraisons)
    // Dans le modèle Livreur
public function livraisons()
{
    return $this->hasMany(Livraison::class);
}
public function user()
{
    return $this->belongsTo(User::class);
}
}

