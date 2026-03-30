@extends('layouts.app')

@section('title', 'Accueil - EcoFlux')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <!-- Hero Section -->
  <div class="row mb-5">
    <div class="col-12">
      <div class="card bg-gradient-ecological text-white shadow-ecological-lg">
        <div class="card-body p-5">
          <div class="row align-items-center">
            <div class="col-lg-8">
              <h1 class="display-4 fw-bold mb-3 text-gradient-ecological">Bienvenue {{ auth()->user()->name }} !</h1>
              <p class="lead mb-4">
                Découvrez EcoFlux, votre plateforme complète de gestion des déchets écologiques.
                Optimisez vos opérations, suivez vos collectes et contribuez à un environnement plus durable.
              </p>
              <div class="d-flex gap-3">
                <a href="{{ route('dashboard') }}" class="btn btn-light btn-lg shadow-sm">
                  <i class="bx bx-tachometer me-2"></i>Accéder au Dashboard
                </a>
                <a href="#" class="btn btn-outline-light btn-lg">
                  <i class="bx bx-play-circle me-2"></i>Tutoriel
                </a>
              </div>
            </div>
            <div class="col-lg-4 text-center">
              <div class="hero-icon">
                <i class="bx bx-recycle display-1 text-white opacity-75"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Quick Actions -->
  <div class="row mb-5">
    <div class="col-12">
      <h4 class="fw-bold mb-4">Actions rapides</h4>
      <div class="row g-4">
        <div class="col-md-3 col-sm-6">
          <div class="card h-100 border-ecological border-2 shadow-ecological">
            <div class="card-body text-center bg-ecological-light">
              <div class="avatar avatar-xl mx-auto mb-3">
                <div class="avatar-initial bg-ecological-card rounded-circle">
                  <i class="bx bx-plus-circle bx-lg text-eco-primary"></i>
                </div>
              </div>
              <h6 class="card-title mb-2 text-eco-primary fw-bold">Nouvelle collecte</h6>
              <p class="card-text text-muted small">Planifier une nouvelle opération de collecte</p>
              <a href="#" class="btn btn-primary btn-sm">Créer</a>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6">
          <div class="card h-100 border-success border-2">
            <div class="card-body text-center">
              <div class="avatar avatar-xl mx-auto mb-3">
                <div class="avatar-initial bg-label-success rounded-circle">
                  <i class="bx bx-truck bx-lg text-success"></i>
                </div>
              </div>
              <h6 class="card-title mb-2">Suivi collecteurs</h6>
              <p class="card-text text-muted small">Voir l'état de vos équipes</p>
              <a href="#" class="btn btn-success btn-sm">Voir</a>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6">
          <div class="card h-100 border-info border-2">
            <div class="card-body text-center">
              <div class="avatar avatar-xl mx-auto mb-3">
                <div class="avatar-initial bg-label-info rounded-circle">
                  <i class="bx bx-package bx-lg text-info"></i>
                </div>
              </div>
              <h6 class="card-title mb-2">Gestion stock</h6>
              <p class="card-text text-muted small">Contrôler l'inventaire</p>
              <a href="#" class="btn btn-info btn-sm">Gérer</a>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6">
          <div class="card h-100 border-warning border-2">
            <div class="card-body text-center">
              <div class="avatar avatar-xl mx-auto mb-3">
                <div class="avatar-initial bg-label-warning rounded-circle">
                  <i class="bx bx-bar-chart bx-lg text-warning"></i>
                </div>
              </div>
              <h6 class="card-title mb-2">Rapports</h6>
              <p class="card-text text-muted small">Analyser les performances</p>
              <a href="#" class="btn btn-warning btn-sm">Voir</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Statistics Overview -->
  <div class="row mb-5">
    <div class="col-12">
      <h4 class="fw-bold mb-4">Aperçu des statistiques</h4>
      <div class="row g-4">
        <div class="col-lg-3 col-md-6">
          <div class="card shadow-ecological">
            <div class="card-body">
              <div class="d-flex align-items-center">
                <div class="avatar avatar-sm flex-shrink-0 me-3">
                  <div class="avatar-initial bg-eco-primary rounded-circle">
                    <i class="bx bx-recycle"></i>
                  </div>
                </div>
                <div>
                  <h6 class="mb-0 text-eco-primary fw-bold">Collectes aujourd'hui</h6>
                  <h4 class="mb-0 text-eco-primary">24</h4>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="card shadow-ecological">
            <div class="card-body">
              <div class="d-flex align-items-center">
                <div class="avatar avatar-sm flex-shrink-0 me-3">
                  <div class="avatar-initial bg-eco-secondary rounded-circle">
                    <i class="bx bx-package"></i>
                  </div>
                </div>
                <div>
                  <h6 class="mb-0 text-eco-secondary fw-bold">Tonnes collectées</h6>
                  <h4 class="mb-0 text-eco-secondary">156.8</h4>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="card shadow-ecological">
            <div class="card-body">
              <div class="d-flex align-items-center">
                <div class="avatar avatar-sm flex-shrink-0 me-3">
                  <div class="avatar-initial bg-info rounded-circle">
                    <i class="bx bx-truck"></i>
                  </div>
                </div>
                <div>
                  <h6 class="mb-0 text-info fw-bold">Véhicules actifs</h6>
                  <h4 class="mb-0 text-info">8</h4>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="card shadow-ecological">
            <div class="card-body">
              <div class="d-flex align-items-center">
                <div class="avatar avatar-sm flex-shrink-0 me-3">
                  <div class="avatar-initial bg-warning rounded-circle">
                    <i class="bx bx-leaf"></i>
                  </div>
                </div>
                <div>
                  <h6 class="mb-0 text-warning fw-bold">Impact CO2 réduit</h6>
                  <h4 class="mb-0 text-warning">2.4t</h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Tips Section -->
  <div class="row">
    <div class="col-12">
      <div class="card bg-ecological-light border-ecological shadow-ecological">
        <div class="card-body">
          <div class="row align-items-center">
            <div class="col-md-8">
              <h5 class="card-title text-eco-primary mb-2">
                <i class="bx bx-bulb me-2"></i>Conseil du jour
              </h5>
              <p class="mb-0 text-eco-secondary">
                Optimisez vos tournées de collecte en utilisant notre système de planification intelligente.
                Cela peut réduire vos coûts de carburant de 15% et améliorer l'efficacité de vos équipes.
              </p>
            </div>
            <div class="col-md-4 text-center">
              <i class="bx bx-leaf display-4 text-eco-primary opacity-50"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection