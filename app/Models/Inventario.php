<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    use HasFactory;

   
    protected $fillable =[
        'id',
        'fecha',
        'lugar',
        // 'numero_lugar', // removed
        'columna', // renamed from fila
        'numero',
        'codigo',
        'valor',
        'cantidad',
        'orden'
    ];

    public $timestamps = true;

    // Relación con el modelo Pedido para 'a_inventario'
    public function pedidosA()
    {
        return $this->hasMany(Pedido::class, 'a_inventario_id');
    }

    // Relación con el modelo Pedido para 'd_inventario'
    public function pedidosD()
    {
        return $this->hasMany(Pedido::class, 'd_inventario_id');
    }
}
