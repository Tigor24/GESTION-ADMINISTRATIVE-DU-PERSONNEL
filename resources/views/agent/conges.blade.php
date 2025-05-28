@extends('layouts.app')
@section('title', 'Mes congés')

@section('content')
<div class="container-fluid">
    <h4 class="mb-4">Bonjour, {{ Auth::user()->name }} 👋</h4>

    <div class="row">
        <div class="col-md-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $total }}</h3><p>Total</p>
                </div>
                <div class="icon"><i class="fas fa-clipboard-list"></i></div>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $valides }}</h3><p>Validées</p>
                </div>
                <div class="icon"><i class="fas fa-check-circle"></i></div>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $refuses }}</h3><p>Refusées</p>
                </div>
                <div class="icon"><i class="fas fa-times-circle"></i></div>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $en_attente }}</h3><p>En attente</p>
                </div>
                <div class="icon"><i class="fas fa-hourglass-half"></i></div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-6 mb-3">
            <a href="{{ route('agent.conges.create') }}" class="card card-hover p-5 text-center text-decoration-none bg-light">
                <i class="fas fa-paper-plane fa-2x text-primary mb-2"></i>
                <h5 class="text-primary">Faire une demande</h5>
            </a>
        </div>
        <div class="col-md-6 mb-3">
            <a href="{{ route('agent.conges.historique') }}" class="card card-hover p-5 text-center text-decoration-none bg-light">
                <i class="fas fa-history fa-2x text-dark mb-2"></i>
                <h5 class="text-dark">Historique des congés</h5>
            </a>
        </div>
    </div>
</div>
@endsection
