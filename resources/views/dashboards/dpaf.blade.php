@if(Auth::user()->role !== 'dpaf') @php abort(403) @endphp @endif


@extends('layouts.app')

@section('title', 'Dashboard DPAF')

@section('content')
<h1>Bienvenue DPAF</h1>
@endsection
