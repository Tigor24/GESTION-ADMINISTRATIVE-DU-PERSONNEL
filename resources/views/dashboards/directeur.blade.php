@if(Auth::user()->role !== 'directeur') @php abort(403) @endphp @endif


@extends('layouts.app')

@section('title', 'Dashboard Directeur')

@section('content')
<h1>Bienvenue Directeur</h1>
@endsection
