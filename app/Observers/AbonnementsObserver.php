<?php

namespace App\Observers;

use App\Models\Abonnements;
use App\Models\Paiement;

class AbonnementsObserver
{
    /**
     * Créer automatiquement un paiement quand un abonnement est créé
     */
    public function created(Abonnements $abonnement): void
    {
        // Protection au cas où le montant est null
        $montant = $abonnement->montant ?? 0;

        Paiement::create([
            'type_paiement'      => 'abonnement',                    // ← Utilisation de ta colonne existante
            'abonnement_id'      => $abonnement->id,
            'commande_id'        => null,
            'mode_paiement'      => 'mobile_money',                  // Tu peux changer plus tard
            'montant'            => $montant,
            'statut'             => 'valide',                        // ou 'en_attente' si tu veux
            'reference_paiement' => 'ABO-' . strtoupper(uniqid()),
        ]);
    }
}