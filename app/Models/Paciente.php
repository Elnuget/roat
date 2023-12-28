<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model // Recuerda que el nombre de la clase debe comenzar con mayúscula
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'fecha_nacimiento',
        'telefono',
        'email',
        // Añade todos los campos que necesites
    ];

    // Si tienes campos adicionales en tu tabla pacientes, agrégalos al array $fillable
}