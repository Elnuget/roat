<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistorialesClinicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historiales_clinicos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('paciente_id');
            $table->foreign('paciente_id')->references('id')->on('pacientes')->onDelete('cascade');
            $table->date('fecha');
            $table->string('motivo_consulta', 255);
            $table->string('enfermedad_actual', 255)->nullable();
            $table->text('antecedentes_personales_oculares')->nullable();
            $table->text('antecedentes_personales_generales')->nullable();
            $table->text('antecedentes_familiares_oculares')->nullable();
            $table->text('antecedentes_familiares_generales')->nullable();
            $table->string('agudeza_visual_vl_sin_correccion_od', 50)->nullable();
            $table->string('agudeza_visual_vl_sin_correccion_oi', 50)->nullable();
            $table->string('agudeza_visual_vl_sin_correccion_ao', 50)->nullable();
            $table->string('agudeza_visual_vp_sin_correccion_od', 50)->nullable();
            $table->string('agudeza_visual_vp_sin_correccion_oi', 50)->nullable();
            $table->string('agudeza_visual_vp_sin_correccion_ao', 50)->nullable();
            $table->text('optotipo')->nullable();
            $table->string('lensometria_od', 50)->nullable();
            $table->string('lensometria_oi', 50)->nullable();
            $table->string('tipo_lente', 50)->nullable();
            $table->string('material', 50)->nullable();
            $table->string('filtro', 50)->nullable();
            $table->string('tiempo_uso', 50)->nullable();
            $table->string('refraccion_od', 50)->nullable();
            $table->string('refraccion_oi', 50)->nullable();
            $table->string('rx_final_dp', 50)->nullable();
            $table->string('rx_final_av_vl', 50)->nullable();
            $table->string('rx_final_av_vp', 50)->nullable();
            $table->text('diagnostico')->nullable();
            $table->text('tratamiento')->nullable();
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
        Schema::dropIfExists('historiales_clinicos');
    }
}
