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
        'numero_lugar',
        'fila',
        'numero',
        'codigo',
        'valor',
        'cantidad',
        'orden'
    ];

    public $timestamps = true;

   
}
