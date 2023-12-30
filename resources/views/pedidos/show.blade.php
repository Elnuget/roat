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
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
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
                    <li><strong>Paciente:</strong> {{ $pedido->paciente->nombre }}</li>
                    <li><strong>Examen Visual:</strong> {{ $pedido->examen_visual }}</li>
                    <li><strong>A Inventario:</strong> {{ $pedido->aInventario->codigo }}</li>
                 
                    <li><strong>A Precio:</strong> ${{ number_format($pedido->a_precio, 0, ',', '.') }}</li>
                    <li><strong>L Detalle:</strong> {{ $pedido->l_detalle }}</li>
                    <li><strong>L Medida:</strong> {{ $pedido->l_medida }}</li>
                    <li><strong>L Precio:</strong> ${{ number_format($pedido->l_precio, 0, ',', '.') }}</li>
                    <li><strong>D Inventario:</strong> {{ $pedido->dInventario->codigo }}</li>
                    <li><strong>D Precio:</strong> ${{ number_format($pedido->d_precio, 0, ',', '.') }}</li>
                    <li><strong>Total:</strong> ${{ number_format($pedido->total, 0, ',', '.') }}</li>
                    <li><strong>Saldo:</strong> ${{ number_format($pedido->saldo, 0, ',', '.') }}</li>
                </ul>
            </div>
        </div>

      {{--   <!-- /.card-body -->
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
            <table id="example" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <td>Codigo</td>
                        <td>Descripcion</td>
                        <td>Unidades</td>
                        <td>Unitario</td>
                        <td>I.V.A.</td>
                        <td>Total</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($detalleVentas as $d)
                        <tr>
                            <th>{{ $d->Producto->cod_interno }}</th>
                            <td>{{ $d->Producto->descripcion }}</td>
                            <td>{{ number_format($d->cantidad, 0, ',', '.') }}</td>
                            <td>${{ number_format($d->precio_neto, 0, ',', '.') }}</td>
                            <td>${{ number_format($d->precio_imp, 0, ',', '.') }}</td>
                            <td>${{ number_format(($d->precio_neto + $d->precio_imp) * $d->cantidad, 0, ',', '.') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <br />
        </div> --}}
    @stop

    @section('js')
    
        <script>
            $(document).ready(function() {
                $("#example").DataTable({
                    order: [
                        [0, "desc"]
                    ],
                    columnDefs: [{
                        targets: [2],
                        visible: true,
                        searchable: true,
                    }, ],
                    dom: 'Bfrtip',
                    buttons: [
                        'excelHtml5',
                        'csvHtml5',

                        {
                            extend: 'print',
                            text: 'Imprimir',
                            autoPrint: true,

                            customize: function(win) {
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
        </script>
    @stop