<?php

namespace App\Http\Controllers;

use App\Models\HistorialClinico;
use Illuminate\Http\Request;

class HistorialClinicoController extends Controller
{
    public function index()
    {
        // Cargar la relación 'usuario' junto con los historiales clínicos
        $historiales = HistorialClinico::with('usuario')->get();
        return view('historiales_clinicos.index', compact('historiales'));
    }

    public function create()
    {
        return view('historiales_clinicos.create');
    }

    protected function validationRules()
    {
        return [
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'edad' => 'required|integer',
            'fecha_nacimiento' => 'nullable|date',  // Cambiado a nullable
            'cedula' => 'nullable|string|max:50',   // Cambiado a nullable
            'celular' => 'required|string|max:20',
            'ocupacion' => 'required|string|max:100',
            'fecha' => 'required|date',
            'motivo_consulta' => 'required|string|max:255',
            'enfermedad_actual' => 'required|string|max:255',
            'antecedentes_personales_oculares' => 'required|string',
            'antecedentes_personales_generales' => 'required|string',
            'antecedentes_familiares_oculares' => 'required|string',
            'antecedentes_familiares_generales' => 'required|string',
            'agudeza_visual_vl_sin_correccion_od' => 'required|string|max:50',
            'agudeza_visual_vl_sin_correccion_oi' => 'required|string|max:50',
            'agudeza_visual_vl_sin_correccion_ao' => 'required|string|max:50',
            'agudeza_visual_vp_sin_correccion_od' => 'required|string|max:50',
            'agudeza_visual_vp_sin_correccion_oi' => 'required|string|max:50',
            'agudeza_visual_vp_sin_correccion_ao' => 'required|string|max:50',
            'optotipo' => 'nullable|string',        // Cambiado a nullable
            'lensometria_od' => 'nullable|string|max:50',     // Cambiado a nullable
            'lensometria_oi' => 'nullable|string|max:50',     // Cambiado a nullable
            'tipo_lente' => 'nullable|string|max:50',         // Cambiado a nullable
            'material' => 'nullable|string|max:50',           // Cambiado a nullable
            'filtro' => 'nullable|string|max:50',             // Cambiado a nullable
            'tiempo_uso' => 'nullable|string|max:50',         // Cambiado a nullable
            'refraccion_od' => 'required|string|max:50',
            'refraccion_oi' => 'required|string|max:50',
            'rx_final_dp_od' => 'required|string|max:50',
            'rx_final_dp_oi' => 'required|string|max:50',
            'rx_final_av_vl_od' => 'required|string|max:50',
            'rx_final_av_vl_oi' => 'required|string|max:50',
            'rx_final_av_vp_od' => 'required|string|max:50',
            'rx_final_av_vp_oi' => 'required|string|max:50',
            'ph_od' => 'required|string|max:50',
            'ph_oi' => 'required|string|max:50',
            'add' => 'nullable|string|max:50',      // Cambiado a nullable
            'cotizacion' => 'nullable|string',      // Cambiado a nullable
            'usuario_id' => 'required|exists:users,id',
            'diagnostico' => 'required|string',
            'tratamiento' => 'required|string'
        ];
    }

    public function store(Request $request)
    {
        $data = $request->validate($this->validationRules());
        
        // Asegurarse de que el usuario_id esté establecido
        if (!isset($data['usuario_id'])) {
            $data['usuario_id'] = auth()->id();
        }
        
        HistorialClinico::create($data);
        return redirect()->route('historiales_clinicos.index')->with('success', 'Historial clínico creado exitosamente');
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
        try {
            $historialClinico = HistorialClinico::findOrFail($id);
            $data = $request->validate($this->validationRules());
            
            // Asegurar que el usuario_id permanezca
            if (!isset($data['usuario_id'])) {
                $data['usuario_id'] = $historialClinico->usuario_id;
            }
            
            $historialClinico->update($data);
            
            return redirect()
                ->route('historiales_clinicos.index')
                ->with('success', 'Historial clínico actualizado exitosamente');
                
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Error al actualizar el historial clínico: ' . $e->getMessage());
        }
    }

    public function destroy(HistorialClinico $historialClinico)
    {
        $historialClinico->delete();
        return redirect()->route('historiales_clinicos.index');
    }
}
