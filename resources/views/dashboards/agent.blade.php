@if(Auth::user()->role !== 'agent') @php abort(403) @endphp @endif


@extends('layouts.app')
@section('title', 'Tableau de bord - Agent')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Welcome Box -->
        <div class="col-12 mb-4">
            <h3>Bonjour, {{ Auth::user()->name }} 👋</h3>
            <p>Bienvenue sur votre espace personnel. Depuis ce tableau de bord, vous pouvez accéder à vos demandes de congés, consulter leur statut, et gérer vos informations.</p>
        </div>

        <!-- Exemple de futur modules -->
        <div class="col-md-6">
            <div class="card card-outline card-primary shadow">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="fas fa-calendar-alt"></i> Congés</h5>
                </div>
                <div class="card-body">
                    <p>Soumettez vos demandes de congés et consultez leur avancement.</p>
                    <a href="{{ route('agent.conges') }}" class="btn btn-sm btn-primary">
                        Accéder à mes congés
                    </a>
                </div>
            </div>
        </div>

        {{-- Ajoute plus tard d'autres modules : Mon profil, Documents, etc. --}}
    </div>
</div>
@endsection
