<?php

namespace App\Models;

use Illuminate\Support\Facades\Storage;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class User extends Eloquent
{
    protected $collection = 'usuarios';
    protected $connection = 'mongodb';

    protected $fillable = [
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'curp',
        'rfid',
        'rol',
        'correo_electronico',
        'contrasena_hash',
        'departamento',
        'imagen'
    ];

    protected $casts = [
        'rol' => 'string',
    ];

    // Accesor para obtener la URL completa de la imagen
    public function getImagenAttribute($value)
    {
        // Verifica que el valor no sea nulo y que sea una cadena
        return $value ? Storage::url($value) : null;
    }

}
