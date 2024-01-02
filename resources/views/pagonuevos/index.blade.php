@extends('adminlte::page')

@section('title', 'Pagos')



@section('content_header')
<h1>Pagos</h1>
<p>Administracion de Pagos</p>
@if (session('error'))
<div class="alert {{ session('tipo') }} alert-dismissible fade show" role="alert">
    <strong> {{ session('mensaje') }}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
@stop

@section('content')

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="pagosTable" class="table table-striped table-bordered">
                <thead>

                    <tr>
                        <td>ID</td>
                        <td>Orden</td>
                        <td>Método de pago</td>

                        <td>Pago</td>
                        <td>Saldo</td>
                        <td>Acciones</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pagos as $index => $pago)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $pago->pedido->numero_orden }}</td>

                        <td>{{ $pago->mediodepago->medio_de_pago }}</td>

                        <td>{{ $pago->pago }}</td>

                        <td>{{ $pago->pedido->saldo }}</td>

                        <td>
                            <a href="{{ route('pagonuevos.edit', $pago->id) }}"
                                class="btn btn-xs btn-default text-primary mx-1 shadow" title="Editar">
                                <i class="fa fa-lg fa-fw fa-pen"></i>
                            </a>




                            <a class="btn btn-xs btn-default text-danger mx-1 shadow" href="#" data-toggle="modal"
                                data-target="#confirmarEliminarModal" data-id="{{ $pago->id }}"
                                data-url="{{ route('pagonuevos.destroy', $pago->id) }}">
                                <i class="fa fa-lg fa-fw fa-trash"></i>
                            </a>

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
                                            ¿Estás seguro de que deseas eliminar este elemento?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Cancelar</button>
                                            <form id="eliminarForm" method="post"
                                                action="{{ route('pagonuevos.destroy', $pago->id) }}">
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
            <br>

        </div>
        <div class="btn-group">
            <a type="button" class="btn btn-success" href="{{ route('pagonuevos.create') }}">Añadir Pago</a>
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
        var pagosTable = $('#pagosTable').DataTable({
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
                        "columns": [0, 1, 2, 3]
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
                    "filename": 'Pagos.pdf',
                    "pageSize": 'LETTER',
                    "exportOptions": {
                        "columns": [0, 1, 2, 3]
                    }
                }
            ],
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
            }
        });


        $('#filtroPaciente').select2();
        // Aplicar filtro al cambio en el select
        $('#filtroPaciente').on('change', function () {
            var pacienteId = $(this).val();
            pagosTable.column(1).search(pacienteId).draw();
        });
    });

    

</script>
@stop