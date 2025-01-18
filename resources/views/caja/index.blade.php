@extends('adminlte::page')

@section('title', 'Caja')

@section('content_header')
    <h1>Caja</h1>
    <p>Administración de Caja</p>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('success') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <!-- Add date filter form -->
            <div class="row mb-3">
                <div class="col-md-4">
                    <form action="{{ route('caja.index') }}" method="GET" class="form-inline">
                        <div class="input-group">
                            <input type="date" name="fecha_filtro" class="form-control" 
                                   value="{{ $fechaFiltro }}">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary">Filtrar</button>
                                <a href="{{ route('caja.index') }}" class="btn btn-secondary">Limpiar</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="info-box bg-success">
                        <div class="info-box-content">
                            <span class="info-box-text">Total en Caja</span>
                            <span class="info-box-number">${{ number_format($totalCaja, 2, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table id="cajaTable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Fecha</th>
                            <th>Motivo</th>
                            <th>Usuario</th>
                            <th>Valor</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($movimientos as $movimiento)
                            <tr>
                                <td>{{ $movimiento->id }}</td>
                                <td>{{ $movimiento->created_at->format('Y-m-d H:i') }}</td>
                                <td>{{ $movimiento->motivo }}</td>
                                <td>{{ $movimiento->user->name }}</td>
                                <td>${{ number_format($movimiento->valor, 2, ',', '.') }}</td>
                                <td>
                                    @can('admin')
                                    <form action="{{ route('caja.destroy', $movimiento->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-xs btn-danger" 
                                                onclick="return confirm('¿Está seguro de eliminar este movimiento?')">
                                            <i class="fa fa-lg fa-fw fa-trash"></i>
                                        </button>
                                    </form>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Formulario para nuevo movimiento -->
            <div class="mt-4">
                <h4>Retiro</h4>
                <form action="{{ route('caja.store') }}" method="POST" class="row">
                    @csrf
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Valor</label>
                            <input type="number" name="valor" class="form-control" step="0.01" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Motivo</label>
                            <input type="text" name="motivo" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>&nbsp;</label>
                            <button type="submit" class="btn btn-primary btn-block">Registrar</button>
                        </div>
                    </div>
                    <input type="hidden" name="user_email" value="{{ Auth::user()->email }}">
                </form>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('#cajaTable').DataTable({
                "order": [[0, "desc"]],
                "paging": false,     // Disable pagination
                "info": false,       // Remove "Showing X of Y entries" text
                "searching": false,  // Remove search box
                "dom": 'Bfrt',      // Modified to remove pagination and info elements
                "buttons": [
                    'excel', 'pdf', 'print'
                ],
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                }
            });
        });
    </script>
@stop
