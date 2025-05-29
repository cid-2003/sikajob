<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    //Inscription fonction store affiche la vue et la fonction register est pour l'inscription l'user
    public function Store(){
        return view('auth.register');
    }

   public function Register(Request $request){

    Log::info('Début de l\'inscription.');

    $validated = request()->validate(
        [
            'name' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
            'role' => ['required', 'string'],
            'badge' =>[''],
            'metiers' => ['required', 'string'],
            'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:3048'],
        ]
    );

    Log::info('Données validées avec succès.', $validated);

     // Gestion de la photo de profil
     if ($request->hasFile('photo')) {
        Log::info('Photo détectée, enregistrement en cours...');
        $photoPath = $request->file('photo')->store('photos', 'S3');
        Log::info('Photo enregistrée avec succès.', ['path' => $photoPath]);
    } else {
        $photoPath = $user->photo ?? 'default.png';
        Log::info('Aucune photo fournie, utilisation de la photo par défaut.');
    }
    

   
    // Création de l'utilisateur
    try {
        $newUser = User::create([
            'name' => $validated['name'],
            'prenom' => $validated['prenom'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
            'badge' => $validated['role'] === 'recruteur' ? true : false,
            'metiers' => $validated['metiers'],
            'photo' => $photoPath,
        ]);

        Log::info('Utilisateur créé avec succès.', ['id' => $newUser->id, 'email' => $newUser->email]);

        return redirect()->route('login')->with('status', 'Inscription réussie ! Vous pouvez maintenant vous connecter.');

    } catch (\Exception $e) {
        Log::error('Erreur lors de l\'inscription.', ['message' => $e->getMessage()]);
        return back()->with('error', 'Une erreur est survenue lors de l\'inscription.');
    }
   }

   //Connexion, la fonction login affiche la vue et Authenticate est pour la connexion
   public function Login(){
    return view ('auth.login');
   }

   public function Authenticate(){
    $validated = request()->validate(
        [
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ]
     );

    if(auth()->attempt($validated)){
        request()->session()->regenerate();

        return redirect()->route('index')->with('Connexion réussie ! Bienvenu.');
    }

    return redirect()->route('login')->withErrors([
        'email' => "Echec, email ou mot de passe incorrect"
    ]);
   }

   //Déconnexion
   public function logout(){
       auth()->logout();
   
       request()->session()->invalidate();
       request()->session()->regenerateToken();
   
       return redirect()->route('login')->with('success', 'Vous êtes déconnecté.');
   }
       
}
