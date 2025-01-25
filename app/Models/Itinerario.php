<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Itinerario extends Model
{
    use HasFactory;

    protected $table = 'itinerarios';

    protected $fillable = [
        'hoja_ruta_id',
        'fecha',
        'origen_destino',
        'hora_salida',
        'hora_llegada',
        'observaciones',
    ];

    public $timestamps = false;

    // ...existing code...
}
