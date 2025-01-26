@extends('adminlte::page')

@section('title', 'Mis Solicitudes')

@section('content_header')
    <h1>Mis Solicitudes</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Lista de Solicitudes Enviadas</h3>
        </div>
        <div class="card-body">
            <table id='estado-soli' class="table table-bordered">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Asunto</th>
                        <th>Detalles</th>
                        <th>Estado</th>
                        <th>Fecha de Envío</th>
                        <th>Fecha de Aceptación</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($solicitudes->isEmpty())
                        <tr>
                            <td colspan="7" class="text-center">No hay solicitudes registradas.</td>
                        </tr>
                    @else
                        @foreach ($solicitudes as $index => $solicitud)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $solicitud->asunto }}</td>
                            <td>{{ $solicitud->detalles_soli }}</td>
                            <td>
                                <span class="badge 
                                {{ 
                                    $solicitud->estado_soli == 'procesando' ? 'bg-warning' : 
                                    ($solicitud->estado_soli == 'aprobado' ? 'bg-success' : 
                                    ($solicitud->estado_soli == 'rechazado' ? 'bg-danger' : ''))
                                }}">
                                {{ 
                                    $solicitud->estado_soli == 'procesando' ? 'En Proceso' : 
                                    ($solicitud->estado_soli == 'aprobado' ? 'Aprobado' : 
                                    ($solicitud->estado_soli == 'rechazado' ? 'Rechazado' : ''))
                                }}
                            </span>
                            </td>
                            <td>{{ $solicitud->created_at }}</td>
                            <td>{{ $solicitud->fecha_aceptacion ?? '-' }}</td>
                            <td>
                                <!-- Botón de Editar -->
                                <a href="{{ route('institucion.solicitud.show', $solicitud->id_soli) }}" class="btn btn-info btn-sm">Más Información</a>
                            </td>
                        </tr>
                        @endforeach
                    @endif                                     
                </tbody>
            </table>
        </div>

        

        <div>
            <h3>Ejemplos de Solicitud:</h3>
        </div>

        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Asunto</th>
                        <th>Detalles</th>
                        <th>Estado</th>
                        <th>Fecha de Envío</th>
                        <th>Fecha de Aceptación</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Solicitud de Laboratorio A</td>
                        <td>Detalles sobre la solicitud A</td>
                        <td><span class="badge bg-success">Aceptada</span></td>
                        <td>2024-01-15</td>
                        <td>2024-01-20</td>
                        <td>
                            <a href="#" class="btn btn-info btn-sm">Más Información</a>
                        </td>
                    </tr>

                    <tr>
                        <td>2</td>
                        <td>Solicitud de Laboratorio B</td>
                        <td>Detalles sobre la solicitud B</td>
                        <td><span class="badge bg-warning">En Proceso</span></td>
                        <td>2024-02-10</td>
                        <td>-</td>
                        <td>
                            <a href="#" class="btn btn-info btn-sm">Más Información</a>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Solicitud de Laboratorio C</td>
                        <td>Detalles sobre la solicitud C</td>
                        <td><span class="badge bg-danger">Rechazada</span></td>
                        <td>2024-03-05</td>
                        <td>2024-03-10</td>
                        <td>
                            <a href="#" class="btn btn-info btn-sm">Más Información</a>
                        </td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Solicitud de Laboratorio D</td>
                        <td>Detalles sobre la solicitud D</td>
                        <td><span class="badge bg-success">Aceptada</span></td>
                        <td>2024-04-01</td>
                        <td>2024-04-05</td>
                        <td>
                            <a href="#" class="btn btn-info btn-sm">Más Información</a>
                        </td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>Solicitud de Laboratorio E</td>
                        <td>Detalles sobre la solicitud E</td>
                        <td><span class="badge bg-warning">En Proceso</span></td>
                        <td>2024-05-15</td>
                        <td>-</td>
                        <td>
                            <a href="#" class="btn btn-info btn-sm">Más Información</a>
                        </td>
                    </tr>
                   
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#estado-soli').DataTable({
                "lengthMenu": [[5,10,50,-1],[5,10,50,"ALL"]],
                "language": {
                    "url": 'https://cdn.datatables.net/plug-ins/2.1.8/i18n/es-ES.json',
                }
            });
        });
    </script>
@stop