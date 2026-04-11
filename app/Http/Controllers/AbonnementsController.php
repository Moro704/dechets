<?php

namespace App\Http\Controllers;

use App\Models\Abonnements;
use Illuminate\Http\Request;

class AbonnementsController extends Controller
{
    public function index()
    {
        $abonnements = Abonnements::latest()->paginate(20);

        return view('abonnements.index', compact('abonnements'));
    }

    public function create()
    {
        return view('abonnements.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
                  'type_abonnement' => ['required', 'string', 'max:255'],
                  'montant'         => ['required', 'numeric', 'min:0'],     // ← Ajouté
                  'date_debut'      => ['required', 'date'],
                  'date_fin'        => ['required', 'date', 'after_or_equal:date_debut'],
                  'statut'          => ['required', 'in:actif,expiré,annulé,en_attente'],
]);

        Abonnements::create($validated);

        return redirect()->route('abonnements.index')->with('success', 'Abonnement créé avec succès.');
    }

    public function edit($id)
    {
        $abonnement = Abonnements::findOrFail($id);

        return view('abonnements.edit', compact('abonnement'));
    }

    public function update(Request $request, $id)
    {
        $abonnement = Abonnements::findOrFail($id);

        $validated = $request->validate([
            'type_abonnement' => ['required', 'string', 'max:255'],
            'date_debut' => ['required', 'date'],
            'date_fin' => ['required', 'date', 'after_or_equal:date_debut'],
            'statut' => ['required', 'in:actif,expiré,annulé,en_attente'],
        ]);

        $abonnement->update($validated);

        return redirect()->route('abonnements.index')->with('success', 'Abonnement mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $abonnement = Abonnements::findOrFail($id);
        $abonnement->delete();

        return redirect()->route('abonnements.index')->with('success', 'Abonnement supprimé avec succès.');
    }
}
