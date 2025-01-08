@extends('adminlte::page')

@section('title', 'ADMINISTRACION DE USUARIOS')

@section('content_header')
    <h1>Registro de Equipos y Actividades:</h1>
@stop

@section('content')
<div class="container">

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
</div>
<div class="card-body">
    <div>
        <button class="btn btn-success" data-toggle="modal" data-target="#registrarDispositivoModal">Registrar Nuevo Dispositivo</button>
    </div>
    <br>
    <table class="table table-bordered table-striped" id="gest-solit">
        <thead class="text-black" style="background-color: #d8d8d8;">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Serie</th>
                <th>Laboratorio</th>
                <th>Fecha de Diagnóstico</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
                @foreach ($dispositivos as $dispositivo)
                <tr>
                    <td>{{ $dispositivo->id_pc }}</td>
                    <td>{{ $dispositivo->name_pc }}</td>
                    <td>{{ $dispositivo->marca }}</td>
                    <td>{{ $dispositivo->modelo }}</td>
                    <td>{{ $dispositivo->serie }}</td>
                    <td>{{ $dispositivo->laboratorio->name_lab }}</td>
                    <td>2025-01-02 15:58</td>
                    <td>
                        <a href="{{ route('tecnico.diagnostico.show', $dispositivo->id_pc) }}" class="btn btn-info">Diagnóstico</a>
                        <a href="{{ route('tecnico.mantenimiento.show', $dispositivo->id_pc) }}" class="btn btn-warning">Mantenimiento</a>
                    </td>
                </tr>
                
                @endforeach

                @if ($dispositivos->isEmpty())
                    <tr>
                        <td colspan="7" class="text-center">No hay equipos registrados.</td>
                    </tr>
                @endif                 
        </tbody>
    </table>
</div>

<!-- Modal para registrar nuevo dispositivo -->
@include('tecnico.modal_dispositivo')

@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectElement = document.getElementById('id_lab');

            // Cargar valor seleccionado del Local Storage
            const selectedLabId = localStorage.getItem('selectedLabId');
            if (selectedLabId) {
                selectElement.value = selectedLabId;
            }

            // Guardar el valor seleccionado en el Local Storage
            selectElement.addEventListener('change', function() {
                localStorage.setItem('selectedLabId', selectElement.value);
            });
        });
    </script>
@endsection