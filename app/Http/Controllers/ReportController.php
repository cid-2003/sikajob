<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Models\Report;

class ReportController extends Controller
{
    public function Report(Request $request, $recruteur){

        //Je véérifie si l'user est connecté
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Veuillez vous connecter pour continuer.');
        }
        $user = Auth::user();
        $request->validate([
            'recruteur_user' => 'required|exists:users,id',
            'reason' => 'required|string|max:500',
        ]);

        // Je vérifie si l'useur est un candidat
        if (Auth::user()->role !== 'candidat') {
            return redirect()->back()->with('error', 'Seuls les candidats peuvent signaler un compte.');
        }

        Report::create([
            'user_id' => Auth::id(),
            'recruteur_id' => $request->$recruteur,
            'reason' => $request->reason,
        ]);

        return back()->with('success', 'Le compte a été signalé avec succès.');
    }

    public function Admin()
    {
        // Vue pour l'admin
        $reports = Report::with('reporter', 'reported')->where('status', 'pending')->get();
        return view('admin.admin', compact('reports'));
    }

    public function updateStatus($id, $status)
    {
        $report = Report::findOrFail($id);
        $report->update(['status' => $status]);

        return redirect()->back()->with('success', 'Le statut du signalement a été mis à jour.');
    }
}
