@extends('layouts.app')
@section('title', 'Demandes à valider - Directeur')

@section('content')
<div class="container-fluid">
    <h4 class="mb-4">Demandes à valider</h4>

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
                                <form action="{{ route('directeur.conges.transmettre', $conge->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button class="btn btn-sm btn-success">Transmettre</button>
                                </form>
                                <form action="{{ route('directeur.conges.refuser', $conge->id) }}" method="POST" class="d-inline">
                                    @csrf
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
