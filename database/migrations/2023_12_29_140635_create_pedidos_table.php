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
            $table->date('fecha')->nullable();
            $table->integer('numero_orden')->nullable();
            $table->string('fact')->nullable();
            $table->decimal('examen_visual', 8, 2)->nullable();

            // Nuevos campos
            $table->string('tipo_lente')->nullable();
            $table->string('material')->nullable();
            $table->string('filtro')->nullable();

            // Add new fields
            $table->string('cliente')->nullable();
            $table->string('celular')->nullable();
            $table->string('correo_electronico')->nullable();

            // Claves foráneas para los items del inventario
            $table->unsignedBigInteger('a_inventario_id')->nullable();
            $table->foreign('a_inventario_id')->references('id')->on('inventarios');
            $table->decimal('a_precio', 8, 2)->nullable();

            $table->string('l_medida')->nullable();
            $table->string('l_detalle')->nullable();
            $table->decimal('l_precio', 8, 2)->nullable();


            $table->unsignedBigInteger('d_inventario_id')->nullable();
            $table->foreign('d_inventario_id')->references('id')->on('inventarios');
            $table->decimal('d_precio', 8, 2)->nullable();

            $table->decimal('total', 8, 2)->nullable();
            $table->decimal('saldo', 8, 2)->nullable();
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
