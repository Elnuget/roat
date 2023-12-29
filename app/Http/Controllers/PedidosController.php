<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\Paciente;
use App\Models\Inventario;

class PedidosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Incluye las relaciones con 'paciente', 'aInventario' y 'dInventario'
        $pedidos = Pedido::with(['paciente', 'aInventario', 'dInventario'])->get();

        return view('pedidos.index', compact('pedidos'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pacientes = Paciente::all();
        $inventarioItems = Inventario::all(); // Obtener todos los items del inventario

        return view('pedidos.create', compact('pacientes', 'inventarioItems'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'fecha' => 'required|date',
            'numero_orden' => 'required|integer',
            'fact' => 'required|string|max:255',
            'paciente_id' => 'required|exists:pacientes,id',
            'examen_visual' => 'required|numeric',
            'a_inventario_id' => 'required|exists:inventarios,id', // Asegúrate de validar correctamente
            'a_precio' => 'required|numeric',
            'l_detalle' => 'required|string|max:255',
            'l_medida' => 'required|string|max:255',
            'l_precio' => 'required|numeric',
            'd_inventario_id' => 'required|exists:inventarios,id', // Asegúrate de validar correctamente
            'd_precio' => 'required|numeric',
            'total' => 'required|numeric',
            'saldo' => 'required|numeric' // Corregir la capitalización de 'Saldo'
        ]);

        $pedido = new Pedido($validatedData);
        $pedido->save();

        // Actualizar el inventario para el artículo A
        $inventarioItemA = Inventario::find($validatedData['a_inventario_id']);
        if ($inventarioItemA) {
            $inventarioItemA->orden = $validatedData['numero_orden'];
            $inventarioItemA->valor = $validatedData['a_precio'];
            $inventarioItemA->save();
        }
        // Actualizar el inventario para el artículo D
        $inventarioItemD = Inventario::find($validatedData['d_inventario_id']);
        if ($inventarioItemD) {
            // Actualizar con el número de orden y el precio del artículo D
            $inventarioItemD->orden = $validatedData['numero_orden'];
            $inventarioItemD->valor = $validatedData['d_precio'];
            $inventarioItemD->save();
        }

        return redirect()->route('pedidos.index')->with('success', 'Pedido creado con éxito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Incluye las relaciones con 'aInventario' y 'dInventario'
        $pedido = Pedido::with(['aInventario', 'dInventario'])->findOrFail($id);

        return view('pedidos.show', compact('Pedido'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pedido = Pedido::findOrFail($id);
        $pacientes = Paciente::all(); // Obtener todos los pacientes
        $inventarioItems = Inventario::all(); // Obtener todos los items del inventario

        return view('pedidos.edit', compact('Pedido', 'pacientes', 'inventarioItems'));
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
            'fecha' => 'required|date',
            'numero_orden' => 'required|integer',
            'fact' => 'required|string|max:255',
            'paciente_id' => 'required|exists:pacientes,id',
            'examen_visual' => 'required|numeric',
            'a_inventario_id' => 'required|exists:inventarios,id', // Asegúrate de validar correctamente
            'a_precio' => 'required|numeric',
            'l_detalle' => 'required|string|max:255',
            'l_medida' => 'required|string|max:255',
            'l_precio' => 'required|numeric',
            'd_inventario_id' => 'required|exists:inventarios,id', // Asegúrate de validar correctamente
            'd_precio' => 'required|numeric',
            'total' => 'required|numeric',
            'saldo' => 'required|numeric' // Corregir la capitalización de 'Saldo'
        ]);

        $pedido = Pedido::findOrFail($id);
        $pedido->fill($validatedData);
        $pedido->save();

        return redirect()->route('Pedidos.index')->with('success', 'Pedido actualizado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pedido = Pedido::findOrFail($id);
        $pedido->delete();

        return redirect()->route('Pedidos.index')->with('success', 'Pedido eliminado con éxito.');
    }
}
