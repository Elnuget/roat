<?php

namespace App\Http\Controllers;

use App\Models\mediosdepago;
use App\Models\Paciente;
use App\Models\Pedido;
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
        
        $mediosdepago = mediosdepago::all();
        $pedidos = Pedido::select('id', 'numero_orden', 'saldo')->get(); // Seleccionar solo id, codigo y saldo
        return view('pagos.create', compact('pacientes', 'mediosdepago', 'pedidos')); // Pasar pedidos a la vista
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
        'pedido_id' => 'required|exists:pedidos,id',
        'mediodepago_id' => 'required|exists:mediosdepagos,id',
        'pago' => 'required|numeric',
    ]);

    // Crear un nuevo pago
    $nuevoPago = Pago::create($validatedData);

    try {
        // Buscar el pedido y restar el monto del pago del saldo
        $pedido = Pedido::find($validatedData['pedido_id']);
        if ($pedido) {
            $pedido->saldo -= $validatedData['pago'];
            $pedido->save();
        }

        return redirect('/Pagos')->with([
            'error' => 'Exito',
            'mensaje' => 'Pago creado exitosamente',
            'tipo' => 'alert-success'
        ]);
    } catch (\Exception $e) {
        // En caso de error, eliminar el pago recién creado
        if (isset($nuevoPago)) {
            $nuevoPago->delete();
        }

        return redirect('/Pagos')->with([
            'error' => 'Error',
            'mensaje' => 'El pago no se ha creado. Error: ' . $e->getMessage(),
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
        $pedidos = Pedido::select('id', 'codigo', 'saldo')->get(); // Seleccionar solo id, codigo y saldo
        $pago = Pago::findOrFail($id);
        return view('pagos.edit', compact('pago', 'pacientes', 'mediosdepago', 'pedidos')); // Pasar pedidos a la vista
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
            'pedido_id' => 'required|exists:pedidos,id',
            'paciente_id' => 'required|exists:pacientes,id',
            'mediodepago_id' => 'required|exists:mediosdepagos,id',
            'saldo' => 'required|numeric',
            'pago' => 'numeric',
        ]);

        Pago::whereId($id)->update($validatedData);



        try {
            return redirect('/Pagos')->with([
                'error' => 'Exito',
                'mensaje' => 'Pago actualizado exitosamente',
                'tipo' => 'alert-success'
            ]);
        } catch (\Exception $e) {
            return redirect('/Pagos')->with([
                'error' => 'Error',
                'mensaje' => 'Pago no se ha actualizado',
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
        $pago = Pago::findOrFail($id);
        $pago->delete();


        try {
            return redirect('/Pagos')->with([
                'error' => 'Exito',
                'mensaje' => 'Pago eliminado exitosamente',
                'tipo' => 'alert-success'
            ]);
        } catch (\Exception $e) {
            return redirect('/Pagos')->with([
                'error' => 'Error',
                'mensaje' => 'Pago no se ha eliminado',
                'tipo' => 'alert-danger'
            ]);
        }
    }
}
