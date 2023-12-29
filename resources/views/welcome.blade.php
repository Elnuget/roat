@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <!-- Campo para editar el mensaje de WhatsApp -->
        <div class="card mb-3">
            <div class="card-body">
                <label for="whatsappMessage">Mensaje de Cumpleaños:</label>
                <input type="text" id="whatsappMessage" class="form-control" value="¡Feliz cumpleaños [nombre]!">
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Pacientes que Cumplen Años Hoy</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Teléfono</th>
                            <th>Fecha de Nacimiento</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Juan Pérez</td>
                            <td>123456789</td>
                            <td>28/12/1980</td>
                            <td>
                                <a href="#" onclick="sendMessage('Juan Pérez')">
                                    <i class="fab fa-whatsapp"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>Maria López</td>
                            <td>987654321</td>
                            <td>28/12/1985</td>
                            <td>
                                <a href="#" onclick="sendMessage('Maria López')">
                                    <i class="fab fa-whatsapp"></i>
                                </a>
                            </td>
                        </tr>
                        <!-- Agrega más filas según sea necesario -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@stop

@section('css')
<!-- CSS personalizado aquí -->
@stop

@section('js')
<script>
    function sendMessage(nombre) {
        var message = document.getElementById('whatsappMessage').value;
        message = message.replace('[nombre]', nombre);
        var whatsappUrl = 'whatsapp://send?text=' + encodeURIComponent(message);
        window.open(whatsappUrl, '_blank');
    }
</script>
@stop
