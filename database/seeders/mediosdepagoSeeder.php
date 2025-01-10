<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\mediosdepago;
use Illuminate\Support\Facades\DB;

class mediosdepagoSeeder extends Seeder
{
    public function run()
    {
        $mediosPago = [
            ['id' => 1, 'medio_de_pago' => 'Efectivo'],
            ['id' => 2, 'medio_de_pago' => 'Transferencia'],
            ['id' => 3, 'medio_de_pago' => 'Tarjeta Débito'],
            ['id' => 4, 'medio_de_pago' => 'Tarjeta Crédito'],
            ['id' => 5, 'medio_de_pago' => 'Tarjeta Banco'],
            ['id' => 6, 'medio_de_pago' => 'Transferencia Pichincha'],
            ['id' => 7, 'medio_de_pago' => 'Transferencia Guayaquil'],
            ['id' => 8, 'medio_de_pago' => 'Transferencia De Una'],
        ];

        foreach ($mediosPago as $medio) {
            DB::table('mediosdepagos')->insert([
                'id' => $medio['id'],
                'medio_de_pago' => $medio['medio_de_pago'],
                "created_at" =>  \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
            ]);
        }
    }
}
