<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PedidoLuna extends Model
{
    protected $fillable = [
        'pedido_id',
        'l_medida',
        'l_detalle',
        'l_precio',
        'tipo_lente',
        'material',
        'filtro',
        'l_precio_descuento'
    ];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }
}
