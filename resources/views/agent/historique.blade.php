@extends('layouts.app')
@section('title', 'Historique des congés')

@section('content')
<div class="container-fluid">
    <h4 class="mb-4">📜 Historique de vos demandes</h4>

    <div class="card shadow">
        <div class="card-body p-0">
            <table class="table table-bordered table-hover m-0">
                <thead class="thead-light">
                    <tr>
                        <th>Type</th>
                        <th>Période</th>
                        <th>Statut</th>
                        <th>Directeur</th>
                        <th>RH</th>
                        <th>DPAF</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($conges as $conge)
                        <tr>
                            <td>{{ $conge->type }}</td>
                            <td>{{ $conge->date_debut }} → {{ $conge->date_fin }}</td>
                            <td><span class="badge bg-{{ $conge->statut === 'validé' ? 'success' : ($conge->statut === 'refusé' ? 'danger' : 'warning') }}">{{ $conge->statut }}</span></td>
                            <td>{{ $conge->avis_directeur }}</td>
                            <td>{{ $conge->avis_rh }}</td>
                            <td>{{ $conge->avis_dpaf }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center">Aucune demande</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
