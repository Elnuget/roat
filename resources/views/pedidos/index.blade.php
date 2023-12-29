@extends('adminlte::page')
@section('title', 'Pedidos')
@section('content_header')
<h1>Pedidos</h1>
<p>Administracion de ventas</p>
@if (session('error'))
<div class="alert {{ session('tipo') }} alert-dismissible fade show" role="alert">
    <strong>{{ session('error') }}</strong> {{ session('mensaje') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif @stop

@section('content')

<div class="card">
    <div class="card-body">
        <table id="example" class="table table-striped table-bordered table-responsive">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Número de Orden</th>
                    <th>Fact</th>
                    <th>Nombre del Paciente</th>
                    <th>Examen Visual</th>
                    <th>Nombre del Item A</th>
                    <th>Precio A</th>
                    <th>Medida L</th>
                    <th>Detalle L</th>
                    <th>Precio L</th>
                    <th>Nombre del Item D</th>
                    <th>Precio D</th>
                    <th>Total</th>
                    <th>Saldo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pedidos as $pedido)
                <tr>
                    <td>{{ $pedido->fecha }}</td>
                    <td>{{ $pedido->numero_orden }}</td>
                    <td>{{ $pedido->fact }}</td>
                    <td>{{ $pedido->paciente->nombre }}</td>
                    <!-- Asegúrate de que el modelo Paciente tenga un campo 'nombre' -->
                    <td>{{ $pedido->examen_visual }}</td>
                    <td>{{ $pedido->aInventario->codigo ?? 'N/A' }}</td> <!-- Mostrar el nombre del objeto A -->
                    <td>{{ $pedido->a_precio }}</td>
                    <td>{{ $pedido->l_medida }}</td>
                    <td>{{ $pedido->l_detalle }}</td>
                    <td>{{ $pedido->l_precio }}</td>
                    <td>{{ $pedido->dInventario->codigo ?? 'N/A' }}</td> <!-- Mostrar el nombre del objeto D -->
                    <td>{{ $pedido->d_precio }}</td>
                    <td>{{ $pedido->total }}</td>
                    <td>{{ $pedido->saldo }}</td>
                    <td>
                        <a href="{{ route('pedidos.show', $pedido ->id) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('pedidos.edit', $pedido ->id) }}"
                            class="btn btn-warning btn-sm">Editar</a>

                        <button type="button" class="btn btn-danger btn-sm"
                            onclick="event.preventDefault(); if(confirm('¿Estás seguro de querer eliminar esta venta?')) { document.getElementById('delete-form-{{ $pedido ->id }}').submit(); }">
                            Eliminar
                        </button>

                        <form id="delete-form-{{ $pedido ->id }}"
                            action="{{ route('pedidos.destroy', $pedido ->id) }}" method="POST"
                            style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <br />
        <div class="btn-group">
            <a type="button" class="btn btn-success" href="{{ route('pedidos.create') }}">Agregar venta</a>
        </div>
    </div>
</div>

@stop
@section('js')
<script>
    $(document).ready(function () {
        $("#example").DataTable({
            order: [
                [0, "desc"]
            ],

            language: {
                url: "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json",
            },
        });
    });
</script>
@stop