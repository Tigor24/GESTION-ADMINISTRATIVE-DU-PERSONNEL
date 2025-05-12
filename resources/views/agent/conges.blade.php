@extends('layouts.app')
@section('title', 'Mes congés')

@section('content')
<div class="container-fluid">
    <!-- Bloc 1 : Faire une demande -->
    <div class="mb-3">
        <a href="{{ route('agent.conges.create') }}" class="btn btn-primary">
            <i class="fas fa-plus-circle"></i> Faire une demande de congé
        </a>
    </div>

    <!-- Bloc 2 : Résumé -->
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner"><h3>{{ $total }}</h3><p>Total</p></div>
                <div class="icon"><i class="fas fa-clipboard-list"></i></div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner"><h3>{{ $valides }}</h3><p>Validés</p></div>
                <div class="icon"><i class="fas fa-check-circle"></i></div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner"><h3>{{ $refuses }}</h3><p>Refusés</p></div>
                <div class="icon"><i class="fas fa-times-circle"></i></div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner"><h3>{{ $en_attente }}</h3><p>En attente</p></div>
                <div class="icon"><i class="fas fa-hourglass-half"></i></div>
            </div>
        </div>
    </div>

    <!-- Bloc 3 : Historique -->
    <div class="card card-outline card-secondary">
        <div class="card-header"><h3 class="card-title">Historique de vos demandes</h3></div>
        <div class="card-body table-responsive p-0">
            <table class="table table-bordered text-sm">
                <thead>
                    <tr>
                        <th>Type</th><th>Période</th><th>Statut</th>
                        <th>Directeur</th><th>RH</th><th>DPAF</th>
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
