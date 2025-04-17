<?php

namespace App\Http\Controllers;

use App\Models\Candidature;
use Illuminate\Http\Request;
use App\Models\Publication;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Models\Notification;

class CandidatureController extends Controller
{
  //Fonction pour postuler a une offre
  public function Postule(Request $request){

     //Je véérifie si l'user est connecté
     if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'Veuillez vous connecter pour continuer.');
    }
    //Je vérifie si le candidat est connecté
    $user = Auth::user();

    //Je verifie d'abors le nombre de candidatures envoyées en 1 jour
    $candidatureCount = Candidature::where('user_id', $user->id)
                      ->whereDate('created_at', now()->toDateString())
                      ->count();

    //Si un candidat a déjà postuler à 3 offres
    if($candidatureCount >= 3){
        return response()->json([
            'message' => 'Vous avez atteint la limite de 3 candidatures pour aujourd\hui. Rendez-vous demain.'
        ], 403);
    }

    $request->validate([
        'cv' => 'required|file|mimes:pdf,doc,docx',
        'letter' => 'required|string',
        'publication_id' => 'required|exists:publications,id',
    ]);

    //Je récupère la publication
    $publication = Publication::findOrFail($request->publication_id);

    //J' enregistrement le cv dans un dossier
    if ($request->hasFile('cv')) {
        $cvPath = $request->file('cv')->store('cv', 'public');
    } else {
        $cvPath = null;
    }

    //Je crée la candidature
    Candidature::create([
        'user_id' => auth()->id(),
        'publication_id' => $request->publication_id,
        'cv' => $cvPath,
        'letter' => $request->letter,
        'status' => 'En attente'
    ]);

    Notification::create([
        "content" => "vous avez recu une nouvelle candidature de " . $user->name . $user->prenom. "",
        "user_id" => $publication->id,
        "owner_id" => auth()->id()
    ]);

    //retourne un message d'erreur ou de succès si la candidature est envoyé
    return response()->json([
        'message' => 'Candidature envoyée avec succès !'
    ], 200);
  }

  

  //Fonction pour voir les notifiacations
  public function voirNotifications(){

     //Je véérifie si l'user est connecté
     if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'Veuillez vous connecter pour continuer.');
    }
    $user = Auth::user();

    // Si l'utilisateur est un recruteur, récupérer les candidatures reçues
    if ($user->role === 'Recruteur') {
        $candidatures = Candidature::whereHas('publication', function ($query) use ($user){
            $query->where('user_id', $user->id);
        })->with(['user', 'publication'])->latest()->get();
    } 
    // Si c'est un candidat, récupérer ses candidatures envoyées
    else {
        $candidatures = Candidature::where('user_id', $user->id)->latest()->get();
    }

    return view('pages.notifications', compact('candidatures', 'user'));
  }

  //Fonction pour modifier les notifications
  public function editNotifications($id){
    $candidature = Candidature::findOrFail($id);
    return response()->json($candidature); 
} 

  //Fonction pour afficher les candidatures chez lz recruteur
  public function voirPotule(){

     //Je véérifie si l'user est connecté
     if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'Veuillez vous connecter pour continuer.');
    }
    $user = Auth::user();

    //Je vérifie si l'user est bien un recruteurs
    if(!$user->is_recruteur){
        abort(403, "Accès refusé.");
    }

    //Je récupère les candidatures des offres du recruteurs
    $candidatures = Candidature::whereHas('publication', function($query) use ($user){
        $query->where('user_id', $user->id);
    })->with('user')->latest()->get();
  }

  //Fonction accepter candidature
  public function acceptCandidature($id){
    $candidature = Candidature::findOrFail($id);
    $candidature->status = 'acceptée';
    $candidature->save();

    return back()->with('success', 'La candidature a été acceptée.');
  }

  //Fonction refuser candidature
  public function refuseCandidature($id){
    $candidature = Candidature::findOrFail($id);
    $candidature->status = 'réfusée';
    $candidature->save();

    //$candidature->delete();

    return back()->with('danger', 'La candidature a été refusée et supprimée');
  }

  public function supprimeCandidature($id)
{
    $candidature = Candidature::findOrFail($id);

    // Optionnel : vérifier que le candidat connecté est bien l'auteur
    if ($candidature->user_id !== auth()->id()) {
        return redirect()->back()->with('error', 'Vous n\'êtes pas autorisé à supprimer cette candidature.');
    }

    $candidature->delete();

    return redirect()->back()->with('success', 'Candidature supprimée avec succès.');
}

//Fonction pour modifier la candidature
public function modifieCandidature($id){
    $candidature = Candidature::findOrFail($id);

    if ($candidature->user_id !== auth()->id()) {
        abort(403);
    }

    return response()->json([
        'letter' => $candidature->letter,
        'cv_url' => $candidature->cv ? asset('storage/' . $candidature->cv) : null,
    ]);
}

//Fonction pour actualiser la candidature
public function updateCandidature(Request $request, $id){
    $candidature = Candidature::findOrFail($id);

    if ($candidature->user_id !== auth()->id()) {
        abort(403);
    }

    // J'empêche la modification si déjà traité
    if ($candidature->status === 'acceptée' || $candidature->status === 'refusée') {
        return redirect()->back()->with('error', 'Impossible de modifier une candidature déjà traitée.');
    }

    $validated = $request->validate([
        'letter' => 'nullable|string',
        'cv' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
    ]);

    if ($request->hasFile('cv')) {
        $cvPath = $request->file('cv')->store('cv', 'public');
        $candidature->cv = $cvPath;
    }

    $candidature->letter = $validated['letter'];
    $candidature->save();

    return redirect()->back()->with('success', 'Candidature mise à jour.');
}



}
