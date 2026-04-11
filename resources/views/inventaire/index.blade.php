@extends('layouts.app')

@section('title', 'Inventaire - Stock Actuel')

@section('content')
<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <div>
            <h4 class="card-title mb-1">Inventaire</h4>
            <small class="text-muted">Suivi en temps réel du stock disponible et des produits en alerte</small>
        </div>
        <div>
            <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary btn-sm">Retour au tableau de bord</a>
        </div>
    </div>        
    <div class="card-body">
        <div class="row g-3 mb-4">
            <div class="col-md-3">
                <div class="card shadow-sm rounded-3 border-0">
                    <div class="card-body">
                        <p class="text-muted small mb-2">Produits suivis</p>
                        <h3 class="mb-0">{{ $totalProduits }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm rounded-3 border-0">
                    <div class="card-body">
                        <p class="text-muted small mb-2">Stock total</p>
                        <h3 class="mb-0">{{ number_format($stockTotal, 2, ',', ' ') }} kg</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm rounded-3 border-0">
                    <div class="card-body">
                        <p class="text-muted small mb-2">Valeur totale</p>
                        <h3 class="mb-0">{{ number_format($valeurTotale, 0, ',', ' ') }} FCFA</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm rounded-3 border-0 {{ $produitsEnAlerte > 0 ? 'border-danger' : 'border-success' }}">
                    <div class="card-body">
                        <p class="text-muted small mb-2">Produits en alerte</p>
                        <h3 class="mb-0 text-{{ $produitsEnAlerte > 0 ? 'danger' : 'success' }}">{{ $produitsEnAlerte }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Code Stock</th>
                        <th>Produit</th>
                        <th class="text-end">Quantité</th>
                        <th class="text-end">Prix unitaire</th>
                        <th class="text-end">Valeur totale</th>
                        <th class="text-center">Seuil</th>
                        <th class="text-center">Statut</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($stocks as $stock)
                        <tr class="{{ $stock->quantite_disponible <= $stock->seuil_alerte ? 'table-danger' : '' }}">
                            <td class="font-monospace">{{ $stock->code_stock }}</td>
                            <td>
                                <div class="fw-semibold">{{ $stock->nom }}</div>
                                @if($stock->produit)
                                    <small class="text-muted">{{ $stock->produit->type ?? '' }}</small>
                                @endif
                            </td>
                            <td class="text-end">{{ number_format($stock->quantite_disponible, 2, ',', ' ') }} {{ $stock->unite_mesure }}</td>
                            <td class="text-end">{{ number_format($stock->prix_unitaire, 0, ',', ' ') }} FCFA</td>
                            <td class="text-end">{{ number_format($stock->valeur_totale, 0, ',', ' ') }} FCFA</td>
                            <td class="text-center">{{ $stock->seuil_alerte }} {{ $stock->unite_mesure }}</td>
                            <td class="text-center">
                                @if($stock->quantite_disponible <= $stock->seuil_alerte)
                                    <span class="badge bg-danger">Bas</span>
                                @else
                                    <span class="badge bg-success">OK</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">Aucun stock trouvé.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4 d-flex justify-content-end">
            {{ $stocks->links() }}
        </div>
    </div>
</div>
@endsection