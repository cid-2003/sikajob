<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Les attributs qui peuvent être assignés en masse.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'prenom',
        'role',
        'email',
        'password',
        'metiers',
        'photo',
        'badge'
    ];


    public function applications(): HasMany{
        return $this->hasMany(Application::class);
    }

    //Attributs à caché pendant la sérialisation
    protected $hidden = [
        'password',
        'remember_token',
    ];

    
    //Atributs a castés
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //J'établie une relation entre un User et une pub
    public function Publication(){
        return $this->hasMany(Publication::class);
    }

    public function settings(){
        
    return $this->hasOne(Setting::class);
    }

    public function likedPublications(){

    return $this->belongsToMany(Publication::class, 'likes');
    }


}
