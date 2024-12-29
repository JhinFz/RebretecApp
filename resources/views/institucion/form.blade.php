@extends('adminlte::page')

@section('title', 'Registro de Solicitudes')

@section('content_header')
    <h1>Registro de Solicitudes</h1>
@stop

@section('content')

<div class="container mt-5">
    <h2 class="text-center">Registrar Solicitud</h2>

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
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($laboratorios as $laboratorio)
                <tr>
                    <td>{{ $laboratorio->name_lab }}</td>
                    <td>{{ $laboratorio->ubicacion_lab }}</td>
                    <td>{{ $laboratorio->cant_pc }}</td>
                    <td>{{ $laboratorio->d_internet }}</td>
                    <td>
                        <!-- Botón de Editar -->
                        <a href="{{ route('institucion.lab.edit', $laboratorio->id_lab) }}" class="btn btn-warning btn-sm">Editar</a>
                                
                        <!-- Botón de Eliminar -->
                        <form action="{{ route('institucion.lab.destroy', $laboratorio->id_lab) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este laboratorio?');">
                            @csrf
                            @method('DELETE') <!-- Esto indica que se debe usar el método DELETE -->
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Tiempo en milisegundos (por ejemplo, 5000 ms = 5 segundos)
            var timeout = 5000;

            // Ocultar el mensaje de éxito después del tiempo especificado
            setTimeout(function() {
                $('#success-message').fadeOut('slow');
            }, timeout);

            // Ocultar el mensaje de error después del tiempo especificado
            setTimeout(function() {
                $('#error-message').fadeOut('slow');
            }, timeout);
        });
    </script>
@endsection