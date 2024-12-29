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
            </p>
            <p><strong>Fecha de Envío:</strong> {{ $solicitud->created_at }}</p>
            <p><strong>Fecha de Aceptación:</strong> {{ $solicitud->fecha_aceptacion ?? '-' }}</p>
            <a href="{{ route('institucion.solicitud.index') }}" class="btn btn-primary">Volver al Listado</a>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop