<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Climate extends Model
{
    use HasFactory;

    protected $fillable = [
        'horario',
        'temp_ar_ecmwf',
        'temp_ar_noaa',
        'temp_ar_sg',
    ];

    protected $casts = [
        'horario' => 'datetime',
    ];
}
