<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente; // Asegúrate de importar tu modelo Paciente

class PacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pacientes = Paciente::all(); // Obtener todos los pacientes
        return view('pacientes.index', compact('pacientes')); // Retornar vista con los pacientes
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pacientes.create'); // Retornar vista para crear un nuevo paciente
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validación de datos
        $validatedData = $request->validate([
            'nombre' => 'required|max:255',
            'telefono' => 'required',
            'fecha_nacimiento' => 'required|date',
        ]);
        try {
        // Crear un nuevo paciente
        Paciente::create($validatedData);

       

     
            return redirect('/Pacientes')->with([
                'error' => 'Exito',
                'mensaje' => 'Paciente creado exitosamente',
                'tipo' => 'alert-success'
            ]);
        } catch (\Exception $e) {
            return redirect('/Pacientes')->with([
                'error' => 'Error',
                'mensaje' => 'Paciente no se ha creado',
                'tipo' => 'alert-danger'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $paciente = Paciente::findOrFail($id); // Encontrar paciente por ID
        return view('pacientes.show', compact('paciente')); // Retornar vista para mostrar el paciente
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $paciente = Paciente::findOrFail($id);
        return view('pacientes.edit', compact('paciente')); // Retornar vista para editar el paciente
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|max:255',
            'telefono' => 'required',
            'fecha_nacimiento' => 'required|date',
        ]);
        try {
        Paciente::whereId($id)->update($validatedData);

        

       
            return redirect('/Pacientes')->with([
                'error' => 'Exito',
                'mensaje' => 'Paciente actualizado exitosamente',
                'tipo' => 'alert-success'
            ]);
        } catch (\Exception $e) {
            return redirect('/Pacientes')->with([
                'error' => 'Error',
                'mensaje' => 'Paciente no se ha actualizado',
                'tipo' => 'alert-danger'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
        $paciente = Paciente::findOrFail($id);
        $paciente->delete();

        
       
            return redirect('/Pacientes')->with([
                'error' => 'Exito',
                'mensaje' => 'Paciente eliminado exitosamente',
                'tipo' => 'alert-success'
            ]);
        } catch (\Exception $e) {
            return redirect('/Pacientes')->with([
                'error' => 'Error',
                'mensaje' => 'No se puede eliminar el paciente porque está asociado a pedidos existentes. Por favor, elimine los pedidos que contienen a este paciente antes de intentar eliminarlo.',
                'tipo' => 'alert-danger'
            ]);
        }
    }
}
