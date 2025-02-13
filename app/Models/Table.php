<?php

namespace App\Models;

use App\Enums\StatutTable;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    protected $fillable = ['name', 'guest_number', 'status', 'location'];

    // N'oubliez pas de convertir la valeur du statut en énumération lors de la récupération
    protected $casts = [
        'status' => 'string', // Conservez comme string pour le stockage en BDD
    ];

    // Optionnel : méthode d'accès personnalisée pour renvoyer l'énumération correcte
    public function getStatusAttribute($value)
    {
        return StatutTable::from($value);
    }

    // Optionnel : méthode pour définir la valeur sous forme de chaîne dans la base de données
    public function setStatusAttribute($value)
    {
        $this->attributes['status'] = $value instanceof StatutTable ? $value->value : $value;
    }
    public function reservations()
{
    return $this->hasMany(Reservation::class, 'table_id');
}
}
