<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empresa;
use App\Models\Conductor;
use App\Models\HojaRuta;
use App\Models\Pasajero;
use App\Models\Itinerario;

class HojaRutaController extends Controller
{
    // List all HojaRuta records
    public function index(Request $request)
    {
        $query = HojaRuta::query();

        if ($request->has('ano')) {
            $query->whereYear('fecha_inicio', $request->ano);
        }

        if ($request->has('mes')) {
            $query->whereMonth('fecha_inicio', $request->mes);
        }

        $hojasRuta = $query->get();

        return view('hoja_ruta.index', compact('hojasRuta'));
    }

    // Show the form to create a new HojaRuta
    public function create()
    {
        return view('hoja_ruta.create');
    }

    // Store the new HojaRuta
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'empresa_nombre' => 'required|string|max:255',
            'empresa_contacto' => 'required|string|max:255',
            'conductor_nombre' => 'required|string|max:255',
            'placa_vehicular' => 'required|string|max:255',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
            'kilometraje_inicio' => 'required|integer',
            'kilometraje_llegada' => 'required|integer',
            'pasajeros' => 'required|array',
            'pasajeros.*.nombre' => 'required|string|max:255',
            'pasajeros.*.cedula' => 'required|string|max:255',
            'pasajeros.*.proyecto' => 'required|string|max:255',
            'itinerarios' => 'required|array',
            'itinerarios.*.fecha' => 'required|date',
            'itinerarios.*.origen_destino' => 'required|string|max:255',
            'itinerarios.*.hora_salida' => 'required|string|max:255',
            'itinerarios.*.hora_llegada' => 'required|string|max:255',
            'itinerarios.*.observaciones' => 'nullable|string|max:255',
        ]);

        // Create the Empresa
        $empresa = Empresa::create([
            'nombre' => $validatedData['empresa_nombre'],
            'contacto' => $validatedData['empresa_contacto'],
        ]);

        // Create the Conductor
        $conductor = Conductor::create([
            'nombre' => $validatedData['conductor_nombre'],
            'placa_vehicular' => $validatedData['placa_vehicular'],
        ]);

        // Create the HojaRuta
        $hojaRuta = HojaRuta::create([
            'empresa_id' => $empresa->id,
            'conductor_id' => $conductor->id,
            'fecha_inicio' => $validatedData['fecha_inicio'],
            'fecha_fin' => $validatedData['fecha_fin'],
            'kilometraje_inicio' => $validatedData['kilometraje_inicio'],
            'kilometraje_llegada' => $validatedData['kilometraje_llegada'],
            'kilometraje_total' => $validatedData['kilometraje_llegada'] - $validatedData['kilometraje_inicio'],
        ]);

        // Create the Pasajeros
        foreach ($validatedData['pasajeros'] as $pasajeroData) {
            Pasajero::create([
                'nombre' => $pasajeroData['nombre'],
                'cedula' => $pasajeroData['cedula'],
                'proyecto' => $pasajeroData['proyecto'],
                'hoja_ruta_id' => $hojaRuta->id,
            ]);
        }

        // Create the Itinerarios
        foreach ($validatedData['itinerarios'] as $itinerarioData) {
            Itinerario::create([
                'hoja_ruta_id' => $hojaRuta->id,
                'fecha' => $itinerarioData['fecha'],
                'origen_destino' => $itinerarioData['origen_destino'],
                'hora_salida' => $itinerarioData['hora_salida'],
                'hora_llegada' => $itinerarioData['hora_llegada'],
                'observaciones' => $itinerarioData['observaciones'],
            ]);
        }

        // Redirect to the list of HojaRuta with a success message
        return redirect()->route('hoja_ruta.index')->with('success', 'Hoja de Ruta creada exitosamente.');
    }

    // Show the details of a specific HojaRuta
    public function show($id)
    {
        $hojaRuta = HojaRuta::with(['empresa', 'conductor', 'pasajeros', 'itinerarios'])->findOrFail($id);
        return view('hoja_ruta.show', compact('hojaRuta'));
    }

    // Show the form to edit a specific HojaRuta
    public function edit($id)
    {
        $hojaRuta = HojaRuta::with(['empresa', 'conductor', 'pasajeros', 'itinerarios'])->findOrFail($id);
        return view('hoja_ruta.edit', compact('hojaRuta'));
    }

    // Update the specific HojaRuta
    public function update(Request $request, $id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'empresa_nombre' => 'required|string|max:255',
            'empresa_contacto' => 'required|string|max:255',
            'conductor_nombre' => 'required|string|max:255',
            'placa_vehicular' => 'required|string|max:255',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
            'kilometraje_inicio' => 'required|integer',
            'kilometraje_llegada' => 'required|integer',
            'pasajeros' => 'required|array',
            'pasajeros.*.nombre' => 'required|string|max:255',
            'pasajeros.*.cedula' => 'required|string|max:255',
            'pasajeros.*.proyecto' => 'required|string|max:255',
            'itinerarios' => 'required|array',
            'itinerarios.*.fecha' => 'required|date',
            'itinerarios.*.origen_destino' => 'required|string|max:255',
            'itinerarios.*.hora_salida' => 'required|string|max:255',
            'itinerarios.*.hora_llegada' => 'required|string|max:255',
            'itinerarios.*.observaciones' => 'nullable|string|max:255',
        ]);

        // Update the Empresa
        $hojaRuta = HojaRuta::findOrFail($id);
        $hojaRuta->empresa->update([
            'nombre' => $validatedData['empresa_nombre'],
            'contacto' => $validatedData['empresa_contacto'],
        ]);

        // Update the Conductor
        $hojaRuta->conductor->update([
            'nombre' => $validatedData['conductor_nombre'],
            'placa_vehicular' => $validatedData['placa_vehicular'],
        ]);

        // Update the HojaRuta
        $hojaRuta->update([
            'fecha_inicio' => $validatedData['fecha_inicio'],
            'fecha_fin' => $validatedData['fecha_fin'],
            'kilometraje_inicio' => $validatedData['kilometraje_inicio'],
            'kilometraje_llegada' => $validatedData['kilometraje_llegada'],
            'kilometraje_total' => $validatedData['kilometraje_llegada'] - $validatedData['kilometraje_inicio'],
        ]);

        // Update the Pasajeros
        foreach ($validatedData['pasajeros'] as $index => $pasajeroData) {
            $hojaRuta->pasajeros[$index]->update([
                'nombre' => $pasajeroData['nombre'],
                'cedula' => $pasajeroData['cedula'],
                'proyecto' => $pasajeroData['proyecto'],
            ]);
        }

        // Update the Itinerarios
        foreach ($validatedData['itinerarios'] as $index => $itinerarioData) {
            $hojaRuta->itinerarios[$index]->update([
                'fecha' => $itinerarioData['fecha'],
                'origen_destino' => $itinerarioData['origen_destino'],
                'hora_salida' => $itinerarioData['hora_salida'],
                'hora_llegada' => $itinerarioData['hora_llegada'],
                'observaciones' => $itinerarioData['observaciones'],
            ]);
        }

        // Redirect to the list of HojaRuta with a success message
        return redirect()->route('hoja_ruta.index')->with('success', 'Hoja de Ruta actualizada exitosamente.');
    }

    // Show the print view of a specific HojaRuta
    public function print($id)
    {
        $hojaRuta = HojaRuta::with(['empresa', 'conductor', 'pasajeros', 'itinerarios'])->findOrFail($id);
        return view('hoja_ruta.print', compact('hojaRuta'));
    }
}
