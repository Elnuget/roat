<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToHistorialesClinicosTable extends Migration
{
    public function up()
    {
        Schema::table('historiales_clinicos', function (Blueprint $table) {
            $table->string('cedula', 50)->nullable();
            $table->string('ph_od', 50)->nullable();
            $table->string('ph_oi', 50)->nullable();
            $table->string('add', 50)->nullable();
            $table->text('cotizacion')->nullable();
            $table->unsignedBigInteger('usuario_id')->nullable();
            $table->foreign('usuario_id')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::table('historiales_clinicos', function (Blueprint $table) {
            $table->dropForeign(['usuario_id']);
            $table->dropColumn(['cedula', 'celular', 'ph_od', 'ph_oi', 'add', 'cotizacion', 'usuario_id']);
        });
    }
}