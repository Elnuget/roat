<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->integer('numero_orden');
            $table->string('fact');
            $table->decimal('examen_visual', 8, 2);

            // Add new fields
            $table->string('cliente');
            $table->string('celular');
            $table->string('correo_electronico');

            // Claves foráneas para los items del inventario
            $table->unsignedBigInteger('a_inventario_id');
            $table->foreign('a_inventario_id')->references('id')->on('inventarios');
            $table->decimal('a_precio', 8, 2);

            $table->string('l_medida');
            $table->string('l_detalle');
            $table->decimal('l_precio', 8, 2);


            $table->unsignedBigInteger('d_inventario_id');
            $table->foreign('d_inventario_id')->references('id')->on('inventarios');
            $table->decimal('d_precio', 8, 2);

            $table->decimal('total', 8, 2);
            $table->decimal('saldo', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pedidos');
    }
}
