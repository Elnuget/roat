@extends('adminlte::page')

@section('title', 'Admin')

@section('content_header')
<h1>Administración</h1>
<p>Funcionalidades Varias</p>
<!-- Sección para mostrar mensajes de error de PHP -->
@if (session('php_error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error:</strong> {{ session('php_error') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if (session('error'))
<div class="alert {{ session('tipo') }} alert-dismissible fade show" role="alert">
    <strong>{{ session('error') }}</strong> {{ session('mensaje') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
@stop

@section('content')
<style>
    .related-cards {
        background-color: #6699cc;
        /* Cambia este color según tus preferencias */
    }
</style>
<div class="row related-cards">
    <!-- Formulario para escribir el mensaje de WhatsApp -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Enviar Mensaje de WhatsApp</h3>
            </div>
            <div class="card-body">
                <textarea id="whatsappMessage" class="form-control" rows="7"
                    placeholder="Escribe tu mensaje aquí"></textarea>
                <!-- El botón ha sido eliminado -->
            </div>
        </div>
    </div>
    <!-- Sección de cumpleaños eliminada -->
</div>
@stop

@section('js')
@include('atajos')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Capturar el input de mensaje de WhatsApp
        var whatsappInput = document.getElementById('whatsappMessage');

        // Establecer un mensaje predeterminado
        whatsappInput.value = "¡Feliz Cumpleaños desde Escleróptica! En este día tan especial, queremos enviarte un cálido saludo y nuestros mejores deseos. Esperamos que tu día esté lleno de alegría y momentos memorables. Recuerda que estamos aquí para cuidar de tu visión y acompañarte en cada paso de tu camino hacia una salud visual óptima. ¡Que tengas un maravilloso cumpleaños!";

        // Función para actualizar el enlace de WhatsApp
        function updateWhatsAppLink() {
            var message = encodeURIComponent(whatsappInput.value);
            document.querySelectorAll('.whatsapp-link').forEach(function (link) {
                var name = link.dataset.name;
                var personalizedMessage = message + ' ' + name;
                link.href = 'https://wa.me/' + link.dataset.phone + '?text=' + personalizedMessage;
            });
        }

        // Actualizar todos los enlaces de WhatsApp con el mensaje predeterminado
        updateWhatsAppLink();

        // Actualizar todos los enlaces de WhatsApp cuando se cambie el mensaje
        whatsappInput.addEventListener('input', function () {
            updateWhatsAppLink();
        });
    });
</script>
@stop