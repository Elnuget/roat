<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class HistorialesClinicosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('historiales_clinicos')->insert([
            'nombres' => 'Juan',
            'apellidos' => 'Perez',
            'edad' => 30,
            'fecha_nacimiento' => '1995-01-01',
            'celular' => '1234567890',
            'ocupacion' => 'Ingeniero',
            'fecha' => now(),
            'motivo_consulta' => 'Dolor de cabeza',
            'enfermedad_actual' => 'Migraña',
            'antecedentes_personales_oculares' => 'Ninguno',
            'antecedentes_personales_generales' => 'Hipertensión',
            'antecedentes_familiares_oculares' => 'Miopía',
            'antecedentes_familiares_generales' => 'Diabetes',
            'agudeza_visual_vl_sin_correccion_od' => '20/20',
            'agudeza_visual_vl_sin_correccion_oi' => '20/20',
            'agudeza_visual_vl_sin_correccion_ao' => '20/20',
            'agudeza_visual_vp_sin_correccion_od' => '20/20',
            'agudeza_visual_vp_sin_correccion_oi' => '20/20',
            'agudeza_visual_vp_sin_correccion_ao' => '20/20',
            'optotipo' => 'Snellen',
            'lensometria_od' => 'Plano',
            'lensometria_oi' => 'Plano',
            'tipo_lente' => 'Monofocal',
            'material' => 'Policarbonato',
            'filtro' => 'UV',
            'tiempo_uso' => 'Todo el día',
            'refraccion_od' => 'Plano',
            'refraccion_oi' => 'Plano',
            'rx_final_dp' => '63',
            'rx_final_av_vl' => '20/20',
            'rx_final_av_vp' => '20/20',
            'diagnostico' => 'Miopía leve',
            'tratamiento' => 'Uso de lentes',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
