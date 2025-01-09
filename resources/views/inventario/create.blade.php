@extends('adminlte::page')

@section('title', 'Crear Articulo')

@section('content_header')
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
    <br>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Crear Articulo</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
                    <i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fas fa-times"></i></button>
            </div>
        </div>
        <div class="card-body">
            <div class="col-md-10">
                <form role="form" action="{{ route('inventario.store') }}" method="POST">
                    @csrf

                    <div class="form-group row">
                        <div class="col-12">
                            <label>Fecha</label>
                            <input name="fecha" required type="date" class="form-control" value="{{ now()->format('Y-m-d') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-6">
                            <label>Lugar</label>
                            <select id="lugar" name="lugar" class="form-control">
                                <option value="Soporte">Soporte</option>
                                <option value="Vitrina">Vitrina</option>
                                <option value="Estuches">Estuches</option>
                                <option value="Cosas Extras">Cosas Extras</option>
                                <option value="Armazones Extras">Armazones Extras</option>
                                <option value="Líquidos">Líquidos</option>
                                <option value="Goteros">Goteros</option>
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
                            <input name="codigo" id="codigo" required type="text" class="form-control">
                        </div>
                        
                    </div>

                    <div class="form-goup row">
                        <div class="col-4">
                            <label>Cantidad</label>
                            <input name="cantidad" id="cantidad" required type="number" class="form-control">
                        </div>
                    </div>

                    <br>


                    <button type="button" class="btn btn-primary pull-left" data-toggle="modal" data-target="#modal">Crear
                        Articulo</button>
                        <a href="{{ route('inventario.index') }}" class="btn btn-secondary ">
                            Cancelar
                        </a>
                    <div class="modal fade" id="modal">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">

                                    <h4 class="modal-title">Crear Articulo</h4>
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
        Crear Articulo
    </div>
    <!-- /.card-footer-->
    </div>

@stop

@section('js')

<script>// Agrega un 'event listener' al documento para escuchar eventos de teclado
document.addEventListener('keydown', function(event) {
    if (event.key === "Home") { // Verifica si la tecla presionada es 'Inicio'
        window.location.href = '/dashboard'; // Redirecciona a '/dashboard'
    }
});

document.addEventListener('DOMContentLoaded', function() {
    const lugarSelect = document.getElementById('lugar');
    const numeroLugarInput = document.getElementById('numero_lugar');

    lugarSelect.addEventListener('change', function() {
        const lugar = this.value;
        if(lugar) {
            fetch(`/inventario/lugares/${lugar}`)
                .then(res => res.json())
                .then(data => {
                    // Clear existing value
                    numeroLugarInput.value = '';
                    // If you want a dropdown, replace input with a select or similar
                    // For now, just pick the first option or keep it empty
                    if(data.length > 0) {
                        numeroLugarInput.value = data[0]; 
                    }
                })
                .catch(err => console.error(err));
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
