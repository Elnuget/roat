<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventario; // Asegúrate de importar el modelo Inventario

class InventarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin')->only(['edit', 'update', 'destroy']);
    }

    /**
     * Muestra una lista del recurso.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $lugares = Inventario::select('lugar', 'numero_lugar')->distinct()->get();
        $inventario = [];

        $fecha = $request->input('fecha');
        $filtroLugar = $request->input('lugar');
        $filtroNumero = $request->input('numero_lugar');

        if ($fecha && $filtroLugar && $filtroNumero) {
            $inventario = Inventario::where('fecha', 'like', $fecha . '%')
                ->where('lugar', $filtroLugar)
                ->where('numero_lugar', $filtroNumero)
                ->get();
        }
        $totalCantidad = collect($inventario)->sum('cantidad');

        return view('inventario.index', compact('inventario', 'lugares', 'totalCantidad'));
    }

    /**
     * Muestra el formulario para crear un nuevo recurso.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('inventario.create');
    }

    /**
     * Almacena un recurso recién creado en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $lugarNumero = $request->input('lugar') . ' ' . $request->input('numero');


        $validatedData = $request->validate([
            'fecha' => 'required|date', // Fecha es requerida y debe ser una fecha válida
            'lugar' => 'required|string|max:255',
            'numero_lugar' => 'required|integer', // Lugar es requerido y debe ser una cadena de texto no mayor a 255 caracteres
            'fila' => 'required|integer', // Fila es requerida y debe ser un número entero
            'numero' => 'required|integer', // Número es requerido y debe ser un número entero
            'codigo' => 'required|string|max:255', // Código es requerido y debe ser una cadena de texto no mayor a 255 caracteres
            'cantidad' => 'required|integer', // Cantidad es requerida y debe ser un número entero
        ]);

        try {

    // Almacenar en la base de datos
    Inventario::create([
        'fecha' => $validatedData['fecha'],
        'lugar' =>$validatedData['lugar'],
        'numero_lugar' => $validatedData['numero_lugar'],
        'fila' => $validatedData['fila'],
        'numero' => $validatedData['numero'],
        'codigo' => $validatedData['codigo'],
        'valor' => null, // or use 0.00 if desired
        'cantidad' => $validatedData['cantidad'],
        'orden' => null  // or use 0 if desired
    ]);

        
            return redirect()->route('inventario.index')->with([
                'error' => 'Exito',
                'mensaje' => 'Artículo creado exitosamente',
                'tipo' => 'alert-success'
            ]);
        } catch (\Exception $e) {
            return redirect()->route('inventario.index')->with([
                'error' => 'Error',
                'mensaje' => 'Artículo no se ha creado. Detalle: ' . $e->getMessage(),
                'tipo' => 'alert-danger'
            ]);
        }
    }

   

    /**
     * Muestra un recurso específico.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $inventario = Inventario::findOrFail($id);
        return view('inventario.show', compact('inventario'));
    }

    /**
     * Muestra el formulario para editar un recurso específico.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $inventario = Inventario::findOrFail($id);
        return view('inventario.edit', compact('inventario'));
    }

    /**
     * Actualiza un recurso específico en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'fecha' => 'required|date',
            'lugar' => 'required|string|max:255',
            'fila' => 'required|integer',
            'numero' => 'required|integer',
            'codigo' => 'required|string|max:255',
            'valor' => 'nullable|numeric',
            'cantidad' => 'required|integer',
            'orden' => 'nullable|integer',
        ]);
        try {
        Inventario::whereId($id)->update($validatedData);

      
            return redirect()->route('inventario.index')->with([
                'error' => 'Exito',
                'mensaje' => 'Artículo actualizado exitosamente',
                'tipo' => 'alert-success'
            ]);
        } catch (\Exception $e) {
            return redirect()->route('inventario.index')->with([
                'error' => 'Error',
                'mensaje' => 'Artículo no se ha actualizado',
                'tipo' => 'alert-danger'
            ]);
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
        try {
        $inventario = Inventario::findOrFail($id);
        $inventario->delete();
        

     
            return redirect()->route('inventario.index')->with([
                'error' => 'Exito',
                'mensaje' => 'Artículo eliminado exitosamente',
                'tipo' => 'alert-success'
            ]);
        } catch (\Exception $e) {
            return redirect()->route('inventario.index')->with([
                'error' => 'Error',
                'mensaje' => 'No se puede eliminar el artículo del inventario porque está asociado a pedidos existentes. Por favor, elimine los pedidos que contienen este artículo antes de intentar eliminarlo.',
                'tipo' => 'alert-danger'
            ]);
        }
    }

    public function getNumerosLugar($lugar)
    {
        $numeros = Inventario::where('lugar', $lugar)->pluck('numero_lugar')->unique()->values();
        return response()->json($numeros);
    }
}