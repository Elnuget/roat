@extends('adminlte::page')
@section('title', 'Crear Hoja de Ruta')

@section('content_header')
<h1>Crear Hoja de Ruta</h1>
@stop

@section('content')
<form action="{{ route('hoja_ruta.store') }}" method="POST">
    @csrf
    <div class="row">
        <div class="col-md-6">
            <h3>Datos de la Empresa</h3>
            <div class="form-group">
                <label for="empresa_nombre">Nombre de la Empresa</label>
                <input type="text" class="form-control" id="empresa_nombre" name="empresa_nombre" required>
            </div>
            <div class="form-group">
                <label for="empresa_contacto">Contacto de la Empresa</label>
                <input type="text" class="form-control" id="empresa_contacto" name="empresa_contacto" required>
            </div>
        </div>
        <div class="col-md-6">
            <h3>Datos del Conductor</h3>
            <div class="form-group">
                <label for="conductor_nombre">Nombre del Conductor</label>
                <input type="text" class="form-control" id="conductor_nombre" name="conductor_nombre" required>
            </div>
            <div class="form-group">
                <label for="placa_vehicular">Placa Vehicular</label>
                <input type="text" class="form-control" id="placa_vehicular" name="placa_vehicular" required>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <h3>Datos de la Hoja de Ruta</h3>
            <div class="form-group">
                <label for="fecha_inicio">Fecha de Inicio</label>
                <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required>
            </div>
            <div class="form-group">
                <label for="fecha_fin">Fecha de Finalización</label>
                <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" required>
            </div>
            <div class="form-group">
                <label for="kilometraje_inicio">Kilometraje Inicial</label>
                <input type="number" class="form-control" id="kilometraje_inicio" name="kilometraje_inicio" required>
            </div>
            <div class="form-group">
                <label for="kilometraje_llegada">Kilometraje Final</label>
                <input type="number" class="form-control" id="kilometraje_llegada" name="kilometraje_llegada" required>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <h3>Pasajeros</h3>
            <div id="pasajeros-container">
                <div class="form-row pasajero">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="pasajeros[0][nombre]">Nombre</label>
                            <input type="text" class="form-control" name="pasajeros[0][nombre]" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="pasajeros[0][cedula]">Cédula</label>
                            <input type="text" class="form-control" name="pasajeros[0][cedula]" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="pasajeros[0][proyecto]">Proyecto</label>
                            <input type="text" class="form-control" name="pasajeros[0][proyecto]" required>
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-secondary" id="add-pasajero">Agregar Pasajero</button>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <h3>Itinerarios</h3>
            <div id="itinerarios-container">
                <div class="form-row itinerario">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="itinerarios[0][fecha]">Fecha</label>
                            <input type="date" class="form-control" name="itinerarios[0][fecha]" required>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="itinerarios[0][origen_destino]">Origen/Destino</label>
                            <input type="text" class="form-control" name="itinerarios[0][origen_destino]" required>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="itinerarios[0][hora_salida]">Hora de Salida</label>
                            <input type="time" class="form-control" name="itinerarios[0][hora_salida]" required>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="itinerarios[0][hora_llegada]">Hora de Llegada</label>
                            <input type="time" class="form-control" name="itinerarios[0][hora_llegada]" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="itinerarios[0][observaciones]">Observaciones</label>
                            <input type="text" class="form-control" name="itinerarios[0][observaciones]">
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-secondary" id="add-itinerario">Agregar Itinerario</button>
        </div>
    </div>

    <button type="submit" class="btn btn-primary mt-3">Guardar Hoja de Ruta</button>
</form>

<script>
    document.getElementById('add-pasajero').addEventListener('click', function() {
        var container = document.getElementById('pasajeros-container');
        var index = container.getElementsByClassName('pasajero').length;
        var newPasajero = `
            <div class="form-row pasajero">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="pasajeros[${index}][nombre]">Nombre</label>
                        <input type="text" class="form-control" name="pasajeros[${index}][nombre]" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="pasajeros[${index}][cedula]">Cédula</label>
                        <input type="text" class="form-control" name="pasajeros[${index}][cedula]" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="pasajeros[${index}][proyecto]">Proyecto</label>
                        <input type="text" class="form-control" name="pasajeros[${index}][proyecto]" required>
                    </div>
                </div>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', newPasajero);
    });

    document.getElementById('add-itinerario').addEventListener('click', function() {
        var container = document.getElementById('itinerarios-container');
        var index = container.getElementsByClassName('itinerario').length;
        var newItinerario = `
            <div class="form-row itinerario">
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="itinerarios[${index}][fecha]">Fecha</label>
                        <input type="date" class="form-control" name="itinerarios[${index}][fecha]" required>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="itinerarios[${index}][origen_destino]">Origen/Destino</label>
                        <input type="text" class="form-control" name="itinerarios[${index}][origen_destino]" required>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="itinerarios[${index}][hora_salida]">Hora de Salida</label>
                        <input type="time" class="form-control" name="itinerarios[${index}][hora_salida]" required>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="itinerarios[${index}][hora_llegada]">Hora de Llegada</label>
                        <input type="time" class="form-control" name="itinerarios[${index}][hora_llegada]" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="itinerarios[${index}][observaciones]">Observaciones</label>
                        <input type="text" class="form-control" name="itinerarios[${index}][observaciones]">
                    </div>
                </div>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', newItinerario);
    });
</script>
@stop
