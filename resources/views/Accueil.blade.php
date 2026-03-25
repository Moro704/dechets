@extends('layouts.app')

@section('content')
<h1>Bienvenue {{ auth()->user()->name }} !</h1>
<p>Ceci est ton tableau de bord pédagogique.</p>
@endsection