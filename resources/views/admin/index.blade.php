@extends('adminlte::page')

@section('title', 'Admin Dashboard')

@section('content_header')
    <h1>Dashboard de Rutas</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Rutas más utilizadas</h3>
                </div>
                <div class="card-body">
                    <canvas id="routesChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tráfico por hora del día</h3>
                </div>
                <div class="card-body">
                    <canvas id="trafficChart"></canvas>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Datos mock para rutas más utilizadas
        const routesData = {
            labels: ['Ruta A', 'Ruta B', 'Ruta C', 'Ruta D', 'Ruta E'],
            datasets: [{
                label: 'Número de viajes',
                data: [150, 120, 90, 60, 30],
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        };

        // Datos mock para tráfico por hora
        const trafficData = {
            labels: ['6am', '9am', '12pm', '3pm', '6pm', '9pm'],
            datasets: [{
                label: 'Usuarios por hora',
                data: [20, 80, 60, 70, 90, 30],
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1,
                tension: 0.4,
                type: 'line'
            }]
        };

        // Renderizar gráficos
        new Chart('routesChart', {
            type: 'bar',
            data: routesData,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        new Chart('trafficChart', {
            type: 'line',
            data: trafficData,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@stop