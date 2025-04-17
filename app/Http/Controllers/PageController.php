<?php

namespace App\Http\Controllers;

use App\Models\Candidature;
use Illuminate\Http\Request;
use App\Models\Publication;
use App\Models\User;
use App\Models\Setting;
use App\Models\Signalement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PageController extends Controller
{
    //Fonction pour afficher les publications et les recruteurs sur la page d'acceuil
    //fonction pour les recherches et recommandation
    public function Index(Request $request){
        $user = auth()->user();
        $recruteurs = User::where('role', 'recruteur')->get();
        $candidats = User::where('role', 'candidat')->get();
        $publications = Publication::all();
        $publications = Publication::with('likes.user')->get();
        //$publications = Publication::where('user_id', $user->id)->get();
        $search = $request->input('search');
        $users = User::all();
        $publications = Publication::orderBy('created_at', 'desc')->paginate(15);
        $recruteurs = User::where('role', 'recruteur')->inRandomOrder()->take(2)->get();
        $candidats = User::where('role', 'candidat')->inRandomOrder()->take(2)->get();
        $recommandations = app(PublicationController::class)->recommandations();


        $search = $request->input('search');

        //Je recupere les element dans les tables user et settings pour ensuite les afficher lors de la recherche
        $publications = Publication::with('user.settings')
        ->when($search, function ($query, $search) {
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('prenom', 'like', "%$search%")
                  ->orWhereHas('settings', function ($s) use ($search) {
                      $s->where('country', 'like', "%$search%")
                        ->orWhere('metiers', 'like', "%$search%");
                  });
            })
            ->orWhere('content', 'like', "%$search%");
        })
        ->latest()
        ->paginate(10);

        return view('pages.index', compact('user', 'search','publications', 'recruteurs', 'candidats', 'search', 'recommandations'));
    }

    public function loadMore(Request $request){
        $offset = $request->input('offset', 0);
        $limit = $request->input('limit', 10);

        $publications = Publication::orderBy('created_at', 'desc')
            ->skip($offset)
            ->take($limit)
            ->get();

        return response()->json($publications);
        return view('pages.index', compact('publications'));
    }

    public function likers(){

        return $this->belongsToMany(User::class, 'likes');

    }

    public function Login(){
        return view('auth.login');
    }

    public function Authenticate(){
        return view('auth.login');
    }

    public function Register(){
        return view('auth.register');
    }

    public function Store(){
        return view('auth.register');
    }

    public function Notifications(){
        //Je véérifie si l'user est connecté
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Veuillez vous connecter pour continuer.');
        }
        $user = auth()->user();

        $user = Auth::user();
        $user = User::where('role', 'Recruteur')->get();
        $candidatures = Candidature::where('user_id', $user->id)->get(); 
        //$user = User::with(['user', 'candidature'])->findOrFail($user);
        $candidature = Candidature::with(['publication.user'])->findOrFail($id);
        
        return view('pages.notifications', compact('candidatures', 'user'));
    }

    public function Settings(){

        //Je véérifie si l'user est connecté
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Veuillez vous connecter pour continuer.');
        }
        $user = auth()->user();
        $settings = Setting::where('user_id', auth()->id())->first();
        return view('pages.settings', compact('settings', 'user'));
    }

    public function Profil(Request $request){

        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Veuillez vous connecter pour continuer.');
        }
        $user = auth()->user();
        $publications = Publication::where('user_id', $user->id)->get();
        $settings = Setting::where('user_id', auth()->id())->first();
        $recruteurs = User::where('role', 'recruteur')->get();
        $candidats = User::where('role', 'candidat')->get();
        $user = User::with('settings')->findOrFail($user->id);

        $likedPublications = Publication::whereHas('likes', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->with('user', 'likes')->latest()->inRandomOrder()->get();

        return view('pages.my-profile', compact('publications', 'likedPublications', 'user', 'settings', 'recruteurs', 'candidats'));
    }

    //Function pour voir le profil utilisateurs
    public function showProfil($id){

        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Veuillez vous connecter pour continuer.');
        }
        $user = auth()->user();
        // Je récupère l'user par son id
        $user = User::findOrFail($id);
        $publications = Publication::where('user_id', $user->id)->get();
        $settings = Setting::where('user_id', auth()->id())->first();
        $recruteurs = User::where('role', 'recruteur')->get();
        $candidats = User::where('role', 'candidat')->get();
        $profil = User::with('settings')->findOrFail($id);
        

        $likedPublications = Publication::whereHas('likes', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->with('user', 'likes')->latest()->get();
        
        return view('pages.my-profile', compact('profil', 'likedPublications', 'user', 'publications', 'settings', 'candidats', 'recruteurs'));
    }

    public function show($id){

        //Je véérifie si l'user est connecté
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Veuillez vous connecter pour continuer.');
        }
        $user = auth()->user();

        $publications = Publication::where('user_id', $user->id)->get();
        //$publications = Publication::where(['user', 'publication'])->findOrFail($id);

        $user = User::findOrFail($id);
        $recruteurs = User::where('role', 'recruteur')->get();
        $candidats = User::where('role', 'candidat')->get();
        $profil = User::with('settings')->findOrFail($id); 


        $likedPublications = Publication::whereHas('likes', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->with('user', 'likes')->latest()->get();
        

        return view('pages.my-profile', compact('user', 'profil','publications', 'candidats', 'recruteurs', 'likedPublications'));
    }


    public function Notif($id){

        //Je véérifie si l'user est connecté
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Veuillez vous connecter pour continuer.');
        }
        $user = Auth::user();
        //Je recupere une seule candidature
        $candidature = Candidature::with(['user', 'publication'])->findOrFail($id);
        return view('pages.notif-detail', compact('candidature', 'user'));
    }

    //Fonction pour voir plus rec et cand
    public function voirPlus(Request $request){

        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Veuillez vous connecter pour continuer.');
        }
        $user = auth()->user();
        
        $settings = Setting::where('user_id', auth()->id())->first();
        $recruteurs = User::where('role', 'recruteur')->get();
        $candidats = User::where('role', 'candidat')->get();
        $users = User::all();
        $user = User::where('role', 'Recruteur', 'Candidats')->get();

        $search = $request->input('search');

        $users = User::with('settings')
        ->when($search, function ($query, $search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('prenom', 'like', "%{$search}%")
                  ->orWhere('role', 'like', "%{$search}%")
                  ->orWhere('country', 'like', "%{$search}%")
                  ->orWhere('metiers', 'like', "%{$search}%");
            });
        })
        ->get();
        


        return view('pages.rec_cad', compact('users', 'search', 'recruteurs', 'candidats'));
    }

    //Fonction pour signalement
    public function Signale($name, Request $request){
    //$recruteur = User::where('name', $name)->firstOrFail();
    $recruteur = User::where('name', $name)->where('role', 'Recruteur')->firstOrFail();
    $user = Auth::user(); 

    Signalement::create([
        'recruteur_id' => $recruteur->id,
        'recruteur_name' => $recruteur->name,
        'user_id' => Auth::id(),
        'user_name' => Auth::user()->name,
        'motif' => $request->motif,
    ]);
    

    return back()->with('success', 'Le signalement a bien été envoyé.');
}

}
