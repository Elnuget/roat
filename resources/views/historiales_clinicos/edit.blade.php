@extends('adminlte::page')

@section('title', 'Editar Historial Clínico')

@section('content_header')
<h1 class="mb-3">Editar Historial Clínico</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('historiales_clinicos.update', $historialClinico) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- DATOS DEL PACIENTE --}}
            <div class="mb-4">
                <h5 class="text-primary">Datos del Paciente</h5>
                <hr>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="nombres">Nombres <span class="text-danger">*</span></label>
                        <input 
                            type="text" 
                            name="nombres" 
                            id="nombres" 
                            class="form-control" 
                            value="{{ $historialClinico->nombres }}" 
                            required
                        >
                    </div>
                    <div class="form-group col-md-6">
                        <label for="apellidos">Apellidos <span class="text-danger">*</span></label>
                        <input 
                            type="text" 
                            name="apellidos" 
                            id="apellidos" 
                            class="form-control" 
                            value="{{ $historialClinico->apellidos }}" 
                            required
                        >
                    </div>
                    <div class="form-group col-md-6">
                        <label for="edad">Edad <span class="text-danger">*</span></label>
                        <input 
                            type="number" 
                            name="edad" 
                            id="edad" 
                            class="form-control" 
                            value="{{ $historialClinico->edad }}" 
                            required
                        >
                    </div>
                    <div class="form-group col-md-6">
                        <label for="fecha_nacimiento">Fecha de Nacimiento <span class="text-danger">*</span></label>
                        <input 
                            type="date" 
                            name="fecha_nacimiento" 
                            id="fecha_nacimiento" 
                            class="form-control" 
                            value="{{ $historialClinico->fecha_nacimiento }}" 
                            required
                        >
                    </div>
                    <div class="form-group col-md-6">
                        <label for="celular">Celular <span class="text-danger">*</span></label>
                        <input 
                            type="text" 
                            name="celular" 
                            id="celular" 
                            class="form-control" 
                            value="{{ $historialClinico->celular }}" 
                            required
                        >
                    </div>
                    <div class="form-group col-md-6">
                        <label for="ocupacion">Ocupación <span class="text-danger">*</span></label>
                        <input 
                            type="text" 
                            name="ocupacion" 
                            id="ocupacion" 
                            class="form-control" 
                            value="{{ $historialClinico->ocupacion }}" 
                            required
                        >
                    </div>
                    <div class="form-group col-md-6">
                        <label for="fecha">Fecha <span class="text-danger">*</span></label>
                        <input 
                            type="date" 
                            name="fecha" 
                            id="fecha" 
                            class="form-control" 
                            value="{{ $historialClinico->fecha }}" 
                            required
                        >
                    </div>
                </div>
            </div>

            {{-- MOTIVO DE CONSULTA / ENFERMEDAD ACTUAL --}}
            <div class="mb-4">
                <h5 class="text-primary">Motivo de Consulta</h5>
                <hr>
                <div class="form-row">
                    <div class="form-group col-12 col-sm-6">
                        <label for="motivo_consulta">Motivo de la Consulta <span class="text-danger">*</span></label>
                        <input 
                            type="text" 
                            name="motivo_consulta" 
                            id="motivo_consulta" 
                            class="form-control" 
                            value="{{ $historialClinico->motivo_consulta }}" 
                            required
                        >
                    </div>
                    <div class="form-group col-12 col-sm-6">
                        <label for="enfermedad_actual">Enfermedad Actual</label>
                        <input 
                            type="text" 
                            name="enfermedad_actual" 
                            id="enfermedad_actual" 
                            class="form-control" 
                            value="{{ $historialClinico->enfermedad_actual }}"
                        >
                    </div>
                </div>
            </div>

            {{-- ANTECEDENTES --}}
            <div class="mb-4">
                <h5 class="text-primary">Antecedentes</h5>
                <hr>
                <div class="form-group">
                    <label for="antecedentes_personales_oculares">Antecedentes Personales Oculares</label>
                    <textarea 
                        name="antecedentes_personales_oculares" 
                        id="antecedentes_personales_oculares" 
                        class="form-control" 
                        rows="2"
                        required
                    >{{ $historialClinico->antecedentes_personales_oculares }}</textarea>
                </div>
                <div class="form-group">
                    <label for="antecedentes_personales_generales">Antecedentes Personales Generales</label>
                    <textarea 
                        name="antecedentes_personales_generales" 
                        id="antecedentes_personales_generales" 
                        class="form-control" 
                        rows="2"
                        required
                    >{{ $historialClinico->antecedentes_personales_generales }}</textarea>
                </div>
                <div class="form-group">
                    <label for="antecedentes_familiares_oculares">Antecedentes Familiares Oculares</label>
                    <textarea 
                        name="antecedentes_familiares_oculares" 
                        id="antecedentes_familiares_oculares" 
                        class="form-control" 
                        rows="2"
                        required
                    >{{ $historialClinico->antecedentes_familiares_oculares }}</textarea>
                </div>
                <div class="form-group">
                    <label for="antecedentes_familiares_generales">Antecedentes Familiares Generales</label>
                    <textarea 
                        name="antecedentes_familiares_generales" 
                        id="antecedentes_familiares_generales" 
                        class="form-control" 
                        rows="2"
                        required
                    >{{ $historialClinico->antecedentes_familiares_generales }}</textarea>
                </div>
            </div>

            {{-- AGUDEZA VISUAL --}}
            <div class="mb-4">
                <h5 class="text-primary">Agudeza Visual (sin Corrección)</h5>
                <hr>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="agudeza_visual_vl_sin_correccion_od">VL OD</label>
                        <input 
                            type="text" 
                            name="agudeza_visual_vl_sin_correccion_od" 
                            id="agudeza_visual_vl_sin_correccion_od" 
                            class="form-control"
                            value="{{ $historialClinico->agudeza_visual_vl_sin_correccion_od }}"
                        >
                    </div>
                    <div class="form-group col-md-4">
                        <label for="agudeza_visual_vl_sin_correccion_oi">VL OI</label>
                        <input 
                            type="text" 
                            name="agudeza_visual_vl_sin_correccion_oi" 
                            id="agudeza_visual_vl_sin_correccion_oi" 
                            class="form-control"
                            value="{{ $historialClinico->agudeza_visual_vl_sin_correccion_oi }}"
                        >
                    </div>
                    <div class="form-group col-md-4">
                        <label for="agudeza_visual_vl_sin_correccion_ao">VL AO</label>
                        <input 
                            type="text" 
                            name="agudeza_visual_vl_sin_correccion_ao" 
                            id="agudeza_visual_vl_sin_correccion_ao" 
                            class="form-control"
                            value="{{ $historialClinico->agudeza_visual_vl_sin_correccion_ao }}"
                        >
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="agudeza_visual_vp_sin_correccion_od">VP OD</label>
                        <input 
                            type="text" 
                            name="agudeza_visual_vp_sin_correccion_od" 
                            id="agudeza_visual_vp_sin_correccion_od" 
                            class="form-control"
                            value="{{ $historialClinico->agudeza_visual_vp_sin_correccion_od }}"
                        >
                    </div>
                    <div class="form-group col-md-4">
                        <label for="agudeza_visual_vp_sin_correccion_oi">VP OI</label>
                        <input 
                            type="text" 
                            name="agudeza_visual_vp_sin_correccion_oi" 
                            id="agudeza_visual_vp_sin_correccion_oi" 
                            class="form-control"
                            value="{{ $historialClinico->agudeza_visual_vp_sin_correccion_oi }}"
                        >
                    </div>
                    <div class="form-group col-md-4">
                        <label for="agudeza_visual_vp_sin_correccion_ao">VP AO</label>
                        <input 
                            type="text" 
                            name="agudeza_visual_vp_sin_correccion_ao" 
                            id="agudeza_visual_vp_sin_correccion_ao" 
                            class="form-control"
                            value="{{ $historialClinico->agudeza_visual_vp_sin_correccion_ao }}"
                        >
                    </div>
                </div>
                <div class="form-group">
                    <label for="optotipo">Optotipo</label>
                    <textarea 
                        name="optotipo" 
                        id="optotipo" 
                        class="form-control" 
                        rows="2"
                    >{{ $historialClinico->optotipo }}</textarea>
                </div>
            </div>

            {{-- LENSOMETRÍA --}}
            <div class="mb-4">
                <h5 class="text-primary">Lensometría</h5>
                <hr>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="lensometria_od">Lensometría OD</label>
                        <input 
                            type="text" 
                            name="lensometria_od" 
                            id="lensometria_od" 
                            class="form-control"
                            value="{{ $historialClinico->lensometria_od }}"
                        >
                    </div>
                    <div class="form-group col-md-6">
                        <label for="lensometria_oi">Lensometría OI</label>
                        <input 
                            type="text" 
                            name="lensometria_oi" 
                            id="lensometria_oi" 
                            class="form-control"
                            value="{{ $historialClinico->lensometria_oi }}"
                        >
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="tipo_lente">Tipo de Lente</label>
                        <input 
                            type="text" 
                            name="tipo_lente" 
                            id="tipo_lente" 
                            class="form-control"
                            value="{{ $historialClinico->tipo_lente }}"
                        >
                    </div>
                    <div class="form-group col-md-4">
                        <label for="material">Material</label>
                        <input 
                            type="text" 
                            name="material" 
                            id="material" 
                            class="form-control"
                            value="{{ $historialClinico->material }}"
                        >
                    </div>
                    <div class="form-group col-md-4">
                        <label for="filtro">Filtro</label>
                        <input 
                            type="text" 
                            name="filtro" 
                            id="filtro" 
                            class="form-control"
                            value="{{ $historialClinico->filtro }}"
                        >
                    </div>
                </div>
                <div class="form-group">
                    <label for="tiempo_uso">Tiempo de Uso</label>
                    <input 
                        type="text" 
                        name="tiempo_uso" 
                        id="tiempo_uso" 
                        class="form-control"
                        value="{{ $historialClinico->tiempo_uso }}"
                    >
                </div>
            </div>

            {{-- REFRACCIÓN --}}
            <div class="mb-4">
                <h5 class="text-primary">Refracción</h5>
                <hr>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="refraccion_od">Refracción OD</label>
                        <input 
                            type="text" 
                            name="refraccion_od" 
                            id="refraccion_od" 
                            class="form-control"
                            value="{{ $historialClinico->refraccion_od }}"
                        >
                    </div>
                    <div class="form-group col-md-6">
                        <label for="refraccion_oi">Refracción OI</label>
                        <input 
                            type="text" 
                            name="refraccion_oi" 
                            id="refraccion_oi" 
                            class="form-control"
                            value="{{ $historialClinico->refraccion_oi }}"
                        >
                    </div>
                </div>
            </div>

            {{-- RX FINAL --}}
            <div class="mb-4">
                <h5 class="text-primary">Rx Final</h5>
                <hr>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="rx_final_dp">DP</label>
                        <input 
                            type="text" 
                            name="rx_final_dp" 
                            id="rx_final_dp" 
                            class="form-control"
                            value="{{ $historialClinico->rx_final_dp }}"
                        >
                    </div>
                    <div class="form-group col-md-4">
                        <label for="rx_final_av_vl">AV VL</label>
                        <input 
                            type="text" 
                            name="rx_final_av_vl" 
                            id="rx_final_av_vl" 
                            class="form-control"
                            value="{{ $historialClinico->rx_final_av_vl }}"
                        >
                    </div>
                    <div class="form-group col-md-4">
                        <label for="rx_final_av_vp">AV VP</label>
                        <input 
                            type="text" 
                            name="rx_final_av_vp" 
                            id="rx_final_av_vp" 
                            class="form-control"
                            value="{{ $historialClinico->rx_final_av_vp }}"
                        >
                    </div>
                </div>
            </div>

            {{-- DIAGNÓSTICO Y TRATAMIENTO --}}
            <div class="mb-4">
                <h5 class="text-primary">Diagnóstico y Tratamiento</h5>
                <hr>
                <div class="form-group">
                    <label for="diagnostico">Diagnóstico</label>
                    <textarea 
                        name="diagnostico" 
                        id="diagnostico" 
                        class="form-control" 
                        rows="2"
                    >{{ $historialClinico->diagnostico }}</textarea>
                </div>
                <div class="form-group">
                    <label for="tratamiento">Tratamiento</label>
                    <textarea 
                        name="tratamiento" 
                        id="tratamiento" 
                        class="form-control" 
                        rows="2"
                    >{{ $historialClinico->tratamiento }}</textarea>
                </div>
            </div>

            {{-- BOTÓN DE GUARDAR CON MODAL DE CONFIRMACIÓN --}}
            <div class="d-flex justify-content-end">
                <a href="{{ route('historiales_clinicos.index') }}" class="btn btn-secondary mr-2">
                    Cancelar
                </a>
                <button 
                    type="button" 
                    class="btn btn-primary" 
                    data-toggle="modal" 
                    data-target="#modal"
                >
                    Guardar
                </button>
            </div>

            {{-- MODAL DE CONFIRMACIÓN --}}
            <div class="modal fade" id="modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Confirmar Edición</h4>
                            <button 
                                type="button" 
                                class="close" 
                                data-dismiss="modal" 
                                aria-label="Close"
                            >
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>¿Está seguro que desea guardar los cambios?</p>
                        </div>
                        <div class="modal-footer">
                            <button 
                                type="button" 
                                class="btn btn-secondary" 
                                data-dismiss="modal"
                            >
                                Cancelar
                            </button>
                            <button 
                                type="submit" 
                                class="btn btn-primary"
                            >
                                Guardar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@stop

@section('js')
<script>
document.addEventListener('keydown', function(event) {
    if (event.key === "Home") {
        window.location.href = '/dashboard';
    }
});
</script>
@stop
