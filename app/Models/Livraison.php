<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livraison extends Model
{
    use HasFactory;

    protected $fillable = ['commande_id', 'type', 'adresse', 'livreur_id', 'heure_livraison', 'statut', 'prix'];


    // Relation avec la commande
    public function commande()
    {
        return $this->belongsTo(Order::class, 'commande_id');
    }

    protected $casts = [
        'date_livraison' => 'datetime',  // Assurez-vous que cette ligne existe
    ];
    public function livreur()
    {
        return $this->belongsTo(Livreur::class, 'livreur_id');
    }

    public function paiement()
{
    return $this->belongsTo(Paiement::class, 'commande_id', 'commande_id');
}

}
