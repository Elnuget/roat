<?php

namespace App\Http\Controllers;

use App\Models\mediosdepago;
use App\Models\Paciente;
use Illuminate\Http\Request;
use App\Models\Pago; // Asegúrate de importar tu modelo Pago

class PagoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagos = Pago::all(); // Obtener todos los pagos
        return view('pagos.index', compact('pagos')); // Retornar vista con los pagos
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pacientes = Paciente::all();
        $mediosdepago = mediosdepago::all();
        return view('pagos.create', compact('pacientes', 'mediosdepago')); // Retornar vista para crear un nuevo pago
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
            'paciente_id' => 'required|exists:pacientes,id',
            'mediodepago_id' => 'required|exists:mediosdepagos,id',
            'saldo' => 'required|numeric',
            'anticipo' => 'numeric',
        ]);

        // Crear un nuevo pago
        Pago::create($validatedData);

        return redirect('/Pagos')->with('success', 'Pago creado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pago = Pago::findOrFail($id); // Encontrar pago por ID
        return view('pagos.show', compact('pago')); // Retornar vista para mostrar el pago
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pacientes = Paciente::all();
        $mediosdepago = mediosdepago::all();
        $pago = Pago::findOrFail($id);
        return view('pagos.edit', compact('pago','pacientes','mediosdepago')); // Retornar vista para editar el pago
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
            'paciente_id' => 'required|exists:pacientes,id',
            'mediodepago_id' => 'required|exists:mediosdepagos,id',
            'saldo' => 'required|numeric',
            'anticipo' => 'numeric',
        ]);

        Pago::whereId($id)->update($validatedData);

        return redirect('/Pagos')->with('success', 'Pago actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pago = Pago::findOrFail($id);
        $pago->delete();

        return redirect('/Pago')->with('success', 'Pago eliminado correctamente');
    }
}
