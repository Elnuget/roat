<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            mediosdepagoSeeder::class,
            PacienteSeeder::class,
            InventarioSeeder::class,
            PedidoSeeder::class, // Añadir el seeder de pedidos
            
        ]);
    }
}