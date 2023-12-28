@extends('adminlte::page')

@section('title', 'Editar Articulo')

@section('content_header')
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
    <br>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Editar Articulo</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
                    <i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fas fa-times"></i></button>
            </div>
        </div>
        <div class="card-body">
            <div class="col-md-6">
                <form role="form" action="{{ route('inventario.update', $inventario) }}" method="POST">
                    @csrf
                    @method('put')

                    <div class="form-group row">
                        <div class="col-12">
                            <label>Fecha</label>
                            <input name="fecha" required type="date" class="form-control" value="{{ $inventario->fecha }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-6">
                            <label>Lugar</label>
                            <select id="lugar" name="lugar" class="form-control">
                                <option {{ $inventario->lugar === 'Soporte' ? 'selected' : '' }} value="Soporte">Soporte</option>
                                <option {{ $inventario->lugar === 'Caja' ? 'selected' : '' }} value="Caja">Caja</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label>Número de lugar</label>
                            <input name="numero_lugar" id="numero_lugar" class="form-control" required type="number" value="{{ $inventario->numero_lugar }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-4">
                            <label>Fila</label>
                            <input name="fila" required type="text" class="form-control" value="{{ $inventario->fila }}">
                        </div>
                        <div class="col-4">
                            <label>Número</label>
                            <input name="numero" id="numero" class="form-control" required type="number" value="{{ $inventario->numero }}">
                        </div>
                        <div class="col-4">
                            <label>Código</label>
                            <input name="codigo" id="codigo" required type="text" class="form-control" value="{{ $inventario->codigo }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-4">
                            <label>Valor</label>
                            <input name="valor" id="valor"  type="number" class="form-control" value="{{ $inventario->valor }}">
                        </div>
                        <div class="col-4">
                            <label>Cantidad</label>
                            <input name="cantidad" id="cantidad" required type="number" class="form-control" value="{{ $inventario->cantidad }}">
                        </div>
                        <div class="col-4">
                            <label>Orden</label>
                            <input name="orden"  type="text" class="form-control" value="{{ $inventario->orden }}">
                        </div>
                    </div>

                    <br>

                    <button type="button" class="btn btn-primary pull-left" data-toggle="modal" data-target="#modal">Editar
                        Articulo</button>
                    <div class="modal fade" id="modal">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">

                                    <h4 class="modal-title">Modificar inventario</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body">
                                    <p>¿Estás seguro que quiere guardar los cambios?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default pull-left"
                                        data-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                </form>
            </div>

            <br>
            <!-- Fin contenido -->
        </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        Editar Articulo
    </div>
    <!-- /.card-footer-->
    </div>

@stop

@section('js')


@stop

@section('footer')
    <div class="float-right d-none d-sm-block">
        <b>Version</b> @version('compact')
    </div>
@stop