<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Support\Facades\DB;

class InventaireController extends Controller
{
    public function index()
    {
        $stocks = Stock::with('produit')
            ->orderBy('quantite_disponible', 'desc')
            ->paginate(20);

        $totalProduits = Stock::count();
        $stockTotal = Stock::sum('quantite_disponible');
        $valeurTotale = Stock::sum(DB::raw('quantite_disponible * prix_unitaire'));
        $produitsEnAlerte = Stock::enAlerte()->count();

        return view('inventaire.index', compact(
            'stocks',
            'totalProduits',
            'stockTotal',
            'valeurTotale',
            'produitsEnAlerte'
        ));
    }
}
