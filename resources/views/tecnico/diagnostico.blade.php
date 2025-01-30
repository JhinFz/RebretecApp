@extends('adminlte::page')

@section('title', 'ADMINISTRACION DE USUARIOS')

@section('content_header')
<h2>Listado de Problemas del Equipo:</h2>
@stop

@section('content')

<div class="container">
    
    <div class="row mt-4">
        <!-- Columna para los detalles del dispositivo -->
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5>Detalles del Dispositivo</h5>
                    <p><strong>ID:</strong> {{ $dispositivo->id_pc }}</p>
                    <p><strong>Modelo:</strong> {{ $dispositivo->modelo }}</p>
                    <p><strong>Marca:</strong> {{ $dispositivo->marca }}</p>
                    <!-- Agrega más detalles según sea necesario -->
                </div>
            </div>
        </div>
        <!-- Columna para los diagnósticos -->
        <div class="col-md-8">
            <div class="mt-4">
                <div class="mt-4">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#diagnosticModal">Registrar Nuevo Diagnóstico</button>
                </div>
                <br>

                @if ($dispositivo && $dispositivo->diagnosticos && $dispositivo->diagnosticos->isEmpty())
                    <div class="alert alert-warning mt-3" role="alert">
                        No hay diagnósticos registrados para este dispositivo.
                    </div>
                @else
                    <table id="diags" class="table table-striped mt-3">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Descripción</th>
                                <th>Fecha</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dispositivo->diagnosticos as $diagnostico)
                                <tr>
                                    <td>{{ $diagnostico->id_diag }}</td>
                                    <td>{{ $diagnostico->diagnostico_detail }}</td>
                                    <td>{{ $diagnostico->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Modal para registrar nuevo diagnóstico -->
<div class="modal fade" id="diagnosticModal" tabindex="-1" role="dialog" aria-labelledby="diagnosticModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="diagnosticModalLabel">Registrar Nuevo Diagnóstico</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('tecnico.diagnostico.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id_pc" value="{{ $dispositivo->id_pc }}">
                    <div class="form-group">
                        <label for="nombre_diag">Nombre del Diagnóstico:</label>
                        <textarea class="form-control" id="nombre_diag" name="nombre_diag" rows="1" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="diagnostico_detail">Descripción:</label>
                        <textarea class="form-control" id="diagnostico_detail" name="diagnostico_detail" rows="3" required></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Registrar Diagnóstico</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function () {
        $('#diags').DataTable({
                "lengthMenu": [[5,10,50,-1],[5,10,50,"ALL"]],
                "pageLength": 10,
                "language": {
                    "url": 'https://cdn.datatables.net/plug-ins/2.1.8/i18n/es-ES.json',
                }
            });
        });
    </script>
@stop