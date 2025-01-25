@extends('adminlte::page')
@section('title', 'Detalle de Hoja de Ruta')

@section('content_header')
<h1>Detalle de Hoja de Ruta</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <h3>Información General</h3>
        <p><strong>Empresa:</strong> {{ optional($hojaRuta->empresa)->nombre }}</p>
        <p><strong>Conductor:</strong> {{ optional($hojaRuta->conductor)->nombre }}</p>
        <p><strong>Fecha Inicio:</strong> {{ $hojaRuta->fecha_inicio }}</p>
        <p><strong>Fecha Fin:</strong> {{ $hojaRuta->fecha_fin }}</p>
        <p><strong>Kilometraje Inicio:</strong> {{ $hojaRuta->kilometraje_inicio }}</p>
        <p><strong>Kilometraje Llegada:</strong> {{ $hojaRuta->kilometraje_llegada }}</p>
        <p><strong>Kilometraje Total:</strong> {{ $hojaRuta->kilometraje_total }}</p>

        <h3>Pasajeros</h3>
        <ul>
            @foreach ($hojaRuta->pasajeros as $pasajero)
                <li>{{ $pasajero->nombre }} - {{ $pasajero->cedula }} - {{ $pasajero->proyecto }}</li>
            @endforeach
        </ul>

        <h3>Itinerarios</h3>
        <ul>
            @foreach ($hojaRuta->itinerarios as $itinerario)
                <li>{{ $itinerario->fecha }} - {{ $itinerario->origen_destino }} - {{ $itinerario->hora_salida }} - {{ $itinerario->hora_llegada }} - {{ $itinerario->observaciones }}</li>
            @endforeach
        </ul>

        <a href="{{ route('hoja_ruta.index') }}" class="btn btn-primary">Volver</a>
    </div>
</div>
@stop
