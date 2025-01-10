<?php

namespace App\Http\Controllers;

use App\Models\HistorialClinico;
use Illuminate\Http\Request;

class HistorialClinicoController extends Controller
{
    public function index()
    {
        $historiales = HistorialClinico::all();
        return view('historiales_clinicos.index', compact('historiales'));
    }

    public function create()
    {
        return view('historiales_clinicos.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'edad' => 'required|integer',
            'fecha_nacimiento' => 'required|date',
            'celular' => 'required|string|max:20',
            'ocupacion' => 'required|string|max:100',
            'fecha' => 'required|date',
            'motivo_consulta' => 'required|string|max:255',
            'enfermedad_actual' => 'nullable|string|max:255',
            'antecedentes_personales_oculares' => 'nullable|string',
            'antecedentes_personales_generales' => 'nullable|string',
            'antecedentes_familiares_oculares' => 'nullable|string',
            'antecedentes_familiares_generales' => 'nullable|string',
            'agudeza_visual_vl_sin_correccion_od' => 'nullable|string|max:50',
            'agudeza_visual_vl_sin_correccion_oi' => 'nullable|string|max:50',
            'agudeza_visual_vl_sin_correccion_ao' => 'nullable|string|max:50',
            'agudeza_visual_vp_sin_correccion_od' => 'nullable|string|max:50',
            'agudeza_visual_vp_sin_correccion_oi' => 'nullable|string|max:50',
            'agudeza_visual_vp_sin_correccion_ao' => 'nullable|string|max:50',
            'optotipo' => 'nullable|string',
            'lensometria_od' => 'nullable|string|max:50',
            'lensometria_oi' => 'nullable|string|max:50',
            'tipo_lente' => 'nullable|string|max:50',
            'material' => 'nullable|string|max:50',
            'filtro' => 'nullable|string|max:50',
            'tiempo_uso' => 'nullable|string|max:50',
            'refraccion_od' => 'nullable|string|max:50',
            'refraccion_oi' => 'nullable|string|max:50',
            'rx_final_dp' => 'nullable|string|max:50',
            'rx_final_av_vl' => 'nullable|string|max:50',
            'rx_final_av_vp' => 'nullable|string|max:50',
            'diagnostico' => 'nullable|string',
            'tratamiento' => 'nullable|string'
        ]);

        HistorialClinico::create($data);

        return redirect()->route('historiales_clinicos.index');
    }

    public function show(HistorialClinico $historialClinico)
    {
        return view('historiales_clinicos.show', compact('historialClinico'));
    }

    public function edit($id)
    {
        $historialClinico = HistorialClinico::findOrFail($id);
        return view('historiales_clinicos.edit', compact('historialClinico'));
    }

    public function update(Request $request, $id)
    {
        $historialClinico = HistorialClinico::findOrFail($id);
        $data = $request->validate([
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'edad' => 'required|integer',
            'fecha_nacimiento' => 'required|date',
            'celular' => 'required|string|max:20',
            'ocupacion' => 'required|string|max:100',
            'fecha' => 'required|date',
            'motivo_consulta' => 'required|string|max:255',
            'enfermedad_actual' => 'nullable|string|max:255',
            'antecedentes_personales_oculares' => 'nullable|string',
            'antecedentes_personales_generales' => 'nullable|string',
            'antecedentes_familiares_oculares' => 'nullable|string',
            'antecedentes_familiares_generales' => 'nullable|string',
            'agudeza_visual_vl_sin_correccion_od' => 'nullable|string|max:50',
            'agudeza_visual_vl_sin_correccion_oi' => 'nullable|string|max:50',
            'agudeza_visual_vl_sin_correccion_ao' => 'nullable|string|max:50',
            'agudeza_visual_vp_sin_correccion_od' => 'nullable|string|max:50',
            'agudeza_visual_vp_sin_correccion_oi' => 'nullable|string|max:50',
            'agudeza_visual_vp_sin_correccion_ao' => 'nullable|string|max:50',
            'optotipo' => 'nullable|string',
            'lensometria_od' => 'nullable|string|max:50',
            'lensometria_oi' => 'nullable|string|max:50',
            'tipo_lente' => 'nullable|string|max:50',
            'material' => 'nullable|string|max:50',
            'filtro' => 'nullable|string|max:50',
            'tiempo_uso' => 'nullable|string|max:50',
            'refraccion_od' => 'nullable|string|max:50',
            'refraccion_oi' => 'nullable|string|max:50',
            'rx_final_dp' => 'nullable|string|max:50',
            'rx_final_av_vl' => 'nullable|string|max:50',
            'rx_final_av_vp' => 'nullable|string|max:50',
            'diagnostico' => 'nullable|string',
            'tratamiento' => 'nullable|string'
        ]);

        $historialClinico->update($data);

        return redirect()->route('historiales_clinicos.index');
    }

    public function destroy(HistorialClinico $historialClinico)
    {
        $historialClinico->delete();

        return redirect()->route('historiales_clinicos.index');
    }
}
