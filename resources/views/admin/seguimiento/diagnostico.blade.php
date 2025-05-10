@extends('adminlte::page')

@section('title', 'ADMINISTRACION DE USUARIOS')

@section('content_header')
<h2>Listado de Diagnósticos (Problemas) del Equipo:</h2>
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
                    <!-- Agregar más detalles según sea necesario -->
                </div>
            </div>
        </div>
        <!-- Columna para los diagnósticos -->
        <div class="col-md-8">
            <div class="mt-4">

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