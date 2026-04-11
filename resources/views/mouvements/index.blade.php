@extends('layouts.app')

@section('title', 'Mouvements de Stock')

@section('content')
<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <div>
            <h4 class="card-title mb-1">Historique des Mouvements</h4>
            <small class="text-muted">Suivi de toutes les entrées et sorties de stock</small>
        </div>
        <div>
            <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary btn-sm">Retour au tableau de bord</a>
        </div>
    </div>

    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Date & Heure</th>
                        <th>Produit</th>
                        <th>Type</th>
                        <th class="text-end">Quantité</th>
                        <th>Source</th>
                        <th>Description</th>
                        <th>Commande</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($mouvements as $mouvement)
                        <tr>
                            <td>
                                <div class="fw-semibold">{{ \Carbon\Carbon::parse($mouvement->date_mouvement)->format('d/m/Y') }}</div>
                                <small class="text-muted">{{ $mouvement->heure_mouvement }}</small>
                            </td>
                            <td>
                                <div class="fw-semibold">{{ $mouvement->stock->nom }}</div>
                                @if($mouvement->stock->produit)
                                    <small class="text-muted">{{ $mouvement->stock->produit->nom }}</small>
                                @endif
                            </td>
                            <td>
                                @if($mouvement->type_mouvement_label === 'Entrée')
                                    <span class="badge bg-success">Entrée</span>
                                @else
                                    <span class="badge bg-danger">Sortie</span>
                                @endif
                            </td>
                            <td class="text-end">{{ number_format($mouvement->quantite, 2, ',', ' ') }} {{ $mouvement->stock->unite_mesure }}</td>
                            <td>{{ $mouvement->source }}</td>
                            <td>{{ $mouvement->description ?? '-' }}</td>
                            <td>
                                @if($mouvement->commande)
                                    <span class="badge bg-info">{{ $mouvement->commande->code_commande }}</span>
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">Aucun mouvement trouvé.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4 d-flex justify-content-end">
            {{ $mouvements->links() }}
        </div>
    </div>
</div>
@endsection