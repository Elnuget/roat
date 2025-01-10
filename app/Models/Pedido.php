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
        'examen_visual',
        'cliente',
        'celular',
        'correo_electronico',
        'a_inventario_id',
        'a_precio',
        'l_detalle',
        'l_medida',
        'l_precio',
        'd_inventario_id',
        'd_precio',
        'total',
        'saldo',
        // Nuevos campos
        'tipo_lente',
        'material',
        'filtro',
        'valor_compra',
        'motivo_compra'
    ];

    protected $dates = [
        'fecha',
        // ...other date fields...
    ];

    // Define si tu modelo debe usar timestamps (created_at y updated_at)
    public $timestamps = true;

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
