<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Papa extends Model
{
    use HasFactory;
    
    protected $keyType = 'string';
    public $incrementing = false;

    protected static function booted()
    {
        static::creating(function ($papa) {
            $papa->id = (string) Str::uuid();
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
