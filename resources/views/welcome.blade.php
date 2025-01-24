@extends('adminlte::page')

@section('title', 'Bienvenido')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h3 class="card-title">
                    <i class="fas fa-hand-paper"></i> ¡Bienvenido {{ Auth::user()->name }}!
                </h3>
            </div>
            <div class="card-body">
                <div class="text-center mb-4">
                    <i class="fas fa-road fa-4x text-primary mb-3"></i>
                </div>
                <p class="lead text-center">
                    En esta aplicación podrás crear y gestionar hojas de ruta para tu empresa.
                    Organiza de manera eficiente los recorridos y mantén un control detallado de cada viaje.
                </p>
                <hr>
                <div class="text-center">
                    <p>
                        <i class="fas fa-info-circle text-info"></i>
                        Utiliza el menú lateral para acceder a todas las funcionalidades del sistema.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
