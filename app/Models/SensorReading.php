<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SensorReading extends Model
{
    protected $table = 'sensor_readings';

    protected $fillable = [
        'ph',
        'ppm',
        'water_level',
        'temperature',
        'humidity',
        'pump_status',
        'last_pump_activation',
    ];

    protected $casts = [
        'ph' => 'decimal:2',
        'temperature' => 'decimal:1',
        'humidity' => 'decimal:1',
        'last_pump_activation' => 'datetime',
    ];
}
