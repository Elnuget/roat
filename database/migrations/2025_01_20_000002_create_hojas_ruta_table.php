<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHojasRutaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hojas_ruta', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('empresa_id');
            $table->unsignedBigInteger('conductor_id');
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->integer('kilometraje_inicio');
            $table->integer('kilometraje_llegada');
            $table->integer('kilometraje_total');
            $table->foreign('empresa_id')->references('id')->on('empresas');
            $table->foreign('conductor_id')->references('id')->on('conductores');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hojas_ruta');
    }
}
