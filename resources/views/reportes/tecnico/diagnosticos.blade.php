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

<h1>Reporte de Diagnósticos de los Equipos Atendidos:</h1>

<h3>Reporte de Datos desde {{ $startDate }} hasta {{ $endDate }}</h3>

<table>
    <thead>
        <tr>
            <th>N°</th>
            <th>ID</th>
            <th>Nombre del Diagnóstico</th>
            <th>Detalles del Diagnóstico</th>
            <th>ID del PC</th>
            <th>Detalles del PC</th>
            <th>Mantenimiento</th>
        </tr>
    </thead>
    <tbody>
        @foreach($diagnosticos as $diagnostico)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $diagnostico->id_diag }}</td>
                <td>{{ $diagnostico->nombre_diag }}</td>
                <td>{{ $diagnostico->diagnostico_detail }}</td>
                <td>{{ $diagnostico->id_pc }}</td>
                <td>{{ $diagnostico->dispositivo->name_pc ?? 'N/A' }}</td>
                <td>{{ $diagnostico->mantenimiento ? 'Sí' : 'No' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="footer">
    <p>Reporte generado el: {{ date('d/m/Y - H:i') }}</p>
</div>

</body>
</html>