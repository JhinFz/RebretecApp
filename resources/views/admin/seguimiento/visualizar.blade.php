@extends('adminlte::page')

@section('title', 'ADMINISTRACION DE USUARIOS')

@section('content_header')
    <h1>Seguimiento de la Solicitud</h1>
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

    @if ($idSoli !== null)
    
        <br>
        <div class="card-body">
            <strong>ID de Solicitud en Atención:</strong> {{ $idSoli }}
        </div>
        <br>
        <table class="table table-bordered table-striped" id="disp-diag-mant">
            <thead class="text-black" style="background-color: #d8d8d8;">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Serie</th>
                    <th>Laboratorio</th>
                    <th>Estado de Diagnóstico</th>
                    <th>Estado de Mantenimiento</th>
                    <th>Visualizar</th>
                </tr>
            </thead>
            <tbody>
                @if ($dispositivos && !$dispositivos->isEmpty())
                    @foreach ($dispositivos as $dispositivo)
                    <tr>
                        <td>{{ $dispositivo->id_pc }}</td>
                        <td>{{ $dispositivo->name_pc }}</td>
                        <td>{{ $dispositivo->marca }}</td>
                        <td>{{ $dispositivo->modelo }}</td>
                        <td>{{ $dispositivo->serie }}</td>
                        <td>{{ $dispositivo->laboratorio->name_lab }}</td>
                        <td>
                            @if ($dispositivo->diagnosticos->contains(function ($diagnostico) {
                                return !is_null($diagnostico->id_diag);
                            }))
                                <div class="badge bg-info">Diagnosticado</div>
                            @else
                                <div class="badge bg-danger">Pendiente</div>
                            @endif
                        </td>
                        <td>
                            @if ($dispositivo->diagnosticos->contains(function ($diagnostico) {
                                return $diagnostico->mantenimiento()->exists();
                            }))
                                <span class="badge bg-success">Corregido</span>
                            @else
                                <span class="badge bg-danger">Pendiente</span>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('seguimiento.diagnosticos', $dispositivo->id_pc) }}" class="btn btn-info">Diagnósticos</a>
                                <a href="{{ route('seguimiento.mantenimiento', $dispositivo->id_pc) }}" class="btn btn-warning">Mantenimientos</a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                @endif                 
            </tbody>
        </table>
    </div>

        <div class="card-body">
            <div class="row justify-content-center">
                <div class="col-auto">
                    <form action="{{ route('finalizar.mant.tecnico') }}" method="POST" style="display: inline;">
                        @csrf
                        <input type="hidden" name="id_soli" value="{{ $idSoli }}">
                        <button type="submit" class="btn btn-success">Volver</button>
                    </form>
                </div>
            </div>
        </div>

    <br>

    @else
        <div class="alert alert-warning" role="alert">
            No tiene solicitudes asignadas
        </div>
    @endif

<!-- Modal para registrar nuevo dispositivo -->
@include('tecnico.modal_dispositivo')

@endsection

@section('scripts')
    
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>

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

        $(document).ready(function () {
            $('#disp-diag-mant').DataTable({
                "lengthMenu": [[5,10,50,-1],[5,10,50,"ALL"]],
                "pageLength": 10,
                "language": {
                    "url": 'https://cdn.datatables.net/plug-ins/2.1.8/i18n/es-ES.json',
                }
            });
        });

    </script>
@endsection