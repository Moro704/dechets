<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesage extends Model
{
    use HasFactory;

    protected $table = 'pesage';

    protected $fillable = [
        'poids_total',
        'date_pesage',
    ];
    public function tries()
{
    return $this->hasMany(Trie::class, 'pesage_id');   // ou hasOne si c'est 1:1
}
}
