@extends('adminlte::page')

@section('title', 'Editar venta')

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
            <h3 class="card-title">Editar Pago</h3>

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
                <form action="{{ route('pedidos.update', $pedido->id) }}" method="POST">
                    @csrf
                    @method('PUT') {{-- Agregado para indicar que es una solicitud de actualización --}}

                    <div class="mb-3">
                        <label for="fecha" class="form-label">Fecha</label>
                        <input type="date" class="form-control" id="fecha" name="fecha"
                            value="{{ $pedido->fecha }}" required>
                    </div>



                    <div class="mb-3">
                        <label for="numero_orden" class="form-label">Número de Orden</label>
                        <input type="number" class="form-control" id="numero_orden" name="numero_orden"
                            value="{{ $pedido->numero_orden }}" required>
                    </div>



                    <div class="mb-3">
                        <label for="fact" class="form-label">Fact</label>
                        <input type="text" class="form-control" id="fact" name="fact" value="{{ $pedido->fact }}"
                            required>
                    </div>



                    <div class="mb-3">
                        <label for="paciente_id" class="form-label">Paciente</label>
                        <select class="form-control" id="paciente_id" name="paciente_id" required>
                            <option value="">Seleccione un Paciente</option>
                            @foreach ($pacientes as $paciente)
                                <option value="{{ $paciente->id }}"
                                    {{ $pedido->paciente_id == $paciente->id ? 'selected' : '' }}>{{ $paciente->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>



                    <div class="mb-3">
                        <label for="examen_visual" class="form-label">Examen Visual</label>
                        <input type="number" class="form-control" id="examen_visual" name="examen_visual"
                            value="{{ $pedido->examen_visual }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="a_inventario_id" class="form-label">Item A del Inventario</label>
                        <select class="form-control" id="a_inventario_id" name="a_inventario_id">
                            <option value="">Seleccione un Item del Inventario</option>
                            @foreach ($inventarioItems as $item)
                                <option value="{{ $item->id }}"
                                    {{ $pedido->a_inventario_id == $item->id ? 'selected' : '' }}>{{ $item->codigo }}
                                </option>
                            @endforeach
                        </select>
                    </div>



                    <div class="mb-3">
                        <label for="a_precio" class="form-label">Precio A</label>
                        <input type="number" class="form-control" id="a_precio" name="a_precio"
                            value="{{ $pedido->a_precio }}">
                    </div>

                    <div class="mb-3">
                        <label for="l_medida" class="form-label">Medida L</label>
                        <input type="text" class="form-control" id="l_medida" name="l_medida"
                            value="{{ $pedido->l_medida }}">
                    </div>

                    <div class="mb-3">
                        <label for="l_detalle" class="form-label">Detalle L</label>
                        <input type="text" class="form-control" id="l_detalle" name="l_detalle"
                            value="{{ $pedido->l_detalle }}">
                    </div>

                    <div class="mb-3">
                        <label for="l_precio" class="form-label">Precio L</label>
                        <input type="number" class="form-control" id="l_precio" name="l_precio"
                            value="{{ $pedido->l_precio }}">
                    </div>

                    <div class="mb-3">
                        <label for="d_inventario_id" class="form-label">Item D del Inventario</label>
                        <select class="form-control" id="d_inventario_id" name="d_inventario_id">
                            <option value="">Seleccione un Item del Inventario</option>
                            @foreach ($inventarioItems as $item)
                                <!-- Utiliza la misma lista de items del inventario -->
                                <option value="{{ $item->id }}"
                                    {{ $pedido->d_inventario_id == $item->id ? 'selected' : '' }}>{{ $item->codigo }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="d_precio" class="form-label">Precio D</label>
                        <input type="number" class="form-control" id="d_precio" name="d_precio"
                            value="{{ $pedido->d_precio }}">
                    </div>


                    <div class="mb-3">
                        <label for="total" class="form-label">Total</label>
                        <input type="number" class="form-control" id="total" name="total"
                            value="{{ $pedido->total }}" required>
                    </div>

                    <div class="mb-3" style="display: none;">
                        <label for="saldo" class="form-label">Saldo</label>
                        <input type="number" class="form-control" id="saldo" name="saldo"
                            value="{{ $pedido->saldo }}" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a href="{{ route('pedidos.index') }}" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        Editar Pedido
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
    </script>

@stop
