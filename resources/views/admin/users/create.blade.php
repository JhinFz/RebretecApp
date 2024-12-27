@extends('adminlte::page')

@section('title', 'ADMINISTRACION DE USUARIOS')

@section('content_header')
    <h1>Listado de Usuarios:</h1>
@stop

@section('content')

@if (session('info'))
    <div class="alert alert-success">
        {{ session('info') }}
    </div>
@endif

<div class="container">
    <h1>Técnicos Pendientes de Aprobación</h1>

    <br>

    <table id="aprobacion-tecnicos" class="table table-striped">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($usuarios as $user)
                @if (!$user->is_approved && $user->tipo_usuario === 'tecnico')
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <form action="{{ route('admin.users.approve', $user) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que quieres aprobar a este usuario?');">
                                @csrf
                                <button type="submit" class="btn btn-success">Aprobar</button>
                            </form>
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que quieres borrar este usuario?');">
                                @csrf
                                @method('DELETE') <!-- Esto indica que se debe usar el método DELETE -->
                                <button type="submit" class="btn btn-danger btn-sm">Borrar</button>
                            </form>
                        </td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
</div>

<br>

<div class="container">
    <h1>Instituciones Educativas Pendientes de Aprobación</h1>

    <br>
    
    <table id="aprobacion-instituciones" class="table table-striped">
        <thead>
            <tr>
                <th>Id</th>
                <th>Código AMIE</th>
                <th>Nombre de la Institución</th>
                <th>Telefono</th>
                <th>Nombre del Representante</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($usuarios as $user)
                @if (!$user->is_approved && $user->tipo_usuario === 'institucion')
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->perfilInstitucion->cod_amie ?? 'N/A'}}</td>
                        <td>{{ $user->perfilInstitucion->instname ?? 'N/A'}}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->name }}</td>
                        <td>
                            <form action="{{ route('admin.users.approve', $user) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que quieres aprobar este usuario?');">
                                @csrf
                                <button type="submit" class="btn btn-success">Aprobar</button>
                            </form>
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que quieres borrar este usuario?');">
                                @csrf
                                @method('DELETE') <!-- Esto indica que se debe usar el método DELETE -->
                                <button type="submit" class="btn btn-danger btn-sm">Borrar</button>
                            </form>
                        </td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
</div>

@endsection

    <!-- Enlaces de paginación -->
@section('js')
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#aprobacion-tecnicos').DataTable({
                "lengthMenu": [[5,10,50,-1],[5,10,50,"ALL"]],
                "language": {
                    "url": 'https://cdn.datatables.net/plug-ins/2.1.8/i18n/es-ES.json',
                }
            });
        });

        $(document).ready(function () {
            $('#aprobacion-instituciones').DataTable({
                "lengthMenu": [[5,10,50,-1],[5,10,50,"ALL"]],
                "language": {
                    "url": 'https://cdn.datatables.net/plug-ins/2.1.8/i18n/es-ES.json',
                }
            });
        });
    </script>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop