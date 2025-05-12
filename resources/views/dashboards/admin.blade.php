@if(Auth::user()->role !== 'admin') @php abort(403) @endphp @endif


@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
  <h1>Bienvenue Admin</h1>
@endsection
