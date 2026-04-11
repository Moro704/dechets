<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Trie extends Model
{
    use HasFactory;

    protected $table = 'tries';

    protected $fillable = [
        'type_dechet',
        'quantite_trier',     // nom cohérent avec la migration
        'unite',
        'pesage_id',          // important à mettre dans fillable

    ];

    /**
     * Casts pour les types de données
     */
    protected $casts = [
        'quantite_trier' => 'decimal:2',
        // si tu ajoutes cette colonne plus tard
    ];

    /**
     * Relation avec Pesage
     * Un tri appartient à un pesage
     */
    public function pesage(): BelongsTo
    {
        return $this->belongsTo(Pesage::class);
    }

    /**
     * Relation avec Production (optionnel selon ton diagramme)
     * Un tri peut donner plusieurs productions
     */

    /**
     * Accesseur exemple : Afficher quantité + unité
     */
}
