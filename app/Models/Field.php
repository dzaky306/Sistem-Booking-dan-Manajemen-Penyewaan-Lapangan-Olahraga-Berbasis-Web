<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    protected $fillable = [
        'name',
        'category',
        'location',
        'description',
        'image',
        'price_per_hour',
        'facilities',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'facilities' => 'array',
            'is_active' => 'boolean',
            'price_per_hour' => 'decimal:2',
        ];
    }
}