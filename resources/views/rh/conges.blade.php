@extends('layouts.app')
@section('title', 'Analyse RH - Demandes de congé')

@section('content')
<div class="container-fluid">
    <h4 class="mb-4">Demandes à analyser</h4>

    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-hover text-sm">
                <thead>
                    <tr>
                        <th>Agent</th>
                        <th>Type</th>
                        <th>Dates</th>
                        <th>Motif</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($conges as $conge)
                        <tr>
                            <td>{{ $conge->user->name }}</td>
                            <td>{{ $conge->type }}</td>
                            <td>{{ $conge->date_debut }} → {{ $conge->date_fin }}</td>
                            <td>{{ $conge->motif }}</td>
                            <td>
                                <form action="{{ route('rh.conges.retour', $conge->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <select name="avis_rh" class="form-control form-control-sm d-inline w-auto">
                                        <option value="validé">Valider</option>
                                        <option value="refusé">Refuser</option>
                                    </select>
                                    <button class="btn btn-sm btn-info">Envoyer</button>
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
