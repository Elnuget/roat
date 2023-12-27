<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventarios', function (Blueprint $table) {
            $table->id();
            $table->date('fecha'); // para la fecha
            $table->string('lugar'); // para el lugar, asumiendo que es una cadena de texto
            $table->integer('numero_lugar'); 
            $table->integer('fila'); // para la fila, asumiendo que es un número entero
            $table->integer('numero'); // para el número, asumiendo que es un número entero
            $table->string('codigo'); // para el código, asumiendo que es una cadena de texto
            $table->decimal('valor', 8, 2)->nullable();
            $table->integer('cantidad'); // para la cantidad, asumiendo que es un número entero
            $table->integer('orden')->nullable(); // para el orden, asumiendo que es un número entero
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
        Schema::dropIfExists('inventarios');
    }
}
