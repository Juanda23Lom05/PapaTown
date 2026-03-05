<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Papa extends Model
{
    use HasFactory;
    
    public const DEFAULT_CIENTIFICO = 'Solanum tuberosum';
    public const DEFAULT_ORIGEN = 'Andes';
    public const NO_DATA = 'N/A';
    public const MAX_NOMBRE_LENGTH = 30;

    protected $keyType = 'string';
    public $incrementing = false;  

    protected $casts = [
        'id' => 'string',
    ];

    protected static function booted()
    {
        static::creating(function ($papa) {
            if (empty($papa->id)) {
                $papa->id = (string) Str::uuid(); 
            }
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