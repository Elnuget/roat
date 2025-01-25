@extends('adminlte::page')
@section('title', 'Editar Hoja de Ruta')

@section('content_header')
<h1>Editar Hoja de Ruta</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('hoja_ruta.update', $hojaRuta->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="empresa_nombre">Nombre de la Empresa</label>
                <input type="text" name="empresa_nombre" class="form-control" value="{{ old('empresa_nombre', $hojaRuta->empresa->nombre) }}" required>
            </div>

            <div class="form-group">
                <label for="empresa_contacto">Contacto de la Empresa</label>
                <input type="text" name="empresa_contacto" class="form-control" value="{{ old('empresa_contacto', $hojaRuta->empresa->contacto) }}" required>
            </div>

            <div class="form-group">
                <label for="conductor_nombre">Nombre del Conductor</label>
                <input type="text" name="conductor_nombre" class="form-control" value="{{ old('conductor_nombre', $hojaRuta->conductor->nombre) }}" required>
            </div>

            <div class="form-group">
                <label for="placa_vehicular">Placa Vehicular</label>
                <input type="text" name="placa_vehicular" class="form-control" value="{{ old('placa_vehicular', $hojaRuta->conductor->placa_vehicular) }}" required>
            </div>

            <div class="form-group">
                <label for="fecha_inicio">Fecha de Inicio</label>
                <input type="date" name="fecha_inicio" class="form-control" value="{{ old('fecha_inicio', $hojaRuta->fecha_inicio) }}" required>
            </div>

            <div class="form-group">
                <label for="fecha_fin">Fecha de Fin</label>
                <input type="date" name="fecha_fin" class="form-control" value="{{ old('fecha_fin', $hojaRuta->fecha_fin) }}" required>
            </div>

            <div class="form-group">
                <label for="kilometraje_inicio">Kilometraje de Inicio</label>
                <input type="number" name="kilometraje_inicio" class="form-control" value="{{ old('kilometraje_inicio', $hojaRuta->kilometraje_inicio) }}" required>
            </div>

            <div class="form-group">
                <label for="kilometraje_llegada">Kilometraje de Llegada</label>
                <input type="number" name="kilometraje_llegada" class="form-control" value="{{ old('kilometraje_llegada', $hojaRuta->kilometraje_llegada) }}" required>
            </div>

            <h3>Pasajeros</h3>
            @foreach ($hojaRuta->pasajeros as $index => $pasajero)
                <div class="form-group">
                    <label for="pasajeros[{{ $index }}][nombre]">Nombre del Pasajero</label>
                    <input type="text" name="pasajeros[{{ $index }}][nombre]" class="form-control" value="{{ old('pasajeros.' . $index . '.nombre', $pasajero->nombre) }}" required>
                </div>
                <div class="form-group">
                    <label for="pasajeros[{{ $index }}][cedula]">Cédula del Pasajero</label>
                    <input type="text" name="pasajeros[{{ $index }}][cedula]" class="form-control" value="{{ old('pasajeros.' . $index . '.cedula', $pasajero->cedula) }}" required>
                </div>
                <div class="form-group">
                    <label for="pasajeros[{{ $index }}][proyecto]">Proyecto del Pasajero</label>
                    <input type="text" name="pasajeros[{{ $index }}][proyecto]" class="form-control" value="{{ old('pasajeros.' . $index . '.proyecto', $pasajero->proyecto) }}" required>
                </div>
            @endforeach

            <h3>Itinerarios</h3>
            @foreach ($hojaRuta->itinerarios as $index => $itinerario)
                <div class="form-group">
                    <label for="itinerarios[{{ $index }}][fecha]">Fecha del Itinerario</label>
                    <input type="date" name="itinerarios[{{ $index }}][fecha]" class="form-control" value="{{ old('itinerarios.' . $index . '.fecha', $itinerario->fecha) }}" required>
                </div>
                <div class="form-group">
                    <label for="itinerarios[{{ $index }}][origen_destino]">Origen y Destino</label>
                    <input type="text" name="itinerarios[{{ $index }}][origen_destino]" class="form-control" value="{{ old('itinerarios.' . $index . '.origen_destino', $itinerario->origen_destino) }}" required>
                </div>
                <div class="form-group">
                    <label for="itinerarios[{{ $index }}][hora_salida]">Hora de Salida</label>
                    <input type="text" name="itinerarios[{{ $index }}][hora_salida]" class="form-control" value="{{ old('itinerarios.' . $index . '.hora_salida', $itinerario->hora_salida) }}" required>
                </div>
                <div class="form-group">
                    <label for="itinerarios[{{ $index }}][hora_llegada]">Hora de Llegada</label>
                    <input type="text" name="itinerarios[{{ $index }}][hora_llegada]" class="form-control" value="{{ old('itinerarios.' . $index . '.hora_llegada', $itinerario->hora_llegada) }}" required>
                </div>
                <div class="form-group">
                    <label for="itinerarios[{{ $index }}][observaciones]">Observaciones</label>
                    <input type="text" name="itinerarios[{{ $index }}][observaciones]" class="form-control" value="{{ old('itinerarios.' . $index . '.observaciones', $itinerario->observaciones) }}">
                </div>
            @endforeach

            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            <a href="{{ route('hoja_ruta.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>
@stop
