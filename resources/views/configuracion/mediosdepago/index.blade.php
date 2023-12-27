@extends('adminlte::page')

@section('title', 'Medios de pago')

@section('content_header')
    <h1>Configuracion</h1>
    <p>Administracion de medios de pago</p>
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
                <table id="example" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Nombre</td>
                            <td>Acciones</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($medio as $m)
                            <tr>
                                <td>{{ $m->id }}</td>
                                <td>{{ $m->medio_de_pago }}</td>

                                <td>
                                    <div class="btn-group">

                                        <button type="button" class="btn btn-success dropdown-toggle"
                                            data-toggle="dropdown">Acciones</button>

                                        <div class="dropdown-menu" role="menu">
                                            <a class="dropdown-item"
                                                href="{{ route('configuracion.mediosdepago.editar', $m->id) }}">Editar</a>

                                            <a class="dropdown-item" href="#" data-toggle="modal"
                                                data-target="#confirmarEliminarModal" data-id="{{ $m->id }}"
                                                data-url="{{ route('configuracion.mediosdepago.destroy', $m->id) }}">Eliminar</a>
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
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <br>
            <div class="btn-group">
                <a type="button" class="btn btn-success" href="{{ route('configuracion.mediosdepago.create') }}">Crear
                    medio
                    de pago</a>

            </div>
        </div>
    </div>


@stop
@section('js')
    <script>
        $(document).ready(function() {
            // Configurar el modal antes de mostrarse
            $('#confirmarEliminarModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');
                var url = button.data('url');
                var modal = $(this);
                modal.find('#eliminarForm').attr('action', url);
            });

            // Inicializar DataTable
            $('#example').DataTable({
                "columnDefs": [{
                    "targets": [2],
                    "visible": true,
                    "searchable": true
                }],
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                }
            });
        });
    </script>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                }
            });
        });
    </script>
@stop

@section('footer')
    <div class="float-right d-none d-sm-block">
        <b>Version</b> @version('compact')
    </div>
@stop
