@extends('layouts.app')

@section('title', 'Modifier un abonnement')

@section('content')
<div class="container">
    <h1>Modifier l'abonnement</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('abonnements.update', $abonnement->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="type_abonnement" class="form-label">Type d'abonnement</label>
            <input type="text" id="type_abonnement" name="type_abonnement" class="form-control" value="{{ old('type_abonnement', $abonnement->type_abonnement) }}" required>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="date_debut" class="form-label">Date de début</label>
                <input type="date" id="date_debut" name="date_debut" class="form-control" value="{{ old('date_debut', $abonnement->date_debut->format('Y-m-d')) }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="date_fin" class="form-label">Date de fin</label>
                <input type="date" id="date_fin" name="date_fin" class="form-control" value="{{ old('date_fin', $abonnement->date_fin->format('Y-m-d')) }}" required>
            </div>
        </div>

        <div class="mb-3">
            <label for="statut" class="form-label">Statut</label>
            <select id="statut" name="statut" class="form-select" required>
                <option value="en_attente" {{ old('statut', $abonnement->statut) == 'en_attente' ? 'selected' : '' }}>En attente</option>
                <option value="actif" {{ old('statut', $abonnement->statut) == 'actif' ? 'selected' : '' }}>Actif</option>
                <option value="expiré" {{ old('statut', $abonnement->statut) == 'expiré' ? 'selected' : '' }}>Expiré</option>
                <option value="annulé" {{ old('statut', $abonnement->statut) == 'annulé' ? 'selected' : '' }}>Annulé</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
        <a href="{{ route('abonnements.index') }}" class="btn btn-secondary">Retour à la liste</a>
    </form>
</div>
@endsection
