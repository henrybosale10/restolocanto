<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\Notification;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'role',
        'profile_picture',
        'address',
        'google_id',  // Ajouté pour l'authentification Google
        'avatar',     // Ajouté pour stocker l'avatar de l'utilisateur
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'role' => 'string', // S'assurer que 'role' est traité comme une chaîne
    ];

    // Vérifie si l'utilisateur est un administrateur
    public function getIsAdminAttribute()
    {
        return $this->role === 'admin'; // Vérifie si l'utilisateur a le rôle 'admin'
    }

    // Vérifie si l'utilisateur est un client
    public function getIsClientAttribute()
    {
        return $this->role === 'client'; // Vérifie si l'utilisateur a le rôle 'client'
    }

    // Relation avec les commandes (Order)
    public function orders()
    {
        return $this->hasMany(Order::class); // Assurez-vous que le modèle Order existe
    }

    // Relation avec les paniers (Cart)
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    // Relation avec les likes dans AvisCommentaire (avis/commentaires)
    public function likes()
    {
        return $this->belongsToMany(User::class, 'avis_commentaire_likes')->withTimestamps();
    }

    // Relation avec les fournisseurs sociaux pour l'authentification via Google (SocialProvider)
    public function socialProviders()
    {
        return $this->hasMany(SocialProvider::class);
    }

    // Relation inverse pour l'utilisateur associé à une réservation
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    // Récupérer les messages non lus pour cet utilisateur
    public function unreadMessages()
    {
        return $this->hasMany(Message::class)->where('read', false); // Utilise 'read' si c'est le nom de la colonne
    }

    // Méthode pour connecter un utilisateur via Google
    public static function createFromGoogle($googleUser)
    {
        return self::create([
            'name' => $googleUser->getName(),
            'email' => $googleUser->getEmail(),
            'google_id' => $googleUser->getId(),
            'avatar' => $googleUser->getAvatar(),
        ]);
    }
}
