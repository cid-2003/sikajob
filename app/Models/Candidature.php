<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidature extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'publication_id', 'cv', 'letter', 'status'];

    //J'établie une relation = une candidature appertient a un candidat
    public function user(){
        return $this->belongsTo(User::class);
    }

    //J'établie une relation = une candidature appartiens a une offre d'emplois
    public function publication(){
        return $this->belongsTo(Publication::class);
    }
}
