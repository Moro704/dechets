@extends('layouts.app')

@section('title', 'Abonnements')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="mb-1">Abonnements</h1>
            <p class="text-muted mb-0">Gérez les abonnements actifs et suivez leurs durées.</p>
        </div>
        <a href="{{ route('abonnements.create') }}" class="btn btn-primary">Nouvel abonnement</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Type</th>
                    <th>Période</th>
                    <th>Statut</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($abonnements as $abonnement)
                    <tr>
                        <td>{{ $abonnement->id }}</td>
                        <td>{{ $abonnement->type_abonnement }}</td>
                        <td>{{ $abonnement->date_debut->format('d/m/Y') }} - {{ $abonnement->date_fin->format('d/m/Y') }}</td>
                        <td>
                            <span class="badge {{ $abonnement->statut === 'actif' ? 'bg-success' : ($abonnement->statut === 'expiré' ? 'bg-secondary' : ($abonnement->statut === 'annulé' ? 'bg-danger' : 'bg-warning text-dark')) }}">
                                {{ ucfirst(str_replace('_', ' ', $abonnement->statut)) }}
                            </span>
                        </td>
                        <td class="text-end">
                            <a href="{{ route('abonnements.edit', $abonnement->id) }}" class="btn btn-sm btn-warning me-2" title="Modifier">
                                <i class="bx bx-edit"></i>
                            </a>
                            <form action="{{ route('abonnements.destroy', $abonnement->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" title="Supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet abonnement ?')">
                                    <i class="bx bx-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">Aucun abonnement trouvé.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $abonnements->links() }}
    </div>
</div>
@endsection
