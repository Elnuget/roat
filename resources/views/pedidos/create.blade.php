@extends('adminlte::page')

@section('title', 'Agregar venta')

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
{{-- Mostrar mensajes de error --}}
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

{{-- Mostrar mensajes de error específicos de la base de datos --}}
@if (session('db_error'))
<div class="alert alert-danger">
    {{ session('db_error') }}
</div>
@endif
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
            <form action="{{ route('pedidos.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="fecha" class="form-label">Fecha</label>
                    <input type="date" class="form-control" id="fecha" name="fecha" required>
                </div>

                <div class="mb-3">
                    <label for="numero_orden" class="form-label">Orden</label>
                    <input type="number" class="form-control" id="numero_orden" name="numero_orden" required>
                </div>

                <div class="mb-3">
                    <label for="fact" class="form-label">Factura</label>
                    <input type="text" class="form-control" id="fact" name="fact" required>
                </div>

                <div class="mb-3">
                    <label for="paciente_id" class="form-label">Paciente</label>
                    <select class="form-control" id="paciente_id" name="paciente_id" required>
                        <option value="">Seleccione un Paciente</option>
                        @foreach($pacientes as $paciente)
                        <option value="{{ $paciente->id }}">{{ $paciente->nombre }}</option>
                        @endforeach
                    </select>
                </div>


                <div class="mb-3">
                    <label for="examen_visual" class="form-label">Examen Visual</label>
                    <input type="number" class="form-control" id="examen_visual" name="examen_visual" required>
                </div>

                <div class="mb-3">
                    <label for="a_inventario_id" class="form-label">Armazón</label>
                    <select class="form-control" id="a_inventario_id" name="a_inventario_id">
                        <option value="">Seleccione un Item del Inventario</option>
                        @foreach($inventarioItems as $item)
                        <!-- Asegúrate de pasar esta variable desde el controlador -->
                        <option value="{{ $item->id }}">{{ $item->codigo }}</option>
                        <!-- Asumiendo que el modelo Inventario tiene un campo 'nombre' -->
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="a_precio" class="form-label">Precio Armazón</label>
                    <input type="number" class="form-control" id="a_precio" name="a_precio">
                </div>

                <div class="mb-3">
                    <label for="l_medida" class="form-label">Lunas Medidas</label>
                    <input type="text" class="form-control" id="l_medida" name="l_medida">
                </div>

                <div class="mb-3">
                    <label for="l_detalle" class="form-label">Lunas Detalle</label>
                    <input type="text" class="form-control" id="l_detalle" name="l_detalle">
                </div>

                <div class="mb-3">
                    <label for="l_precio" class="form-label">Precio Lunas</label>
                    <input type="number" class="form-control" id="l_precio" name="l_precio">
                </div>

                <div class="mb-3">
                    <label for="d_inventario_id" class="form-label">Accesorio</label>
                    <select class="form-control" id="d_inventario_id" name="d_inventario_id">
                        <option value="">Seleccione un Item del Inventario</option>
                        @foreach($inventarioItems as $item) <!-- Utiliza la misma lista de items del inventario -->
                        <option value="{{ $item->id }}">{{ $item->codigo }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="d_precio" class="form-label">Precio Accesorio</label>
                    <input type="number" class="form-control" id="d_precio" name="d_precio">
                </div>

                <div class="mb-3">
                    <label for="total" class="form-label">Total</label>
                    <input type="number" class="form-control" id="total" name="total" required>
                </div>
                <div class="mb-3" style="display: none;">
                    <label for="total" class="form-label">Saldo</label>
                    <input type="number" class="form-control" id="saldo" name="saldo" required>
                </div>
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="{{ route('pedidos.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>

        <br>
        <!-- Fin contenido -->
    </div>
</div>
<!-- /.card-body -->
<div class="card-footer">
    Añadir Pedido
</div>
<!-- /.card-footer-->
</div>

@stop
@section('js')
   
<script>
    function calculateTotal() {
        var examenVisual = parseFloat(document.getElementById('examen_visual').value) || 0;
        var aPrecio = parseFloat(document.getElementById('a_precio').value) || 0;
        var dPrecio = parseFloat(document.getElementById('d_precio').value) || 0;
        var lPrecio = parseFloat(document.getElementById('l_precio').value) || 0;

        var total = examenVisual + aPrecio + dPrecio + lPrecio;

        document.getElementById('total').value = total.toFixed(2); // Redondeo a 2 decimales
        // Asignar el mismo valor a saldo
        document.getElementById('saldo').value = total.toFixed(2);
    }

    document.getElementById('examen_visual').addEventListener('input', calculateTotal);
    document.getElementById('a_precio').addEventListener('input', calculateTotal);
    document.getElementById('d_precio').addEventListener('input', calculateTotal);
    document.getElementById('l_precio').addEventListener('input', calculateTotal);
    // Agrega un 'event listener' al documento para escuchar eventos de teclado
document.addEventListener('keydown', function(event) {
    if (event.key === "Home") { // Verifica si la tecla presionada es 'F1'
        window.location.href = '/dashboard'; // Redirecciona a '/dashboard'
    }
});

</script>

@stop