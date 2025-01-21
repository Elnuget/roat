<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\Paciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Pedido;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Establecer la zona horaria a la de Quito, Ecuador
        $hoy = Carbon::now('America/Guayaquil');

        // Obtener pedidos ordenados por fecha descendente
        $pedidos = Pedido::orderBy('fecha', 'desc')->get();

        // Obtener datos de ventas por año
        $salesData = Pedido::select(
            DB::raw('YEAR(fecha) as year'),
            DB::raw('SUM(total) as total')
        )
        ->groupBy('year')
        ->orderBy('year', 'asc')
        ->get()
        ->pluck('total', 'year')
        ->toArray();

        $salesData = [
            'years' => array_keys($salesData),
            'totals' => array_values($salesData)
        ];

        // Obtener el año seleccionado desde la solicitud o usar el más reciente
        $selectedYear = $request->input('year', end($salesData['years']));

        // Obtener datos de ventas por mes para el año seleccionado
        $salesDataMonthly = Pedido::whereYear('fecha', $selectedYear)
            ->select(
                DB::raw('MONTH(fecha) as month'),
                DB::raw('SUM(total) as total')
            )
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->get()
            ->pluck('total', 'month')
            ->toArray();

        $salesDataMonthly = [
            'months' => array_map(function($month) {
                return DateTime::createFromFormat('!m', $month)->format('F');
            }, array_keys($salesDataMonthly)),
            'totals' => array_values($salesDataMonthly)
        ];

        // Obtener datos de ventas por usuario
        $userSalesData = Pedido::select(
            'usuario',
            DB::raw('SUM(total) as total')
        )
        ->groupBy('usuario')
        ->orderBy('total', 'desc')
        ->get()
        ->pluck('total', 'usuario')
        ->toArray();

        $userSalesData = [
            'users' => array_keys($userSalesData),
            'totals' => array_values($userSalesData)
        ];

        return view('admin.index', compact('pedidos', 'salesData', 'salesDataMonthly', 'selectedYear', 'userSalesData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
