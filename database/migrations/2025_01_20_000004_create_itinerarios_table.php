<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItinerariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itinerarios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hoja_ruta_id');
            $table->date('fecha');
            $table->string('origen_destino');
            $table->time('hora_salida');
            $table->time('hora_llegada');
            $table->text('observaciones')->nullable();
            $table->foreign('hoja_ruta_id')->references('id')->on('hojas_ruta');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('itinerarios');
    }
}
