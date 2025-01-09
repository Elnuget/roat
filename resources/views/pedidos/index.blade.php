@extends('adminlte::page')
@section('title', 'Pedidos')

@section('content_header')
<h1>Pedidos</h1>
<p>Administracion de ventas</p>
@if (session('error'))
<div class="alert {{ session('tipo') }} alert-dismissible fade show" role="alert">
    <strong>{{ session('mensaje') }}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif @stop

@section('content')

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="pedidosTable" class="table table-striped table-bordered table-responsive">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Orden</th>
                        <th>Factura</th>
                        <th>Cliente</th>
                        <th>Celular</th>
                        <th>Correo Electrónico</th>
                        <th>Total</th>
                        <th>Saldo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pedidos as $pedido)
                    <tr>
                        <td>{{ $pedido->fecha }}</td>
                        <td>{{ $pedido->numero_orden }}</td>
                        <td>{{ $pedido->fact }}</td>
                        <td>{{ $pedido->cliente }}</td>
                        <td>{{ $pedido->celular }}</td>
                        <td>{{ $pedido->correo_electronico }}</td>
                        <td>{{ $pedido->total }}</td>
                        <td>
                            <span style="color: {{ $pedido->saldo == 0 ? 'green' : 'red' }}">
                                {{ $pedido->saldo }}
                            </span>
                        </td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('pedidos.show', $pedido->id) }}"
                                    class="btn btn-xs btn-default text-primary mx-1 shadow" title="Ver">
                                    <i class="fa fa-lg fa-fw fa-eye"></i>
                                </a>
                                <a href="{{ route('pedidos.edit', $pedido->id) }}"
                                    class="btn btn-xs btn-default text-primary mx-1 shadow" title="Editar">
                                    <i class="fa fa-lg fa-fw fa-pen"></i>
                                </a>
                                @if($pedido->fact == 'Pendiente')
                                <form action="{{ route('pedidos.approve', $pedido->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-xs btn-default text-success mx-1 shadow" title="Aprobar">
                                        <i class="fa fa-lg fa-fw fa-check"></i>
                                    </button>
                                </form>
                                @endif
                                <a class="btn btn-xs btn-default text-danger mx-1 shadow" href="#" data-toggle="modal"
                                    data-target="#confirmarEliminarModal" data-id="{{ $pedido->id }}"
                                    data-url="{{ route('pedidos.destroy', $pedido->id) }}">
                                    <i class="fa fa-lg fa-fw fa-trash"></i>
                                </a>
                            </div>
                            <!-- Confirmar Eliminar Modal -->
                            <div class="modal fade" id="confirmarEliminarModal" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Confirmar Eliminación
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            ¿Estás seguro de que deseas eliminar este pedido?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Cancelar</button>
                                            <form id="eliminarForm" method="post"
                                                action="{{ route('pedidos.destroy', $pedido->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Eliminar</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <br />
        <div class="btn-group">
            <a type="button" class="btn btn-success" href="{{ route('pedidos.create') }}">Añadir pedido</a>
        </div>
    </div>
</div>

@stop
@section('js')
@include('atajos')

<script>
    $(document).ready(function () {
        // Configurar el modal antes de mostrarse
        $('#confirmarEliminarModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Botón que activó el modal
            var url = button.data('url'); // Extraer la URL del atributo data-url
            var modal = $(this);
            modal.find('#eliminarForm').attr('action', url); // Actualizar la acción del formulario
        });

        // Inicializar DataTable
        var pedidosTable = $('#pedidosTable').DataTable({
            "scrollX": true,
            "order": [[0, "desc"]],
            "columnDefs": [{
                "targets": [2],
                "visible": true,
                "searchable": true,
            }],
            "dom": 'Bfrtip',
            "buttons": [
                'excelHtml5',
                'csvHtml5',
                {
                    "extend": 'print',
                    "text": 'Imprimir',
                    "autoPrint": true,
                    "exportOptions": {
                        "columns": [0, 1, 2, 3, 4, 5, 6],
                        "orientation": "landscape"
                    },
                    "customize": function (win) {
                        $(win.document.body).css('font-size', '16pt');
                        $(win.document.body).find('table')
                            .addClass('compact')
                            .css('font-size', 'inherit');
                    }
                },
                {
                    "extend": 'pdfHtml5',
                    "text": 'PDF',
                    "filename": 'Pedidos.pdf',
                    "pageSize": 'LETTER',
                    "orientation": "landscape",
                    "exportOptions": {
                        "columns": [0, 1, 2, 3, 4, 5, 6]
                    }
                }
            ],
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
            }
        });
    });
</script>
@stop