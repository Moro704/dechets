<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Planification extends Model
{
    protected $table = 'planifications';

    protected $fillable = [
        'code_planification',
        'nom_tournee',
        'jour_semaine',
        'date_prevue',
        'periode',
        'type_collecte',
        'statut',
        'zone_id',
        'collecteur_id',
        'declaration_id',
    ];

    public function zone()
    {
        return $this->belongsTo(Zone::class);
    }

    public function collecteur()
    {
        return $this->belongsTo(Collecteur::class);
    }

    public function declaration()
    {
        return $this->belongsTo(Declaration::class);
    }

    // === RELATIONS ===
    public function collecte()
    {
        return $this->hasOne(Collectes::class);   // une planification = une collecte réelle
    }

    // === SCOPES (très utile) ===
    public function scopeEffectuees($query)
    {
        return $query->whereHas('collecte', function ($q) {
            $q->whereIn('statut', ['Effectuée', 'Triée']);
        });
    }

    public function scopeNonEffectuees($query)
    {
        return $query->whereDoesntHave('collecte')
            ->orWhere('statut', 'Planifiée');
    }

    // === CONSTANTES (propre et évite les fautes de frappe) ===
    const STATUTS = [
        'Planifiée' => 'Planifiée',
        'En cours' => 'En cours',
        'Effectuée' => 'Effectuée',
        'Triée' => 'Triée',
    ];
}
