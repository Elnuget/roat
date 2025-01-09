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
        $currentDate = date('Y-m-d'); // Obtener la fecha actual
        $lastOrder = Pedido::orderBy('numero_orden', 'desc')->first();
        $nextOrderNumber = $lastOrder ? $lastOrder->numero_orden + 1 : 1; // Obtener el siguiente número de orden

        $nextInvoiceNumber = 'Pendiente';

        return view('pedidos.create', compact('pacientes', 'inventarioItems', 'currentDate', 'nextOrderNumber', 'nextInvoiceNumber'));
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
        try {
        $pedido = new Pedido($validatedData);
        $pedido->save();

        // Actualizar el inventario para el artículo A
        $inventarioItemA = Inventario::find($validatedData['a_inventario_id']);
        if ($inventarioItemA) {
            $inventarioItemA->orden = $validatedData['numero_orden'];
            $inventarioItemA->cantidad -= 1;
            $inventarioItemA->valor = $validatedData['a_precio'];
            $inventarioItemA->save();
        }
        // Actualizar el inventario para el artículo D
        $inventarioItemD = Inventario::find($validatedData['d_inventario_id']);
        if ($inventarioItemD) {
            // Actualizar con el número de orden y el precio del artículo D
            $inventarioItemD->orden = $validatedData['numero_orden'];
            $inventarioItemD->cantidad -= 1;
            $inventarioItemD->valor = $validatedData['d_precio'];
            $inventarioItemD->save();
        }

       
      
            return redirect('/Pedidos')->with([
                'error' => 'Exito',
                'mensaje' => 'Pedido creado exitosamente',
                'tipo' => 'alert-success'
            ]);
        } catch (\Exception $e) {
            return redirect('/Pedidos')->with([
                'error' => 'Error',
                'mensaje' => 'Pedido no se ha creado',
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
        // Incluye las relaciones con 'aInventario' y 'dInventario'
        $pedido = Pedido::with(['aInventario', 'dInventario'])->findOrFail($id);

        return view('pedidos.show', compact('pedido'));
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

        return view('pedidos.edit', compact('pedido', 'pacientes', 'inventarioItems'));
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
        try {
        $pedido = Pedido::findOrFail($id);
        $pedido->fill($validatedData);
        $pedido->save();

        

            return redirect('/Pedidos')->with([
                'error' => 'Exito',
                'mensaje' => 'Pedido actualizado exitosamente',
                'tipo' => 'alert-success'
            ]);
        } catch (\Exception $e) {
            return redirect('/Pedidos')->with([
                'error' => 'Error',
                'mensaje' => 'Pedido no se ha actualizado',
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
        $pedido = Pedido::findOrFail($id);
        $pedido->delete();

   

     
            return redirect('/Pedidos')->with([
                'error' => 'Exito',
                'mensaje' => 'Pedido eliminado exitosamente',
                'tipo' => 'alert-success'
            ]);
        } catch (\Exception $e) {
            return redirect('/Pedidos')->with([
                'error' => 'Error',
                'mensaje' => 'No se puede eliminar el pedido porque tiene registros de pagos asociados. Por favor, elimine los pagos antes de intentar eliminar el pedido.',
                'tipo' => 'alert-danger'
            ]);
        }
    }

    public function approve($id)
    {
        $pedido = Pedido::findOrFail($id);
        $pedido->fact = 'Aprobado';
        $pedido->save();

        return redirect()->route('pedidos.index')->with([
            'error' => 'Exito',
            'mensaje' => 'Factura aprobada exitosamente',
            'tipo' => 'alert-success'
        ]);
    }
}
