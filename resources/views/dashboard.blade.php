@extends('adminlte::page')

@section('title', 'ADMINISTRACION DE USUARIOS')

@section('content_header')
    <h1>Menú Inicio</h1>
@stop

@section('content')

<div class="container mt-5">
    <h1>Bienvenido, {{ Auth::user()->name }}!</h1>

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

        <a href="" class="btn btn-primary">Administrar Usuarios</a>
        <a href="" class="btn btn-secondary">Configuraciones</a>
        <a href="" class="btn btn-success">Informes</a>
        <a href="" class="btn btn-info">Dashboard</a>
        <a href="" class="btn btn-danger">Cerrar Sesión</a>

        @endif

        @if(Auth::user()->hasRole('Tecnico')) 

        <a href="" class="btn btn-primary">Administrar Usuarios</a>
        <a href="" class="btn btn-secondary">Configuraciones</a>
        <a href="" class="btn btn-success">Informes</a>
        <a href="" class="btn btn-info">Dashboard</a>
        <a href="" class="btn btn-danger">Cerrar Sesión</a>

        @endif

        
        @if(Auth::user()->hasRole('Institucion')) 

        <a href="" class="btn btn-primary">Solicitar Mantenimiento</a>
        <a href="" class="btn btn-secondary">Ver Estado de Solicitudes Enviadas</a>
        <a href="" class="btn btn-info">Página Principal</a>
        <a href="" class="btn btn-danger">Cerrar Sesión</a>

        @endif

    </div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop