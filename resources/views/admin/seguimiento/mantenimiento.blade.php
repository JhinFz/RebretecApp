@extends('adminlte::page')

@section('title', 'ADMINISTRACION DE USUARIOS')

@section('content_header')
{{-- <h2>Listado de Problemas del Equipo:</h2> --}}
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
                <h3>Actividades de Mantenimiento Realizadas:</h3>
                @if ($mantenimientos->isEmpty())
                    <div class="alert alert-warning mt-3" role="alert">
                        No hay actividades correctivas registradas para este dispositivo.
                    </div>
                @else
                    <table id="mantenimiento" class="table table-striped mt-3">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Descripción</th>
                                <th>ID</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mantenimientos as $mantenimiento)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $mantenimiento->actividades }}</td>
                                    <td>{{ $mantenimiento->id_mant }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
@include('tecnico.modal_mantenimiento')

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('scripts')

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>


<script>
    function loadDataFromSession(diagnosticoDetail, idDiag) {
            // Asignar valores al modal
            document.getElementById('diagnosticoDetail').textContent = diagnosticoDetail;
            document.getElementById('id_diag').value = idDiag;
    }

        $(document).ready(function () {
            $('#diags').DataTable({
                "lengthMenu": [[5,10,50,-1],[5,10,50,"ALL"]],
                "pageLength": 10,
                "language": {
                    "url": 'https://cdn.datatables.net/plug-ins/2.1.8/i18n/es-ES.json',
                }
            });
        });
    
        $(document).ready(function () {
            $('#mantenimiento').DataTable({
                "lengthMenu": [[5,10,50,-1],[5,10,50,"ALL"]],
                "pageLength": 10,
                "language": {
                    "url": 'https://cdn.datatables.net/plug-ins/2.1.8/i18n/es-ES.json',
                }
            });
        });
</script>   
@stop