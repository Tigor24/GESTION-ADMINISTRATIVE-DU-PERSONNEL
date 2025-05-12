@extends('layouts.app')
@section('title', 'Analyse RH')
@section('content')
<div class="card">
    <div class="card-header"><h3>Demandes à analyser (RH)</h3></div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead><tr><th>Agent</th><th>Période</th><th>Motif</th><th>Action</th></tr></thead>
            <tbody>
                @foreach($conges as $conge)
                    <tr>
                        <td>{{ $conge->user->name }}</td>
                        <td>{{ $conge->date_debut }} au {{ $conge->date_fin }}</td>
                        <td>{{ $conge->motif }}</td>
                        <td>
                            <form action="{{ route('rh.conges.retour', $conge->id) }}" method="POST" style="display:inline">@csrf
                                <select name="avis_rh" class="form-select form-select-sm d-inline w-auto">
                                    <option value="validé">Valider</option>
                                    <option value="refusé">Refuser</option>
                                </select>
                                <button class="btn btn-primary btn-sm">Transmettre</button>
                            </form>
                        </td>
                        
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
