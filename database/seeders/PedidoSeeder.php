<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pedido;
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
        $inventario1 = Inventario::where('codigo', 'A101')->first();
        $inventario2 = Inventario::where('codigo', 'B202')->first();
        $inventario3 = Inventario::where('codigo', 'C303')->first();

        Pedido::create([
            'fecha' => '2025-01-10',
            'numero_orden' => 1,
            'fact' => 'F001',
            'examen_visual' => 50.00,
            'cliente' => 'Juan Perez',
            'celular' => '1234567890',
            'correo_electronico' => 'juan.perez@example.com',
            'a_inventario_id' => $inventario1->id,
            'a_precio' => 100.50,
            'l_medida' => 'Medida A',
            'l_detalle' => 'Detalle A',
            'l_precio' => 150.00,
            'd_inventario_id' => $inventario2->id,
            'd_precio' => 200.75,
            // Nuevos campos
            'tipo_lente' => 'Tipo A',
            'material' => 'Material A',
            'filtro' => 'Filtro A',
            'total' => 501.25,
            'saldo' => 100.00,
        ]);

        Pedido::create([
            'fecha' => '2025-01-11',
            'numero_orden' => 2,
            'fact' => 'F002',
            'examen_visual' => 60.00,
            'cliente' => 'Maria Lopez',
            'celular' => '0987654321',
            'correo_electronico' => 'maria.lopez@example.com',
            'a_inventario_id' => $inventario2->id,
            'a_precio' => 200.75,
            'l_medida' => 'Medida B',
            'l_detalle' => 'Detalle B',
            'l_precio' => 250.00,
            'd_inventario_id' => $inventario3->id,
            'd_precio' => 300.25,
            // Nuevos campos
            'tipo_lente' => 'Tipo B',
            'material' => 'Material B',
            'filtro' => 'Filtro B',
            'total' => 811.00,
            'saldo' => 200.00,
        ]);

        Pedido::create([
            'fecha' => '2025-01-12',
            'numero_orden' => 3,
            'fact' => 'F003',
            'examen_visual' => 70.00,
            'cliente' => 'Carlos Sanchez',
            'celular' => '1122334455',
            'correo_electronico' => 'carlos.sanchez@example.com',
            'a_inventario_id' => $inventario3->id,
            'a_precio' => 300.25,
            'l_medida' => 'Medida C',
            'l_detalle' => 'Detalle C',
            'l_precio' => 350.00,
            'd_inventario_id' => $inventario1->id,
            'd_precio' => 100.50,
            // Nuevos campos
            'tipo_lente' => 'Tipo C',
            'material' => 'Material C',
            'filtro' => 'Filtro C',
            'total' => 820.75,
            'saldo' => 300.00,
        ]);
    }
}
