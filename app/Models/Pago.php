<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;

    protected $fillable = [
        'paciente_id',
        'mediodepago_id',
        'saldo',
        'anticipo'
    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }

    public function mediodepago()
    {
        return $this->belongsTo(mediosdepago::class);
    }
}
