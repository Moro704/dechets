<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Stock extends Model
{
    use HasFactory;

    protected $table = 'stocks';

    protected $fillable = [
        'code_stock',
        'nom',
        'quantite_disponible',
        'prix_unitaire',
        'unite_mesure',
        'seuil_alerte',
        'produit_id',
        'commande_id',
    ];

    protected $casts = [
        'quantite_disponible' => 'decimal:2',
        'prix_unitaire' => 'decimal:2',
        'seuil_alerte' => 'decimal:2',
    ];

    /**
     * Relation avec le Produit
     */
    public function produit(): BelongsTo
    {
        return $this->belongsTo(Produit::class, 'produit_id');
    }

    /**
     * Relation avec les Mouvements
     */
    public function mouvements()
    {
        return $this->hasMany(Mouvement::class);
    }

    /**
     * Scope : Stocks en alerte (quantité basse)
     */
    public function scopeEnAlerte($query)
    {
        return $query->whereColumn('quantite_disponible', '<=', 'seuil_alerte');
    }

    /**
     * Accesseur : Valeur totale du stock (quantité × prix unitaire)
     */
    public function getValeurTotaleAttribute()
    {
        return $this->quantite_disponible * $this->prix_unitaire;
    }
}
