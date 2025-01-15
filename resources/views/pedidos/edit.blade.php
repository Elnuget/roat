@extends('adminlte::page')

@section('title', 'Editar Pedido')

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
            <h3 class="card-title">Editar Pedido #{{ $pedido->numero_orden }}</h3>
        </div>

        <div class="card-body">
            <form action="{{ route('pedidos.update', $pedido->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Información Básica --}}
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Información Básica</h3>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="fecha">Fecha</label>
                                <input type="date" name="fecha" class="form-control" 
                                    value="{{ $pedido->fecha ? $pedido->fecha->format('Y-m-d') : '' }}">
                            </div>
                            <div class="col-md-6">
                                <label for="numero_orden">Número de Orden</label>
                                <input type="number" name="numero_orden" class="form-control" value="{{ $pedido->numero_orden }}">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Datos del Cliente --}}
                <div class="card collapsed-card">
                    <div class="card-header">
                        <h3 class="card-title">Datos Personales</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        {{-- Fila 2 --}}
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="fact" class="form-label">Factura</label>
                                <input type="text" class="form-control" id="fact" name="fact"
                                       value="{{ $pedido->fact }}">
                            </div>
                            <div class="col-md-6">
                                <label for="cliente" class="form-label">Cliente</label>
                                <input type="text" class="form-control" id="cliente" name="cliente"
                                       value="{{ $pedido->cliente }}">
                            </div>
                        </div>

                        {{-- Fila 3 --}}
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label for="examen_visual" class="form-label">Examen Visual</label>
                                <input type="number" class="form-control form-control-sm" id="examen_visual" name="examen_visual"
                                       value="{{ $pedido->examen_visual }}">
                            </div>
                            <div class="col-md-3">
                                <label for="examen_visual_descuento" class="form-label">Descuento Examen (%)</label>
                                <input type="number" class="form-control form-control-sm" id="examen_visual_descuento"
                                       name="examen_visual_descuento" min="0" max="100" value="{{ $pedido->examen_visual_descuento }}">
                            </div>
                            <div class="col-md-3">
                                <label for="celular" class="form-label">Celular</label>
                                <input type="text" class="form-control" id="celular" name="celular"
                                       value="{{ $pedido->celular }}">
                            </div>
                            <div class="col-md-3">
                                <label for="correo_electronico" class="form-label">Correo Electrónico</label>
                                <input type="email" class="form-control" id="correo_electronico" name="correo_electronico"
                                       value="{{ $pedido->correo_electronico }}">
                            </div>
                        </div>

                        {{-- Nueva fila para paciente --}}
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="paciente" class="form-label">Paciente</label>
                                <input type="text" class="form-control" id="paciente" name="paciente" value="{{ $pedido->paciente }}">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Armazón y Accesorios --}}
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Armazón y Accesorios</h3>
                    </div>
                    <div class="card-body">
                        <div id="armazones-container">
                            @foreach($pedido->inventarios as $index => $inventario)
                            <div class="armazon-section mb-3">
                                @if($index > 0)
                                    <hr>
                                @endif
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Armazón (Inventario)</label>
                                        <select name="a_inventario_id[]" class="form-control">
                                            <option value="">Seleccione un armazón</option>
                                            @foreach($inventarioItems as $item)
                                                <option value="{{ $item->id }}" 
                                                    {{ $inventario->id == $item->id ? 'selected' : '' }}>
                                                    {{ $item->codigo }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-6">
                                        <label>Precio</label>
                                        <input type="number" name="a_precio[]" class="form-control" 
                                            value="{{ $inventario->pivot->precio }}" step="0.01">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Descuento (%)</label>
                                        <input type="number" name="a_precio_descuento[]" class="form-control" 
                                            value="{{ $inventario->pivot->descuento }}" min="0" max="100">
                                    </div>
                                </div>
                                @if($index > 0)
                                    <div class="row mt-2">
                                        <div class="col-12 text-right">
                                            <button type="button" class="btn btn-danger btn-sm remove-armazon">
                                                Eliminar Armazón
                                            </button>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            @endforeach
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <button type="button" class="btn btn-success" id="add-armazon">
                                    Agregar Armazón
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Lunas --}}
                <div id="lunas-container" class="card collapsed-card">
                    <div class="card-header">
                        <h3 class="card-title">Lunas</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        @foreach($pedido->lunas as $index => $luna)
                            <div class="luna-section {{ $index > 0 ? 'mt-4' : '' }}">
                                @if($index > 0)
                                    <hr>
                                    <div class="d-flex justify-content-end">
                                        <button type="button" class="btn btn-danger btn-sm remove-luna" onclick="this.closest('.luna-section').remove(); calculateTotal();">
                                            <i class="fas fa-times"></i> Eliminar
                                        </button>
                                    </div>
                                @endif
                                
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Lunas Medidas</label>
                                        <input type="text" class="form-control" name="l_medida[]" value="{{ $luna->l_medida }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Lunas Detalle</label>
                                        <input type="text" class="form-control" name="l_detalle[]" value="{{ $luna->l_detalle }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label class="form-label">Tipo de Lente</label>
                                        <input type="text" class="form-control" name="tipo_lente[]" 
                                               list="tipo_lente_options" value="{{ $luna->tipo_lente }}"
                                               placeholder="Seleccione o escriba un tipo de lente">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Material</label>
                                        <input type="text" class="form-control" name="material[]" 
                                               list="material_options" value="{{ $luna->material }}"
                                               placeholder="Seleccione o escriba un material">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Filtro</label>
                                        <input type="text" class="form-control" name="filtro[]" 
                                               list="filtro_options" value="{{ $luna->filtro }}"
                                               placeholder="Seleccione o escriba un filtro">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-3">
                                        <label class="form-label">Precio Lunas</label>
                                        <input type="number" class="form-control input-sm" name="l_precio[]"
                                               value="{{ $luna->l_precio }}" step="0.01" oninput="calculateTotal()">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Desc. Lunas (%)</label>
                                        <input type="number" class="form-control input-sm" name="l_precio_descuento[]"
                                               value="{{ $luna->l_precio_descuento }}" min="0" max="100" oninput="calculateTotal()">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="card-footer">
                        <button type="button" class="btn btn-success" onclick="duplicateLunas()">Agregar más Lunas</button>
                    </div>
                </div>

                {{-- Compra Rápida --}}
                <div class="card collapsed-card">
                    <div class="card-header">
                        <h3 class="card-title">Compra Rápida</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="valor_compra" class="form-label">Valor de Compra</label>
                                <input type="number" class="form-control input-sm" id="valor_compra" name="valor_compra" value="{{ $pedido->valor_compra }}">
                            </div>
                            <div class="col-md-6">
                                <label for="motivo_compra" class="form-label">Motivo de Compra</label>
                                <input type="text" class="form-control" id="motivo_compra" name="motivo_compra" 
                                       list="motivo_compra_options" placeholder="Seleccione o escriba un motivo" value="{{ $pedido->motivo_compra }}">
                                <datalist id="motivo_compra_options">
                                    <option value="Líquidos">
                                    <option value="Accesorios">
                                    <option value="Estuches">
                                    <option value="Otros">
                                </datalist>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Total y Botones --}}
                <div class="card">
                    <div class="card-body">
                        {{-- Fila 8 --}}
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="total" class="form-label" style="color: red;">Total</label>
                                <input type="number" class="form-control input-sm" id="total" name="total"
                                       value="{{ $pedido->total }}" readonly>
                            </div>
                        </div>

                        {{-- Fila oculta (Saldo) --}}
                        <div class="row mb-3" style="display: none;">
                            <div class="col-md-12">
                                <label for="saldo" class="form-label">Saldo</label>
                                <input type="number" class="form-control" id="saldo" name="saldo"
                                       value="{{ $pedido->saldo }}">
                            </div>
                        </div>

                        {{-- Botones y Modal --}}
                        <div class="d-flex justify-content-start">
                            <button type="button" class="btn btn-primary mr-2" data-toggle="modal" data-target="#modal">
                                Editar pedido
                            </button>
                            <a href="{{ route('pedidos.index') }}" class="btn btn-secondary">
                                Cancelar
                            </a>
                        </div>

                        <div class="modal fade" id="modal">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Editar pedido</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>¿Estás seguro que quiere editar el pedido?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default pull-left"
                                                data-dismiss="modal">Cancelar
                                        </button>
                                        <button type="submit" class="btn btn-primary">Editar pedido</button>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- /.card-body -->

    <div class="card-footer">
        Editar Pedido
    </div>
    <!-- /.card-footer-->
@stop

@section('js')
<script>
    document.getElementById('add-armazon').addEventListener('click', function() {
        const container = document.getElementById('armazones-container');
        const template = `
            <div class="armazon-section mb-3">
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <label>Armazón (Inventario)</label>
                        <select name="a_inventario_id[]" class="form-control">
                            <option value="">Seleccione un armazón</option>
                            @foreach($inventarioItems as $item)
                                <option value="{{ $item->id }}">{{ $item->codigo }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-6">
                        <label>Precio</label>
                        <input type="number" name="a_precio[]" class="form-control" value="0" step="0.01">
                    </div>
                    <div class="col-md-6">
                        <label>Descuento (%)</label>
                        <input type="number" name="a_precio_descuento[]" class="form-control" value="0" min="0" max="100">
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-12 text-right">
                        <button type="button" class="btn btn-danger btn-sm remove-armazon">
                            Eliminar Armazón
                        </button>
                    </div>
                </div>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', template);
    });

    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-armazon')) {
            e.target.closest('.armazon-section').remove();
        }
    });

    // Función para calcular el total
    function calculateTotal() {
        let total = 0;

        // Sumar examen visual
        const examenVisual = parseFloat(document.getElementById('examen_visual').value) || 0;
        const examenVisualDescuento = parseFloat(document.getElementById('examen_visual_descuento').value) || 0;
        total += examenVisual * (1 - (examenVisualDescuento / 100));

        // Sumar todos los armazones
        document.querySelectorAll('[name="a_precio[]"]').forEach((precioInput, index) => {
            const precio = parseFloat(precioInput.value) || 0;
            const descuento = parseFloat(document.querySelectorAll('[name="a_precio_descuento[]"]')[index]?.value) || 0;
            total += precio * (1 - (descuento / 100));
        });

        // Sumar lunas
        const lPrecio = parseFloat(document.getElementById('l_precio').value) || 0;
        const lPrecioDescuento = parseFloat(document.getElementById('l_precio_descuento').value) || 0;
        total += lPrecio * (1 - (lPrecioDescuento / 100));

        // Sumar accesorios
        document.querySelectorAll('[name="d_precio[]"]').forEach((precioInput, index) => {
            const precio = parseFloat(precioInput.value) || 0;
            const descuento = parseFloat(document.querySelectorAll('[name="d_precio_descuento[]"]')[index]?.value) || 0;
            total += precio * (1 - (descuento / 100));
        });

        // Sumar valor de compra rápida
        const valorCompra = parseFloat(document.getElementById('valor_compra').value) || 0;
        total += valorCompra;

        // Actualizar campos total y saldo
        document.getElementById('total').value = total.toFixed(2);
        document.getElementById('saldo').value = total.toFixed(2);
    }

    // Agregar event listeners para todos los campos que afectan al total
    document.addEventListener('DOMContentLoaded', function() {
        // Event listeners para campos existentes
        const fields = [
            'examen_visual', 'examen_visual_descuento',
            'l_precio', 'l_precio_descuento',
            'valor_compra'
        ];
        
        fields.forEach(field => {
            const element = document.getElementById(field);
            if (element) {
                element.addEventListener('input', calculateTotal);
            }
        });

        // Event listener para nuevos campos de armazones
        document.getElementById('armazones-container').addEventListener('input', function(e) {
            if (e.target.matches('[name="a_precio[]"], [name="a_precio_descuento[]"]')) {
                calculateTotal();
            }
        });

        // Event listener para nuevos campos de accesorios
        document.getElementById('accesorios-container').addEventListener('input', function(e) {
            if (e.target.matches('[name="d_precio[]"], [name="d_precio_descuento[]"]')) {
                calculateTotal();
            }
        });

        // Calcular total inicial
        calculateTotal();
    });

    // Mostrar todas las opciones del datalist al hacer clic en el input
    document.querySelectorAll('input[list]').forEach(input => {
        input.addEventListener('click', function() {
            this.setAttribute('list', this.getAttribute('list'));
        });
    });

    function duplicateAccesorios() {
        const container = document.getElementById('accesorios-container').querySelector('.card-body');
        const newItem = document.querySelector('.accesorio-item').cloneNode(true);
        // Clear the values in the cloned inputs
        newItem.querySelectorAll('input').forEach(input => input.value = '');
        newItem.querySelector('select').selectedIndex = 0;
        container.appendChild(newItem);
    }
</script>
@stop
