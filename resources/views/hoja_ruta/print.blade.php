<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hoja de Ruta</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .header, .footer {
            text-align: center;
            margin-bottom: 20px;
        }
        .section {
            margin-bottom: 20px;
        }
        .section h2 {
            border-bottom: 1px solid #000;
            padding-bottom: 5px;
        }
        .signature {
            margin-top: 50px;
            text-align: center;
        }
        .signature div {
            display: inline-block;
            width: 200px;
            border-top: 1px solid #000;
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Hoja de Ruta</h1>
    </div>

    <div class="section">
        <h2>Empresa</h2>
        <p><strong>Nombre:</strong> {{ $hojaRuta->empresa->nombre }}</p>
        <p><strong>Contacto:</strong> {{ $hojaRuta->empresa->contacto }}</p>
    </div>

    <div class="section">
        <h2>Conductor</h2>
        <p><strong>Nombre:</strong> {{ $hojaRuta->conductor->nombre }}</p>
        <p><strong>Placa Vehicular:</strong> {{ $hojaRuta->conductor->placa_vehicular }}</p>
    </div>

    <div class="section">
        <h2>Detalles de la Ruta</h2>
        <p><strong>Fecha Inicio:</strong> {{ $hojaRuta->fecha_inicio }}</p>
        <p><strong>Fecha Fin:</strong> {{ $hojaRuta->fecha_fin }}</p>
        <p><strong>Kilometraje Inicio:</strong> {{ $hojaRuta->kilometraje_inicio }}</p>
        <p><strong>Kilometraje Llegada:</strong> {{ $hojaRuta->kilometraje_llegada }}</p>
        <p><strong>Kilometraje Total:</strong> {{ $hojaRuta->kilometraje_total }}</p>
    </div>

    <div class="section">
        <h2>Pasajeros</h2>
        <ul>
            @foreach ($hojaRuta->pasajeros as $pasajero)
                <li>
                    <strong>Nombre:</strong> {{ $pasajero->nombre }},
                    <strong>Cédula:</strong> {{ $pasajero->cedula }},
                    <strong>Proyecto:</strong> {{ $pasajero->proyecto }}
                </li>
            @endforeach
        </ul>
    </div>

    <div class="section">
        <h2>Itinerarios</h2>
        <ul>
            @foreach ($hojaRuta->itinerarios as $itinerario)
                <li>
                    <strong>Fecha:</strong> {{ $itinerario->fecha }},
                    <strong>Origen/Destino:</strong> {{ $itinerario->origen_destino }},
                    <strong>Hora Salida:</strong> {{ $itinerario->hora_salida }},
                    <strong>Hora Llegada:</strong> {{ $itinerario->hora_llegada }},
                    <strong>Observaciones:</strong> {{ $itinerario->observaciones }}
                </li>
            @endforeach
        </ul>
    </div>

    <div class="signature">
        <div>Firma del Conductor</div>
    </div>
</body>
</html>
