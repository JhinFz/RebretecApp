@extends('adminlte::page')

@section('title', 'Detalles de la Solicitud')

@section('content_header')
    <h1>Detalles de mi Solicitud</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <p class="card-title"><strong>Asunto:</strong> {{ $solicitud->asunto }} </p>
        </div>
        <div class="card-body">
            <p><strong>Código de Solicitud:</strong> {{ $solicitud->id_soli }}</p>
            <p><strong>Detalles:</strong> {{ $solicitud->detalles_soli }}</p>
            <p><strong>Estado:</strong> 
                <span class="badge 
                {{ 
                    $solicitud->estado_soli == 'procesando' ? 'bg-warning' : 
                    ($solicitud->estado_soli == 'aprobado' ? 'bg-success' : 
                    ($solicitud->estado_soli == 'rechazado' ? 'bg-danger' : ''))
                }}">
                {{ 
                    $solicitud->estado_soli == 'procesando' ? 'En Proceso' : 
                    ($solicitud->estado_soli == 'aprobado' ? 'Aprobado' : 
                    ($solicitud->estado_soli == 'rechazado' ? 'Rechazado' : ''))
                }}
                </span>
                @if($solicitud->estado_soli === 'rechazado')
                    <div class="alert alert-danger mt-3">
                        <strong>Nota:</strong> La solicitud ha sido rechazada. No cumple con los requisitos para la realización de un mantenimiento.
                        <br>
                        Si tiene dudas o desea más información, por favor comuníquese al número <strong>{{ env('PHONE_NUMBER') }}</strong> o envie un correo a la dirección <strong>{{ env('MAIL_USERNAME') }}</strong>.
                    </div>
                @endif
            </p>
            <p><strong>Fecha de Envío:</strong> {{ $solicitud->created_at }}</p>
            <p><strong>Fecha de Aceptación:</strong> {{ $solicitud->fecha_aceptacion ?? '-' }}</p>
    </div>
    <div class="card">
        <div class="card-header">
            <p class="card-title">Datos del técnico asignado:</p>
        </div>
        <div class="card-body">
            <p><strong>Nombre del Técnico Responsable:</strong> {{ $tecnico->user->name ?? '-' }}</p>
            <p><strong>Número de contacto:</strong> {{ $tecnico->telefono ?? '-' }}</p>
            <a href="{{ route('institucion.solicitud.index') }}" class="btn btn-primary">Volver al Listado</a>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop