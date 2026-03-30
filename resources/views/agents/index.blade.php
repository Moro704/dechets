@extends('layouts.app')

@section('content')
  <div class="container">
    <h1>Liste des Agents</h1>
    <a href="{{ route('agents.create') }}" class="btn btn-primary mb-3">Ajouter un Agent</a>
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Adresse</th>
                <th>Matricule</th>
                <th>Qualification</th>
                <th>Actions</th>
            </tr>
            
            
        </thead>
        <tbody>
            @forelse($agents as $agent)
                <tr>
                    <td>{{ $agent->user->name }}</td>
                    <td>{{ $agent->user->email }}</td>
                    <td>{{ $agent->user->telephone }}</td>
                    <td>{{ $agent->user->address }}</td>
                    <td>{{ $agent->matricul }}</td>
                    <td>{{ $agent->qualification }}</td>
                    <td>
                        <a href="{{ route('agents.edit', $agent->id) }}" class="btn btn-sm btn-warning">Modifier</a>
                        <form action="{{ route('agents.destroy', $agent->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet agent ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Aucun agent trouvé.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    
  </div>

   
@endsection