<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portafolio extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion',
        'categoria',
        'imagen',
        'url'
    ];

    use HasFactory;
}
