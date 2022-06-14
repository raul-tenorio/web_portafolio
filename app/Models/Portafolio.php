<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Portafolio extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'nombre',
        'descripcion',
        'categoria',
        'imagen',
        'url'
    ];



    public function getUrl()
    {
        return Storage::disk('dropbox')->url($this->imagen);
    }



    
}