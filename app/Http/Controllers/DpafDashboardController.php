<?php

namespace App\Http\Controllers;

use App\Models\Conge;

class DpafDashboardController extends Controller
{
    public function index()
    {
        $conges = Conge::whereIn('statut', ['transmis_dpaf', 'analyse_rh_terminée'])->get();
        return view('dpaf.conges', compact('conges'));
    }
}
