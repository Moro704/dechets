@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Créer une Planification</h1>
    <form action="{{ route('planifications.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="code_planification">Code Planification</label>
            <input type="text" class="form-control" id="code_planification" name="code_planification" required>
        </div>
        <div class="form-group">
            <label for="nom_tournee">Nom Tournée</label>
            <input type="text" class="form-control" id="nom_tournee" name="nom_tournee">
        </div>
        <div class="form-group">
            <label for="jour_semaine">Jour Semaine</label>
            <input type="text" class="form-control" id="jour_semaine" name="jour_semaine" required>
        </div>
        <div class="form-group">
            <label for="date_prevue">Date Prévue</label>
            <input type="date" class="form-control" id="date_prevue" name="date_prevue">
        </div>
        <div class="form-group">
            <label for="periode">Période</label>
            <select class="form-control" id="periode" name="periode" required>
                <option value="HEBDOMADAIRE">Hebdomadaire</option>
                <option value="BI_HEBDOMADAIRE">Bi-hebdomadaire</option>
            </select>
        </div>
        <div class="form-group">
            <label for="type_collecte">Type Collecte</label>
            <input type="text" class="form-control" id="type_collecte" name="type_collecte" required>
        </div>
        <div class="form-group">
            <label for="statut">Statut</label>
            <select class="form-control" id="statut" name="statut" required>
                <option value="ACTIVE">Active</option>
                <option value="SUSPENDUE">Suspendue</option>
                <option value="TERMINEE">Terminée</option>
                <option value="ANNULEE">Annulée</option>
            </select>
        </div>
        <div class="form-group">
            <label for="zone_id">Zone</label>
            <select class="form-control" id="zone_id" name="zone_id" required>
                @foreach($zones as $zone)
                <option value="{{ $zone->id }}">{{ $zone->nom_zone }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="collecteur_id">Collecteur</label>
            <select class="form-control" id="collecteur_id" name="collecteur_id" required>
                @foreach($collecteurs as $collecteur)
                <option value="{{ $collecteur->id }}">{{ $collecteur->nom_collecteur }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="declaration_id">Déclaration</label>
            <select class="form-control" id="declaration_id" name="declaration_id">
                <option value="">Aucune</option>
                @foreach($declarations as $declaration)
                <option value="{{ $declaration->id }}">{{ $declaration->id }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Créer</button>
    </form>
</div>
@endsection