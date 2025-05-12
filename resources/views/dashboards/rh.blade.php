@if(Auth::user()->role !== 'rh') @php abort(403) @endphp @endif


@extends('layouts.app')

@section('title', 'Dashboard RH')

@section('content')
  <h1>Bienvenue Rh</h1>
@endsection
