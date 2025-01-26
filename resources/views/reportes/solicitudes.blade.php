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

<h1>Reporte de Solicitudes</h1>

<table>
    <thead>
        <tr>
            <th>N°</th>
            <th>Asunto</th>
            <th>Estado</th>
            <th>Fecha de Aceptación</th>
            <th>Técnico Asignado</th>
            <th>Cumplimiento</th>
            <th>ID</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($solicitudes as $solicitud)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $solicitud->asunto }}</td>
            <td>{{ $solicitud->estado_soli }}</td>
            <td>{{ $solicitud->fecha_aceptacion ?? 'No'}}</td>
            <td>{{ $solicitud->perfilTecnico->user->name ?? 'No' }}</td>
            <td>{{ $solicitud->cumplimiento == 1 ? 'Completado' : 'No' }}</td>
            <td>{{ $solicitud->id_soli }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="footer">
    <p>Reporte generado el: {{ date('d/m/Y - H:i') }}</p>
</div>

</body>
</html>