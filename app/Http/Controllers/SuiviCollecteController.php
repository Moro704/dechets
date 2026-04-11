<?php

namespace App\Http\Controllers;

use App\Models\Collecteur;
use App\Models\Planification;
use App\Models\Zone;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SuiviCollecteController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->get('type', 'effectuees'); // effectuees ou non_effectuees

        $query = Planification::with(['zone', 'collecteur', 'collecte']);

        // === FILTRES ===
        // 1. Date
        $dateFilter = $request->get('date_filter');
        if ($dateFilter === 'today') {
            $query->whereDate('date_prevue', Carbon::today());
        } elseif ($dateFilter === 'week') {
            $query->whereBetween('date_prevue', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
        } elseif ($dateFilter === 'month') {
            $query->whereMonth('date_prevue', Carbon::now()->month);
        }

        // 2. Zone
        if ($zoneId = $request->get('zone_id')) {
            $query->where('zone_id', $zoneId);
        }

        // 3. Collecteur
        if ($collecteurId = $request->get('collecteur_id')) {
            $query->where('collecteur_id', $collecteurId);
        }

        // 4. Statut
        if ($statut = $request->get('statut')) {
            $query->where('statut', $statut);
        }

        // === TYPE DE COLLECTE ===
        if ($type === 'effectuees') {
            $query->effectuees();
        } else {
            $query->nonEffectuees();
        }

        $collectes = $query->latest('date_prevue')->paginate(15);

        // Données pour les filtres (select)
        $zones = Zone::all();
        $collecteurs = Collecteur::all();

        return view('suivi_collecte.index', compact('collectes', 'zones', 'collecteurs', 'type'));
    }
}
