<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesage extends Model
{
    protected $table = 'pesages';

    protected $fillable = [
        'id_collecte',
        'poids',
        'unite',
        'description',
        'statut',
    ];

    // Relation inverse vers Collectes
    public function collecte()
    {
        return $this->belongsTo(Collectes::class, 'id_collecte');
    }
}
