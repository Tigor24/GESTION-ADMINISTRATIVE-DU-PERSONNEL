<?php

namespace App\Http\Controllers;

use App\Models\Conge;

class RhDashboardController extends Controller
{
    public function index()
    {
        $conges = Conge::where('statut', 'en_analyse_rh')->get();

        return view('rh.conges', compact('conges'));
    }
}
