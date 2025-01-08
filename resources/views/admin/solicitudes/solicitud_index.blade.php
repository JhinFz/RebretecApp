@extends('adminlte::page')

@section('title', 'Mis Solicitudes')

@section('content_header')
    <h1>Solicitudes</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Lista de Solicitudes Recibidas</h3>
        </div>
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
        <div class="card-body">
            <table class="table table-bordered" id="gest-solit">
                <thead class=" text-white" style="background-color: #2dc228;">
                    <tr>
                        <th>ID</th>
                        <th>Institución Educativa</th>
                        <th>Asunto</th>
                        <th>Detalles</th>
                        <th>Fecha de Envío</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                        @foreach ($solicitudes as $index => $solicitud)
                        <tr>
                            <td>{{ $solicitud->id_soli }}</td>
                            <td>{{ $solicitud->perfilInstitucion->instname }}</td>
                            <td>{{ $solicitud->asunto }}</td>
                            <td>{{ $solicitud->detalles_soli }}</td>
                            <td>{{ $solicitud->created_at }}</td>
                            <td>
                                <a href="{{ route('admin.solicitud.edit', $solicitud->id_soli) }}" data-bs-toggle="" data-bs-target="" class="btn btn-success btn-sm">Comprobar</a>
                                <form action="{{ route('admin.solicitud.destroy', $solicitud->id_soli) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que quieres rechazar esta solicitud?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Rechazar</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach             
                </tbody>
            </table>
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
            $('#gest-solit').DataTable({
                "lengthMenu": [[5,10,50,-1],[5,10,50,"ALL"]],
                "language": {
                    "url": 'https://cdn.datatables.net/plug-ins/2.1.8/i18n/es-ES.json',
                }
            });
        });

    </script>
@stop