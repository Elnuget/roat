@extends('adminlte::page')

@section('title', 'Ver Pago')

@section('content_header')
<h2>Ver Pago</h2>
@stop

@section('content')
<br>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            Pago {{ $pago->id }}</h3>
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
                <li><strong>ID:</strong> {{ $pago->id }}</li>
                <li><strong>Fecha de Pago:</strong> {{ $pago->created_at->format('d-m-Y') }}</li>
                <li><strong>Método de Pago:</strong> {{ $pago->mediodepago->medio_de_pago }}</li>
                <li><strong>Pedido ID:</strong> {{ $pago->pedido->id }}</li>
                <li><strong>Saldo del Pedido:</strong> {{ $pago->pedido->saldo }}</li>
                <li><strong>Pago:</strong> {{ $pago->pago }}</li>
            </ul>
        </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        Ver Pago
    </div>
    <!-- /.card-footer-->
</div>
<br>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            Detalle del Pago {{ $pago->id }}</h3>
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
                    <th>ID</th>
                    <th>Fecha de Pago</th>
                    <th>Método de Pago</th>
                    <th>Pedido ID</th>
                    <th>Saldo del Pedido</th>
                    <th>Pago</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $pago->id }}</td>
                    <td>{{ $pago->created_at->format('d-m-Y') }}</td>
                    <td>{{ $pago->mediodepago->medio_de_pago }}</td>
                    <td>{{ $pago->pedido->id }}</td>
                    <td>{{ $pago->pedido->saldo }}</td>
                    <td>{{ $pago->pago }}</td>
                </tr>
            </tbody>
        </table>
        <br />
    </div>
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
                    filename: 'Pago.pdf',

                    title: 'Pago {{ $pago->id }}',
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
