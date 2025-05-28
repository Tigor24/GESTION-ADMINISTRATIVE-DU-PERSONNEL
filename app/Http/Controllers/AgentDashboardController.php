<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Conge;

class AgentDashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $total = Conge::where('user_id', $userId)->count();
        $valides = Conge::where('user_id', $userId)->where('statut', 'validé')->count();
        $refuses = Conge::where('user_id', $userId)->where('statut', 'refusé')->count();
        $en_attente = Conge::where('user_id', $userId)->whereNotIn('statut', ['validé', 'refusé'])->count();

        return view('dashboards.agent', compact('total', 'valides', 'refuses', 'en_attente'));
    }
}
