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
        try {
            // Crear un nuevo pago
            $nuevoPago = Pagonuevo::create($validatedData);


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
        return view('pagonuevos.edit', compact('pago', 'mediosdepago', 'pedidos')); // Pasar pedidos a la vista
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
        try {
            // Obtener el pago actual
            $pago = Pagonuevo::findOrFail($id);

            // Obtener el pedido asociado al pago
            $pedido = Pedido::find($validatedData['pedido_id']);

            // Verificar si el monto del pago ha cambiado
            $montoAnterior = $pago->pago;
            $montoActual = $validatedData['pago'];


            if ($montoAnterior != $montoActual) {
                // Restar el monto anterior al saldo del pedido
                $pedido->saldo += $montoAnterior;
                
                // Restar el monto actual al saldo del pedido
                $pedido->saldo -= $montoActual;
                
                // Actualizar el monto del pago en la base de datos
                $pago->update($validatedData);
    
                // Actualizar el saldo del pedido
                $pedido->save();
            }
       

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
        try {
            // Obtener el pago a eliminar
            $pago = Pagonuevo::findOrFail($id);
    
            // Obtener el pedido asociado al pago
            $pedido = Pedido::find($pago->pedido_id);
    
            // Sumar el monto del pago al saldo del pedido
            $pedido->saldo += $pago->pago;
    
            // Eliminar el pago de la base de datos
            $pago->delete();
    
            // Actualizar el saldo del pedido
            $pedido->save();
    
            return redirect('/Pagonuevos')->with([
                'error' => 'Éxito',
                'mensaje' => 'Pago eliminado exitosamente. Monto revertido al pedido.',
                'tipo' => 'alert-success'
            ]);
        } catch (\Exception $e) {
            return redirect('/Pagonuevos')->with([
                'error' => 'Error',
                'mensaje' => 'Pago no se ha eliminado.',
                'tipo' => 'alert-danger'
            ]);
        }
    }
}
