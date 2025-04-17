<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Signalement extends Model
{
    use HasFactory;
    protected $fillable = ['user_name', 'recruteur_name', 'motif'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function recruteur(){
        return $this->belongsTo(User::class, 'recruteur_name');
    }
}
