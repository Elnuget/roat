@extends('adminlte::page')

@section('title', 'Editar Historial Clínico')

@section('content_header')
    <h1 class="mb-3">Editar Historial Clínico</h1>
@stop

@section('content')
    {{-- Mensajes de error y éxito --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

<div class="card">
    <div class="card-body">
        <form action="{{ route('historiales_clinicos.update', $historialClinico->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- FECHA DE REGISTRO --}}
            <div class="card mb-4">
                <div class="card-header" data-toggle="collapse" data-target="#fechaRegistro" style="cursor: pointer">
                    <h5 class="mb-0">
                        <i class="fas fa-calendar-alt mr-2"></i> Fecha de Registro
                    </h5>
                </div>
                <div id="fechaRegistro" class="collapse show">
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="fecha">Fecha <span class="text-danger">*</span></label>
                                <input type="date" name="fecha" id="fecha" class="form-control" 
                                    value="{{ old('fecha', $historialClinico->fecha) }}" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- DATOS DEL PACIENTE --}}
            <div class="card mb-4">
                <div class="card-header" data-toggle="collapse" data-target="#datosPaciente" style="cursor: pointer">
                    <h5 class="mb-0">
                        <i class="fas fa-user mr-2"></i> Datos del Paciente
                    </h5>
                </div>
                <div id="datosPaciente" class="collapse show">
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="nombres">Nombres <span class="text-danger">*</span></label>
                                <input type="text" name="nombres" id="nombres" class="form-control" 
                                    value="{{ old('nombres', $historialClinico->nombres) }}" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="apellidos">Apellidos <span class="text-danger">*</span></label>
                                <input type="text" name="apellidos" id="apellidos" class="form-control" 
                                    value="{{ old('apellidos', $historialClinico->apellidos) }}" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="cedula">Cédula</label>
                                <input type="text" name="cedula" id="cedula" class="form-control" 
                                    value="{{ old('cedula', $historialClinico->cedula) }}">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="edad">Edad <span class="text-danger">*</span></label>
                                <input type="number" name="edad" id="edad" class="form-control" 
                                    value="{{ old('edad', $historialClinico->edad) }}" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                                <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control" 
                                    value="{{ old('fecha_nacimiento', $historialClinico->fecha_nacimiento) }}">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="celular">Celular <span class="text-danger">*</span></label>
                                <input type="text" name="celular" id="celular" class="form-control" 
                                    value="{{ old('celular', $historialClinico->celular) }}" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="ocupacion">Ocupación <span class="text-danger">*</span></label>
                                <input type="text" name="ocupacion" id="ocupacion" class="form-control" 
                                    value="{{ old('ocupacion', $historialClinico->ocupacion) }}" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- MOTIVO DE CONSULTA Y ENFERMEDAD ACTUAL --}}
            <div class="card mb-4">
                <div class="card-header" data-toggle="collapse" data-target="#motivoConsulta">
                    <h5 class="mb-0">
                        <i class="fas fa-notes-medical mr-2"></i> Motivo de Consulta y Enfermedad Actual
                    </h5>
                </div>
                <div id="motivoConsulta" class="collapse show">
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Motivo de Consulta <span class="text-danger">*</span></label>
                                <input type="text" name="motivo_consulta" class="form-control" 
                                    value="{{ old('motivo_consulta', $historialClinico->motivo_consulta) }}" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Enfermedad Actual <span class="text-danger">*</span></label>
                                <input type="text" name="enfermedad_actual" class="form-control" 
                                    value="{{ old('enfermedad_actual', $historialClinico->enfermedad_actual) }}" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ANTECEDENTES --}}
            <div class="card mb-4">
                <div class="card-header" data-toggle="collapse" data-target="#antecedentes">
                    <h5 class="mb-0">
                        <i class="fas fa-history mr-2"></i> Antecedentes
                    </h5>
                </div>
                <div id="antecedentes" class="collapse show">
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Antecedentes Personales Oculares <span class="text-danger">*</span></label>
                                <textarea name="antecedentes_personales_oculares" class="form-control" rows="3" required>{{ old('antecedentes_personales_oculares', $historialClinico->antecedentes_personales_oculares) }}</textarea>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Antecedentes Personales Generales <span class="text-danger">*</span></label>
                                <textarea name="antecedentes_personales_generales" class="form-control" rows="3" required>{{ old('antecedentes_personales_generales', $historialClinico->antecedentes_personales_generales) }}</textarea>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Antecedentes Familiares Oculares <span class="text-danger">*</span></label>
                                <textarea name="antecedentes_familiares_oculares" class="form-control" rows="3" required>{{ old('antecedentes_familiares_oculares', $historialClinico->antecedentes_familiares_oculares) }}</textarea>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Antecedentes Familiares Generales <span class="text-danger">*</span></label>
                                <textarea name="antecedentes_familiares_generales" class="form-control" rows="3" required>{{ old('antecedentes_familiares_generales', $historialClinico->antecedentes_familiares_generales) }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- AGUDEZA VISUAL Y PH --}}
            <div class="card mb-4">
                <div class="card-header" data-toggle="collapse" data-target="#agudezaVisual">
                    <h5 class="mb-0">
                        <i class="fas fa-eye mr-2"></i> Agudeza Visual y PH
                    </h5>
                </div>
                <div id="agudezaVisual" class="collapse show">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h6>Agudeza Visual VL sin Corrección <span class="text-danger">*</span></h6>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label>OD</label>
                                        <input type="text" name="agudeza_visual_vl_sin_correccion_od" class="form-control" required
                                            value="{{ old('agudeza_visual_vl_sin_correccion_od', $historialClinico->agudeza_visual_vl_sin_correccion_od) }}">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>OI</label>
                                        <input type="text" name="agudeza_visual_vl_sin_correccion_oi" class="form-control" required
                                            value="{{ old('agudeza_visual_vl_sin_correccion_oi', $historialClinico->agudeza_visual_vl_sin_correccion_oi) }}">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>AO</label>
                                        <input type="text" name="agudeza_visual_vl_sin_correccion_ao" class="form-control" required
                                            value="{{ old('agudeza_visual_vl_sin_correccion_ao', $historialClinico->agudeza_visual_vl_sin_correccion_ao) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h6>Agudeza Visual VP sin Corrección <span class="text-danger">*</span></h6>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label>OD</label>
                                        <input type="text" name="agudeza_visual_vp_sin_correccion_od" class="form-control" required
                                            value="{{ old('agudeza_visual_vp_sin_correccion_od', $historialClinico->agudeza_visual_vp_sin_correccion_od) }}">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>OI</label>
                                        <input type="text" name="agudeza_visual_vp_sin_correccion_oi" class="form-control" required
                                            value="{{ old('agudeza_visual_vp_sin_correccion_oi', $historialClinico->agudeza_visual_vp_sin_correccion_oi) }}">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>AO</label>
                                        <input type="text" name="agudeza_visual_vp_sin_correccion_ao" class="form-control" required
                                            value="{{ old('agudeza_visual_vp_sin_correccion_ao', $historialClinico->agudeza_visual_vp_sin_correccion_ao) }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <h6>Pin Hole (PH) <span class="text-danger">*</span></h6>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>PH OD</label>
                                        <input type="text" name="ph_od" class="form-control" required
                                            value="{{ old('ph_od', $historialClinico->ph_od) }}">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>PH OI</label>
                                            <input type="text" name="ph_oi" class="form-control" required
                                                value="{{ old('ph_oi', $historialClinico->ph_oi) }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- Se eliminó el campo ADD de esta sección --}}
                            <input type="hidden" name="usuario_id" value="{{ old('usuario_id', $historialClinico->usuario_id) }}">
                        <div class="form-group">
                            <label>Optotipo</label>
                            <textarea name="optotipo" class="form-control" rows="2">{{ old('optotipo', $historialClinico->optotipo) }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            {{-- LENSOMETRÍA --}}
            <div class="card mb-4">
                <div class="card-header" data-toggle="collapse" data-target="#lensometria">
                    <h5 class="mb-0">
                        <i class="fas fa-glasses mr-2"></i> Lensometría
                    </h5>
                </div>
                <div id="lensometria" class="collapse show">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h6>Lensometría</h6>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>OD</label>
                                        <input type="text" name="lensometria_od" class="form-control" 
                                            value="{{ old('lensometria_od', $historialClinico->lensometria_od) }}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>OI</label>
                                        <input type="text" name="lensometria_oi" class="form-control" 
                                            value="{{ old('lensometria_oi', $historialClinico->lensometria_oi) }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Tipo de Lente</label>
                                    <input type="text" name="tipo_lente" class="form-control" 
                                        value="{{ old('tipo_lente', $historialClinico->tipo_lente) }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Material</label>
                                    <input type="text" name="material" class="form-control" 
                                        value="{{ old('material', $historialClinico->material) }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Filtro</label>
                                    <input type="text" name="filtro" class="form-control" 
                                        value="{{ old('filtro', $historialClinico->filtro) }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Tiempo de Uso</label>
                                    <input type="text" name="tiempo_uso" class="form-control" 
                                        value="{{ old('tiempo_uso', $historialClinico->tiempo_uso) }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- RX FINAL --}}
            <div class="card mb-4">
                <div class="card-header" data-toggle="collapse" data-target="#rxFinal">
                    <h5 class="mb-0">
                        <i class="fas fa-prescription mr-2"></i> Rx Final
                    </h5>
                </div>
                <div id="rxFinal" class="collapse show">
                    <div class="card-body">
                        <div class="form-row mb-3">
                            <div class="form-group col-md-6">
                                <label>Refracción OD <span class="text-danger">*</span></label>
                                <input type="text" name="refraccion_od" class="form-control" required
                                    value="{{ old('refraccion_od', $historialClinico->refraccion_od) }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Refracción OI <span class="text-danger">*</span></label>
                                <input type="text" name="refraccion_oi" class="form-control" required
                                    value="{{ old('refraccion_oi', $historialClinico->refraccion_oi) }}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label>DP OD <span class="text-danger">*</span></label>
                                <input type="text" name="rx_final_dp_od" class="form-control" required
                                    value="{{ old('rx_final_dp_od', $historialClinico->rx_final_dp_od) }}">
                            </div>
                            <div class="form-group col-md-3">
                                <label>DP OI <span class="text-danger">*</span></label>
                                <input type="text" name="rx_final_dp_oi" class="form-control" required
                                    value="{{ old('rx_final_dp_oi', $historialClinico->rx_final_dp_oi) }}">
                            </div>
                            <div class="form-group col-md-3">
                                <label>AV VL OD <span class="text-danger">*</span></label>
                                <input type="text" name="rx_final_av_vl_od" class="form-control" required
                                    value="{{ old('rx_final_av_vl_od', $historialClinico->rx_final_av_vl_od) }}">
                            </div>
                            <div class="form-group col-md-3">
                                <label>AV VL OI <span class="text-danger">*</span></label>
                                <input type="text" name="rx_final_av_vl_oi" class="form-control" required
                                    value="{{ old('rx_final_av_vl_oi', $historialClinico->rx_final_av_vl_oi) }}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label>AV VP OD <span class="text-danger">*</span></label>
                                <input type="text" name="rx_final_av_vp_od" class="form-control" required
                                    value="{{ old('rx_final_av_vp_od', $historialClinico->rx_final_av_vp_od) }}">
                            </div>
                            <div class="form-group col-md-3">
                                <label>AV VP OI <span class="text-danger">*</span></label>
                                <input type="text" name="rx_final_av_vp_oi" class="form-control" required
                                    value="{{ old('rx_final_av_vp_oi', $historialClinico->rx_final_av_vp_oi) }}">
                            </div>
                            <div class="form-group col-md-3">
                                <label>ADD</label>
                                <input type="text" name="add" class="form-control" 
                                    value="{{ old('add', $historialClinico->add) }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- DIAGNÓSTICO, TRATAMIENTO Y COTIZACIÓN --}}
            <div class="card mb-4">
                <div class="card-header" data-toggle="collapse" data-target="#diagnostico">
                    <h5 class="mb-0">
                        <i class="fas fa-file-medical mr-2"></i> Diagnóstico y Cotización
                    </h5>
                </div>
                <div id="diagnostico" class="collapse show">
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-12">
                                <label>Diagnóstico <span class="text-danger">*</span></label>
                                <textarea name="diagnostico" class="form-control" rows="3" required>{{ old('diagnostico', $historialClinico->diagnostico) }}</textarea>
                            </div>
                            <div class="form-group col-12">
                                <label>Tratamiento <span class="text-danger">*</span></label>
                                <textarea name="tratamiento" class="form-control" rows="3" required>{{ old('tratamiento', $historialClinico->tratamiento) }}</textarea>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Cotización</label>
                                <input type="text" name="cotizacion" class="form-control" 
                                    value="{{ old('cotizacion', $historialClinico->cotizacion) }}">
                            </div>
                            <input type="hidden" name="usuario_id" value="{{ old('usuario_id', $historialClinico->usuario_id) }}">
                        </div>
                    </div>
                </div>
            </div>

            {{-- BOTONES DE ACCIÓN --}}
            <div class="d-flex justify-content-end">
                <a href="{{ route('historiales_clinicos.index') }}" class="btn btn-secondary mr-2">
                    Cancelar
                </a>
                <button type="submit" class="btn btn-primary">
                    Actualizar
                </button>
            </div>
        </form>
    </div>
</div>
@stop

@section('css')
<style>
    .card-header {
        background-color: #f8f9fa;
        transition: background-color 0.3s ease;
    }
    .card-header:hover {
        background-color: #e9ecef;
    }
    .form-group label {
        font-weight: 600;
    }
    .text-danger {
        font-weight: bold;
    }
</style>
@stop

@section('js')
<script>
    $(document).ready(function() {
        // Inicializar todos los collapse
        $('.collapse').collapse('show');
        
        // Toggle de iconos en los headers
        $('.card-header').click(function() {
            $(this).find('i').toggleClass('fa-minus fa-plus');
        });
    });
</script>
@stop
