<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pagonuevo extends Model
{
    use HasFactory;
    protected $fillable = [
        'pedido_id',
        'mediodepago_id',
      
        'pago'
    ];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }

    public function mediodepago()
    {
        return $this->belongsTo(mediosdepago::class);
    }
}
