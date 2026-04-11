<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Collectes extends Model
{
    protected $table = 'collectes';

    protected $fillable = [
        'type_collecte',
        'photo',
        'statut',
        'planification_id',
    ];

    public function planification()
    {
        return $this->belongsTo(Planification::class);
    }

    // Relation vers Pesage (un pesage par collecte)
    public function pesage()
    {
        return $this->hasOne(Pesage::class, 'id_collecte');
    }
}
