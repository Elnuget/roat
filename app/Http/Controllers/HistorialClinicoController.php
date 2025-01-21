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
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'edad' => 'required|numeric|min:0|max:150',
            'fecha_nacimiento' => 'nullable|date',
            'cedula' => 'nullable|string|max:50',
            'celular' => 'required|string|max:20',
            'ocupacion' => 'required|string|max:100',
            'fecha' => 'required|date',
            'motivo_consulta' => 'required|string|max:1000',
            'enfermedad_actual' => 'required|string|max:1000',
            'antecedentes_personales_oculares' => 'required|string|max:1000',
            'antecedentes_personales_generales' => 'required|string|max:1000',
            'antecedentes_familiares_oculares' => 'required|string|max:1000',
            'antecedentes_familiares_generales' => 'required|string|max:1000',
            'agudeza_visual_vl_sin_correccion_od' => 'required|string|max:50',
            'agudeza_visual_vl_sin_correccion_oi' => 'required|string|max:50',
            'agudeza_visual_vl_sin_correccion_ao' => 'required|string|max:50',
            'agudeza_visual_vp_sin_correccion_od' => 'required|string|max:50',
            'agudeza_visual_vp_sin_correccion_oi' => 'required|string|max:50',
            'agudeza_visual_vp_sin_correccion_ao' => 'required|string|max:50',
            'ph_od' => 'required|string|max:50',
            'ph_oi' => 'required|string|max:50',
            'optotipo' => 'nullable|string|max:1000',
            'lensometria_od' => 'nullable|string|max:50',
            'lensometria_oi' => 'nullable|string|max:50',
            'tipo_lente' => 'nullable|string|max:50',
            'material' => 'nullable|string|max:50',
            'filtro' => 'nullable|string|max:50',
            'tiempo_uso' => 'nullable|string|max:50',
            'refraccion_od' => 'required|string|max:50',
            'refraccion_oi' => 'required|string|max:50',
            'rx_final_dp_od' => 'required|string|max:50',
            'rx_final_dp_oi' => 'required|string|max:50',
            'rx_final_av_vl_od' => 'required|string|max:50',
            'rx_final_av_vl_oi' => 'required|string|max:50',
            'rx_final_av_vp_od' => 'required|string|max:50',
            'rx_final_av_vp_oi' => 'required|string|max:50',
            'add' => 'nullable|string|max:50',
            'diagnostico' => 'required|string|max:1000',
            'tratamiento' => 'required|string|max:1000',
            'cotizacion' => 'nullable|string|max:1000',
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
            
            // Log de datos recibidos para debug
            Log::info('Datos recibidos en update:', $request->all());

            // Validar los datos
            $rules = $this->validationRules();
            
            // Asegurar que usuario_id sea el correcto
            $rules['usuario_id'] = 'required|exists:users,id';
            
            // Realizar la validación
            $data = $request->validate($rules);
            
            // Asegurar que el usuario_id se mantiene
            $data['usuario_id'] = $historialClinico->usuario_id;
            
            // Log de datos validados para debug
            Log::info('Datos validados:', $data);
            
            // Actualizar el registro
            $historialClinico->update($data);
            
            return redirect()
                ->route('historiales_clinicos.index')
                ->with('success', 'Historial clínico actualizado exitosamente');
                
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Error de validación: ' . json_encode($e->errors()));
            return redirect()
                ->back()
                ->withErrors($e->errors())
                ->withInput()
                ->with('error', 'Error de validación en el formulario');
                
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
