@extends('layouts.app')
@section('title', 'Demandes à traiter - DPAF')

@section('content')
<div class="container-fluid">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Demandes de congé (étapes DPAF)</h3>
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table table-bordered table-hover text-sm">
                <thead class="bg-light">
                    <tr>
                        <th>Agent</th>
                        <th>Période</th>
                        <th>Motif</th>
                        <th>Statut</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($conges as $conge)
                        <tr>
                            <td>{{ $conge->user->name ?? '-' }}</td>
                            <td>{{ $conge->date_debut }} au {{ $conge->date_fin }}</td>
                            <td>{{ $conge->motif }}</td>
                            <td><span class="badge bg-{{ $conge->statut === 'analyse_rh_terminée' ? 'warning' : 'info' }}">{{ $conge->statut }}</span></td>
                            <td>
                                @if($conge->statut === 'transmis_dpaf')
                                    <form action="{{ route('dpaf.conges.vers_rh', $conge->id) }}" method="POST" style="display:inline">
                                        @csrf
                                        <button class="btn btn-sm btn-warning">Envoyer au RH</button>
                                    </form>
                                @elseif($conge->statut === 'analyse_rh_terminée')
                                    <form action="{{ route('dpaf.conges.finaliser', $conge->id) }}" method="POST" style="display:inline">
                                        @csrf
                                        <select name="avis_dpaf" class="form-select form-select-sm d-inline w-auto">
                                            <option value="validé">Valider</option>
                                            <option value="refusé">Refuser</option>
                                        </select>
                                        <button class="btn btn-sm btn-success">Décider</button>
                                    </form>
                                @else
                                    <em>Rien à faire</em>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center">Aucune demande à afficher</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
