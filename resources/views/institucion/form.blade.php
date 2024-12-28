@extends('adminlte::page')

@section('title', 'Registro de Solicitudes')

@section('content_header')
    <h1>Registro de Solicitudes</h1>
@stop

@section('content')

<div class="container mt-5">
    <h2 class="text-center">Registrar Solicitud</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Paso 1 -->
    <h4>Paso 1: Registrar Información del Laboratorio</h4>

    <button class="btn btn-primary" data-toggle="modal" data-target="#modalLaboratorio">Registrar Laboratorio</button>

    <!-- Tabla de registros -->
    <table class="table mt-3" id="tablaRegistros">
        <thead>
            <tr>
                <th>Nombre del Laboratorio</th>
                <th>Ubicación del Laboratorio</th>
                <th>Cantidad de Computadores</th>
                <th>Disponilidad de Internet</th>
            </tr>
        </thead>
        <tbody>
            @foreach($laboratorios as $laboratorio)
                <tr>
                    <td>{{ $laboratorio->name_lab }}</td>
                    <td>{{ $laboratorio->ubicacion_lab }}</td>
                    <td>{{ $laboratorio->cant_pc }}</td>
                    <td>{{ $laboratorio->d_internet }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    <!-- Modal Laboratorio -->
    @include('institucion.modal_lab')

    <br>
    <!-- Paso 2 -->
    <h4>Paso 2: Verificar Información del Perfil de la Institución Educativa</h4>
    <button class="btn btn-warning" data-toggle="modal" data-target="#modalUsuario">Verificar Información</button>

    <!-- Tabla de Información del Usuario -->

    <table class="table mt-3" id="tablaUsuario">
        <thead>
            <tr>
                <th style="width: 30%;">Campo</th>
                <th style="width: 70%;">Valor</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Nombre de la Institución Educativa</td>
                <td>{{ $perfil->instname }}</td>
            </tr>
            <tr>
                <td>Código AMIE</td>
                <td>{{ $perfil->cod_amie }}</td>
            </tr>
            <tr>
                <td>Número de Teléfono</td>
                <td>{{ $perfil->telefono }}</td>
            </tr>
            <tr>
                <td>Dirección del Establecimiento</td>
                <td>{{ $perfil->direccion }}</td>
            </tr>
            <tr>
                <td>Nombre del Representante</td>
                <td>{{ Auth::user()->name ?? 'No disponible' }}</td>
            </tr>
        </tbody>
    </table>

    <!-- Modal Usuario -->
    @include('institucion.modal_perfil')

    <br>

    <!-- Paso 3 -->
    <h4>Paso 3: Detallar Causas de Mantenimiento</h4>
    
    <br>

    @include('institucion.modal_solicitud')

    <br>
    
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script>
    //
</script>

@endsection