@php
    $lastCashHistory = \App\Models\CashHistory::latest()->first();
    $isClosed = !$lastCashHistory || $lastCashHistory->estado !== 'Apertura';
    
    // Calcular el monto como en el controlador de historial de caja
    $sumCaja = \App\Models\CashHistory::sum('monto');
@endphp

@if($isClosed)
<div class="position-fixed w-100 h-100 d-flex align-items-center justify-content-center" style="background-color: rgba(0,0,0,0.9) !important; z-index: 9999; top: 0; left: 0;">
    <div class="text-white" style="max-width: 500px;">
        <div class="text-center mb-4">
            <h1><i class="fas fa-cash-register fa-3x mb-3"></i></h1>
            <h2>¡Atención! La caja está cerrada</h2>
            <p>Debe abrir la caja antes de continuar operando en el sistema</p>
        </div>

        <div class="card" style="background-color: #d4edda; border: none;">
            <div class="card-body">
                <h5 class="text-dark mb-3">Apertura de Caja</h5>
                <form action="{{ route('cash-histories.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="monto" class="text-dark">Monto Actual</label>
                        <input type="number" class="form-control" name="monto" id="monto" value="{{ $sumCaja }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="estado" class="text-dark">Estado</label>
                        <input type="text" class="form-control" name="estado" id="estado" value="Apertura" readonly>
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                        <i class="fas fa-door-open mr-2"></i>Abrir Caja
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endif

{{-- Content Wrapper --}}
<div class="content-wrapper {{ config('adminlte.classes_content_wrapper', '') }}" @if($isClosed) style="filter: blur(5px);" @endif>
    {{-- Content Header --}}
    @hasSection('content_header')
        <div class="content-header">
            <div class="{{ config('adminlte.classes_content_header') ?: config('adminlte.classes_content', 'container-fluid') }}">
                @yield('content_header')
            </div>
        </div>
    @endif

    {{-- Main Content --}}
    <div class="content">
        <div class="{{ config('adminlte.classes_content') ?: 'container-fluid' }}">
            @yield('content')
        </div>
    </div>
</div>
