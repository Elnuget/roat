<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasajero extends Model
{
    use HasFactory;

    protected $table = 'pasajeros';

    protected $fillable = [
        'nombre',
        'cedula',
        'proyecto',
        'hoja_ruta_id',
    ];

    public $timestamps = false;

    // ...existing code...
}
