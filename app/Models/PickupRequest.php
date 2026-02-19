<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PickupRequest extends Model
{
    protected $fillable = [
        'user_id', 'category', 'category_label', 'estimated_weight_kg', 'actual_weight_kg',
        'estimated_price', 'final_price', 'lat', 'lng', 'address', 'scheduled_at',
        'status', 'admin_verified_at', 'verified_by',
    ];

    protected function casts(): array
    {
        return [
            'estimated_weight_kg' => 'decimal:2',
            'actual_weight_kg' => 'decimal:2',
            'estimated_price' => 'decimal:2',
            'final_price' => 'decimal:2',
            'lat' => 'decimal:8',
            'lng' => 'decimal:8',
            'scheduled_at' => 'datetime',
            'admin_verified_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function verifiedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'verified_by');
    }
}
