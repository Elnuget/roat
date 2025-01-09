<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Paciente;

class PacienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Paciente::create([
            'nombre' => 'Juan Perez',
            'telefono' => '123456789',
            'fecha_nacimiento' => '1980-01-01',
            'email' => 'juan.perez@example.com'
        ]);

        Paciente::create([
            'nombre' => 'Maria Lopez',
            'telefono' => '987654321',
            'fecha_nacimiento' => '1990-02-02',
            'email' => 'maria.lopez@example.com'
        ]);

        Paciente::create([
            'nombre' => 'Carlos Sanchez',
            'telefono' => '555555555',
            'fecha_nacimiento' => '2000-03-03',
            'email' => 'carlos.sanchez@example.com'
        ]);
    }
}
