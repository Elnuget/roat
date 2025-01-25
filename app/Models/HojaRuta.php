<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HojaRuta extends Model
{
    use HasFactory;

    protected $table = 'hojas_ruta';

    protected $fillable = [
        'empresa_id',
        'conductor_id',
        'fecha_inicio',
        'fecha_fin',
        'kilometraje_inicio',
        'kilometraje_llegada',
        'kilometraje_total',
    ];

    public $timestamps = false;

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function conductor()
    {
        return $this->belongsTo(Conductor::class);
    }

    public function pasajeros()
    {
        return $this->hasMany(Pasajero::class);
    }

    public function itinerarios()
    {
        return $this->hasMany(Itinerario::class);
    }

    // ...existing code...
}
