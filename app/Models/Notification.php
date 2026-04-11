<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'type',
        'message',
        'icon',
        'data',
        'is_read',
    ];

    protected $casts = [
        'data' => 'array',
        'is_read' => 'boolean',
    ];

    public static function record(string $type, string $message, string $icon = '🔔', array $data = []): self
    {
        return static::create([
            'type' => $type,
            'message' => $message,
            'icon' => $icon,
            'data' => $data,
            'is_read' => false,
        ]);
    }
}
