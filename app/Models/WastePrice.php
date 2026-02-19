<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WastePrice extends Model
{
    protected $fillable = ['category', 'name', 'price_per_kg'];

    protected function casts(): array
    {
        return ['price_per_kg' => 'decimal:2'];
    }
}
