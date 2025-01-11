@extends('adminlte::page')

@section('title', 'Ver Historial Clínico')

@section('content_header')
<h1 class="mb-3">Ver Historial Clínico</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <form>
            {{-- DATOS DEL PACIENTE --}}
            <div class="mb-4">
                <h5 class="text-primary">Datos del Paciente</h5>
                <hr>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="nombres">Nombres</label>
                        <input type="text" id="nombres" class="form-control" value="{{ $historialClinico->nombres }}" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="apellidos">Apellidos</label>
                        <input type="text" id="apellidos" class="form-control" value="{{ $historialClinico->apellidos }}" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="edad">Edad</label>
                        <input type="number" id="edad" class="form-control" value="{{ $historialClinico->edad }}" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                        <input type="date" id="fecha_nacimiento" class="form-control" value="{{ $historialClinico->fecha_nacimiento }}" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="celular">Celular</label>
                        <input type="text" id="celular" class="form-control" value="{{ $historialClinico->celular }}" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="ocupacion">Ocupación</label>
                        <input type="text" id="ocupacion" class="form-control" value="{{ $historialClinico->ocupacion }}" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="fecha">Fecha</label>
                        <input type="date" id="fecha" class="form-control" value="{{ $historialClinico->fecha }}" readonly>
                    </div>
                </div>
            </div>

            {{-- MOTIVO DE CONSULTA / ENFERMEDAD ACTUAL --}}
            <div class="mb-4">
                <h5 class="text-primary">Motivo de Consulta</h5>
                <hr>
                <div class="form-row">
                    <div class="form-group col-12 col-sm-6">
                        <label for="motivo_consulta">Motivo de la Consulta</label>
                        <input type="text" id="motivo_consulta" class="form-control" value="{{ $historialClinico->motivo_consulta }}" readonly>
                    </div>
                    <div class="form-group col-12 col-sm-6">
                        <label for="enfermedad_actual">Enfermedad Actual</label>
                        <input type="text" id="enfermedad_actual" class="form-control" value="{{ $historialClinico->enfermedad_actual }}" readonly>
                    </div>
                </div>
            </div>

            {{-- ANTECEDENTES --}}
            <div class="mb-4">
                <h5 class="text-primary">Antecedentes</h5>
                <hr>
                <div class="form-group">
                    <label for="antecedentes_personales_oculares">Antecedentes Personales Oculares</label>
                    <textarea id="antecedentes_personales_oculares" class="form-control" rows="2" readonly>{{ $historialClinico->antecedentes_personales_oculares }}</textarea>
                </div>
                <div class="form-group">
                    <label for="antecedentes_personales_generales">Antecedentes Personales Generales</label>
                    <textarea id="antecedentes_personales_generales" class="form-control" rows="2" readonly>{{ $historialClinico->antecedentes_personales_generales }}</textarea>
                </div>
                <div class="form-group">
                    <label for="antecedentes_familiares_oculares">Antecedentes Familiares Oculares</label>
                    <textarea id="antecedentes_familiares_oculares" class="form-control" rows="2" readonly>{{ $historialClinico->antecedentes_familiares_oculares }}</textarea>
                </div>
                <div class="form-group">
                    <label for="antecedentes_familiares_generales">Antecedentes Familiares Generales</label>
                    <textarea id="antecedentes_familiares_generales" class="form-control" rows="2" readonly>{{ $historialClinico->antecedentes_familiares_generales }}</textarea>
                </div>
            </div>

            {{-- AGUDEZA VISUAL --}}
            <div class="mb-4">
                <h5 class="text-primary">Agudeza Visual (sin Corrección)</h5>
                <hr>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="agudeza_visual_vl_sin_correccion_od">VL OD</label>
                        <input type="text" id="agudeza_visual_vl_sin_correccion_od" class="form-control" value="{{ $historialClinico->agudeza_visual_vl_sin_correccion_od }}" readonly>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="agudeza_visual_vl_sin_correccion_oi">VL OI</label>
                        <input type="text" id="agudeza_visual_vl_sin_correccion_oi" class="form-control" value="{{ $historialClinico->agudeza_visual_vl_sin_correccion_oi }}" readonly>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="agudeza_visual_vl_sin_correccion_ao">VL AO</label>
                        <input type="text" id="agudeza_visual_vl_sin_correccion_ao" class="form-control" value="{{ $historialClinico->agudeza_visual_vl_sin_correccion_ao }}" readonly>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="agudeza_visual_vp_sin_correccion_od">VP OD</label>
                        <input type="text" id="agudeza_visual_vp_sin_correccion_od" class="form-control" value="{{ $historialClinico->agudeza_visual_vp_sin_correccion_od }}" readonly>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="agudeza_visual_vp_sin_correccion_oi">VP OI</label>
                        <input type="text" id="agudeza_visual_vp_sin_correccion_oi" class="form-control" value="{{ $historialClinico->agudeza_visual_vp_sin_correccion_oi }}" readonly>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="agudeza_visual_vp_sin_correccion_ao">VP AO</label>
                        <input type="text" id="agudeza_visual_vp_sin_correccion_ao" class="form-control" value="{{ $historialClinico->agudeza_visual_vp_sin_correccion_ao }}" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="optotipo">Optotipo</label>
                    <textarea id="optotipo" class="form-control" rows="2" readonly>{{ $historialClinico->optotipo }}</textarea>
                </div>
            </div>

            {{-- LENSOMETRÍA --}}
            <div class="mb-4">
                <h5 class="text-primary">Lensometría</h5>
                <hr>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="lensometria_od">Lensometría OD</label>
                        <input type="text" id="lensometria_od" class="form-control" value="{{ $historialClinico->lensometria_od }}" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="lensometria_oi">Lensometría OI</label>
                        <input type="text" id="lensometria_oi" class="form-control" value="{{ $historialClinico->lensometria_oi }}" readonly>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="tipo_lente">Tipo de Lente</label>
                        <input type="text" id="tipo_lente" class="form-control" value="{{ $historialClinico->tipo_lente }}" readonly>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="material">Material</label>
                        <input type="text" id="material" class="form-control" value="{{ $historialClinico->material }}" readonly>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="filtro">Filtro</label>
                        <input type="text" id="filtro" class="form-control" value="{{ $historialClinico->filtro }}" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="tiempo_uso">Tiempo de Uso</label>
                    <input type="text" id="tiempo_uso" class="form-control" value="{{ $historialClinico->tiempo_uso }}" readonly>
                </div>
            </div>

            {{-- REFRACCIÓN --}}
            <div class="mb-4">
                <h5 class="text-primary">Refracción</h5>
                <hr>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="refraccion_od">Refracción OD</label>
                        <input type="text" id="refraccion_od" class="form-control" value="{{ $historialClinico->refraccion_od }}" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="refraccion_oi">Refracción OI</label>
                        <input type="text" id="refraccion_oi" class="form-control" value="{{ $historialClinico->refraccion_oi }}" readonly>
                    </div>
                </div>
            </div>

            {{-- RX FINAL --}}
            <div class="mb-4">
                <h5 class="text-primary">RX Final</h5>
                <hr>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="rx_final_dp">DP</label>
                        <input type="text" id="rx_final_dp" class="form-control" value="{{ $historialClinico->rx_final_dp }}" readonly>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="rx_final_av_vl">AV VL</label>
                        <input type="text" id="rx_final_av_vl" class="form-control" value="{{ $historialClinico->rx_final_av_vl }}" readonly>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="rx_final_av_vp">AV VP</label>
                        <input type="text" id="rx_final_av_vp" class="form-control" value="{{ $historialClinico->rx_final_av_vp }}" readonly>
                    </div>
                </div>
            </div>

            {{-- DIAGNÓSTICO Y TRATAMIENTO --}}
            <div class="mb-4">
                <h5 class="text-primary">Diagnóstico y Tratamiento</h5>
                <hr>
                <div class="form-group">
                    <label for="diagnostico">Diagnóstico</label>
                    <textarea id="diagnostico" class="form-control" rows="2" readonly>{{ $historialClinico->diagnostico }}</textarea>
                </div>
                <div class="form-group">
                    <label for="tratamiento">Tratamiento</label>
                    <textarea id="tratamiento" class="form-control" rows="2" readonly>{{ $historialClinico->tratamiento }}</textarea>
                </div>
            </div>

            <a href="{{ route('historiales_clinicos.index') }}" class="btn btn-secondary">Volver</a>
        </form>
    </div>
</div>
@stop
