<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = ['nome', 'dataCriacao','descricao'];

    protected $casts = [
        'created_at' => 'datetime:d-m-Y H:i:s',
        'updated_at' => 'datetime:d-m-Y H:i:s',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($projeto) {
            if (empty($projeto->dataCriacao)) {
                $projeto->dataCriacao = Carbon::now();
            }
        });
    }
}
