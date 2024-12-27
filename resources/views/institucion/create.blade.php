@extends('adminlte::page')

@section('title', 'Registro de Solicitudes')

@section('content_header')
    <h1>Registro de Solicitudes</h1>
@stop

@section('content')

<div class="container mt-5">
    <h2>Registrar Solicitud</h2>

    <!-- Paso 1 -->
    <h4>Paso 1: Registrar Información del Laboratorio</h4>

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <button class="btn btn-primary" data-toggle="modal" data-target="#modalLaboratorio">Registrar Laboratorio</button>

    <!-- Tabla de registros -->
    <table class="table mt-3" id="tablaRegistros">
        <thead>
            <tr>
                <th>Nombre del Laboratorio</th>
                <th>Ubicación del Laboratorio</th>
                <th>Cantidad de Computadores</th>
                <th>Disponilidad de Internet</th>
            </tr>
        </thead>
        <tbody>
            @foreach($laboratorios as $laboratorio)
                <tr>
                    <td>{{ $laboratorio->name_lab }}</td>
                    <td>{{ $laboratorio->ubicacion_lab }}</td>
                    <td>{{ $laboratorio->cant_pc }}</td>
                    <td>{{ $laboratorio->d_internet }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Modal Laboratorio -->
    <div class="modal fade" id="modalLaboratorio" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Registrar Laboratorio</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formLaboratorio" action="{{ route('institucion.labsolicitud.store') }}" method="POST" onsubmit="return confirm('Confirmar envío, una vez registrados los datos, no pueden modificarse');">
                        @csrf
                        <div class="form-group">
                            <label>Nombre del Laboratorio</label>
                            <input type="text" class="form-control" name="name_lab" required>
                        </div>
                        <div class="form-group">
                            <label>Ubicación</label>
                            <input type="text" class="form-control" name="ubicacion_lab" required>
                        </div>
                        <div class="form-group">
                            <label>Cantidad de PC</label>
                            <input type="number" class="form-control" name="cant_pc" required>
                        </div>
                        <div class="form-group">
                            <label>¿El laboratorio dispone de Internet?</label>
                            <select class="form-control" name="d_internet" required>
                                <option value="" disabled selected>Seleccionar...</option>
                                <option value="Si">Sí</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Detalles Adicionales</label>
                            <textarea class="form-control" name="mensaje" required></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" id="guardarLaboratorio">Guardar</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
    </div>

    <br>
    <!-- Paso 2 -->
    <h4>Paso 2: Verificar Información del Perfil de Usuario</h4>
    <button class="btn btn-secondary" data-toggle="modal" data-target="#modalUsuario">Verificar Información</button>

    <!-- Tabla de Información del Usuario -->
    <table class="table mt-3" id="tablaUsuario">
        <thead>
            <tr>
                <th>Institución</th>
                <th>Teléfono</th>
                <th>Código AMIE</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Dirección</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td id="userInstname">Institución Ejemplo</td>
                <td id="userTelefono">123456789</td>
                <td id="userCodAmie">AMIE123</td>
                <td id="userName">Juan Pérez</td>
                <td id="userEmail">juan@example.com</td>
                <td id="userDireccion">Calle Falsa 123</td>
            </tr>
        </tbody>
    </table>

    <!-- Modal Usuario -->
    <div class="modal fade" id="modalUsuario" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Información del Usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formUsuario">
                        <div class="form-group">
                            <label for="instname">Institución</label>
                            <input type="text" class="form-control" id="instname" value="Institución Ejemplo" required>
                        </div>
                        <div class="form-group">
                            <label for="telefono">Teléfono</label>
                            <input type="text" class="form-control" id="telefono" value="123456789" required>
                        </div>
                        <div class="form-group">
                            <label for="cod_amie">Código AMIE</label>
                            <input type="text" class="form-control" id="cod_amie" value="AMIE123" required>
                        </div>
                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input type="text" class="form-control" id="name" value="Juan Pérez" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Correo Electrónico</label>
                            <input type="email" class="form-control" id="email" value="juan@example.com" required>
                        </div>
                        <div class="form-group">
                            <label for="direccion">Dirección</label>
                            <input type="text" class="form-control" id="direccion" value="Calle Falsa 123" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="guardarUsuario">Guardar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <br>

    <!-- Paso 3 -->
    <h4>Paso 3: Detallar Causas de Mantenimiento</h4>
    <textarea class="form-control mb-3" id="detallesServicio" placeholder="Escribe los detalles de tu solicitud aquí..."></textarea>
    <button class="btn btn-success" id="enviarSolicitud">Enviar Solicitud</button>

    <!-- Solicitudes Enviadas -->
    <div class="mt-4" id="solicitudesEnviadas">
        <h5>Solicitudes Realizadas</h5>
        <ul class="list-group" id="listaSolicitudes"></ul>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>

    $('#guardarUsuario').on('click', function() {
        const instname = $('#instname').val();
        const telefono = $('#telefono').val();
        const codAmie = $('#cod_amie').val();
        const name = $('#name').val();
        const email = $('#email').val();
        const direccion = $('#direccion').val();

        // Actualizar la tabla de usuario
        $('#userInstname').text(instname);
        $('#userTelefono').text(telefono);
        $('#userCodAmie').text(codAmie);
        $('#userName').text(name);
        $('#userEmail').text(email);
        $('#userDireccion').text(direccion);

        $('#modalUsuario').modal('hide');
    });

    $('#enviarSolicitud').on('click', function() {
        const detalles = $('#detallesServicio').val();
        const fechaEnvio = new Date().toLocaleString();
        
        $('#listaSolicitudes').append(`<li class="list-group-item">Solicitud: ${detalles} - Fecha: ${fechaEnvio}</li>`);
        $('#detallesServicio').val(''); // Limpiar el campo de detalles
    });
</script>

@endsection