<div class="container mt-4">
    <h1 class="mb-4">Listado de Técnicos</h1>

    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table id="gest-tecnicos" class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Acciones</th> <!-- Nueva columna para acciones -->
            </tr>
        </thead>
        <tbody>
            @foreach ($usuarios as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <!-- Botón de Editar -->
                        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-warning btn-sm">Editar</a>
                        
                        <!-- Botón de Eliminar -->
                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que quieres borrar este usuario?');">
                            @csrf
                            @method('DELETE') <!-- Esto indica que se debe usar el método DELETE -->
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
<div class="container">
<h1>Listado de Instituciones Educativas</h1>
</div>
    <table id="gest-instituciones" class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre del Representante</th>
                <th>Email</th>
                <th>Acciones</th> <!-- Nueva columna para acciones -->
            </tr>
        </thead>
        <tbody>
            @foreach ($usuarios as $user)
                @if ($user->tipo_usuario === 'institucion')
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <!-- Botón de Editar -->
                        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-warning btn-sm">Editar</a>
                        
                        <!-- Botón de Eliminar -->
                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que quieres borrar este usuario?');">
                            @csrf
                            @method('DELETE') <!-- Esto indica que se debe usar el método DELETE -->
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endif
            @endforeach
        </tbody>
    </table>


    <!-- Enlaces de paginación -->
    @section('js')
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#gest-tecnicos').DataTable({
                "lengthMenu": [[5,10,50,-1],[5,10,50,"ALL"]],
                "language": {
                    "url": 'https://cdn.datatables.net/plug-ins/2.1.8/i18n/es-ES.json',
                }
            });
        });

        $(document).ready(function () {
            $('#gest-instituciones').DataTable({
                "lengthMenu": [[5,10,50,-1],[5,10,50,"ALL"]],
                "language": {
                    "url": 'https://cdn.datatables.net/plug-ins/2.1.8/i18n/es-ES.json',
                }
            });
        });
    </script>
    @stop

</div>