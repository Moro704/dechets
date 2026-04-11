<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Declaration extends Model
{
    protected $table = 'declarations';

    protected $fillable = [
        'type_dechet',
        'poids_estime',
        'photo',
        'description',
        'statut',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
