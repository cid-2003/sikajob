<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function CheckRequirements(){
        //Je véérifie si l'user est connecté
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Veuillez vous connecter pour continuer.');
        }
        $user = auth()->user();

        return response()->json([
            'hasDocuments' => $user->cv_path && $user->letter_path
        ]);
    }
    
}
