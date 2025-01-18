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
        $request->validate([
            'monto' => 'required|numeric',
            'estado' => 'required|string'
        ]);

        $cashHistory = new CashHistory([
            'monto' => $request->monto,
            'estado' => $request->estado,
            'user_id' => auth()->id()
        ]);

        $cashHistory->save();
        $cashHistory->load('user'); // Carga la relación con el usuario

        Mail::raw(
            "Nuevo registro en CashHistory:\n\n".
            "Monto: {$cashHistory->monto}\n".
            "Estado: {$cashHistory->estado}\n".
            "Usuario: {$cashHistory->user->name}",
            function ($message) {
                $message->to('escleropticarg@gmail.com')
                        ->subject('Nuevo Registro en CashHistory');
            }
        );

        return redirect()->back()->with([
            'error' => 'Exito',
            'mensaje' => 'Registro de caja creado exitosamente',
            'tipo' => 'alert-success'
        ]);
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
