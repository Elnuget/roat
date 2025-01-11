@extends('adminlte::page')

@section('title', 'Ver Venta')

@section('content_header')
<h2>Ver Venta</h2>
@stop

@section('content')
<br>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Venta {{ $pedido->id }}</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    
    <div class="card-body">
        {{-- Información Básica --}}
        <div class="card collapsed-card">
            <div class="card-header">
                <h3 class="card-title">Información Básica</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>Fecha:</strong> {{ date('d-m-Y', strtotime($pedido->fecha)) }}</li>
                    <li class="list-group-item"><strong>Número de Orden:</strong> {{ $pedido->numero_orden }}</li>
                    <li class="list-group-item"><strong>Factura:</strong> {{ $pedido->fact }}</li>
                </ul>
            </div>
        </div>

        {{-- Datos Personales --}}
        <div class="card collapsed-card">
            <div class="card-header">
                <h3 class="card-title">Datos Personales</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>Cliente:</strong> {{ $pedido->cliente }}</li>
                    <li class="list-group-item"><strong>Paciente:</strong> {{ $pedido->paciente }}</li>
                    <li class="list-group-item"><strong>Celular:</strong> {{ $pedido->celular }}</li>
                    <li class="list-group-item"><strong>Correo Electrónico:</strong> {{ $pedido->correo_electronico }}</li>
                    <li class="list-group-item"><strong>Examen Visual:</strong> ${{ number_format($pedido->examen_visual, 2, ',', '.') }}</li>
                </ul>
            </div>
        </div>

        {{-- Armazón --}}
        <div class="card collapsed-card">
            <div class="card-header">
                <h3 class="card-title">Armazón</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>Armazón:</strong> {{ $pedido->aInventario ? $pedido->aInventario->codigo : 'No asignado' }}</li>
                    <li class="list-group-item">
                        <strong>Precio Armazón:</strong> ${{ number_format($pedido->a_precio, 2, ',', '.') }}
                        @php
                            $armazonBase = round($pedido->a_precio / 1.15, 2);
                            $armazonIva = round($pedido->a_precio - $armazonBase, 2);
                        @endphp
                        <span style="color: red;">
                            (Base: ${{ number_format($armazonBase, 2, ',', '.') }})
                            (IVA: ${{ number_format($armazonIva, 2, ',', '.') }})
                        </span>
                    </li>
                </ul>
            </div>
        </div>

        {{-- Lunas --}}
        <div class="card collapsed-card">
            <div class="card-header">
                <h3 class="card-title">Lunas</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>Lunas Medidas:</strong> {{ $pedido->l_medida }}</li>
                    <li class="list-group-item"><strong>Lunas Detalle:</strong> {{ $pedido->l_detalle }}</li>
                    <li class="list-group-item"><strong>Tipo de Lente:</strong> {{ $pedido->tipo_lente }}</li>
                    <li class="list-group-item"><strong>Material:</strong> {{ $pedido->material }}</li>
                    <li class="list-group-item"><strong>Filtro:</strong> {{ $pedido->filtro }}</li>
                    <li class="list-group-item">
                        <strong>Precio Lunas:</strong> ${{ number_format($pedido->l_precio, 2, ',', '.') }}
                        @php
                            $lunasBase = round($pedido->l_precio / 1.15, 2);
                            $lunasIva = round($pedido->l_precio - $lunasBase, 2);
                        @endphp
                        <span style="color: red;">
                            (Base: ${{ number_format($lunasBase, 2, ',', '.') }})
                            (IVA: ${{ number_format($lunasIva, 2, ',', '.') }})
                        </span>
                    </li>
                </ul>
            </div>
        </div>

        {{-- Accesorios --}}
        <div class="card collapsed-card">
            <div class="card-header">
                <h3 class="card-title">Accesorios</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>Accesorio:</strong> {{ $pedido->dInventario ? $pedido->dInventario->codigo : 'No asignado' }}</li>
                    <li class="list-group-item">
                        <strong>Precio Accesorio:</strong> ${{ number_format($pedido->d_precio, 2, ',', '.') }}
                        @php
                            $accesorioBase = round($pedido->d_precio / 1.15, 2);
                            $accesorioIva = round($pedido->d_precio - $accesorioBase, 2);
                        @endphp
                        <span style="color: red;">
                            (Base: ${{ number_format($accesorioBase, 2, ',', '.') }})
                            (IVA: ${{ number_format($accesorioIva, 2, ',', '.') }})
                        </span>
                    </li>
                </ul>
            </div>
        </div>

        {{-- Compra Rápida --}}
        <div class="card collapsed-card">
            <div class="card-header">
                <h3 class="card-title">Compra Rápida</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>Valor de Compra:</strong> ${{ number_format($pedido->valor_compra, 2, ',', '.') }}</li>
                    <li class="list-group-item"><strong>Motivo de Compra:</strong> {{ $pedido->motivo_compra }}</li>
                </ul>
            </div>
        </div>

        {{-- Totales --}}
        <div class="card">
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>Total:</strong> ${{ number_format($pedido->total, 2, ',', '.') }}</li>
                    <li class="list-group-item"><strong>Saldo:</strong> ${{ number_format($pedido->saldo, 2, ',', '.') }}</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@stop

@section('js')
<script>
    document.addEventListener('keydown', function(event) {
        if (event.key === "Home") {
            window.location.href = '/dashboard';
        }
    });
</script>
@stop