<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pedido;
use App\Models\Paciente;
use App\Models\Inventario;

class PedidoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $paciente1 = Paciente::where('nombre', 'Juan Perez')->first();
        $paciente2 = Paciente::where('nombre', 'Maria Lopez')->first();
        $paciente3 = Paciente::where('nombre', 'Carlos Sanchez')->first();

        $inventario1 = Inventario::where('codigo', 'A101')->first();
        $inventario2 = Inventario::where('codigo', 'B202')->first();
        $inventario3 = Inventario::where('codigo', 'C303')->first();

        Pedido::create([
            'fecha' => '2025-01-10',
            'numero_orden' => 1,
            'fact' => 'F001',
            'paciente_id' => $paciente1->id,
            'examen_visual' => 50.00,
            'a_inventario_id' => $inventario1->id,
            'a_precio' => 100.50,
            'l_medida' => 'Medida A',
            'l_detalle' => 'Detalle A',
            'l_precio' => 150.00,
            'd_inventario_id' => $inventario2->id,
            'd_precio' => 200.75,
            'total' => 501.25,
            'saldo' => 100.00,
        ]);

        Pedido::create([
            'fecha' => '2025-01-11',
            'numero_orden' => 2,
            'fact' => 'F002',
            'paciente_id' => $paciente2->id,
            'examen_visual' => 60.00,
            'a_inventario_id' => $inventario2->id,
            'a_precio' => 200.75,
            'l_medida' => 'Medida B',
            'l_detalle' => 'Detalle B',
            'l_precio' => 250.00,
            'd_inventario_id' => $inventario3->id,
            'd_precio' => 300.25,
            'total' => 811.00,
            'saldo' => 200.00,
        ]);

        Pedido::create([
            'fecha' => '2025-01-12',
            'numero_orden' => 3,
            'fact' => 'F003',
            'paciente_id' => $paciente3->id,
            'examen_visual' => 70.00,
            'a_inventario_id' => $inventario3->id,
            'a_precio' => 300.25,
            'l_medida' => 'Medida C',
            'l_detalle' => 'Detalle C',
            'l_precio' => 350.00,
            'd_inventario_id' => $inventario1->id,
            'd_precio' => 100.50,
            'total' => 820.75,
            'saldo' => 300.00,
        ]);
    }
}
