<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlatClient extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'description', 'prix', 'image', 'plat_id'];

    // Relation avec Plat
    public function plat()
    {
        return $this->belongsTo(Plat::class);
    }

}



