<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'publication_id'];

    //J'établie une relation entre User et like
    public function user(){
        return $this->belongsTo(User::class);
    }

    //J'établie une relation entre une pub et un like
    public function Publication(){
        return $this->belongsTo(Publication::class);
    }
}
