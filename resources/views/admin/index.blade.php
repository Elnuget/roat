@extends('adminlte::page')

@section('title', 'Admin Dashboard')

@section('content_header')
    <h1>Admin Dashboard</h1>
    <p>Funcionalidades Varias</p>
    <!-- Sección para mostrar mensajes de error de PHP -->
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
    <style>
        .related-cards {
            background-color: #6699cc;
            /* Cambia este color según tus preferencias */
        }
    </style>
    <div class="row related-cards">
        <!-- Espacio para tarjetas relacionadas -->
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card mt-4">
                <div class="card-header">
                    <h3 class="card-title">Total de Ventas por Año</h3>
                </div>
                <div class="card-body">
                    <canvas id="salesChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mt-4">
                <div class="card-header">
                    <h3 class="card-title">Total de Ventas por Mes en {{ $selectedYear }}</h3>
                </div>
                <div class="card-body">
                    <canvas id="monthlySalesChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Combobox para seleccionar el año -->
    <div class="card mt-4">
        <div class="card-header">
            <h3 class="card-title">Seleccionar Año</h3>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('admin.index') }}">
                <div class="form-group">
                    <label for="year">Año:</label>
                    <select name="year" id="year" class="form-control" onchange="this.form.submit()">
                        @foreach ($salesData['years'] as $year)
                            <option value="{{ $year }}" {{ $year == $selectedYear ? 'selected' : '' }}>{{ $year }}</option>
                        @endforeach
                    </select>
                </div>
            </form>
        </div>
    </div>

    <!-- Gráfico de ventas por usuario -->
    <div class="card mt-4">
        <div class="card-header">
            <h3 class="card-title">Total de Ventas por Usuario</h3>
        </div>
        <div class="card-body">
            <canvas id="userSalesChart"></canvas>
        </div>
    </div>

    <div class="card mt-4">
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
                        @foreach ($pedidos as $pedido)
                            <tr>
                                <td>{{ $pedido->fecha }}</td>
                                <td>{{ $pedido->cliente }}</td>
                                <td>{{ number_format($pedido->total, 2, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
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

            // Datos para el gráfico
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

            // Datos para el gráfico de ventas por mes
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

            // Datos para el gráfico de ventas por usuario
            var userSalesData = @json($userSalesData);

            var ctxUser = document.getElementById('userSalesChart').getContext('2d');
            var userSalesChart = new Chart(ctxUser, {
                type: 'bar',
                data: {
                    labels: userSalesData.users,
                    datasets: [{
                        label: 'Total de Ventas',
                        data: userSalesData.totals,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
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
        });
    </script>
@stop