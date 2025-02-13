<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'platclient_id', 'quantity', 'session_id'];

    /**
     * Relation avec PlatClient
     */
    public function platClient()
    {
        return $this->belongsTo(PlatClient::class, 'platclient_id');
    }
    public function user()
{
    return $this->belongsTo(User::class);
}

}

