<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pago;
use App\Models\Pedido;

class PagoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pedido1 = Pedido::where('numero_orden', 1)->first();
        $pedido2 = Pedido::where('numero_orden', 2)->first();
        $pedido3 = Pedido::where('numero_orden', 3)->first();

        Pago::create([
            'fecha' => '2025-01-15',
            'pedido_id' => $pedido1->id,
            'monto' => 100.00,
            'metodo_pago' => 'Tarjeta de Crédito',
        ]);

        Pago::create([
            'fecha' => '2025-01-16',
            'pedido_id' => $pedido2->id,
            'monto' => 200.00,
            'metodo_pago' => 'Efectivo',
        ]);

        Pago::create([
            'fecha' => '2025-01-17',
            'pedido_id' => $pedido3->id,
            'monto' => 300.00,
            'metodo_pago' => 'Transferencia Bancaria',
        ]);
    }
}
