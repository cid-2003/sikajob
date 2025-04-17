<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\Like;
use App\Models\setting;
use App\Models\Candidature;
use App\Models\Notification;
use App\Models\User;

class PublicationController extends Controller
{

    //utiliser la meme fonction pour la publication de text, image, vidéo, creer une fonction pour la suppression, les likes postulation, copie de lien

    //Fonction pour créer la publication
    public function Store(Request $request){

        // Validation des données
        $request->validate([
            'content' => 'required|string',
        ]);


        // Création de la publication
        $publication = new Publication();
        $publication->user_id = Auth::id();
        $publication->content = $request->content;

        $publication->save();

        return back()->with('success', 'Publication créée avec succès !');
    }

    //Fonction pour supprimer la publication
    public function destroy($id){
        $publication = Publication::findOrFail($id);

        $publication->delete();

        return redirect()->back()->with('success', 'Publication supprimée avec succès.');
    }


    //Function pour le like et unlike
    public function Like(Request $request){

        if (!Auth::check()) {
            return response()->json(['error' => 'Non authentifié'], 401);
        }
    
        $user = Auth::user();
        $publicationId = $request->publication_id;
        $publication = Publication::findOrFail($publicationId);
    
        $like = Like::where('user_id', $user->id)->where('publication_id', $publicationId)->first();
    
        if ($like) {
            $like->delete();
            $liked = false;
        } else {
            Like::create(['user_id' => $user->id, 'publication_id' => $publicationId]);
            $liked = true;
        }
    
        $likesCount = Like::where('publication_id', $publicationId)->count();
    
        $usernames = Like::where('publication_id', $publicationId)
                        ->with('user')
                        ->get()
                        ->pluck('user.name');
    
        return response()->json([
            'liked' => $liked,
            'likesCount' => $likesCount,
            'usernames' => $usernames
        ]);
    }

    //Function pour voir la publication et postuler si possible
    public function Show($id){
        $publication = Publication::findOrFail($id);
        $user = Auth::user();

        return view('pages.show', compact('publication', 'user'));
    }

    //Function pour la postulation
    public function Postule(Request $request, $id){
        $request->validate([
            'letter' => 'required|string',
            'cv' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        //Je recupere la publication
        $publication = Publication::findOrFail($id);
        //Je recupere la candidat qui a soumis la candidature
        $candidat = Auth::user();
        //Je recupere le recruteur a qui appartiens la publication
        $recruteur = User::find($publication->user_id);

        //Je vérifie si le recruteur existe
        if (!$recruteur) {
             return redirect()->back()->with('error', 'Recruteur introuvable.');
        }

        $cvPath = null;

        if ($request->hasFile('cv')) {
        $cvPath = $request->file('cv')->store('cv', 'public');
        }

        Candidature::create([
            'publication_id' => $publication->id,
            'user_id' => $candidat->id,
            'letter' => $request->letter,
            'cv' => $cvPath,
        ]);

        Notification::create([
            "content" => "vous avez recu une nouvelle candidature de " . $candidat->name . ""  . $candidat->prenom,
            "user_id" => $candidat->id,
            "owner_id" => $recruteur->id,
        ]);

        return redirect()->back()->with('success', 'Candidature envoyée!');
    }

    //Fonction de recommandation
    public function recommandations(){
    $user = Auth::user();

    if (!$user || !$user->settings) {
        return collect(); // ou une réponse vide si l'user n'est pas connecté ou n'a pas encore rempli ses infos
    }

    $metier = $user->metiers;
    $pays = $user->settings->country;

    $publicationsPays = Publication::with('user')
        ->whereHas('user', function ($query) use ($metier, $pays) {
            $query->where('metiers', $metier)
                  ->whereHas('settings', function ($q) use ($pays) {
                      $q->where('country', $pays);
                  });
        })
        ->inRandomOrder()
        ->get();

    $publicationsAutresPays = Publication::with('user')
        ->whereHas('user', function ($query) use ($metier, $pays) {
            $query->where('metiers', $metier)
                  ->whereHas('settings', function ($q) use ($pays) {
                      $q->where('country', '!=', $pays);
                  });
        })
        ->inRandomOrder()
        ->get();

    return $publicationsPays->merge($publicationsAutresPays);
    }

}
