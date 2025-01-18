@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class="text-primary"><i class="fas fa-home"></i> Bienvenido al Sistema de Gestión ÓPTICA</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12 mb-4">
            <div class="card bg-gradient-info">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-info-circle"></i> Guía Rápida de Atajos del Sistema</h5>
                    <p class="card-text">Utiliza las siguientes teclas para navegar rápidamente por el sistema:</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="small-box bg-primary">
                <div class="inner">
                    <h4>Navegación Principal</h4>
                    <ul class="list-unstyled">
                        <li><strong>Tecla [Home] o [1]:</strong> Dashboard</li>
                        <li><strong>Tecla [2]:</strong> Panel Admin</li>
                        <li><strong>Tecla [3]:</strong> Gestión de Pedidos</li>
                    </ul>
                </div>
                <div class="icon">
                    <i class="fas fa-compass"></i>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="small-box bg-success">
                <div class="inner">
                    <h4>Gestión de Clientes</h4>
                    <ul class="list-unstyled">
                        <li><strong>Tecla [4]:</strong> Pacientes</li>
                        <li><strong>Tecla [5]:</strong> Inventario</li>
                        <li><strong>Tecla [6]:</strong> Pagos</li>
                    </ul>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h4>Configuración</h4>
                    <ul class="list-unstyled">
                        <li><strong>Tecla [7]:</strong> Usuarios</li>
                        <li><strong>Tecla [8]:</strong> Medios de Pago</li>
                    </ul>
                </div>
                <div class="icon">
                    <i class="fas fa-cog"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-secondary">
                    <h3 class="card-title"><i class="fas fa-star"></i> Funciones Destacadas</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="info-box">
                                <span class="info-box-icon bg-info"><i class="fas fa-glasses"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Gestión de Pedidos</span>
                                    <small>Control de órdenes y estados</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="info-box">
                                <span class="info-box-icon bg-success"><i class="fas fa-user-md"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Pacientes</span>
                                    <small>Historial y seguimiento</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="info-box">
                                <span class="info-box-icon bg-warning"><i class="fas fa-box"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Inventario</span>
                                    <small>Control de stock</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="info-box">
                                <span class="info-box-icon bg-danger"><i class="fas fa-credit-card"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Pagos</span>
                                    <small>Gestión de cobros</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <style>
        .small-box {
            border-radius: 15px;
            transition: transform 0.3s;
        }
        .small-box:hover {
            transform: translateY(-5px);
        }
        .info-box {
            border-radius: 10px;
            transition: all 0.3s;
        }
        .info-box:hover {
            transform: scale(1.05);
        }
        .card {
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
    </style>
@stop

@section('js')
    @include('atajos')
    <script>
        $(document).ready(function() {
            // Animación inicial
            $('.small-box').hide().fadeIn(1000);
            $('.info-box').hide().fadeIn(1500);
        });
    </script>
@stop
