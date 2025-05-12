<?php
public function vueComplete()
{
    $user = auth()->user();

    $conges = Conge::where('user_id', $user->id)->latest()->get();
    $total = $conges->count();
    $valides = $conges->where('statut', 'validé')->count();
    $refuses = $conges->where('statut', 'refusé')->count();
    $en_attente = $conges->whereNotIn('statut', ['validé', 'refusé'])->count();

    return view('agent.conges', compact('conges', 'total', 'valides', 'refuses', 'en_attente'));
}

public function store(Request $request)
{
    $request->validate([
        'type' => 'required|string',
        'date_debut' => 'required|date',
        'date_fin' => 'required|date|after_or_equal:date_debut',
        'motif' => 'nullable|string',
    ]);

    Conge::create([
        'user_id' => auth()->id(),
        'type' => $request->type,
        'date_debut' => $request->date_debut,
        'date_fin' => $request->date_fin,
        'motif' => $request->motif,
        'statut' => 'en_attente',
    ]);

    return back()->with('success', 'Demande enregistrée.');
}
