@extends('adminlte::page')

@section('title', 'Añadir Pago')

@section('content_header')
@if(session('error'))
<div class="alert {{session('tipo')}} alert-dismissible fade show" role="alert">
    <strong>{{session('error')}}</strong> {{session('mensaje')}}
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
        <h3 class="card-title">Añadir Pago</h3>

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
            <form role="form" action="{{ route('pagonuevos.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label>Seleccione una Orden</label>
                    <select name="pedido_id" required class="form-control">
                        <option value="">Seleccionar la orden</option>
                        @foreach($pedidos as $pedido)
                        <option value="{{ $pedido->id }}">{{ $pedido->numero_orden }}</option>
                        @endforeach
                    </select>
                </div>


                <div class="form-group">
                    <label>Seleccione un Medio de Pago</label>
                    <select name="mediodepago_id" required class="form-control">

                        <option value="">Seleccionar el método de pago</option>
                        @foreach($mediosdepago as $medioDePago)
                        <option value="{{ $medioDePago->id }}">{{ $medioDePago->medio_de_pago }}</option>
                        @endforeach
                    </select>
                </div>



                <div class="form-group">
                    <label>Pago</label>
                    <input name="pago" required type="text" class="form-control">
                </div>


                <br>

                <button type="button" class="btn btn-primary pull-left" data-toggle="modal" data-target="#modal">Añadir
                    Pago</button>
                <a href="{{ route('pagos.index') }}" class="btn btn-secondary ">
                    Cancelar
                </a>
                <div class="modal fade" id="modal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Confirmar Creación</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <p>¿Está seguro que desea guardar este nuevo pago?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default pull-left"
                                    data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Guardar</button>
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
    Añadir Pago
</div>
<!-- /.card-footer-->
</div>

@stop
@section('js')
   
<script>// Agrega un 'event listener' al documento para escuchar eventos de teclado
document.addEventListener('keydown', function(event) {
    if (event.key === "Home") { // Verifica si la tecla presionada es 'F1'
        window.location.href = '/dashboard'; // Redirecciona a '/dashboard'
    }
});</script>
@stop