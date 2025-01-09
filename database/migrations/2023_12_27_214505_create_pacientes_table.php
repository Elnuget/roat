<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePacientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id();
            // Agregar campos personalizados
            $table->string('nombre'); // Campo para el nombre
            $table->string('telefono'); // Campo para el teléfono
            $table->date('fecha_nacimiento'); // Campo para la fecha de nacimiento
            $table->string('email'); // Campo para el email
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
        Schema::dropIfExists('pacientes');
    }
}
