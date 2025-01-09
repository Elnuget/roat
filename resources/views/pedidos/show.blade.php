@extends('adminlte::page')

@section('title', 'Ver Venta')

@section('content_header')
<h2>Ver Venta </h2>
@stop

@section('content')
<br>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            Venta {{ $pedido->id }}</h3>
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
            <ul>
                <!-- Reemplazar los siguientes campos con los de tu modelo -->
                <li><strong>Fecha:</strong> {{ date('d-m-Y', strtotime($pedido->fecha)) }}</li>
                <li><strong>Número de Orden:</strong> {{ $pedido->numero_orden }}</li>
                <li><strong>Factura:</strong> {{ $pedido->fact }}</li>
                <li><strong>Cliente:</strong> {{ $pedido->cliente }}</li>
                <li><strong>Celular:</strong> {{ $pedido->celular }}</li>
                <li><strong>Correo Electrónico:</strong> {{ $pedido->correo_electronico }}</li>
                <li><strong>Examen Visual:</strong> {{ $pedido->examen_visual }}</li>
                <li><strong>Armazón:</strong> {{ $pedido->aInventario->codigo }}</li>
                @php
                    // Armazón
                    $armazonBase = round($pedido->a_precio / 1.15, 2);
                    $armazonIva = round($pedido->a_precio - $armazonBase, 2);
                    
                    // Lunas
                    $lunasBase = round($pedido->l_precio / 1.15, 2);
                    $lunasIva = round($pedido->l_precio - $lunasBase, 2);
                    
                    // Accesorio
                    $accesorioBase = round($pedido->d_precio / 1.15, 2);
                    $accesorioIva = round($pedido->d_precio - $accesorioBase, 2);
                @endphp
                <li><strong>Precio Armazón:</strong> ${{ number_format($pedido->a_precio, 2, ',', '.') }}
                    <span style="color: red;">
                        (Base: ${{ number_format($armazonBase, 2, ',', '.') }})
                        (IVA: ${{ number_format($armazonIva, 2, ',', '.') }})
                    </span>
                </li>
                <li><strong>Lunas Detalle:</strong> {{ $pedido->l_detalle }}</li>
                <li><strong>Lunas Medidas:</strong> {{ $pedido->l_medida }}</li>
                <li><strong>Tipo de Lente:</strong> {{ $pedido->tipo_lente }}</li>
                <li><strong>Material:</strong> {{ $pedido->material }}</li>
                <li><strong>Filtro:</strong> {{ $pedido->filtro }}</li>
                <li><strong>Precio Lunas:</strong> ${{ number_format($pedido->l_precio, 2, ',', '.') }}
                    <span style="color: red;">
                        (Base: ${{ number_format($lunasBase, 2, ',', '.') }})
                        (IVA: ${{ number_format($lunasIva, 2, ',', '.') }})
                    </span>
                </li>
                <li><strong>Accesorio:</strong> {{ $pedido->dInventario->codigo }}</li>
                <li><strong>Accesorio Precio:</strong> ${{ number_format($pedido->d_precio, 2, ',', '.') }}
                    <span style="color: red;">
                        (Base: ${{ number_format($accesorioBase, 2, ',', '.') }})
                        (IVA: ${{ number_format($accesorioIva, 2, ',', '.') }})
                    </span>
                </li>
                <li><strong>Total:</strong> ${{ number_format($pedido->total, 2, ',', '.') }}</li>
                <li><strong>Saldo:</strong> ${{ number_format($pedido->saldo, 2, ',', '.') }}</li>
            </ul>
        </div>
    </div>

     <!-- /.card-body -->
    <div class="card-footer">
        Venta
    </div>
    <!-- /.card-footer-->
</div>
<br>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            Detalle pedido {{ $pedido->id }}</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                title="Collapse">
                <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fas fa-times"></i></button>
        </div>
    </div>
    <div class="card-body">
        <table id="example" class="table table-striped table-bordered table-responsive">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Orden</th>
                    <th>Factura</th>
                    <th>Cliente</th>
                    <th>Celular</th>
                    <th>Correo Electrónico</th>
                    <th>Examen Visual</th>
                    <th>Armazón</th>
                    <th>Precio Armazón</th>
                    <th>Lunas Medidas</th>
                    <th>Lunas Detalle</th>
                    <th>Tipo de Lente</th>
                    <th>Material</th>
                    <th>Filtro</th>
                    <th>Precio Lunas</th>
                    <th>Accesorio</th>
                    <th>Precio Accesorio</th>
                    <th>Total</th>
                    <th>Saldo</th>
                    
                </tr>
            </thead>
            <tbody>
                
                <tr>
                    <td>{{ $pedido->fecha }}</td>
                    <td>{{ $pedido->numero_orden }}</td>
                    <td>{{ $pedido->fact }}</td>
                    <td>{{ $pedido->cliente }}</td>
                    <td>{{ $pedido->celular }}</td>
                    <td>{{ $pedido->correo_electronico }}</td>
                    <td>{{ $pedido->examen_visual }}</td>
                    <td>{{ $pedido->aInventario->codigo ?? 'N/A' }}</td> <!-- Mostrar el nombre del objeto A -->
                    <td>{{ $pedido->a_precio }}</td>
                    <td>{{ $pedido->l_medida }}</td>
                    <td>{{ $pedido->l_detalle }}</td>
                    <td>{{ $pedido->tipo_lente }}</td>
                    <td>{{ $pedido->material }}</td>
                    <td>{{ $pedido->filtro }}</td>
                    <td>{{ $pedido->l_precio }}</td>
                    <td>{{ $pedido->dInventario->codigo ?? 'N/A' }}</td>
                    <!-- Mostrar el nombre del objeto D -->
                    <td>{{ $pedido->d_precio }}</td>
                    <td>{{ $pedido->total }}</td>
                    <td>{{ $pedido->saldo }}</td>
                </tr>
               
            </tbody>
        </table>
        <br />
    </div> 
    @stop

    @section('js')

    <script>
        $(document).ready(function () {
            $("#example").DataTable({
                order: [
                    [0, "desc"]
                ],
                columnDefs: [{
                    targets: [2],
                    visible: true,
                    searchable: true,
                },],
                dom: 'Bfrtip',
                buttons: [
                    'excelHtml5',
                    'csvHtml5',

                    {
                        extend: 'print',
                        text: 'Imprimir',
                        autoPrint: true,

                        customize: function (win) {
                            $(win.document.body).css('font-size', '16pt');
                            $(win.document.body).find('table')
                                .addClass('compact')
                                .css('font-size', 'inherit');
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        text: 'PDF',
                        filename: 'Venta.pdf',

                        title: 'Venta {{ $pedido->id }}',
                        pageSize: 'LETTER',
                    }
                ],
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json",
                },
            });
        });
        // Agrega un 'event listener' al documento para escuchar eventos de teclado
document.addEventListener('keydown', function(event) {
    if (event.key === "Home") { // Verifica si la tecla presionada es 'F1'
        window.location.href = '/dashboard'; // Redirecciona a '/dashboard'
    }
});

    </script>
    @stop