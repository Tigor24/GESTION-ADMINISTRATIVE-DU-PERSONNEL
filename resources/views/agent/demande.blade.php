@extends('layouts.app')
@section('title', 'Nouvelle demande')

@section('content')
<div class="container-fluid">
    <h4 class="mb-4">📝 Nouvelle demande de congé</h4>

    <form action="{{ route('agent.conges.store') }}" method="POST" class="card p-4 shadow">
        @csrf
        <div class="form-group">
            <label for="type">Type de congé</label>
            <select name="type" id="type" class="form-control" required>
                <option value="annuel">Annuel</option>
                <option value="maladie">Maladie</option>
                <option value="maternité">Maternité</option>
            </select>
        </div>

        <div class="form-group">
            <label for="date_debut">Date début</label>
            <input type="date" name="date_debut" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="date_fin">Date fin</label>
            <input type="date" name="date_fin" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="motif">Motif</label>
            <textarea name="motif" class="form-control" rows="3"></textarea>
        </div>

        <button type="submit" class="btn btn-success">
            <i class="fas fa-paper-plane"></i> Soumettre la demande
        </button>
    </form>
</div>
@endsection
