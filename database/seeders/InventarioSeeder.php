<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Inventario;

class InventarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Inventario::create([
            'fecha' => '2025-01-01',
            'lugar' => 'Almacen A',
            'numero_lugar' => 1,
            'fila' => 1,
            'numero' => 101,
            'codigo' => 'A101',
            'valor' => 100.50,
            'cantidad' => 10,
            'orden' => 1
        ]);

        Inventario::create([
            'fecha' => '2025-01-02',
            'lugar' => 'Almacen B',
            'numero_lugar' => 2,
            'fila' => 2,
            'numero' => 202,
            'codigo' => 'B202',
            'valor' => 200.75,
            'cantidad' => 20,
            'orden' => 2
        ]);

        Inventario::create([
            'fecha' => '2025-01-03',
            'lugar' => 'Almacen C',
            'numero_lugar' => 3,
            'fila' => 3,
            'numero' => 303,
            'codigo' => 'C303',
            'valor' => 300.25,
            'cantidad' => 30,
            'orden' => 3
        ]);
    }
}
