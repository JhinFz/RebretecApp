@extends('adminlte::page')

@section('title', 'ADMINISTRACION DE USUARIOS')

@section('content_header')
    <h1>Menú Inicio</h1>
@stop

@section('content')

<div class="container mt-5">
    <h1>Bienvenido/a, {{ Auth::user()->name }}!</h1>

    @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-message">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

    @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert" id="error-message">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
    @endif
    
    <div class="mt-4">

        @if(Auth::user()->hasRole('Administrador')) 

        <div class="flex-wrap mb-3">
            <a href="{{ route('admin.users.index') }}" class="btn btn-primary me-2">Administrar Usuarios</a>
            <a href="{{ route('admin.solicitud.index') }}" class="btn btn-secondary me-2">Solicitudes</a>
            <a href="" class="btn btn-success me-2">Informes</a>
            <a href="{{ url('/logout') }}" class="btn btn-danger me-2">Cerrar Sesión</a>
        </div>
            @if ($conteos['solicitudes'] > 0)
                <div class="alert alert-warning" role="alert">
                    <strong>Notificación:</strong> Hay {{ $conteos['solicitudes'] }} solicitud(es) de mantenimiento recibidas que necesitan aprobación.
                    <a href="{{ route('admin.solicitud.index') }}" class="btn btn-info me-2">Comprobar</a>
                </div>
            @endif
            @if ($conteos['tecnicos'] > 0)
                <div class="alert alert-warning" role="alert">
                    <strong>Notificación:</strong> Hay {{ $conteos['tecnicos'] }} cuenta(s) de técnico(s) registradas que necesitan aprobación.
                    <a href="{{ route('admin.users.create') }}" class="btn btn-info me-2">Comprobar</a>
                </div>
            @endif
            @if ($conteos['instituciones'] > 0)
                <div class="alert alert-warning" role="alert">
                    <strong>Notificación:</strong> Hay {{ $conteos['instituciones'] }} cuenta(s) de Instituciones Educativas registradas que necesitan aprobación.
                    <a href="{{ route('admin.users.create') }}" class="btn btn-info me-2">Comprobar</a>
                </div>
            @endif
        @endif

        @if(Auth::user()->hasRole('Tecnico')) 

        <div class="flex-wrap mb-3">
            <a href="{{ route('tecnico.solicitud.index') }}" class="btn btn-primary">Revisar Solicitudes Asignadas</a>
            <a href="{{ route('tecnico.form.index') }}" class="btn btn-secondary">Acciones Pendientes</a>
            <a href="{{ url('user/profile') }}" class="btn btn-success">Configuraciones</a>
            <a href="" class="btn btn-info">Informes</a>
            <a href="{{ url('/logout') }}" class="btn btn-danger">Cerrar Sesión</a>
        </div>
            @if ($conteos['solicitudAsig'] > 0)
                <div class="alert alert-warning" role="alert">
                    <strong>Notificación:</strong> Hay {{ $conteos['solicitudAsig'] }} solicitud(es) de mantenimiento asignada que necesitan atención.
                    <a href="{{ route('tecnico.solicitud.index') }}" class="btn btn-info me-2">Comprobar</a>
                </div>
            @endif

        @endif

        
        @if(Auth::user()->hasRole('Institucion')) 

        <div class="flex-wrap mb-3">
            <a href="" class="btn btn-primary">Solicitar Mantenimiento</a>
            <a href="" class="btn btn-secondary">Ver Estado de Solicitudes Enviadas</a>
            <a href="" class="btn btn-info">Página Principal</a>
            <a href="" class="btn btn-danger">Cerrar Sesión</a>
        </div>
            @if ($conteos['solicitudAcep'] > 0)
                <div class="alert alert-success" role="alert">
                    <strong>Notificación:</strong> Hay {{ $conteos['solicitudAcep'] }} solicitud(es) de mantenimiento que ha sido aprobado por el Administrador.
                    <a href="{{ route('institucion.solicitud.index') }}" class="btn btn-info me-2">Comprobar</a>
                </div>
            @endif
        @endif

    </div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop