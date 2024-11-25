@extends('layouts.plantillabase');

@section('contenido')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
    <body>
        <div class="container">
            <h1 class="text-center">SEDE MORONA SANTIAGO</h1> 
            <br>
            @if(session("correcto"))
                <div class="alert alert-success">{{session("correcto")}}</div>
            @endif
            @if(session("incorrecto"))
                <div class="alert alert-danger">{{session("incorrecto")}}</div>
            @endif
            <form action="{{route("donacion.create")}}" method="POST">
              @csrf
              <table class="table">
                @error('nombres')
                  <p><strong>{{$message}}</strong></p>
                @enderror
                @error('correo')
                  <p><strong>{{$message}}</strong></p>
                @enderror
                @error('lugar')
                  <p><strong>{{$message}}</strong></p>
                @enderror
                @error('telefono')
                  <p><strong>{{$message}}</strong></p>
                @enderror
                @error('fecha')
                  <p><strong>{{$message}}</strong></p>
                @enderror
                @error('hora')
                  <p><strong>{{$message}}</strong></p>
                @enderror
                @error('punto_recoleccion')
                  <p><strong>{{$message}}</strong></p>
                @enderror
                @error('detalle')
                  <p><strong>{{$message}}</strong></p>
                @enderror
                @error('tipos')
                  <p><strong>{{$message}}</strong></p>
                @enderror
                @error('marca')
                  <p><strong>{{$message}}</strong></p>
                @enderror
                @error('modelo')
                  <p><strong>{{$message}}</strong></p>
                @enderror
                @error('serie')
                  <p><strong>{{$message}}</strong></p>
                @enderror
                @error('detalle2')
                  <p><strong>{{$message}}</strong></p>
                @enderror
                @error('observaciones')
                  <p><strong>{{$message}}</strong></p>
                @enderror
                @error('nombre_donador')
                  <p><strong>{{$message}}</strong></p>
                @enderror
                @error('cl')
                  <p><strong>{{$message}}</strong></p>
                @enderror
                @error('tecnico_ingeniero')
                  <p><strong>{{$message}}</strong></p>
                @enderror

                <tr>
                  <td>Nombres:</td>
                  <td class="col-6"><input type="text" class="form-control" name="nombres"></td>
                  <td>Correo electrónico:</td>
                  <td class="col-6"><input type="email" class="form-control" name="correo"></td>
                </tr>
                <tr>
                  <td>Lugar:</td>
                  <td><input type="text" class="form-control" name="lugar"></td>
                  <td>Teléfono:</td>
                  <td><input type="tel" class="form-control" name="telefono"></td>
                </tr>
                <tr>
                  <td>Fecha:</td>
                  <td><input type="date" class="form-control" name="fecha"></td>
                  <td>Hora:</td>
                  <td><input type="time" class="form-control" name="hora"></td>
                  
                </tr>
                <tr>
                    <td>Punto de recolección:</td>
                    <td colspan="3"><input type="text" class="form-control" name="punto_recoleccion"></td>
                </tr>
                
                <tr>
                  <td>Detalle de Equipos:</td>
                  <td colspan="3"><textarea class="form-control" name="detalle"></textarea></td>
                </tr>
                <tr>
                  <td>Tipos:</td>
                  <td><input type="text" class="form-control" name="tipos"></td>
                  <td>Marca:</td>
                  <td><input type="text" class="form-control" name="marca"></td>
                </tr>
                <tr>
                  <td>Modelo:</td>
                  <td><input type="text" class="form-control" name="modelo"></td>
                  <td>Serie:</td>
                  <td><input type="text" class="form-control" name="serie"></td>
                </tr>
                <tr>
                  <td>Detalle:</td>
                  <td colspan="3"><textarea class="form-control" name="detalle2"></textarea></td>
                </tr>
                <tr>
                  <td>OBSERVACIONES:</td>
                  <td colspan="3"><textarea class="form-control" name="observaciones"></textarea></td>
                </tr>
                <tr>
                  <td colspan="4">Términos y condiciones: La parte Donante declara ser propietaria del bien mueble objeto de la presente nota de entrega, además tiene la intención libre, voluntaria de donar y no realizar ningún reclamo posterior a la entrega del equipo informático a la institución.</td>
                </tr>
                
                <tr>
                  <td>Nombre del Donador:</td>
                  <td><input type="text" class="form-control" name="nombre_donador"></td>
                  <td>#C.L:</td>
                  <td><input type="text" class="form-control" name="cl"></td>
                </tr>
                <tr>
                  <td>Técnico / Ingeniero:</td>
                  <td colspan="3"><input type="text" class="form-control" name="tecnico_ingeniero"></td>
                </tr>
              </table>

              <a href="{{route("registros")}}" class="btn btn-secondary">Cancelar</a>
              <button type="submit" class="btn btn-success">Guardar</button>
              
            </form>
          </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    </body>
</html>

@endsection