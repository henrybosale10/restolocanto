<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'total_price', 'status'];

    // Relation avec les articles de la commande
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Relation avec l'utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function livraison()
    {
        return $this->hasOne(Livraison::class, 'commande_id');
    }

    // Relation avec Paiement
    public function paiement()
    {
        return $this->hasOne(Paiement::class, 'commande_id');
    }

}
