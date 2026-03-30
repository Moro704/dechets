<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Agents extends Model
{
    use HasFactory;

    protected $table = 'agents';

    protected $fillable = [
        'matricul',
        'qualification',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
