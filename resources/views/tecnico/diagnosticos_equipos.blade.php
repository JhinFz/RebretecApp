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
        <h6>
            <p>En esta sección se deben ingresar los dispositivos que necesiten el servicio de mantenimiento (Botón Registrar Nuevo Dispositivo).</p>
        </h6> 
        <h6>
            <p>
                Por cada dispositivo ingresado, se podrá registrar las causas del mantenimiento (Botón Diagnóstico) 
                y sus acciones correctivas (Botón Mantenimiento).
            </p>
        </h6>
    </div>

    @if ($idSoli !== null)
    
        <div>
            <button class="btn btn-primary" data-toggle="modal" data-target="#registrarDispositivoModal">Registrar Nuevo Dispositivo</button>
        </div>
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
                    <th>Acción</th>
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
                                <a href="{{ route('tecnico.diagnostico.show', $dispositivo->id_pc) }}" class="btn btn-info">Diagnóstico</a>
                                <a href="{{ route('tecnico.mantenimiento.show', $dispositivo->id_pc) }}" class="btn btn-warning">Mantenimiento</a>
                                <form action="{{ route('tecnico.dispositivo.destroy', $dispositivo->id_pc) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que quieres borrar este dispositivo?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>                           
                        </td>
                    </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="9" class="text-center">No hay equipos registrados.</td>
                    </tr>
                @endif                 
            </tbody>
        </table>
    </div>

    @if ($dispositivos && $dispositivos->every(function ($dispositivo) {
        return $dispositivo->diagnosticos->isNotEmpty() && $dispositivo->diagnosticos->contains(function ($diagnostico) {
            return $diagnostico->mantenimiento()->count() > 0; // Verifica que existan mantenimientos
        });
    }))
        <div class="card-body">
            <div class="row justify-content-center">
                <strong>
                    Una vez completado el mantenimiento a cada computador, ya puede proceder a finalizar el servicio:
                </strong> 
            </div>
            <br>
            <div class="row justify-content-center">
                <div class="col-auto">
                    <form action="{{ route('finalizar.mant.tecnico') }}" method="POST" style="display: inline;">
                        @csrf
                        <input type="hidden" name="id_soli" value="{{ $idSoli }}">
                        <button type="submit" class="btn btn-success">Finalizar Atención</button>
                    </form>
                </div>
            </div>
        </div>
    @endif

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