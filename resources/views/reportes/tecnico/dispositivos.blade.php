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

<h3>Reporte de Datos desde {{ $startDate }} hasta {{ $endDate }}</h3>

<table>
    <thead>
        <tr>
            <th>N°</th>
            <th>ID</th>
            <th>Nombre</th>
            <th>Marca</th>
            <th>Modelo</th>
            <th>Serie</th>
            <th>ID de Laboratorio</th>
        </tr>
    </thead>
    <tbody>
        @foreach($dispositivos as $dispositivo)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $dispositivo->id_pc }}</td>
                <td>{{ $dispositivo->name_pc }}</td>
                <td>{{ $dispositivo->marca }}</td>
                <td>{{ $dispositivo->modelo }}</td>
                <td>{{ $dispositivo->serie }}</td>
                <td>{{ $dispositivo->laboratorio->id_lab }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="footer">
    <p>Reporte generado el: {{ date('d/m/Y - H:i') }}</p>
</div>

</body>
</html>