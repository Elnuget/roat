<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\Inventario;

class PedidosController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin')->only(['edit', 'update', 'destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Pedido::with(['aInventario', 'dInventario']);

        if ($request->filled('ano')) {
            $query->whereYear('fecha', '=', $request->ano);
        }

        if ($request->filled('mes')) {
            $query->whereMonth('fecha', '=', (int)$request->mes);
        }

        $pedidos = $query->paginate(10);

        return view('pedidos.index', compact('pedidos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Filtrar armazones (excluyendo accesorios)
        $armazones = Inventario::where('cantidad', '>', 0)
            ->where('codigo', 'not like', '%ESTUCHE%')
            ->where('codigo', 'not like', '%LIQUIDO%')
            ->where('codigo', 'not like', '%GOTERO%')
            ->where('codigo', 'not like', '%SPRAY%')
            ->get();

        // Filtrar accesorios
        $accesorios = Inventario::where('cantidad', '>', 0)
            ->where(function($query) {
                $query->where('codigo', 'like', '%ESTUCHE%')
                    ->orWhere('codigo', 'like', '%LIQUIDO%')
                    ->orWhere('codigo', 'like', '%GOTERO%')
                    ->orWhere('codigo', 'like', '%SPRAY%');
            })
            ->get();

        $currentDate = date('Y-m-d');
        $lastOrder = Pedido::orderBy('numero_orden', 'desc')->first();
        $nextOrderNumber = $lastOrder ? $lastOrder->numero_orden + 1 : 1;
        $nextInvoiceNumber = 'Pendiente';

        return view('pedidos.create', compact('armazones', 'accesorios', 'currentDate', 'nextOrderNumber', 'nextInvoiceNumber'));
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
            'fecha' => 'nullable|date',
            'numero_orden' => 'nullable|integer',
            'fact' => 'nullable|string|max:255',
            'examen_visual' => 'nullable|numeric',
            'cliente' => 'nullable|string|max:255',
            'paciente' => 'nullable|string|max:255', // New validation rule
            'celular' => 'nullable|string|max:255',
            'correo_electronico' => 'nullable|string|email|max:255',
            'a_inventario_id' => 'nullable|exists:inventarios,id',
            'a_precio' => 'nullable|numeric',
            'l_detalle' => 'nullable|string|max:255',
            'l_medida' => 'nullable|string|max:255',
            'l_precio' => 'nullable|numeric',
            'd_inventario_id' => 'nullable|exists:inventarios,id',
            'd_precio' => 'nullable|numeric',
            'total' => 'nullable|numeric',
            'saldo' => 'nullable|numeric',
            // Nuevos campos
            'tipo_lente' => 'nullable|string|max:255',
            'material' => 'nullable|string|max:255',
            'filtro' => 'nullable|string|max:255',
            'valor_compra' => 'nullable|numeric',
            'motivo_compra' => 'nullable|string|max:255'
        ]);

        try {
            $pedido = new Pedido($validatedData);
            $pedido->save();

            // Actualizar el inventario para el artículo A
            if (!empty($validatedData['a_inventario_id'])) {
                $inventarioItemA = Inventario::find($validatedData['a_inventario_id']);
                if ($inventarioItemA) {
                    $inventarioItemA->orden = $validatedData['numero_orden'];
                    $inventarioItemA->cantidad -= 1;
                    $inventarioItemA->valor = $validatedData['a_precio'];
                    $inventarioItemA->save();
                }
            }

            // Actualizar el inventario para el artículo D
            if (!empty($validatedData['d_inventario_id'])) {
                $inventarioItemD = Inventario::find($validatedData['d_inventario_id']);
                if ($inventarioItemD) {
                    $inventarioItemD->orden = $validatedData['numero_orden'];
                    $inventarioItemD->cantidad -= 1;
                    $inventarioItemD->valor = $validatedData['d_precio'];
                    $inventarioItemD->save();
                }
            }

            return redirect('/Pedidos')->with([
                'error' => 'Exito',
                'mensaje' => 'Pedido creado exitosamente',
                'tipo' => 'alert-success'
            ]);
        } catch (\Exception $e) {
            return redirect('/Pedidos')->with([
                'error' => 'Error',
                'mensaje' => 'Pedido no se ha creado. Motivo: ' . $e->getMessage(),
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
        $inventarioItems = Inventario::all(); // Obtener todos los items del inventario

        return view('pedidos.edit', compact('pedido', 'inventarioItems'));
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
            'fecha' => 'nullable|date',
            'numero_orden' => 'nullable|integer',
            'fact' => 'nullable|string|max:255',
            'examen_visual' => 'nullable|numeric',
            'cliente' => 'nullable|string|max:255',
            'paciente' => 'nullable|string|max:255', // New validation rule
            'celular' => 'nullable|string|max:255',
            'correo_electronico' => 'nullable|string|email|max:255',
            'a_inventario_id' => 'nullable|exists:inventarios,id',
            'a_precio' => 'nullable|numeric',
            'l_detalle' => 'nullable|string|max:255',
            'l_medida' => 'nullable|string|max:255',
            'l_precio' => 'nullable|numeric',
            'd_inventario_id' => 'nullable|exists:inventarios,id',
            'd_precio' => 'nullable|numeric',
            'total' => 'nullable|numeric',
            'saldo' => 'nullable|numeric',
            // Nuevos campos
            'tipo_lente' => 'nullable|string|max:255',
            'material' => 'nullable|string|max:255',
            'filtro' => 'nullable|string|max:255',
            'valor_compra' => 'nullable|numeric',
            'motivo_compra' => 'nullable|string|max:255'
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
