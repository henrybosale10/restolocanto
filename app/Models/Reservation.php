<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'prenom', 'nom', 'email', 'telephone', 'date_reservation', 'guest_number', 'table_id'
    ];

    // Définir la relation avec le modèle Table
    public function table()
    {
        return $this->belongsTo(Table::class);
    }
    protected $casts = [
        'date_reservation' => 'datetime', // Cast à un objet Carbon
    ];
    // Relation avec les commandes
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
