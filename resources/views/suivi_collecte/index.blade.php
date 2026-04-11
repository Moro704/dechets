@extends('layouts.app')  <!-- ou ton layout actuel -->

@section('content')
<div class="container-fluid">
    <h4 class="py-3">Suivi des Collectes</h4>

    <!-- Filtres -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" class="row g-3">
                <input type="hidden" name="type" value="{{ $type }}">

                <!-- Preset dates -->
                 
               <div class="col-md-3">
    <label class="form-label">Période</label>
    <select name="date_filter" class="form-select">
        <option value="">Toutes</option>
        <option value="today" {{ request('date_filter') == 'today' ? 'selected' : '' }}>Aujourd'hui</option>
        <option value="week" {{ request('date_filter') == 'week' ? 'selected' : '' }}>Cette semaine</option>
        <option value="month" {{ request('date_filter') == 'month' ? 'selected' : '' }}>Ce mois</option>
    </select>
</div>

                <!-- Zone -->
                <div class="col-md-2">
                    <label class="form-label">Zone</label>
                    <select name="zone_id" class="form-select">
                        <option value="">Toutes</option>
                        @foreach($zones as $zone)
                            <option value="{{ $zone->id }}" {{ request('zone_id')==$zone->id ? 'selected' : '' }}>{{ $zone->nom }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Collecteur -->
                <div class="col-md-2">
                    <label class="form-label">Collecteur</label>
                    <select name="collecteur_id" class="form-select">
                        <option value="">Tous</option>
                        @foreach($collecteurs as $c)
                            <option value="{{ $c->id }}" {{ request('collecteur_id')==$c->id ? 'selected' : '' }}>{{ $c->nom }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Statut -->
                <div class="col-md-2">
                    <label class="form-label">Statut</label>
                    <select name="statut" class="form-select">
                        <option value="">Tous</option>
                        @foreach(App\Models\Planification::STATUTS as $key => $value)
                            <option value="{{ $key }}" {{ request('statut')==$key ? 'selected' : '' }}>{{ $value }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary me-2">Filtrer</button>
                    <a href="{{ route('suivi_collecte.index') }}" class="btn btn-secondary">Réinitialiser</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Tabs -->
    <ul class="nav nav-tabs mb-3">
        <li class="nav-item">
            <a href="?type=effectuees" class="nav-link {{ $type=='effectuees' ? 'active' : '' }}">Collectes Effectuées</a>
        </li>
        <li class="nav-item">
            <a href="?type=non_effectuees" class="nav-link {{ $type=='non_effectuees' ? 'active' : '' }}">Collectes Non Effectuées</a>
        </li>
    </ul>

    <!-- Tableau -->
    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Code</th>
                        <th>Zone</th>
                        <th>Collecteur</th>
                        <th>Date</th>
                        <th>Statut</th>
                        @if($type == 'effectuees')
                            <th>Photo</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($collectes as $p)
                        <tr>
                            <td><strong>{{ $p->code_planification }}</strong></td>
                            <td>{{ $p->zone?->nom ?? '—' }}</td>
                            <td>{{ $p->collecteur?->nom ?? '—' }}</td>
                            <td>
                                {{ $type == 'effectuees' ? ($p->collecte?->created_at?->format('d/m/Y') ?? $p->date_prevue) : $p->date_prevue }}
                            </td>
                            <td>
                                <span class="badge bg-{{ $p->statut == 'Effectuée' || $p->statut == 'Triée' ? 'success' : ($p->statut == 'En cours' ? 'warning' : 'secondary') }}">
                                    {{ $p->statut }}
                                </span>
                            </td>
                            @if($type == 'effectuees')
                                <td>
                                    @if($p->collecte && $p->collecte->photo)
                                        <img src="{{ asset('storage/' . $p->collecte->photo) }}" width="50" class="img-thumbnail">
                                    @else
                                        —
                                    @endif
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $collectes->links() }}
    </div>
</div>
@endsection