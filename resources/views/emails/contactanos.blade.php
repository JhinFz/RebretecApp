<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Correo de Prueba</h1>
    <p>correo enviado desde laravel</p>

    <p><strong>Nombre de la Institución: </strong>{{$contacto['instname']}}</p>
    <p><strong>Nombre del Representante: </strong>{{$contacto['name']}}</p>
    <p><strong>Teléfono: </strong>{{$contacto['telefono']}}</p>
    <p><strong>Correo electrónico: </strong>{{$contacto['correo']}}</p>
    <p><strong>Dirección/Ubicación: </strong>{{$contacto['direccion']}}</p>
    <p><strong>Detalles: </strong>{{$contacto['mensaje']}}</p>
</body>
</html>