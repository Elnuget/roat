@extends('adminlte::page')

@section('title', 'Crear Historial Clínico')

@section('content_header')
    <h1 class="mb-3">Crear Historial Clínico</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('historiales_clinicos.store') }}" method="POST">
            @csrf

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
                            placeholder="Ingresa los nombres del paciente"
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
                            placeholder="Ingresa los apellidos del paciente"
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
                            placeholder="Ingresa la edad del paciente"
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
                            placeholder="Ingresa el número de celular del paciente"
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
                            placeholder="Ingresa la ocupación del paciente"
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
                            placeholder="¿Qué molestias presenta?"
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
                            placeholder="Breve descripción de la enfermedad actual"
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
                        placeholder="Ingresa aquí si hay algún antecedente ocular personal relevante"
                    ></textarea>
                </div>
                <div class="form-group">
                    <label for="antecedentes_personales_generales">Antecedentes Personales Generales</label>
                    <textarea 
                        name="antecedentes_personales_generales" 
                        id="antecedentes_personales_generales" 
                        class="form-control" 
                        rows="2"
                        placeholder="Ingresa aquí los antecedentes generales de importancia"
                    ></textarea>
                </div>
                <div class="form-group">
                    <label for="antecedentes_familiares_oculares">Antecedentes Familiares Oculares</label>
                    <textarea 
                        name="antecedentes_familiares_oculares" 
                        id="antecedentes_familiares_oculares" 
                        class="form-control" 
                        rows="2"
                        placeholder="Registra antecedentes oculares en la familia"
                    ></textarea>
                </div>
                <div class="form-group">
                    <label for="antecedentes_familiares_generales">Antecedentes Familiares Generales</label>
                    <textarea 
                        name="antecedentes_familiares_generales" 
                        id="antecedentes_familiares_generales" 
                        class="form-control" 
                        rows="2"
                        placeholder="Registra antecedentes generales importantes en la familia"
                    ></textarea>
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
                            placeholder="Ej: 20/20"
                        >
                    </div>
                    <div class="form-group col-md-4">
                        <label for="agudeza_visual_vl_sin_correccion_oi">VL OI</label>
                        <input 
                            type="text" 
                            name="agudeza_visual_vl_sin_correccion_oi" 
                            id="agudeza_visual_vl_sin_correccion_oi" 
                            class="form-control"
                            placeholder="Ej: 20/25"
                        >
                    </div>
                    <div class="form-group col-md-4">
                        <label for="agudeza_visual_vl_sin_correccion_ao">VL AO</label>
                        <input 
                            type="text" 
                            name="agudeza_visual_vl_sin_correccion_ao" 
                            id="agudeza_visual_vl_sin_correccion_ao" 
                            class="form-control"
                            placeholder="Ej: 20/20"
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
                            placeholder="Ej: 20/20"
                        >
                    </div>
                    <div class="form-group col-md-4">
                        <label for="agudeza_visual_vp_sin_correccion_oi">VP OI</label>
                        <input 
                            type="text" 
                            name="agudeza_visual_vp_sin_correccion_oi" 
                            id="agudeza_visual_vp_sin_correccion_oi" 
                            class="form-control"
                            placeholder="Ej: 20/25"
                        >
                    </div>
                    <div class="form-group col-md-4">
                        <label for="agudeza_visual_vp_sin_correccion_ao">VP AO</label>
                        <input 
                            type="text" 
                            name="agudeza_visual_vp_sin_correccion_ao" 
                            id="agudeza_visual_vp_sin_correccion_ao" 
                            class="form-control"
                            placeholder="Ej: 20/20"
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
                        placeholder="Especifica la cartilla o método utilizado para la prueba"
                    ></textarea>
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
                            placeholder="Ej: -2.00 / +1.00 x 90"
                        >
                    </div>
                    <div class="form-group col-md-6">
                        <label for="lensometria_oi">Lensometría OI</label>
                        <input 
                            type="text" 
                            name="lensometria_oi" 
                            id="lensometria_oi" 
                            class="form-control"
                            placeholder="Ej: -1.50 / +0.75 x 80"
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
                            placeholder="Ej: Monofocal, Bifocal, etc."
                        >
                    </div>
                    <div class="form-group col-md-4">
                        <label for="material">Material</label>
                        <input 
                            type="text" 
                            name="material" 
                            id="material" 
                            class="form-control"
                            placeholder="Ej: Policarbonato, CR-39, etc."
                        >
                    </div>
                    <div class="form-group col-md-4">
                        <label for="filtro">Filtro</label>
                        <input 
                            type="text" 
                            name="filtro" 
                            id="filtro" 
                            class="form-control"
                            placeholder="Ej: Antirreflejo, Luz Azul, Transitions..."
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
                        placeholder="Ej: Uso diario, sólo para lectura, etc."
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
                            placeholder="Ej: -2.00 / +1.00 x 90"
                        >
                    </div>
                    <div class="form-group col-md-6">
                        <label for="refraccion_oi">Refracción OI</label>
                        <input 
                            type="text" 
                            name="refraccion_oi" 
                            id="refraccion_oi" 
                            class="form-control"
                            placeholder="Ej: -1.50 / +0.75 x 80"
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
                            placeholder="Distancia Pupilar (mm)"
                        >
                    </div>
                    <div class="form-group col-md-4">
                        <label for="rx_final_av_vl">AV VL</label>
                        <input 
                            type="text" 
                            name="rx_final_av_vl" 
                            id="rx_final_av_vl" 
                            class="form-control"
                            placeholder="Agudeza Visual lejana"
                        >
                    </div>
                    <div class="form-group col-md-4">
                        <label for="rx_final_av_vp">AV VP</label>
                        <input 
                            type="text" 
                            name="rx_final_av_vp" 
                            id="rx_final_av_vp" 
                            class="form-control"
                            placeholder="Agudeza Visual cercana"
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
                        placeholder="Describe el diagnóstico del paciente"
                    ></textarea>
                </div>
                <div class="form-group">
                    <label for="tratamiento">Tratamiento</label>
                    <textarea 
                        name="tratamiento" 
                        id="tratamiento" 
                        class="form-control" 
                        rows="2"
                        placeholder="Describir el tratamiento o recomendaciones"
                    ></textarea>
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
                            <h4 class="modal-title">Confirmar Creación</h4>
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
                            <p>¿Está seguro que desea guardar este nuevo historial clínico?</p>
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
