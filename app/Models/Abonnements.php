<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Abonnements extends Model
{
    protected $fillable = [
        'type_abonnement',
        'montant',           // ← Ajouté
        'date_debut',
        'date_fin',
        'statut',
    ];

    protected $casts = [
        'date_debut' => 'date',
        'date_fin'   => 'date',
        'montant'    => 'decimal:2',   // ← Ajouté
    ];
}