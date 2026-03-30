<!-- 
 @extends('layouts.app')

@section('title', 'Dashboard - EcoFlux')

@section('content')
<div class="row">
     Welcome Card
    <div class="col-12 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="card-title mb-2">Bienvenue sur EcoFlux !</h4>
                        <p class="card-text text-muted mb-0">
                            Système de gestion des déchets et zones de collecte.
                            Vous êtes maintenant connecté et pouvez gérer vos zones de collecte.
                        </p>
                    </div>
                    <div class="col-md-4 text-center">
                        <div class="mt-3 mt-md-0">
                            <i class="bx bx-recycle bx-lg text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

     Statistics Cards 
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="avatar flex-shrink-0 me-3">
                        <div class="avatar-initial bg-label-primary rounded">
                            <i class="bx bx-map-pin bx-sm"></i>
                        </div>
                    </div>
                    <div class="card-info">
                        <span class="fw-semibold d-block mb-1">Zones</span>
                        <h3 class="card-title mb-0">{{ \App\Models\Zone::count() }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="avatar flex-shrink-0 me-3">
                        <div class="avatar-initial bg-label-success rounded">
                            <i class="bx bx-user bx-sm"></i>
                        </div>
                    </div>
                    <div class="card-info">
                        <span class="fw-semibold d-block mb-1">Utilisateurs</span>
                        <h3 class="card-title mb-0">{{ \App\Models\User::count() }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="avatar flex-shrink-0 me-3">
                        <div class="avatar-initial bg-label-info rounded">
                            <i class="bx bx-calendar bx-sm"></i>
                        </div>
                    </div>
                    <div class="card-info">
                        <span class="fw-semibold d-block mb-1">Aujourd'hui</span>
                        <h3 class="card-title mb-0">{{ now()->format('d/m') }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="avatar flex-shrink-0 me-3">
                        <div class="avatar-initial bg-label-warning rounded">
                            <i class="bx bx-time bx-sm"></i>
                        </div>
                    </div>
                    <div class="card-info">
                        <span class="fw-semibold d-block mb-1">Heure</span>
                        <h3 class="card-title mb-0">{{ now()->format('H:i') }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

     Quick Actions 
    <div class="col-12 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Actions Rapides</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 col-lg-3 mb-3">
                        <a href="{{ route('zones.index') }}" class="btn btn-primary d-block">
                            <i class="bx bx-list-ul me-2"></i>
                            Voir les Zones
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-3 mb-3">
                        <a href="{{ route('zones.create') }}" class="btn btn-success d-block">
                            <i class="bx bx-plus me-2"></i>
                            Ajouter une Zone
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-3 mb-3">
                        <a href="{{ route('profile.edit') }}" class="btn btn-info d-block">
                            <i class="bx bx-user me-2"></i>
                            Mon Profil
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-3 mb-3">
                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-danger d-block w-100">
                                <i class="bx bx-log-out me-2"></i>
                                Déconnexion
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

     Recent Zones 
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Zones Récentes</h5>
                <a href="{{ route('zones.index') }}" class="btn btn-sm btn-outline-primary">
                    Voir Tout
                </a>
            </div>
            <div class="card-body">
                @if(\App\Models\Zone::count() > 0)
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Ville</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(\App\Models\Zone::latest()->take(5)->get() as $zone)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-sm me-3">
                                                <div class="avatar-initial bg-label-secondary rounded-circle">
                                                    <i class="bx bx-map-pin bx-xs"></i>
                                                </div>
                                            </div>
                                            <div>
                                                <h6 class="mb-0">{{ $zone->nom }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $zone->ville }}</td>
                                    <td>{{ Str::limit($zone->description ?? 'N/A', 50) }}</td>
                                    <td>
                                        <a href="{{ route('zones.show', $zone->id) }}" class="btn btn-sm btn-icon btn-text-secondary rounded-pill">
                                            <i class="bx bx-show bx-xs"></i>
                                        </a>
                                        <a href="{{ route('zones.edit', $zone->id) }}" class="btn btn-sm btn-icon btn-text-secondary rounded-pill">
                                            <i class="bx bx-edit bx-xs"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="bx bx-map-pin bx-lg text-muted mb-3"></i>
                        <h6 class="text-muted">Aucune zone créée</h6>
                        <p class="text-muted mb-3">Commencez par créer votre première zone de collecte.</p>
                        <a href="{{ route('zones.create') }}" class="btn btn-primary">
                            <i class="bx bx-plus me-2"></i>
                            Créer une Zone
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection


-->