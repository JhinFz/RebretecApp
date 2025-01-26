<!DOCTYPE html>
<html>
<head>
    <title>Reporte PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        h1 {
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Reporte de Usuarios desde {{ $startDate }} hasta {{ $endDate }}</h1>
    <table border="1" width="100%">
        <thead>
            <tr>
                <th>N°</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Fecha de Creación</th>
                <th>ID</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at }}</td>
                    <td>{{ $user->id }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="footer">
        <p>Reporte generado el: {{ date('d/m/Y - H:i') }}</p>
    </div>
</body>
</html>