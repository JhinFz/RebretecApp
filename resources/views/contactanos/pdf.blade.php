<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Donaciones</title>
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <!-- Contenedor principal -->
    <div class="container">
        <!-- Logo -->
        <div class="text-center mt-4">
            <img src="{{ asset('assets/logos/original_.JPG') }}" alt="Logo de la organización" width="500">
        </div>

        <!-- Título -->
        <h1 class="text-center mt-4"><u>Reporte de Solicitudes</u></h1>
        <h2 class="text-center mt-4">Sede Morona Santiago</h2>

        <br>
        <!-- Fecha actual -->
        <h5 class="text-right">Fecha: <?php echo date("d/m/Y"); ?></h5>
    </div>
    <br>
    <h2><u>Listado de Solicitudes:</u></h2>
    <br>
    <table id="dispositivos" class="table table-striped table-bordered shadow-lg mt-4" style="width:100%">
    <thead class=" text-white" style="background-color: #0ca32b;">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Nombres</th>
            <th scope="col">E-mail</th>
            <th scope="col">Detalles</th>
            <th scope="col">Teléfono</th>
            <th scope="col">Dirección</th>
            <th scope="col">Fecha de creación</th>
        </tr>
    </thead>
    <tbody>
        @foreach($contactos as $contacto)
        <tr>
            <td>{{$contacto->id}}</td>
            <td>{{$contacto->nombre}}</td>
            <td>{{$contacto->correo}}</td>
            <td>{{$contacto->mensaje}}</td>
            <td>{{$contacto->telefono}}</td>
            <td>{{$contacto->direccion}}</td>
            <td>{{$contacto->equipo}}</td>
            <td>{{$contacto->fecha}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
</html>