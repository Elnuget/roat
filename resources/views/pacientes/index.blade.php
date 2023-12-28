@extends('adminlte::page')

@section('title', 'Pacientes')

@section('content_header')
<h1>Pacientes</h1>
<p>Administracion de Pacientes</p>
@if (session('error'))
<div class="alert {{ session('tipo') }} alert-dismissible fade show" role="alert">
    <strong>{{ session('error') }}</strong> {{ session('mensaje') }}
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
            <table id="pacientesTable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Nombre</td>
                        <td>Fecha de Nacimiento</td>
                        <td>Teléfono</td>


                        <td>Acciones</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pacientes as $paciente)
                    <tr>
                        <td>{{ $paciente->id }}</td>
                        <td>{{ $paciente->nombre }}</td>
                        <td>{{ $paciente->fecha_nacimiento }}</td>
                        <td>{{ $paciente->telefono }}</td>


                        <td>
                            <a href="{{ route('pacientes.edit', $paciente->id) }}"
                                class="btn btn-xs btn-default text-primary mx-1 shadow" title="Editar">
                                <i class="fa fa-lg fa-fw fa-pen"></i>
                            </a>




                            <a class="btn btn-xs btn-default text-danger mx-1 shadow" href="#" data-toggle="modal"
                                data-target="#confirmarEliminarModal" data-id="{{ $paciente->id }}"
                                data-url="{{ route('pacientes.destroy', $paciente->id) }}">
                                <i class="fa fa-lg fa-fw fa-trash"></i>
                            </a>

                            <!-- Confirmar Eliminar Modal -->
                            <div class="modal fade" id="confirmarEliminarModal" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Confirmar Eliminación</h5>
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
                                            <form id="eliminarForm" method="post" action="">
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
            <a type="button" class="btn btn-success" href="{{ route('pacientes.create') }}">Añadir Paciente</a>
        </div>
    </div>
</div>


@stop

@section('js')

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
        $('#pacientesTable').DataTable({
            "order": [ // Corrección aquí: Cambiar "order: a "order":
                [0, "desc"]
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
                    "filename": 'Pacientes.pdf',
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
    });
</script>
@stop
