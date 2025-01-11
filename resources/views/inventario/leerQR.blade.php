@extends('adminlte::page')

@section('title', 'Leer QR')

@section('content_header')
    <h1>Leer QR</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Escanear Código QR</h3>
        </div>
        <div class="card-body">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-lg-6 text-center">
                    <div class="form-group">
                        <label for="camera-select">Seleccionar Cámara:</label>
                        <select id="camera-select" class="form-control mb-4">
                            <!-- Las opciones se llenarán dinámicamente -->
                        </select>
                    </div>
                    
                    <div class="video-container mb-4" style="min-height: 300px;">
                        <video id="preview" style="max-width: 100%; width: 100%;"></video>
                    </div>

                    <div id="scanResult" class="alert alert-info" style="display: none;">
                        <p class="mb-0">Código QR detectado. Redirigiendo...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .video-container {
            position: relative;
            background: #f8f9fa;
            border-radius: 8px;
            overflow: hidden;
        }
        
        #preview {
            display: block;
            margin: 0 auto;
        }

        @media (max-width: 768px) {
            .video-container {
                min-height: 200px;
            }
        }
    </style>
@stop

@section('js')
<script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
<script>
    let scanner = new Instascan.Scanner({ 
        video: document.getElementById('preview'),
        mirror: false
    });

    scanner.addListener('scan', function (content) {
        console.log('Contenido escaneado:', content);
        document.getElementById('scanResult').style.display = 'block';
        setTimeout(function() {
            window.location.href = content;
        }, 1000);
    });

    const cameraSelect = document.getElementById('camera-select');

    cameraSelect.addEventListener('change', function (e) {
        const cameraId = e.target.value;
        const cameras = scanner.cameras;
        const camera = cameras.find(c => c.id === cameraId);
        if (camera) {
            scanner.start(camera);
        }
    });

    Instascan.Camera.getCameras().then(function (cameras) {
        if (cameras.length > 0) {
            cameras.forEach(function(camera, i) {
                const option = document.createElement('option');
                option.value = camera.id;
                option.text = camera.name || `Cámara ${i + 1}`;
                cameraSelect.appendChild(option);
            });

            scanner.start(cameras[0]);
        } else {
            console.error('No se encontraron cámaras.');
            alert('No se encontraron cámaras en el dispositivo.');
        }
    }).catch(function (e) {
        console.error(e);
        alert('Error al acceder a la cámara: ' + e);
    });
</script>
@stop
