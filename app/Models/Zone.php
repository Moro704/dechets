<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'description',
        'ville',
    ];

    public function planifications()
    {
        return $this->hasMany(Planification::class);
    }

    public function collecteurs()
    {
        return $this->hasMany(Collecteur::class);
    }
}
