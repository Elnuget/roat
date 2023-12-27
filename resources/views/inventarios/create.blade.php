@extends('adminlte::page')

@section('title', 'Crear Inventario')

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
            <h3 class="card-title">Crear Inventario</h3>

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
                <form role="form" action="{{ route('inventarios.store') }}" method="POST">
                    @csrf

                    <div class="form-group row">
                        <div class="col-12">
                            <label>Fecha</label>
                            <input name="fecha" required type="date" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-6">
                            <label>Lugar</label>
                            <select id="lugar" name="lugar" class="form-control">
                                <option selected=true value="Soporte">Soporte</option>
                                <option value="Caja">Caja</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label>Número de lugar</label>
                            <input name="numero_lugar" id="numero_lugar" class="form-control" required type="number">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-4">
                            <label>Fila</label>
                            <input name="fila" required type="text" class="form-control">
                        </div>
                        <div class="col-4">
                            <label>Número</label>
                            <input name="numero" id="numero" class="form-control" required type="number">
                        </div>
                        <div class="col-4">
                            <label>Código</label>
                            <input name="codigo" id="codigo" required type="number" class="form-control">
                        </div>
                        
                    </div>

                    <div class="form-goup row">
                        <div class="col-4">
                            <label>Valor</label>
                            <input name="valor" id="valor" required type="number" class="form-control">
                        </div>
                        <div class="col-4">
                            <label>Cantidad</label>
                            <input name="cantidad" id="cantidad" required type="number" class="form-control">

                        </div>
                        <div class="col-4">
                            <label>Orden</label>
                            <input name="orden" required type="text" class="form-control">
                        </div>
                    </div>

                    <br>


                    <button type="button" class="btn btn-primary pull-left" data-toggle="modal" data-target="#modal">Crear
                        Articulo</button>
                    <div class="modal fade" id="modal">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">

                                    <h4 class="modal-title">Crear Inventario</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body">
                                    <p>¿Estás seguro que desea guardar?</p>
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
        Crear inventario
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
