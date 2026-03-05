<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Papa extends Model
{
    use HasFactory;
    
    protected $keyType = 'string'; // Correcto para UUID
    public $incrementing = false;  // Correcto para UUID

    // Añade esto para asegurar que Postgres no intente tratarlo como número
    protected $casts = [
        'id' => 'string',
    ];

    protected static function booted()
    {
        static::creating(function ($papa) {
            $papa->id = (string) Str::uuid(); // Genera el UUID automáticamente
        });
    }

    protected $fillable = [
        'nombre_comun',
        'nombre_cientifico',
        'origen',
        'color_piel',
        'color_pulpa',
        'forma',
    ];
}