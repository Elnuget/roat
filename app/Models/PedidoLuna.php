<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PedidoLuna extends Model
{
    protected $table = 'pedido_lunas';
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

    protected $casts = [
        'l_precio' => 'float',
        'l_precio_descuento' => 'float'
    ];
    
    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }
}
