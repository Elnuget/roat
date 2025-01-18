@extends('adminlte::page')

@section('title', 'Admin Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
    <p>Funcionalidades Varias</p>
    @if (session('php_error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error:</strong> {{ session('php_error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

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
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Pedidos Recientes</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="pedidosTable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Cliente</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @isset($pedidos)
                            @foreach ($pedidos as $pedido)
                                <tr>
                                    <td>{{ $pedido->fecha }}</td>
                                    <td>{{ $pedido->cliente }}</td>
                                    <td>{{ number_format($pedido->total, 2, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        @endisset
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header">
            <h3 class="card-title">Total de Ventas por Año</h3>
        </div>
        <div class="card-body">
            <canvas id="salesChart"></canvas>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header">
            <h3 class="card-title">Seleccionar Año</h3>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('dashboard') }}">
                <div class="form-group">
                    <label for="year">Año:</label>
                    <select name="year" id="year" class="form-control" onchange="this.form.submit()">
                        @isset($salesData)
                            @foreach ($salesData['years'] as $year)
                                <option value="{{ $year }}" {{ $year == ($selectedYear ?? '') ? 'selected' : '' }}>{{ $year }}</option>
                            @endforeach
                        @endisset
                    </select>
                </div>
            </form>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header">
            <h3 class="card-title">Total de Ventas por Mes en {{ $selectedYear ?? date('Y') }}</h3>
        </div>
        <div class="card-body">
            <canvas id="monthlySalesChart"></canvas>
        </div>
    </div>
@stop

@section('js')
    @include('atajos')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        $(document).ready(function () {
            $('#pedidosTable').DataTable({
                "order": [[0, "desc"]],
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                }
            });

            @if(isset($salesData))
                var salesData = @json($salesData);
                var ctx = document.getElementById('salesChart').getContext('2d');
                var salesChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: salesData.years,
                        datasets: [{
                            label: 'Total de Ventas',
                            data: salesData.totals,
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            @endif

            @if(isset($salesDataMonthly))
                var monthlySalesData = @json($salesDataMonthly);
                var ctxMonthly = document.getElementById('monthlySalesChart').getContext('2d');
                var monthlySalesChart = new Chart(ctxMonthly, {
                    type: 'bar',
                    data: {
                        labels: monthlySalesData.months,
                        datasets: [{
                            label: 'Total de Ventas',
                            data: monthlySalesData.totals,
                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            @endif
        });
    </script>
@stop
