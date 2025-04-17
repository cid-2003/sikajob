<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'recruteur_id', 'reason'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function recruteur()
    {
        return $this->belongsTo(User::class, 'recruteur_id');
    }
}
