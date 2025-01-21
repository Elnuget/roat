<?php

namespace App\Http\Controllers;

use App\Models\CashHistory;
use Illuminate\Http\Request;
use App\Models\Caja;
use Illuminate\Support\Facades\Mail;

class CashHistoryController extends Controller
{
    public function index()
    {
        $cashHistories = CashHistory::with('user')->latest()->get();
        $sumCaja = Caja::sum('valor');
        return view('cash-histories.index', compact('cashHistories', 'sumCaja'));
    }

    public function store(Request $request)
    {
        $cashHistory = new \App\Models\CashHistory();
        $cashHistory->monto = $request->monto;
        $cashHistory->estado = $request->estado;
        $cashHistory->user_id = auth()->id();
        $cashHistory->save();

        return redirect()->back()->with('success', 'Caja ' . $request->estado . ' exitosamente');
    }

    public function update(Request $request, CashHistory $cashHistory)
    {
        $request->validate([
            'monto' => 'required|numeric',
            'estado' => 'required|string'
        ]);

        $cashHistory->update($request->all());

        return redirect()->back()->with([
            'error' => 'Exito',
            'mensaje' => 'Registro de caja actualizado exitosamente',
            'tipo' => 'alert-success'
        ]);
    }

    public function destroy(CashHistory $cashHistory)
    {
        $cashHistory->delete();

        return redirect()->back()->with([
            'error' => 'Exito',
            'mensaje' => 'Registro de caja eliminado exitosamente',
            'tipo' => 'alert-success'
        ]);
    }
}
