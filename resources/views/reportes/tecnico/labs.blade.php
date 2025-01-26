<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Solicitudes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
        }
    </style>
</head>
<body>

<h1>Reporte de los Laboratorios Atendidos:</h1>

<h3>Reporte de Datos desde {{ $startDate }} hasta {{ $endDate }}</h3>

<table>
    <thead>
        <tr>
            <th>N°</th>
            <th>ID</th>
            <th>Nombre</th>
            <th>Ubicación</th>
            <th>Cantidad de PCs</th>
            <th>Disponibilidad de Internet</th>
            <th>Detalles</th>
            <th>ID de Perfil</th>
            <th>Perfil de Institución</th>
        </tr>
    </thead>
    <tbody>
        @foreach($laboratorios as $laboratorio)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $laboratorio->id_lab }}</td>
                <td>{{ $laboratorio->name_lab }}</td>
                <td>{{ $laboratorio->ubicacion_lab }}</td>
                <td>{{ $laboratorio->cant_pc }}</td>
                <td>{{ $laboratorio->d_internet }}</td>
                <td>{{ $laboratorio->detalles_lab }}</td>
                <td>{{ $laboratorio->id_perfil }}</td>
                <td>{{ $laboratorio->perfilInstitucion->nombre_perfil ?? 'N/A' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="footer">
    <p>Reporte generado el: {{ date('d/m/Y - H:i') }}</p>
</div>

</body>
</html>