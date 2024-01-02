<?php

namespace App\Http\Controllers;

use App\Models\mediosdepago;
use App\Models\Pedido;
use Illuminate\Http\Request;
use App\Models\Pagonuevo;


class PagonuevosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagos = Pagonuevo::all(); // Obtener todos los pagos
        return view('pagonuevos.index', compact('pagos')); // Retornar vista con los pagos
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mediosdepago = mediosdepago::all();
        $pedidos = Pedido::all(); // Seleccionar solo id, codigo y saldo
        return view('pagonuevos.create', compact('mediosdepago', 'pedidos')); // Pasar pedidos a la vista
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
        $nuevoPago = Pagonuevo::create($validatedData);

        try {
            // Buscar el pedido y restar el monto del pago del saldo
            $pedido = Pedido::find($validatedData['pedido_id']);
            if ($pedido) {
                $pedido->saldo -= $validatedData['pago'];
                $pedido->save();
            }

            return redirect('/Pagonuevos')->with([
                'error' => 'Exito',
                'mensaje' => 'Pago creado exitosamente',
                'tipo' => 'alert-success'
            ]);
        } catch (\Exception $e) {
            // En caso de error, eliminar el pago recién creado
            if (isset($nuevoPago)) {
                $nuevoPago->delete();
            }

            return redirect('/Pagosnuevo')->with([
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mediosdepago = mediosdepago::all();
        $pedidos = Pedido::all(); // Seleccionar solo id, codigo y saldo
        $pago = Pagonuevo::findOrFail($id);
        return view('pagonuevos.edit', compact('pago','mediosdepago', 'pedidos')); // Pasar pedidos a la vista
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
        // Validación de datos
        $validatedData = $request->validate([
            'pedido_id' => 'required|exists:pedidos,id',
            'mediodepago_id' => 'required|exists:mediosdepagos,id',
            'pago' => 'required|numeric',
        ]);

        // Crear un nuevo pago
        Pagonuevo::whereId($id)->update($validatedData);

        try {
            return redirect('/Pagonuevos')->with([
                'error' => 'Exito',
                'mensaje' => 'Pago actualizado exitosamente',
                'tipo' => 'alert-success'
            ]);
        } catch (\Exception $e) {
            return redirect('/Pagonuevos')->with([
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
        $pago = Pagonuevo::findOrFail($id);
        $pago->delete();


        try {
            return redirect('/Pagonuevos')->with([
                'error' => 'Exito',
                'mensaje' => 'Pago eliminado exitosamente',
                'tipo' => 'alert-success'
            ]);
        } catch (\Exception $e) {
            return redirect('/Pagonuevos')->with([
                'error' => 'Error',
                'mensaje' => 'Pago no se ha eliminado',
                'tipo' => 'alert-danger'
            ]);
        }
    }
}
