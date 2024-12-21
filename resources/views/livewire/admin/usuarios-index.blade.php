<div class="container mt-4">
    <h1 class="mb-4">Lista de Usuarios</h1>

    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table id="gest-usuarios" class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Acciones</th> <!-- Nueva columna para acciones -->
            </tr>
        </thead>
        <tbody>
            @foreach ($usuarios as $usuario)
                <tr>
                    <td>{{ $usuario->id }}</td>
                    <td>{{ $usuario->name }}</td>
                    <td>{{ $usuario->email }}</td>
                    <td>
                        <!-- Botón de Editar -->
                        <a href="{{ route('admin.users.edit', $usuario) }}" class="btn btn-warning btn-sm">Editar</a>
                        
                        <!-- Botón de Eliminar -->
                        <form action="{{ route('admin.users.destroy', $usuario) }}" method="GET" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que quieres borrar este usuario?');">
                            @csrf
                            @method('DELETE') <!-- Esto indica que se debe usar el método DELETE -->
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
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
            $('#gest-usuarios').DataTable({
                "lengthMenu": [[5,10,50,-1],[5,10,50,"ALL"]]
            });
        });
    </script>
    @stop

</div>