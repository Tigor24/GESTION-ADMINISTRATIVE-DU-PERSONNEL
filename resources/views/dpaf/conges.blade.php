@extends('layouts.app')
@section('title', 'Traitement des demandes - DPAF')

@section('content')
<div class="container-fluid">
    <h4 class="mb-4">Demandes validées par le Directeur</h4>

    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-hover text-sm">
                <thead>
                    <tr>
                        <th>Agent</th>
                        <th>Type</th>
                        <th>Dates</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($conges as $conge)
                        <tr>
                            <td>{{ $conge->user->name }}</td>
                            <td>{{ $conge->type }}</td>
                            <td>{{ $conge->date_debut }} → {{ $conge->date_fin }}</td>
                            <td>{{ $conge->statut }}</td>
                            <td>
                                <form action="{{ route('dpaf.conges.vers_rh', $conge->id) }}" method="POST" class="d-inline">@csrf
                                    <button class="btn btn-sm btn-warning">Envoyer RH</button>
                                </form>
                                <form action="{{ route('dpaf.conges.finaliser', $conge->id) }}" method="POST" class="d-inline">@csrf
                                    <input type="hidden" name="avis_dpaf" value="validé">
                                    <button class="btn btn-sm btn-success">Valider</button>
                                </form>
                                <form action="{{ route('dpaf.conges.finaliser', $conge->id) }}" method="POST" class="d-inline">@csrf
                                    <input type="hidden" name="avis_dpaf" value="refusé">
                                    <button class="btn btn-sm btn-danger">Refuser</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center">Aucune demande</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
