@extends('adminlte::page')

@section('title', 'Generar QR')

@section('content_header')
    <h1>Generar QR</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Generar Código QR</h3>
        </div>
        <div class="card-body">
            <form id="qrForm">
                <div class="form-group row">
                    <div class="col-6">
                        <label>Lugar</label>
                        <input list="lugares" name="lugar" id="lugar" class="form-control" required>
                        <datalist id="lugares">
                            <option value="Soporte">
                            <option value="Vitrina">
                            <option value="Estuches">
                            <option value="Cosas Extras">
                            <option value="Armazones Extras">
                            <option value="Líquidos">
                            <option value="Goteros">
                        </datalist>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-6">
                        <label>Columna</label>
                        <input type="text" name="columna" id="columna" class="form-control" required>
                    </div>
                </div>
                <button type="button" class="btn btn-primary" onclick="generateQR()">Generar</button>
            </form>
            <div id="qrCode" class="mt-4"></div>
        </div>
    </div>
@stop

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
<script>
    function generateQR() {
        const lugar = document.getElementById('lugar').value;
        const columna = document.getElementById('columna').value;
        const url = `/Inventario/Crear?lugar=${encodeURIComponent(lugar)}&columna=${encodeURIComponent(columna)}`;
        const qrCodeContainer = document.getElementById('qrCode');
        qrCodeContainer.innerHTML = '';
        new QRCode(qrCodeContainer, url);
    }
</script>
@stop
