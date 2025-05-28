<?php

namespace App\Http\Controllers;

use App\Models\Conge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CongeController extends Controller
{
    // 👤 Agent → vue d'ensemble de ses congés
    public function index()
    {
        $userId = Auth::id();

        $total = Conge::where('user_id', $userId)->count();
        $valides = Conge::where('user_id', $userId)->where('statut', 'validé')->count();
        $refuses = Conge::where('user_id', $userId)->where('statut', 'refusé')->count();
        $en_attente = Conge::where('user_id', $userId)->whereNotIn('statut', ['validé', 'refusé'])->count();

        return view('agent.conges', compact('total', 'valides', 'refuses', 'en_attente'));
    }

    // 👤 Agent → historique
    public function historique()
    {
        $userId = Auth::id();
        $conges = Conge::where('user_id', $userId)->latest()->get();

        return view('agent.historique', compact('conges'));
    }

    // 👤 Agent → envoie une nouvelle demande
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'motif' => 'nullable|string',
        ]);

        Conge::create([
            'user_id' => Auth::id(),
            'type' => $request->type,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
            'motif' => $request->motif,
            'statut' => 'en_attente',
        ]);

        return back()->with('success', 'Demande enregistrée.');
    }

    // 👔 Directeur → voir les demandes à valider
    public function indexDirecteur()
    {
        $conges = Conge::where('statut', 'en_attente')->get();
        return view('directeur.conges', compact('conges'));
    }

    // 👔 Directeur → transmettre au DPAF
    public function transmettreAuDpaf($id)
    {
        $conge = Conge::findOrFail($id);
        $conge->update([
            'statut' => 'transmis_dpaf',
            'avis_directeur' => 'validé'
        ]);

        return back()->with('success', 'Transmis au DPAF avec succès.');
    }

    // 👔 Directeur → refuser
    public function refuserParDirecteur($id)
    {
        $conge = Conge::findOrFail($id);
        $conge->update([
            'statut' => 'refusé',
            'avis_directeur' => 'refusé'
        ]);

        return back()->with('danger', 'Refusé par le Directeur.');
    }

    // 🧑‍💼 DPAF → voir les demandes (étendues)
    public function indexDpaf()
    {
        $conges = Conge::whereIn('statut', ['transmis_dpaf', 'analyse_rh_terminée'])->get();
        return view('dpaf.conges', compact('conges'));
    }

    // 🧑‍💼 DPAF → transmettre au RH
    public function envoyerAuRh($id)
    {
        $conge = Conge::findOrFail($id);
        $conge->update([
            'statut' => 'en_analyse_rh'
        ]);

        return back()->with('info', 'Transmis au RH pour traitement.');
    }

    // 🧑‍💼 DPAF → décision finale
    public function finaliserParDpaf($id, Request $request)
    {
        $request->validate(['avis_dpaf' => 'required|in:validé,refusé']);

        $conge = Conge::findOrFail($id);
        $conge->update([
            'avis_dpaf' => $request->avis_dpaf,
            'statut' => $request->avis_dpaf === 'validé' ? 'validé' : 'refusé'
        ]);

        return back()->with('success', 'Décision finale enregistrée.');
    }

    // 👩‍💼 RH → voir les demandes à analyser
    public function indexRh()
    {
        $conges = Conge::where('statut', 'en_analyse_rh')->get();
        return view('rh.conges', compact('conges'));
    }

    // 👩‍💼 RH → retourner au DPAF avec avis
    public function retourRh($id, Request $request)
    {
        $request->validate(['avis_rh' => 'required|in:validé,refusé']);

        $conge = Conge::findOrFail($id);
        $conge->update([
            'avis_rh' => $request->avis_rh,
            'statut' => 'analyse_rh_terminée'
        ]);

        return back()->with('success', 'Avis RH transmis au DPAF.');
    }
}
