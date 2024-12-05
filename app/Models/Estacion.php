<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Estacion extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'estaciones';  // Nombre de la colección en MongoDB
    protected $fillable = [
        'nombre',
        'sensores',
        'usuarios',
        'sensores'
    ];
}

