<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;

    protected $table = 'pagos'; // Ensure the model uses the 'pagos' table

    protected $fillable = [
        'pedido_id',
        'mediodepago_id',
        'pago'
    ];

    public function mediodepago()
    {
        return $this->belongsTo(mediosdepago::class);
    }

    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }
}
