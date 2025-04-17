<?php

namespace App\Http\Controllers;
use App\Models\Publication;
use App\Models\Application;

use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    //Postuler aux offres
    public function Store(Publication $publication)
    {
        // Vérifier si l'utilisateur a déjà postulé
        if (auth()->user()->applications()->where('publication_id', $publication->id)->exists()) {
            return response()->json(['message' => 'Vous avez déjà postulé à cette offre'], 422);
        }

        // Créer la candidature
        auth()->user()->applications()->create([
            'publication_id' => $publication->id,
            'status' => 'pending'
        ]);

        return response()->json(['message' => 'Candidature envoyée avec succès']);
    }
}
