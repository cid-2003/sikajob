<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Publication extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'content',
        'likes'
    ];

    //J'établie une relation entre une pub et l'user qui l'a créée
    public function user(){
        return $this->belongsTo(User::class);
    }

    //J'établie une relation entre une pub et les likes
    public function likes(){
        return $this->hasMany(Like::class);
    }

    //Je vérifie si la pub est une image
    public function hasImage(){
        return !is_null($this->image);
    }

    //Je retourne le chemin url de l'image
    public function ImagePath(){
        return $this->hasImage() ? asset('storage/' . $this->image) : null;
    }

    //Je vérifie si la pub est une vidéo
    public function hasVideo(){
        return !is_null($this->video);
    }

    //Je retrourne le chemin url de la video
    public function VideoPath(){
        return $this->hasVideo() ? asset('storage/' . $this->video) : null;
    }

    //Relation entre candidatures et publicaations
    public function Candidatures(){
        return $this->hasMany(Candidature::class);
    }


    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];



}