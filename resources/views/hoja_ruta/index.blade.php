@extends('adminlte::page')
@section('title', 'Hojas de Ruta')

@section('content_header')
<h1>Hojas de Ruta</h1>
<p>Administración de Hojas de Ruta</p>
@if (session('error'))
    <div class="alert {{ session('tipo') }} alert-dismissible fade show" role="alert">
        <strong>{{ session('mensaje') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
@stop

@section('content')

<div class="card">
    <div class="card-body">
        {{-- Agregar resumen de totales --}}
        @php
            $totalKilometraje = $hojasRuta->sum('kilometraje_total');
        @endphp
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="info-box bg-info">
                    <div class="info-box-content">
                        <span class="info-box-text">Total Kilometraje</span>
                        <span class="info-box-number">{{ number_format($totalKilometraje, 2, ',', '.') }} km</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Agregar formulario de filtro --}}
        <form method="GET" class="form-row mb-3" id="filterForm">
            <div class="col-md-2">
                <label for="filtroAno">Seleccionar Año:</label>
                <select name="ano" class="form-control" id="filtroAno">
                    <option value="">Seleccione Año</option>
                    @for ($year = date('Y'); $year >= 2000; $year--)
                        <option value="{{ $year }}" {{ request('ano') == $year ? 'selected' : '' }}>{{ $year }}</option>
                    @endfor
                </select>
            </div>
            <div class="col-md-2">
                <label for="filtroMes">Seleccionar Mes:</label>
                <select name="mes" class="form-control" id="filtroMes">
                    <option value="">Seleccione Mes</option>
                    @foreach (range(1, 12) as $m)
                        <option value="{{ $m }}" {{ request('mes') == $m ? 'selected' : '' }}>
                            {{ DateTime::createFromFormat('!m', $m)->format('F') }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2 align-self-end">
                <button type="button" class="btn btn-primary" id="actualButton">Actual</button>
            </div>
        </form>

        {{-- Botón Añadir Hoja de Ruta --}}
        <div class="btn-group mb-3">
            <a type="button" class="btn btn-success" href="{{ route('hoja_ruta.create') }}">Añadir Hoja de Ruta</a>
        </div>

        <div class="table-responsive">
            <table id="hojasRutaTable" class="table table-striped table-bordered table-responsive">
                <thead>
                    <tr>
                        <th>Fecha Inicio</th>
                        <th>Fecha Fin</th>
                        <th>Empresa</th>
                        <th>Conductor</th>
                        <th>Kilometraje Inicio</th>
                        <th>Kilometraje Llegada</th>
                        <th>Kilometraje Total</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($hojasRuta as $hojaRuta)
                        <tr>
                            <td>{{ $hojaRuta->fecha_inicio }}</td>
                            <td>{{ $hojaRuta->fecha_fin }}</td>
                            <td>{{ optional($hojaRuta->empresa)->nombre }}</td>
                            <td>{{ optional($hojaRuta->conductor)->nombre }}</td>
                            <td>{{ $hojaRuta->kilometraje_inicio }}</td>
                            <td>{{ $hojaRuta->kilometraje_llegada }}</td>
                            <td>{{ $hojaRuta->kilometraje_total }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('hoja_ruta.show', $hojaRuta->id) }}"
                                        class="btn btn-xs btn-default text-primary mx-1 shadow" title="Ver">
                                        <i class="fa fa-lg fa-fw fa-eye"></i>
                                    </a>
                                    @can('admin')
                                        <a href="{{ route('hoja_ruta.edit', $hojaRuta->id) }}"
                                            class="btn btn-xs btn-default text-primary mx-1 shadow" title="Editar">
                                            <i class="fa fa-lg fa-fw fa-pen"></i>
                                        </a>
                                        <a class="btn btn-xs btn-default text-danger mx-1 shadow" href="#" data-toggle="modal"
                                            data-target="#confirmarEliminarModal" data-id="{{ $hojaRuta->id }}"
                                            data-url="{{ route('hoja_ruta.destroy', $hojaRuta->id) }}">
                                            <i class="fa fa-lg fa-fw fa-trash"></i>
                                        </a>
                                        <a href="{{ route('hoja_ruta.print', $hojaRuta->id) }}" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Imprimir">
                                            <i class="fa fa-lg fa-fw fa-print"></i>
                                        </a>
                                    @endcan
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
                                                ¿Estás seguro de que deseas eliminar esta hoja de ruta?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Cancelar</button>
                                                <form id="eliminarForm" method="post"
                                                    action="{{ route('hoja_ruta.destroy', $hojaRuta->id) }}">
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
    </div>
</div>

@stop
@section('js')
@include('atajos')
@parent
<script>
    $(document).ready(function () {
        // Configurar el modal antes de mostrarse
        $('#confirmarEliminarModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Botón que activó el modal
            var url = button.data('url'); // Extraer la URL del atributo data-url
            var modal = $(this);
            modal.find('#eliminarForm').attr('action', url); // Actualizar la acción del formulario
        });

        // Inicializar DataTable con nueva configuración
        var hojasRutaTable = $('#hojasRutaTable').DataTable({
            "scrollX": true,
            "order": [[0, "desc"]],  // Índice 0 = columna "Fecha Inicio"
            "columnDefs": [
                {
                    "targets": [2],
                    "visible": true,
                    "searchable": true,
                }
            ],
            "dom": 'Bfrtip',
            "paging": false,         // Deshabilitar paginación
            "lengthChange": false,   // Deshabilitar opción de cambiar longitud
            "info": false,           // Ocultar texto de información
            "processing": false,     // Deshabilitar indicador de carga
            "serverSide": false,     // No usar paginación en servidor
            "buttons": [
                {
                    "extend": 'excelHtml5',
                    "text": 'Excel',
                    "title": 'Hojas_de_Ruta_' + new Date().toISOString().split('T')[0],
                    "exportOptions": {
                        "columns": [0, 1, 2, 3, 4, 5, 6]
                    }
                },
                {
                    "extend": 'csvHtml5',
                    "text": 'CSV',
                    "title": 'Hojas_de_Ruta_' + new Date().toISOString().split('T')[0],
                    "exportOptions": {
                        "columns": [0, 1, 2, 3, 4, 5, 6]
                    }
                },
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
                    "filename": 'Hojas_de_Ruta_' + new Date().toISOString().split('T')[0],
                    "pageSize": 'LETTER',
                    "orientation": "landscape",
                    "exportOptions": {
                        "columns": [0, 1, 2, 3, 4, 5, 6]
                    }
                }
            ],
            "language": {
                "info": "",          // Quitar "Mostrando registros del X al Y de Z"
                "infoEmpty": "",     // Quitar texto cuando no hay registros
                "infoFiltered": "",  // Quitar texto cuando hay filtrado
                "paginate": {
                    "next": "",
                    "previous": ""
                }
            },
            "stateSave": true,
            "stateDuration": 60 * 60 * 24, // 24 horas
            "stateLoadParams": function (settings, data) {
                data.order = [[0, "desc"]];
            }
        });

        // Aplicar filtros existentes al cargar la página
        var year = $('#filtroAno').val();
        var month = $('#filtroMes').val();
        if (year || month) {
            hojasRutaTable.draw(); // Redibujar tabla con filtros aplicados
        }
    });

    document.getElementById('filtroAno').addEventListener('change', function () {
        document.getElementById('filterForm').submit();
    });
    document.getElementById('filtroMes').addEventListener('change', function () {
        document.getElementById('filterForm').submit();
    });

    // Añadir evento al botón "Actual"
    document.getElementById('actualButton').addEventListener('click', function () {
        const currentDate = new Date();
        const currentYear = currentDate.getFullYear();
        const currentMonth = currentDate.getMonth() + 1; // getMonth() es 0-indexado

        document.getElementById('filtroAno').value = currentYear;
        document.getElementById('filtroMes').value = currentMonth;

        document.getElementById('filterForm').submit();
    });
</script>
@stop
