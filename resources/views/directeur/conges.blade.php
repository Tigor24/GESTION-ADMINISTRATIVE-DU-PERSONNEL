@extends('layouts.app')
@section('title', 'Demandes à traiter - Directeur')
@section('content')
<div class="card">
    <div class="card-header"><h3>Demandes à transmettre au DPAF</h3></div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead><tr><th>Agent</th><th>Période</th><th>Motif</th><th>Actions</th></tr></thead>
            <tbody>
                @foreach($conges as $conge)
                    <tr>
                        <td>{{ $conge->user->name }}</td>
                        <td>{{ $conge->date_debut }} → {{ $conge->date_fin }}</td>
                        <td>{{ $conge->motif }}</td>
                        <td>
                            <form action="{{ route('directeur.conges.transmettre', $conge->id) }}" method="POST" style="display:inline">@csrf
                                <button class="btn btn-sm btn-success">Transmettre</button>
                            </form>
                            <form action="{{ route('directeur.conges.refuser', $conge->id) }}" method="POST" style="display:inline">@csrf
                                <button class="btn btn-sm btn-danger">Refuser</button>
                            </form>
                        </td>
                        
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
