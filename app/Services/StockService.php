<?php

namespace App\Services;

use App\Models\Mouvement;
use App\Models\Stock;
use Illuminate\Support\Facades\DB;

class StockService
{
    /**
     * Entrée de stock automatique
     * Met à jour le stock et crée le mouvement
     */
    public function entreeStock($stock_id, $quantite, $source, $description = null, $commande_id = null)
    {
        DB::transaction(function () use ($stock_id, $quantite, $source, $description, $commande_id) {
            $stock = Stock::findOrFail($stock_id);

            // Mise à jour stock
            $stock->increment('quantite_disponible', $quantite);

            // Création mouvement automatique
            Mouvement::create([
                'type_mouvement' => 'ENTREE',
                'quantite' => $quantite,
                'source' => $source,
                'description' => $description,
                'stock_id' => $stock->id,
                'commande_id' => $commande_id,
                'date_mouvement' => now()->toDateString(),
                'heure_mouvement' => now()->toTimeString(),
            ]);
        });
    }

    /**
     * Sortie de stock automatique
     * Met à jour le stock et crée le mouvement
     */
    public function sortieStock($stock_id, $quantite, $source, $description = null, $commande_id = null)
    {
        DB::transaction(function () use ($stock_id, $quantite, $source, $description, $commande_id) {
            $stock = Stock::findOrFail($stock_id);

            if ($stock->quantite_disponible < $quantite) {
                throw new \Exception("Stock insuffisant pour {$stock->nom}. Disponible: {$stock->quantite_disponible} {$stock->unite_mesure}");
            }

            // Diminution du stock
            $stock->decrement('quantite_disponible', $quantite);

            // Mouvement automatique
            Mouvement::create([
                'type_mouvement' => 'SORTIE',
                'quantite' => $quantite,
                'source' => $source,
                'description' => $description,
                'stock_id' => $stock->id,
                'commande_id' => $commande_id,
                'date_mouvement' => now()->toDateString(),
                'heure_mouvement' => now()->toTimeString(),
            ]);
        });
    }

    /**
     * Ajustement manuel du stock (pour corrections d'inventaire)
     */
    public function ajusterStock($stock_id, $nouvelle_quantite, $motif)
    {
        DB::transaction(function () use ($stock_id, $nouvelle_quantite, $motif) {
            $stock = Stock::findOrFail($stock_id);
            $ancienne_quantite = $stock->quantite_disponible;
            $difference = $nouvelle_quantite - $ancienne_quantite;

            // Mise à jour stock
            $stock->update(['quantite_disponible' => $nouvelle_quantite]);

            // Mouvement d'ajustement
            $type = $difference > 0 ? 'ENTREE' : 'SORTIE';
            Mouvement::create([
                'type_mouvement' => $type,
                'quantite' => abs($difference),
                'source' => 'Ajustement manuel',
                'description' => "Ajustement: {$motif}. Ancien: {$ancienne_quantite}, Nouveau: {$nouvelle_quantite}",
                'stock_id' => $stock->id,
                'date_mouvement' => now()->toDateString(),
                'heure_mouvement' => now()->toTimeString(),
            ]);
        });
    }
}
