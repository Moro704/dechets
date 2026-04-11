<?php

namespace App\Http\Controllers;

use App\Models\Collecteur;
use App\Models\Declaration;
use App\Models\Planification;
use App\Models\Zone;
use Illuminate\Http\Request;

class PlanificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $planifications = Planification::with(['zone', 'collecteur', 'declaration'])->paginate(10);

        return view('planifications.index', compact('planifications'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $zones = Zone::all();
        $collecteurs = Collecteur::all();
        $declarations = Declaration::all();

        return view('planifications.create', compact('zones', 'collecteurs', 'declarations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'code_planification' => 'required|unique:planifications',
            'nom_tournee' => 'nullable|string',
            'jour_semaine' => 'required|string',
            'date_prevue' => 'nullable|date',
            'periode' => 'required|string',
            'type_collecte' => 'required|string',
            'statut' => 'required|string',
            'zone_id' => 'required|exists:zones,id',
            'collecteur_id' => 'required|exists:collecteurs,id',
            'declaration_id' => 'nullable|exists:declarations,id',
        ]);

        Planification::create($request->all());

        return redirect()->route('planifications.index')->with('success', 'Planification créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Planification $planification)
    {
        $planification->load(['zone', 'collecteur', 'declaration']);

        return view('planifications.show', compact('planification'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Planification $planification)
    {
        $zones = Zone::all();
        $collecteurs = Collecteur::all();
        $declarations = Declaration::all();

        return view('planifications.edit', compact('planification', 'zones', 'collecteurs', 'declarations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Planification $planification)
    {
        $request->validate([
            'code_planification' => 'required|unique:planifications,code_planification,'.$planification->id,
            'nom_tournee' => 'nullable|string',
            'jour_semaine' => 'required|string',
            'date_prevue' => 'nullable|date',
            'periode' => 'required|string',
            'type_collecte' => 'required|string',
            'statut' => 'required|string',
            'zone_id' => 'required|exists:zones,id',
            'collecteur_id' => 'required|exists:collecteurs,id',
            'declaration_id' => 'nullable|exists:declarations,id',
        ]);

        $planification->update($request->all());

        return redirect()->route('planifications.index')->with('success', 'Planification mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Planification $planification)
    {
        $planification->delete();

        return redirect()->route('planifications.index')->with('success', 'Planification supprimée avec succès.');
    }
}
