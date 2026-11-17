<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'field_id',
        'booking_date',
        'start_time',
        'duration',
        'end_time',
        'total_price',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'booking_date' => 'date',
            'duration' => 'integer',
            'total_price' => 'integer',
        ];
    }

    // Relasi ke pengguna
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke lapangan
    public function field(): BelongsTo
    {
        return $this->belongsTo(Field::class);
    }
}
