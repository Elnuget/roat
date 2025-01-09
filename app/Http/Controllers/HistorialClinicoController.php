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
            'paciente_id' => 'required|exists:pacientes,id',
            'fecha' => 'required|date',
            'motivo_consulta' => 'required|string|max:255',
            // ...other validation rules...
        ]);

        HistorialClinico::create($data);

        return redirect()->route('historiales_clinicos.index');
    }

    public function show(HistorialClinico $historialClinico)
    {
        return view('historiales_clinicos.show', compact('historialClinico'));
    }

    public function edit(HistorialClinico $historialClinico)
    {
        return view('historiales_clinicos.edit', compact('historialClinico'));
    }

    public function update(Request $request, HistorialClinico $historialClinico)
    {
        $data = $request->validate([
            'paciente_id' => 'required|exists:pacientes,id',
            'fecha' => 'required|date',
            'motivo_consulta' => 'required|string|max:255',
            // ...other validation rules...
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
