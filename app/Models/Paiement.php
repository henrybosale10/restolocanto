<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'commande_id', 'methode_paiement', 'transaction_id', 'statut', 'date_paiement'
    ];


    // Relation avec l'utilisateur
    public function utilisateur()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relation avec la commande
    public function commande()
    {
        return $this->belongsTo(Order::class, 'commande_id');
    }
    public function livraison()
    {
        return $this->hasOne(Livraison::class, 'commande_id', 'commande_id');
    }
}
