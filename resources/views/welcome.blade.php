@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class="text-primary">
        <i class="fas fa-tachometer-alt"></i> Dashboard
    </h1>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        @php
            use App\Models\CashHistory;
            $cashHistories = CashHistory::with('user')->latest()->get();
            $lastCashHistory = \App\Models\CashHistory::latest()->first();
        @endphp

        @if($lastCashHistory && $lastCashHistory->estado !== 'Apertura')
        <div class="alert alert-warning">
            Advertencia: Debes abrir la caja antes de continuar.
            <a href="{{ route('cash-histories.index') }}" class="btn btn-primary">Abrir Caja</a>
        </div>
        @endif

        <div class="card shadow mb-3">
            <div class="card-header bg-success text-white">
                <h3 class="card-title">
                    <i class="fas fa-cash-register"></i> Historial de Caja
                </h3>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    @foreach($cashHistories as $item)
                        <li class="list-group-item">
                            Monto: {{ $item->monto }} -
                            Estado: {{ $item->estado }} 
                            @if($item->user)
                               - Usuario: {{ $item->user->name }}
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <!-- Caja de información (Info Box) para resaltar "Atajos del Sistema" -->
        <div class="info-box mb-3 shadow-sm">
            <span class="info-box-icon bg-info">
                <i class="fas fa-keyboard"></i>
            </span>
            <div class="info-box-content">
                <span class="info-box-text">Atajos del Sistema</span>
                <span class="info-box-number">Tips para navegar más rápido</span>
            </div>
        </div>
        
        <!-- Tarjeta principal -->
        <div class="card shadow">
            <div class="card-header bg-info text-white">
                <h3 class="card-title"><i class="fas fa-magic"></i> Detalles de Atajos</h3>
            </div>
            <div class="card-body">
                <!-- Callout para dar una introducción o recomendaciones -->
                <div class="callout callout-info">
                    <h5><i class="fas fa-info-circle"></i> Información Importante</h5>
                    <p>Aquí encontrarás los atajos de teclado disponibles para desplazarte más rápido en la aplicación. ¡Úsalos para ser más eficiente!</p>
                </div>

                <!-- Lista de atajos con badges y códigos -->
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <span class="badge bg-primary">Inicio</span>
                        <strong>Dashboard/Inicio:</strong>
                        <code>(Tecla de Inicio)</code>
                    </li>
                    <li class="list-group-item">
                        <span class="badge bg-secondary">Anterior</span>
                        <strong>Anterior:</strong>
                        <code>(ALT + ←)</code>
                    </li>
                    <li class="list-group-item">
                        <span class="badge bg-secondary">Siguiente</span>
                        <strong>Siguiente:</strong>
                        <code>(ALT + →)</code>
                    </li>
                    <li class="list-group-item">
                        <span class="badge bg-info">1</span>
                        <strong>Dashboard/Inicio:</strong>
                        <code>(Tecla número 1)</code>
                    </li>
                    <li class="list-group-item">
                        <span class="badge bg-info">2</span>
                        <strong>Admin:</strong>
                        <code>(Tecla número 2)</code>
                    </li>
                    <li class="list-group-item">
                        <span class="badge bg-info">3</span>
                        <strong>Pedidos:</strong>
                        <code>(Tecla número 3)</code>
                    </li>
                    <li class="list-group-item">
                        <span class="badge bg-info">4</span>
                        <strong>Pacientes:</strong>
                        <code>(Tecla número 4)</code>
                    </li>
                    <li class="list-group-item">
                        <span class="badge bg-info">5</span>
                        <strong>Inventario:</strong>
                        <code>(Tecla número 5)</code>
                    </li>
                    <li class="list-group-item">
                        <span class="badge bg-info">6</span>
                        <strong>Pago:</strong>
                        <code>(Tecla número 6)</code>
                    </li>
                    <li class="list-group-item">
                        <span class="badge bg-info">7</span>
                        <strong>Usuarios:</strong>
                        <code>(Tecla número 7)</code>
                    </li>
                    <li class="list-group-item">
                        <span class="badge bg-info">8</span>
                        <strong>Medio de pago:</strong>
                        <code>(Tecla número 8)</code>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
    <!-- Puedes agregar aquí tus estilos personalizados -->
@stop

@section('js')
    <script>
        $(document).ready(function() {
            var rows = $('#historyTable tbody tr');
            if (rows.length > 0) {
                // Columna "Estado" asumiendo la posición 4
                var estado = rows.first().find('td').eq(4).text().trim();
                if (estado !== 'Apertura') {
                    $('#cashOpenModal').modal('show');
                }
            }
        });
    </script>
    @include('atajos')
@stop
