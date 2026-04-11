<?php

namespace App\Http\Controllers;

use App\Models\Planification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RapportController extends Controller
{
    public function index(Request $request)
    {
        $periode = $request->get('periode', 'month');

        $query = Planification::with(['zone', 'collecteur', 'collecte.pesage'])
            ->where('statut', '!=', 'Planifiée');

        // Filtre période
        if ($periode === 'today') {
            $query->whereDate('date_prevue', Carbon::today());
        } elseif ($periode === 'week') {
            $query->whereBetween('date_prevue', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
        } elseif ($periode === 'month') {
            $query->whereMonth('date_prevue', Carbon::now()->month)
                  ->whereYear('date_prevue', Carbon::now()->year);
        } elseif ($periode === 'year') {
            $query->whereYear('date_prevue', Carbon::now()->year);
        }

        $planifications = $query->get();

        // KPI
        $totalCollectes = $planifications->count();
        $totalDechets = $planifications->sum(function ($p) {
            return optional($p->collecte?->pesage)->poids ?? 0;
        });

        // Collectes par mois (pour le graphique)
        $collectesParMois = Planification::selectRaw('MONTH(date_prevue) as mois, COUNT(*) as total')
            ->whereYear('date_prevue', Carbon::now()->year)
            ->groupBy('mois')
            ->orderBy('mois')
            ->pluck('total', 'mois');

        $moisLabels = [];
        $moisData = [];
        for ($i = 1; $i <= 12; $i++) {
            $moisLabels[] = Carbon::create()->month($i)->format('F');
            $moisData[] = $collectesParMois->get($i, 0);
        }

        // ====================== DÉCHETS PAR TYPE ======================
        $dechetsParType = DB::table('tries')
            ->join('pesage', 'pesage.id', '=', 'tries.pesage_id')
            ->select(
                'tries.type_dechet',
                DB::raw('COUNT(*) as nombre'),
                DB::raw('SUM(tries.quantite_trier) as quantite_total')
            )
            ->groupBy('tries.type_dechet')
            ->orderByDesc('quantite_total')
            ->get();

        // Performance collecteurs
        $performanceCollecteurs = Planification::with('collecteur')
            ->selectRaw('collecteur_id, COUNT(*) as nb_collectes')
            ->where('statut', '!=', 'Planifiée')
            ->groupBy('collecteur_id')
            ->orderByDesc('nb_collectes')
            ->get();

        // Collectes par zone
        $collectesParZone = Planification::with('zone')
            ->selectRaw('zone_id, COUNT(*) as total_collectes')
            ->where('statut', '!=', 'Planifiée')
            ->groupBy('zone_id')
            ->get();

        return view('rapports.index', compact(
            'totalCollectes',
            'totalDechets',
            'collectesParMois',
            'dechetsParType',
            'performanceCollecteurs',
            'collectesParZone',
            'periode',
            'moisLabels',
            'moisData'
        ));
    }
}