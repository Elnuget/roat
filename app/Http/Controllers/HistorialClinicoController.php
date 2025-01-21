<?php

namespace App\Http\Controllers;

use App\Models\HistorialClinico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
            'nombres' => 'nullable|string|max:255',
            'apellidos' => 'nullable|string|max:255',
            'edad' => 'nullable|numeric|min:0|max:150',
            'fecha_nacimiento' => 'nullable|date',
            'cedula' => 'nullable|string|max:50',
            'celular' => 'nullable|string|max:20',
            'ocupacion' => 'nullable|string|max:100',
            'fecha' => 'nullable|date',
            'motivo_consulta' => 'nullable|string|max:1000',
            'enfermedad_actual' => 'nullable|string|max:1000',
            'antecedentes_personales_oculares' => 'nullable|string|max:1000',
            'antecedentes_personales_generales' => 'nullable|string|max:1000',
            'antecedentes_familiares_oculares' => 'nullable|string|max:1000',
            'antecedentes_familiares_generales' => 'nullable|string|max:1000',
            'agudeza_visual_vl_sin_correccion_od' => 'nullable|string|max:50',
            'agudeza_visual_vl_sin_correccion_oi' => 'nullable|string|max:50',
            'agudeza_visual_vl_sin_correccion_ao' => 'nullable|string|max:50',
            'agudeza_visual_vp_sin_correccion_od' => 'nullable|string|max:50',
            'agudeza_visual_vp_sin_correccion_oi' => 'nullable|string|max:50',
            'agudeza_visual_vp_sin_correccion_ao' => 'nullable|string|max:50',
            'ph_od' => 'nullable|string|max:50',
            'ph_oi' => 'nullable|string|max:50',
            'optotipo' => 'nullable|string|max:1000',
            'lensometria_od' => 'nullable|string|max:50',
            'lensometria_oi' => 'nullable|string|max:50',
            'tipo_lente' => 'nullable|string|max:50',
            'material' => 'nullable|string|max:50',
            'filtro' => 'nullable|string|max:50',
            'tiempo_uso' => 'nullable|string|max:50',
            'refraccion_od' => 'nullable|string|max:50',
            'refraccion_oi' => 'nullable|string|max:50',
            'rx_final_dp_od' => 'nullable|string|max:50',
            'rx_final_dp_oi' => 'nullable|string|max:50',
            'rx_final_av_vl_od' => 'nullable|string|max:50',
            'rx_final_av_vl_oi' => 'nullable|string|max:50',
            'rx_final_av_vp_od' => 'nullable|string|max:50',
            'rx_final_av_vp_oi' => 'nullable|string|max:50',
            'add' => 'nullable|string|max:50',
            'diagnostico' => 'nullable|string|max:1000',
            'tratamiento' => 'nullable|string|max:1000',
            'cotizacion' => 'nullable|string|max:1000',
            'usuario_id' => 'nullable|exists:users,id',
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
            
            // Obtener los datos validados
            $data = $request->validate($this->validationRules());
            
            // Filtrar campos vacíos
            $data = array_filter($data, function($value) {
                return $value !== null && $value !== '';
            });
            
            // Asegurar que el usuario_id se mantiene
            $data['usuario_id'] = $historialClinico->usuario_id;
            
            // Actualizar el registro
            $historialClinico->update($data);
            
            return redirect()
                ->route('historiales_clinicos.index')
                ->with('success', 'Historial clínico actualizado exitosamente');
                
        } catch (\Exception $e) {
            Log::error('Error al actualizar: ' . $e->getMessage());
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
