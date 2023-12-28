<?php

namespace App\Http\Controllers;

use App\Models\mediosdepago;
use Illuminate\Http\Request;

class mediosdepagoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $medio = mediosdepago::all();
        return view('configuracion.mediosdepago.index', compact('medio'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('configuracion.mediosdepago.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $medio = new mediosdepago();

        $medio->medio_de_pago = ucfirst($request->medio_de_pago);

        try {

            $medio->save();
            return redirect()->route('configuracion.mediosdepago.index')->with([
                'error' => 'Exito',
                'mensaje' => 'Medio de pago creado con exito',
                'tipo' => 'alert-success'
            ]);
        } catch (\Exception $e) {
            return redirect()->route('configuracion.mediosdepago.index')->with([
                'error' => 'Error',
                'mensaje' => 'Medio de pago no pudo ser creado',
                'tipo' => 'alert-danger'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\mediosdepago  $mediosdepago
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $medio = mediosdepago::findOrFail($id);
        return view('configuracion.mediosdepago.show', compact('medio'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editar($id)
    {
        $medio = mediosdepago::findOrFail($id);
        return view('configuracion.mediosdepago.editar', compact('medio'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\mediosdepago  $mediosdepago
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, mediosdepago $mediosdepago)
    {
        $mediosdepago = mediosdepago::find($request->id);
        $mediosdepago->medio_de_pago = ucfirst($request->medio_de_pago);

        try {
            $mediosdepago->save();
            return redirect()->route('configuracion.mediosdepago.index')->with([
                'error' => 'Exito',
                'mensaje' => 'Medio de pago modificado con exito',
                'tipo' => 'alert-primary'
            ]);
        } catch (\Exception $e) {
            $medio = $mediosdepago;
            return view('configuracion.mediosdepago.editar', compact('medio'));
        }
    }

     /**
     * Elimina un recurso específico de la base de datos.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $inventario = mediosdepago::findOrFail($id);
        $inventario->delete();
        return redirect()->route('configuracion.mediosdepago.index');
    }
}