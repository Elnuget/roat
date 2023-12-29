<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    // Especifica los campos que pueden ser asignados masivamente
    protected $fillable = [
        'fecha',
        'numero_orden',
        'fact',
        'paciente_id',
        'examen_visual',
        'a_inventario_id', // Añadido según la nueva estructura
        'a_precio',
        'l_detalle',
        'l_medida',
        'l_precio',
        'd_inventario_id', // Añadido según la nueva estructura
        'd_precio',
        'total',
        'saldo'
        // Añade más campos según sea necesario
    ];

    // Define si tu modelo debe usar timestamps (created_at y updated_at)
    public $timestamps = true;

    // Definir la relación con el modelo Paciente
    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }

    // Relación con el modelo Inventario para 'a_inventario'
    public function aInventario()
    {
        return $this->belongsTo(Inventario::class, 'a_inventario_id');
    }

    // Relación con el modelo Inventario para 'd_inventario'
    public function dInventario()
    {
        return $this->belongsTo(Inventario::class, 'd_inventario_id');
    }
}
