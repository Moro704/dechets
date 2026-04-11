@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">📊 Rapports Statistiques - EcoFlux</h3>
        <small class="text-muted">Dernière mise à jour : {{ now()->format('d/m/Y H:i') }}</small>
    </div>

    <!-- Filtres période -->
    <div class="mb-4">
        <div class="btn-group" role="group">
            <a href="?periode=today" class="btn {{ request('periode') == 'today' ? 'btn-primary' : 'btn-outline-primary' }}">Aujourd'hui</a>
            <a href="?periode=week" class="btn {{ request('periode') == 'week' ? 'btn-primary' : 'btn-outline-primary' }}">Cette semaine</a>
            <a href="?periode=month" class="btn {{ request('periode') == 'month' ? 'btn-primary' : 'btn-outline-primary' }}">Ce mois</a>
            <a href="?periode=year" class="btn {{ request('periode') == 'year' ? 'btn-primary' : 'btn-outline-primary' }}">Cette année</a>
        </div>
    </div>

    <!-- KPI Cards -->
    <div class="row g-3 mb-5">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <i class="fas fa-truck fa-2x text-primary mb-3"></i>
                    <h5 class="card-title text-muted">Total Collectes</h5>
                    <h2 class="fw-bold text-primary">{{ number_format($totalCollectes) }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <i class="fas fa-weight-hanging fa-2x text-success mb-3"></i>
                    <h5 class="card-title text-muted">Total Déchets Collectés</h5>
                    <h2 class="fw-bold text-success">{{ number_format($totalDechets, 1) }} <small>kg</small></h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <i class="fas fa-recycle fa-2x text-info mb-3"></i>
                    <h5 class="card-title text-muted">Types de déchets</h5>
                    <h2 class="fw-bold text-info">{{ $dechetsParType->count() }}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- Graphique Collectes par mois -->
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0">📈 Collectes par mois ({{ now()->year }})</h5>
                </div>
                <div class="card-body">
                    <canvas id="collectesParMoisChart" height="110"></canvas>
                </div>
            </div>
        </div>

        <!-- Pie Chart Déchets par type -->
        <div class="col-lg-4">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0">🗑️ Répartition des déchets par type</h5>
                </div>
                <div class="card-body">
                    <canvas id="dechetsParTypeChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Tableaux -->
    <div class="row g-4 mt-4">
        <!-- Performance Collecteurs -->
        <div class="col-lg-6">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0">🏆 Performance des Collecteurs</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Collecteur</th>
                                <th class="text-end">Collectes</th>
                                <th class="text-end">Total Déchets (kg)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($performanceCollecteurs as $perf)
                            <tr>
                                <td>{{ $perf->collecteur->nom ?? 'Inconnu' }}</td>
                                <td class="text-end fw-bold">{{ $perf->nb_collectes }}</td>
                                <td class="text-end text-success">{{ number_format(0, 1) }} kg</td> <!-- Ajoute le calcul si besoin -->
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Collectes par Zone -->
        <div class="col-lg-6">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0">📍 Collectes par Zone</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Zone</th>
                                <th class="text-end">Nombre de collectes</th>
                                <th class="text-end">Total Déchets (kg)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($collectesParZone as $zone)
                            <tr>
                                <td>{{ $zone->zone->nom ?? 'Inconnu' }}</td>
                                <td class="text-end fw-bold">{{ $zone->total_collectes }}</td>
                                <td class="text-end text-success">{{ number_format(0, 1) }} kg</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4"></script>
<script>
    // Couleurs modernes et accessibles
    const colors = ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b', '#6f42c1', '#fd7e14'];

    // Bar Chart - Collectes par mois
    new Chart(document.getElementById('collectesParMoisChart'), {
        type: 'bar',
        data: {
            labels: @json($moisLabels),
            datasets: [{
                label: 'Nombre de collectes',
                data: @json($moisData),
                backgroundColor: '#4e73df',
                borderColor: '#4e73df',
                borderWidth: 1,
                borderRadius: 6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, grid: { color: '#e9ecef' } }
            }
        }
    });

    // Pie Chart - Déchets par type
    new Chart(document.getElementById('dechetsParTypeChart'), {
        type: 'doughnut',   // doughnut est plus moderne que pie
        data: {
            labels: @json($dechetsParType->pluck('type_dechet')),
            datasets: [{
                data: @json($dechetsParType->pluck('nombre')),
                backgroundColor: colors,
                borderWidth: 3,
                borderColor: '#fff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '65%',
            plugins: {
                legend: { position: 'bottom', labels: { padding: 20, usePointStyle: true } },
                tooltip: { backgroundColor: 'rgba(0,0,0,0.8)' }
            }
        }
    });
</script>
@endsection