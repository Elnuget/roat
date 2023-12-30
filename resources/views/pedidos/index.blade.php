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
                            @foreach ($pedidos as $pedido)
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
                                    <td>{{ $pedido->dInventario->codigo ?? 'N/A' }}</td>
                                    <!-- Mostrar el nombre del objeto D -->
                                    <td>{{ $pedido->d_precio }}</td>
                                    <td>{{ $pedido->total }}</td>
                                    <td>{{ $pedido->saldo }}</td>
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
                                            <a class="btn btn-xs btn-default text-danger mx-1 shadow" href="#"
                                                data-toggle="modal" data-target="#confirmarEliminarModal"
                                                data-id="{{ $pedido->id }}"
                                                data-url="{{ route('pagos.destroy', $pedido->id) }}">
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
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
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
                    <a type="button" class="btn btn-success" href="{{ route('pedidos.create') }}">Agregar venta</a>
                </div>
            </div>
        </div>

    @stop
    @section('js')


        <script>
            $(document).ready(function() {



                // Configurar el modal antes de mostrarse
                $('#confirmarEliminarModal').on('show.bs.modal', function(event) {
                    var button = $(event.relatedTarget); // Botón que activó el modal
                    var url = button.data('url'); // Extraer la URL del atributo data-url
                    var modal = $(this);
                    modal.find('#eliminarForm').attr('action', url); // Actualizar la acción del formulario
                });

                // Inicializar DataTable
                var pedidosTable = $('#pedidosTable').DataTable({
                    "scrollX": true,
                    "order": [ // Corrección aquí: Cambiar "order: a "order":
                        [0, "asc"]
                    ],
                    "columnDefs": [{ // Añadir comillas a "columnDefs"
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
                                "columns":   [0, 1, 2, 3,4,5,6,7,8,9,10,11,12,13],
                                "orientation": "landscape" 
                            },
                            "customize": function(win) {
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
                                "columns": [0, 1, 2, 3,4,5,6,7,8,9,10,11,12,13]
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
