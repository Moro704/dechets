@extends('layouts.app')

@section('title', 'Liste des Collecteurs')

@section('content')
<div class="container">
    <h1>Liste des Collecteurs</h1>

    <a href="{{ route('collecteurs.create') }}" class="btn btn-primary mb-3">Ajouter un Collecteur</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Num permis</th>
                <th>Matricule</th>
                <th>Adresse</th>
                <th>Zone</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($collecteurs as $collecteur)
            <tr>
                <td>{{ $collecteur->user->name }}</td>
                <td>{{ $collecteur->user->email }}</td>
                <td>{{ $collecteur->user->telephone }}</td>
                <td>{{ $collecteur->numpermis }}</td>
                <td>{{ $collecteur->matricul }}</td>
                    <td>{{ $collecteur->user->address }}</td>
                <td>{{ $collecteur->zone->nom ?? 'Non défini' }}</td>
                <td>
                    <a href="{{ route('collecteurs.edit', $collecteur->id) }}" class="btn btn-sm btn-warning">Modifier</a>
                    <form action="{{ route('collecteurs.destroy', $collecteur->id) }}" method="POST" style="display:inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger"
                            onclick="return confirm('Voulez-vous vraiment supprimer ce collecteur ?')">Supprimer</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="7" class="text-center">Aucun collecteur trouvé.</td></tr>
            @endforelse
        </tbody>
    </table>

    {{ $collecteurs->links() }} <!-- Pagination -->
</div>
@endsection