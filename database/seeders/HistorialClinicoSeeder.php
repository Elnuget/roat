<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HistorialClinico;
use App\Models\Paciente;

class HistorialClinicoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $paciente = Paciente::where('nombre', 'Juan Perez')->first();

        HistorialClinico::create([
            'paciente_id' => $paciente->id,
            'fecha' => '2025-01-10',
            'motivo_consulta' => 'Dolor de cabeza',
            'enfermedad_actual' => 'Migraña',
            'antecedentes_personales_oculares' => 'Miopía',
            'antecedentes_personales_generales' => 'Hipertensión',
            'antecedentes_familiares_oculares' => 'Glaucoma',
            'antecedentes_familiares_generales' => 'Diabetes',
            'agudeza_visual_vl_sin_correccion_od' => '20/20',
            'agudeza_visual_vl_sin_correccion_oi' => '20/25',
            'agudeza_visual_vl_sin_correccion_ao' => '20/20',
            'agudeza_visual_vp_sin_correccion_od' => '20/30',
            'agudeza_visual_vp_sin_correccion_oi' => '20/40',
            'agudeza_visual_vp_sin_correccion_ao' => '20/30',
            'optotipo' => 'Snellen',
            'lensometria_od' => '-1.00',
            'lensometria_oi' => '-1.25',
            'tipo_lente' => 'Monofocal',
            'material' => 'Policarbonato',
            'filtro' => 'UV',
            'tiempo_uso' => 'Todo el día',
            'refraccion_od' => '-1.00',
            'refraccion_oi' => '-1.25',
            'rx_final_dp' => '63',
            'rx_final_av_vl' => '20/20',
            'rx_final_av_vp' => '20/30',
            'diagnostico' => 'Miopía',
            'tratamiento' => 'Uso de lentes'
        ]);

        HistorialClinico::create([
            'paciente_id' => $paciente->id,
            'fecha' => '2025-02-15',
            'motivo_consulta' => 'Visión borrosa',
            'enfermedad_actual' => 'Astigmatismo',
            'antecedentes_personales_oculares' => 'Astigmatismo',
            'antecedentes_personales_generales' => 'Ninguno',
            'antecedentes_familiares_oculares' => 'Cataratas',
            'antecedentes_familiares_generales' => 'Hipertensión',
            'agudeza_visual_vl_sin_correccion_od' => '20/30',
            'agudeza_visual_vl_sin_correccion_oi' => '20/40',
            'agudeza_visual_vl_sin_correccion_ao' => '20/30',
            'agudeza_visual_vp_sin_correccion_od' => '20/50',
            'agudeza_visual_vp_sin_correccion_oi' => '20/60',
            'agudeza_visual_vp_sin_correccion_ao' => '20/50',
            'optotipo' => 'Snellen',
            'lensometria_od' => '-0.75',
            'lensometria_oi' => '-1.00',
            'tipo_lente' => 'Bifocal',
            'material' => 'Cristal',
            'filtro' => 'Azul',
            'tiempo_uso' => 'Para lectura',
            'refraccion_od' => '-0.75',
            'refraccion_oi' => '-1.00',
            'rx_final_dp' => '64',
            'rx_final_av_vl' => '20/30',
            'rx_final_av_vp' => '20/50',
            'diagnostico' => 'Astigmatismo',
            'tratamiento' => 'Uso de lentes bifocales'
        ]);
    }
}
