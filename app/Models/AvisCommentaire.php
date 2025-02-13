<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Auth;

class AvisCommentaire extends Model
{
    protected $fillable = ['user_id', 'contenu', 'note', 'parent_id'];

    // Relation pour les commentaires liés à un avis
    public function commentaires()
    {
        return $this->hasMany(AvisCommentaire::class, 'parent_id');
    }

    // Relation pour l'utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Scope pour récupérer uniquement les avis principaux
    public function scopeAvis($query)
    {
        return $query->whereNull('parent_id');
    }

    // Relation pour les likes
    public function likes()
{
    return $this->belongsToMany(User::class, 'avis_likes', 'avis_commentaire_id', 'user_id')
                ->withPivot('is_like')
                ->withTimestamps();
}


    public function dislikes()
    {
        return $this->belongsToMany(User::class, 'avis_likes')
            ->withPivot('is_like')
            ->wherePivot('is_like', false);  // Filtrer seulement les "dislikes"
    }
}
