@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Atajos del Sistema</h3>
           
        </div>
        <div class="card-body">
            <p>Información sobre los atajos del sistema que desees destacar.</p>

           
            <ul class="list-group">
                <li class="list-group-item"><strong>Dashboard/Inicio::</strong> (Tecla de Inicio)</li>
                <li class="list-group-item"><strong>Anterior:</strong> (Tecla ALT + Tecla de flecha dirección <-)</li>
                <li class="list-group-item"><strong>Siguiente:</strong> (Tecla ALT + Tecla de flecha dirección ->)</li>
                <li class="list-group-item"><strong>Dashboard/Inicio:</strong> (Tecla número 1)</li>
                <li class="list-group-item"><strong>Admin:</strong> (Tecla número  2)</li>
                <li class="list-group-item"><strong>Pedidos:</strong> (Tecla número  3)</li>
                <li class="list-group-item"><strong>Pacientes:</strong> (Tecla número  4)</li>
                <li class="list-group-item"><strong>Inventario:</strong> (Tecla número  5)</li>
                <li class="list-group-item"><strong>Pago:</strong> (Tecla número  6)</li>
                <li class="list-group-item"><strong>Usuarios:</strong> (Tecla número  7)</li>
                <li class="list-group-item"><strong>Medio de pago:</strong> (Tecla número  8)</li>
            </ul>
        </div>
    </div>
@stop

@section('css')
    <!-- CSS personalizado aquí -->
@stop

@section('js')
    @include('atajos')
@stop