<?php

namespace App\Http\Controllers;

use App\Models\Conge;

class DirecteurDashboardController extends Controller
{
    public function index()
    {
        $conges = Conge::where('statut', 'en_attente')->get();

        return view('directeur.conges', compact('conges'));
    }
}
