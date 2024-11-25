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
        <h1 class="text-center mt-4"><u>Reporte de Donaciones</u></h1>
        <h2 class="text-center mt-4">Sede Morona Santiago</h2>

        <br>
        <!-- Fecha actual -->
        <h5 class="text-right">Fecha: <?php echo date("d/m/Y"); ?></h5>
    </div>
    <br>
    <h2><u>Listado de Donantes:</u></h2>
    <br>
    <table id="donantes" class="table table-striped table-bordered shadow-lg mt-4" style="width:100%">
        <thead class="bg-primary text-white">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombres</th>
                <th scope="col">E-mail</th>
                <th scope="col">Lugar</th>
                <th scope="col">Telefono</th>
                <th scope="col">Fecha</th>
                <th scope="col">Hora</th>
                <th scope="col">Punto de Recolección</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dispositivos as $dispositivo)
            <tr>
                <td>{{$dispositivo->id}}</td>
                <td>{{$dispositivo->nombres}}</td>
                <td>{{$dispositivo->mail}}</td>
                <td>{{$dispositivo->lugar}}</td>
                <td>{{$dispositivo->telefono}}</td>
                <td>{{$dispositivo->fecha}}</td>
                <td>{{$dispositivo->hora}}</td>
                <td>{{$dispositivo->p_recoleccion}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <br><br>
    <h2><u>Listado de Dispositivos:</u></h2>
    <br><br>
    <table id="dispositivos" class="table table-striped table-bordered shadow-lg mt-4" style="width:100%">
        <thead class="bg-primary text-white">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Detalle de Equipo</th>
                <th scope="col">Tipo</th>
                <th scope="col">Marca</th>
                <th scope="col">Modelo</th>
                <th scope="col">Serie</th>
                <th scope="col">Detalle</th>
                <th scope="col">Observaciones</th>
                <th scope="col">Nombre de Donador</th>
                <th scope="col">CI</th>
                <th scope="col">Técnico/Ingeniero</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dispositivos as $dispositivo)
            <tr>
                <td>{{$dispositivo->id}}</td>
                <td>{{$dispositivo->d_equipos}}</td>
                <td>{{$dispositivo->tipo}}</td>
                <td>{{$dispositivo->marca}}</td>
                <td>{{$dispositivo->modelo}}</td>
                <td>{{$dispositivo->serie}}</td>
                <td>{{$dispositivo->detalle}}</td>
                <td>{{$dispositivo->observaciones}}</td>
                <td>{{$dispositivo->n_donante}}</td>
                <td>{{$dispositivo->ci}}</td>
                <td>{{$dispositivo->t_ingeniero}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</html>
