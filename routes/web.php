<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PublicationController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\CandidatureController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RechercheController;


Route::get('/index', function () {
    return view('pages.index');
})->name('pages.index'); 

Route::get('/', [PageController::class, 'Index'])->name('index');
//Chargement des publications
Route::get('/publications/load-more', [PageController::class, 'loadMore'])->name('publication.load-more');
//Route pour voir rec et cand
Route::get('/rec_cad', [PageController::class, 'voirPlus'])->name('rec_cad');

// Inscription
Route::get('/register', [AuthController::class, 'Store'])->name('register.view');
Route::post('/register', [AuthController::class, 'Register'])->name('register.store');

// connexion
Route::post('/login', [AuthController::class, 'Authenticate']);
Route::get('/login', [AuthController::class, 'Login'])->name('login');
//Déconnexion
Route::get('/logout', [AuthController::class, 'Logout'])->name('logout');

//Route pour les recherhes
Route::get('/search', [PageController::class, 'Index'])->name('search');

//Route pour les signalement
Route::post('/signaler/{name}', [PageController::class, 'Signale'])->name('signaler');

// notifications
Route::get('/notifications', [PageController::class, 'Notifications'])->name('notification');
Route::get('/notif-detail/{id}', [PageController::class, 'Notif'])->name('notif-detail');


//Route pour l'envoye des candidature, la modifications, suppression le refus, l'acceptation
Route::get('/candidatures', [PageController::class])->name('candidature.store');//Afficharge de la vue
Route::get('/notifications', [CandidatureController::class, 'voirNotifications'])->name('notifications');//Voir les candidatures coté recruteurs
Route::get('/candidature/{id}/edit', [CandidatureController::class, 'modifieCandidature'])->name('candidature.modifie');//Modifie cand coté candidat
Route::put('/candidature/{id}/update', [CandidatureController::class, 'updateCandidature'])->name('candidature.update');
Route::delete('candidature/{id}/supprime', [CandidatureController::class, 'supprimeCandidature'])->name('candidature.supprime');//Supprime cand coté candidat
Route::post('/candidature/{id}/accepter', [CandidatureController::class, 'acceptCandidature'])->name('candidature.accepter');//Acepter cand coté recruteurs
Route::post('/candidature/{id}/refuser', [CandidatureController::class, 'refuseCandidature'])->name('candidature.refuser');//Refuser cand coté recruteurs

// settings
Route::post('/settings', [PageController::class, 'updateSettings'])->name('settings.update');
Route::get('/settings', [PageController::class, 'Settings'])->name('settings');
// My-Profile
Route::get('/my-profile', [PageController::class, 'Profil'])->name('my-profile');
Route::get('/profil/{name}', [PageController::class, 'showProfil'])->name('profil.user');
Route::get('/profile/{id}', [PageController::class, 'show'])->name('profile.show');

//Route pour la modifications l'ajout de l'experience et autre et la suppression de compte
Route::middleware(['auth'])->group(function(){
    Route::put('/settings/update', [SettingController::class, 'updateCompte'])->name('settings.update');
    Route::post('/settings/experiences', [SettingController::class, 'updateExperiences'])->name('settings.experiences');
    Route::delete('/settings/delete', [SettingController::class, 'deleteCompte'])->name('settings.delete');
    Route::post('/settings/password', [SettingController::class, 'updatePassword'])->name('password.update');
});

//Route pour la publication
Route::middleware(['auth'])->group(function(){
    //route pour poster la publication
    Route::post('/publication', [PublicationController::class, 'Store'])->name('publication.store');
});
Route::delete('/publications/{id}', [PublicationController::class, 'destroy'])->name('publications.destroy');

//Route pour like et unlike
Route::post('/publication/like', [PublicationController::class, 'Like'])->name('publication.like');


//Route pour posuler 
Route::get('/publication/{id}/postule', [PublicationController::class, 'Show'])->name('publication.show');
Route::post('/publication/{id}/postule', [PublicationController::class, 'Postule'])->name('postule');

//Route pour l'admin
//Route::middleware(['auth', 'admin'])->get('/admin/reports', [AdminController::class, 'showReports'])->name('admin.reports');

Route::fallback(function () {
    return redirect()->route('index');
});


