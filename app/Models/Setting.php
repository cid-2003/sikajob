<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;


    protected $fillable = ['user_id','born', 'number', 'country', 'about', 'experiences'];



    protected $casts = [
        'experiences' => 'array',
        'born' => 'date',
    ];

    //Relation avec la taable user
    public function user(){
        //J'utilise l'email de l'user pour le récuperer
        return $this->belongsTo(User::class, 'user_id');
    }
}
