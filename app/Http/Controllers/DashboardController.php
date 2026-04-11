<?php

namespace App\Http\Controllers;

use App\Models\Abonnements;
use App\Models\Agents;
use App\Models\Collecteur;
use App\Models\Client;
use App\Models\Commande;
use App\Models\Paiement;
use App\Models\Produit;
use App\Models\Stock;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();

        $clientsCount = Client::count();
        $commandesPending = Commande::where('statut', 'en_attente')->count();
        $paiementsValidCount = Paiement::where('statut', 'valide')->count();
        $totalRevenue = Paiement::where('statut', 'valide')->sum('montant');
        $produitsCount = Produit::count();
        $agentsCount = Agents::count();
        $collecteursCount = Collecteur::count();
        $abonnementsCount = Abonnements::count();
        $lowStockCount = Stock::enAlerte()->count();
        $recentCommandes = Commande::with('client')
            ->orderByDesc('date_commande')
            ->limit(5)
            ->get();

        $commandesByStatus = Commande::selectRaw('statut, COUNT(*) as total')
            ->groupBy('statut')
            ->pluck('total', 'statut')
            ->toArray();

        $revenueByMonth = Paiement::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, SUM(montant) as total')
            ->where('statut', 'valide')
            ->where('created_at', '>=', now()->subMonths(11)->startOfMonth())
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get()
            ->keyBy(fn ($item) => $item->year.'-'.$item->month);

        $monthlyRevenue = collect();

        for ($i = 0; $i < 12; $i++) {
            $date = now()->subMonths(11 - $i);
            $key = $date->year.'-'.$date->month;

            $monthlyRevenue->push([
                'month' => $date->format('M'),
                'amount' => $revenueByMonth[$key]->total ?? 0,
            ]);
        }

        $statusLabels = [
            'en_attente' => 'En attente',
            'validée' => 'Validées',
            'livrée' => 'Livrées',
            'annulée' => 'Annulées',
        ];

        $statusData = [];
        foreach ($statusLabels as $status => $label) {
            $statusData[] = $commandesByStatus[$status] ?? 0;
        }

        return view('dashboard', [
            'userName' => $user?->name ?? 'Utilisateur',
            'clientsCount' => $clientsCount,
            'commandesPending' => $commandesPending,
            'paiementsValidCount' => $paiementsValidCount,
            'totalRevenue' => $totalRevenue,
            'produitsCount' => $produitsCount,
            'agentsCount' => $agentsCount,
            'collecteursCount' => $collecteursCount,
            'abonnementsCount' => $abonnementsCount,
            'lowStockCount' => $lowStockCount,
            'recentCommandes' => $recentCommandes,
            'monthlyRevenue' => $monthlyRevenue,
            'commandesStatusLabels' => array_values($statusLabels),
            'commandesStatusData' => $statusData,
        ]);
    }
}
