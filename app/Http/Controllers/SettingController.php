<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Setting;
use Illuminate\Support\Facades\Log;

class SettingController extends Controller
{
    //Function pour ajouter et modifier ses informations
    public function updateCompte(Request $request){

        //Je véérifie si l'user est connecté
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Veuillez vous connecter pour continuer.');
        }
        $user = auth()->user();
        //dd($user);
        //$user = User::find($id); 

        $validatedData = $request->validate([
            'name' => 'nullable|string|max:255',
            'prenom' => 'nullable|string|max:255',
            'email' => 'nullable|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
            //'born' => 'nullable|date',
            'number' => 'nullable|string|max:20|regex:/^\+?[0-9\s\-]{7,20}$/',
            'country' => 'nullable|string|max:255',
            'metiers' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:3048',
            'about' => 'nullable|string|max:200',
            'experiences' => 'nullable|array',
            'experiences.*.company' => 'nullable|string|max:255',
            'experiences.*.start_date' => 'nullable|date',
            'experiences.*.end_date' => 'nullable|date|after_or_equal:experiences.*.start_date',
        ]);

        //Mise à jour de la table users
        if ($user) {
            $user->update([
                'name' => $validatedData['name'] ?? $user->name,
                'prenom' => $validatedData['prenom'] ?? $user->prenom,
                'email' => $validatedData['email'] ?? $user->email,
                'metiers' => $validatedData['metiers'] ?? $user->metiers,
                'password' => isset($validatedData['password']) ? Hash::make($validatedData['password']) : $user->password,
                'photo' => $request->hasFile('photo') ? $request->file('photo')->store('photos', 's3') : $user->photo,
            ]);
        }


        $settings = Setting::firstOrNew(['user_id' => $user->id]);
        //$settings->born = $validatedData['born'] ?? $settings->born;
        $settings->number = $validatedData['number'] ?? $settings->number;
        $settings->country = $validatedData['country'] ?? $settings->country;
        $settings->about = $validatedData['about'] ?? $settings->about;

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('photos', 's3');
            $settings->photo = $path;
        }

        $settings->save();


        return redirect()->back()->with('success', 'Informations mises à jour avec succès.');
    }

    public function updateExperiences(Request $request){
        //Je véérifie si l'user est connecté
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Veuillez vous connecter pour continuer.');
        }
        $user = Auth::user();

        $validated = $request->validate([
            'experiences.*.company' => 'required|string|max:255',
            'experiences.*.start_date' => 'required|date',
            'experiences.*.end_date' => 'nullable|date|after_or_equal:experiences.*.start_date',
        ]);

        $settings = Setting::firstOrNew(['user_id' => $user->id]);
        $settings->experiences = json_encode($request->experiences);
        $settings->save();

        return redirect()->back()->with('success', 'Expériences mises à jour avec succès.');
    }

    public function deleteCompte(){

        //Je véérifie si l'user est connecté
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Veuillez vous connecter pour continuer.');
        }
        $user = Auth::user(); //Je recupère l'user connecté
        Log::info('Suppression du compte en cours', ['user_id' => $user->id]);
        Log::info('Photo de profil supprimée', ['user_id' => $user->id]);
        $user = Auth::user();

        if ($user->photo) {
            Storage::disk('public')->delete($user->photo);
        }

        $user->delete();
        Log::info('Compte supprimé avec succès', ['user_id' => $user->id]);

        Auth::login();
        Log::info('Déconnexion effectuée');

        return redirect('/')->with('success', 'Votre compte a été suprimé.');
    }

    public function updatePassword(Request $request){

        $request->validate([
            'current_password' => ['required'],
            'new_password' => ['required', 'min:8', 'confirmed'],
        ]);

        $user = auth()->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Le mot de passe actuel est incorrect.');
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'Votre mot de passe a été modifié avec succès.');
    }
}
