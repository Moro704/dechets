@extends('layouts.app')

@section('title', 'Historique système')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h4 class="mb-0">Historique système</h4>
        </div>
        <div class="card-body">
            <p class="text-muted">Suivez les actions et événements du système.</p>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Événement</th>
                            <th>Utilisateur</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="3" class="text-center text-muted">Aucun journal disponible pour le moment.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
