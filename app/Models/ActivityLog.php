<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $table = 'activity_logs';

    protected $fillable = [
        'event',
        'ph',
        'ppm',
        'water_level',
        'status',
        'details',
    ];

    protected $casts = [
        'ph' => 'decimal:2',
    ];
}
