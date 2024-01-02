@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Atajos del Sistema</h3>
            <!-- Línea para imprimir la fecha y hora actual -->
            
        </div>
        <div class="card-body">
            <!-- Contenido de los atajos del sistema aquí -->
            <p>Aquí puedes añadir información sobre los atajos del sistema que desees destacar.</p>
            
            <!-- Botón para ir al Dashboard -->
            <a href="/dashboard" class="btn btn-primary">Ir al Dashboard (Inicio)</a>
            <button class="btn btn-primary"> anterior (alt + <-)</button>
            <button class="btn btn-primary"> siguiente (alt + ->)</button>

        </div>
    </div>
@stop

@section('css')
    <!-- CSS personalizado aquí -->
@stop

@section('js')
<script>
 // Agrega un 'event listener' al documento para escuchar eventos de teclado
document.addEventListener('keydown', function(event) {
    if (event.key === "F1") { // Verifica si la tecla presionada es 'F1'
        window.location.href = '/dashboard'; // Redirecciona a '/dashboard'
    }
});
</script>
@stop
