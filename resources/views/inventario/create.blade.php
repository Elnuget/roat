@extends('adminlte::page')

@section('title', 'Crear Articulo')

@section('content_header')
    @if (session('error'))
        <div class="alert {{ session('tipo') }} alert-dismissible fade show" role="alert">
            <strong> {{ session('mensaje') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
@stop

@section('content')
    <br>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Crear Articulo</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
                    <i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fas fa-times"></i></button>
            </div>
        </div>
        <div class="card-body">
            <div class="col-md-10">
                <form role="form" action="{{ route('inventario.store') }}" method="POST">
                    @csrf

                    <div class="form-group row">
                        <div class="col-12">
                            <label>Fecha</label>
                            <input name="fecha" required type="date" class="form-control" value="{{ now()->format('Y-m-d') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-6">
                            <label>Lugar</label>
                            <input type="text" name="lugar" id="lugar" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-4">
                            <label>Columna</label> <!-- renamed from Fila -->
                            <input name="columna" required type="text" class="form-control" value="{{ request('columna') }}">
                        </div>
                        <div class="col-4">
                            <label>Número</label>
                            <input name="numero" id="numero" class="form-control" required type="number">
                        </div>
                        <div class="col-4">
                            <label>Código</label>
                            <input name="codigo" id="codigo" required type="text" class="form-control">
                        </div>
                        
                    </div>

                    <div class="form-goup row">
                        <div class="col-4">
                            <label>Cantidad</label>
                            <input name="cantidad" id="cantidad" required type="number" class="form-control" value="1">
                        </div>
                    </div>

                    <br>


                    <button type="button" class="btn btn-primary pull-left" data-toggle="modal" data-target="#modal">Crear
                        Articulo</button>
                        <a href="{{ route('inventario.index') }}" class="btn btn-secondary ">
                            Cancelar
                        </a>
                    <div class="modal fade" id="modal">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">

                                    <h4 class="modal-title">Crear Articulo</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body">
                                    <p>¿Estás seguro que desea guardar?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default pull-left"
                                        data-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                </form>
            </div>

            <br>
            <!-- Fin contenido -->
        </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        Crear Articulo
    </div>
    <!-- /.card-footer-->
    </div>

@stop

@section('js')

<script>
// Agrega un 'event listener' al documento para escuchar eventos de teclado
document.addEventListener('keydown', function(event) {
    if (event.key === "Home") { // Verifica si la tecla presionada es 'Inicio'
        window.location.href = '/dashboard'; // Redirecciona a '/dashboard'
    }
});

document.addEventListener('DOMContentLoaded', function() {
    const lugarSelect = document.getElementById('lugar');
    const newLugarInput = document.getElementById('newLugar');

    lugarSelect.addEventListener('change', function() {
        if (this.value === 'new') {
            newLugarInput.style.display = 'block';
        } else {
            newLugarInput.style.display = 'none';
        }
    });
});

// Función para guardar un lugar en el historial
function saveLocation(lugar) {
    let locations = JSON.parse(localStorage.getItem('recentLocations') || '[]');
    // Eliminar si ya existe para evitar duplicados
    locations = locations.filter(loc => loc !== lugar);
    // Agregar al principio del array
    locations.unshift(lugar);
    // Mantener solo los últimos 5 lugares
    if (locations.length > 5) {
        locations.pop();
    }
    localStorage.setItem('recentLocations', JSON.stringify(locations));
}

// Función para obtener sugerencias
function getSuggestions(input) {
    const locations = JSON.parse(localStorage.getItem('recentLocations') || '[]');
    return locations.filter(location => 
        location.toLowerCase().includes(input.toLowerCase())
    );
}

// Cuando el formulario se envía, guardar el lugar
document.querySelector('form').addEventListener('submit', function(e) {
    const lugar = document.getElementById('lugar').value;
    if (lugar) {
        saveLocation(lugar);
    }
});

// Configurar el autocompletado
const lugarInput = document.getElementById('lugar');
let currentFocus;

lugarInput.addEventListener('input', function(e) {
    const val = this.value;
    // cerrar cualquier lista abierta
    closeAllLists();
    if (!val) { return false; }
    currentFocus = -1;

    const suggestions = getSuggestions(val);
    if (suggestions.length === 0) return;

    const suggList = document.createElement("DIV");
    suggList.setAttribute("id", this.id + "autocomplete-list");
    suggList.setAttribute("class", "autocomplete-items");
    this.parentNode.appendChild(suggList);

    suggestions.forEach(sugg => {
        const suggDiv = document.createElement("DIV");
        suggDiv.innerHTML = sugg;
        suggDiv.addEventListener("click", function(e) {
            lugarInput.value = this.innerText;
            closeAllLists();
        });
        suggList.appendChild(suggDiv);
    });
});

function closeAllLists(elmnt) {
    const x = document.getElementsByClassName("autocomplete-items");
    for (let i = 0; i < x.length; i++) {
        if (elmnt != x[i] && elmnt != lugarInput) {
            x[i].parentNode.removeChild(x[i]);
        }
    }
}

document.addEventListener("click", function (e) {
    closeAllLists(e.target);
});

// Resto del código JavaScript existente...
</script>

<style>
.autocomplete-items {
    position: absolute;
    border: 1px solid #d4d4d4;
    border-bottom: none;
    border-top: none;
    z-index: 99;
    top: 100%;
    left: 0;
    right: 0;
    background-color: #fff;
}

.autocomplete-items div {
    padding: 10px;
    cursor: pointer;
    border-bottom: 1px solid #d4d4d4;
}

.autocomplete-items div:hover {
    background-color: #e9e9e9;
}
</style>
@stop

@section('footer')
    <div class="float-right d-none d-sm-block">
        <b>Version</b> @version('compact')
    </div>
@stop
