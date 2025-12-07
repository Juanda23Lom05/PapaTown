<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Papa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre_comun',
        'nombre_cientifico',
        'origen',
        'color_piel',
        'color_pulpa',
        'forma',
    ];

    
}
