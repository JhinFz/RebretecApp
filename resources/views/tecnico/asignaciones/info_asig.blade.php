@extends('adminlte::page')

@section('title', 'Gestión de Solicitudes')

@section('content_header')
    <h1>Gestión de Solicitud</h1>
@stop

@section('content')

<div class="card">
    <div class="card-header">
        <p class="card-title"><strong>Código de Solicitud:</strong> {{ $solicitud->id_soli }} </p>
    </div>
    <div class="card-body">

        Datos de Contacto

        <p><strong>Nombre de la Institución Educativa:</strong> {{ $solicitud->perfilInstitucion->instname }} </p>
        <p><strong>Código AMIE:</strong> {{ $solicitud->perfilInstitucion->cod_amie }} </p>
        <p><strong>Dirección:</strong> {{ $solicitud->perfilInstitucion->direccion }}</p>
        <p><strong>Nombre del Representante:</strong> {{ $solicitud->perfilInstitucion->user->name }}</p>
        <p><strong>telefono:</strong> {{ $solicitud->perfilInstitucion->telefono }}</p>
        
    </div>
    <div class="card-body">

        Detalles de la solicitud

        <p><strong>Asunto:</strong> {{ $solicitud->asunto }} </p>
        <p><strong>Detalles:</strong> {{ $solicitud->detalles_soli }}</p>
        <p><strong>Fecha de Envío:</strong> {{ $solicitud->created_at }}</p>
    </div>
    <div class="card-body">

        Detalles de los laboratorios 

        <table class="table table-bordered" id="tablaRegistros">
            <thead>
                <tr>
                    <th>Nombre del Laboratorio</th>
                    <th>Ubicación</th>
                    <th>Cantidad de Computadores</th>
                    <th>Disponilidad de Internet</th>
                    <th>Detalles adicionales</th>
                </tr>
            </thead>
            <tbody>
                @foreach($laboratorios as $laboratorio)
                    <tr>
                        <td>{{ $laboratorio->name_lab }}</td>
                        <td>{{ $laboratorio->ubicacion_lab }}</td>
                        <td>{{ $laboratorio->cant_pc }}</td>
                        <td>{{ $laboratorio->d_internet }}</td>
                        <td>{{ $laboratorio->detalles_lab }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-body">

        <a href="{{ route('tecnico.form.index') }}" class="btn btn-success">Comenzar Atención</a>

        <a href="{{ route('tecnico.solicitud.index') }}" class="btn btn-primary">Volver al Listado</a>
        
    </div>
</div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('scripts')

    <script>
        //
    </script>

@endsection