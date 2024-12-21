@extends('adminlte::page')

@section('title', 'CRUD de Dispositivos')

@section('content_header')
    <h1 align="center"><u>REGISTROS</u></h1>
@stop

@section('content')
<h2>Listado de Instituciones:</h2>
<div align="right">
    <a href="{{route('dispositivo.pdf')}}" class="btn btn-danger" target="_blank">Reporte PDF</a>
</div>
<a href="{{route("registro.form")}}" class="btn btn-success">Insertar Registro</a>
<br><br>

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
            <th scope="col">Ubicación</th>
            <th scope="col">Acciones</th>
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
            <td>
                @csrf
                <a href="" data-bs-toggle="modal" data-bs-target="#modalEditar{{ $dispositivo->id }}" class="btn btn-warning btn-sm">Editar</a>
                <a href="{{route('elim',$dispositivo->id)}}" class="btn btn-danger btn-sm">Borrar</a>          
                <!-- @method('DELETE')
                <button type="submit" class="btn btn-danger">Borrar</button>
                -->           
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<br><br>
<h2>Listado de Equipos:</h2>
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
            <th scope="col">Nombre del Representante</th>
            <th scope="col">CI</th>
            <th scope="col">Técnico/Ingeniero</th>
            <th scope="col">Acciones</th>
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
            <td>
                @csrf
                <a href="" data-bs-toggle="modal" data-bs-target="#modalEditar{{ $dispositivo->id }}" class="btn btn-warning btn-sm"><i class="fa-regular fa-pen-to-square"></i></a>
                <a href="{{route('elim',$dispositivo->id)}}" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash-can"></i></a>          
                <!-- @method('DELETE')
                <button type="submit" class="btn btn-danger">Borrar</button>
                -->           
            </td>


                <!-- Modal de modificar datos-->
                <div class="modal fade" id="modalEditar{{ $dispositivo->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Modificar Datos de los Registros de las donaciones</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                        <div class="modal-body">
                        <form action="{{route('donacion.modificar')}}" method="POST">
                        @csrf
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">ID:</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="txtid" value="{{ $dispositivo->id }}" readonly>
                                        
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Cédula del Representante:</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="txtci" value="{{ $dispositivo->ci }}">
                                        
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Nombres:</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="txtnombres" value="{{ $dispositivo->nombres }}">
                                        
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Correo electrónico:</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="txtmail" value="{{ $dispositivo->mail }}">
                                        
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Lugar:</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="txtlugar" value="{{ $dispositivo->lugar }}">
                                        
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Teléfono:</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="txttelf" value="{{ $dispositivo->telefono }}">
                                        
                                    </div>
                                    <div class="mb-3">

                                        <label for="exampleInputEmail1" class="form-label">Fecha:</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="txtfecha" value="{{ $dispositivo->fecha }}">
                                        
                                    </div>

                                    <div class="mb-3">

                                        <label for="exampleInputEmail1" class="form-label">Hora:</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="txthora" value="{{ $dispositivo->hora }}"> 
                                        
                                    </div>
                                    
                                    <div class="mb-3">

                                        <label for="exampleInputEmail1" class="form-label">Punto de recolección:</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="txtprecoleccion" value="{{ $dispositivo->p_recoleccion }}">
                                        
                                    </div>
                                    <div class="mb-3">

                                        <label for="exampleInputEmail1" class="form-label">Detalles de equipos:</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="txtdetalleq" value="{{ $dispositivo->d_equipos }}">
                                        
                                    </div>
                                    <div class="mb-3">

                                        <label for="exampleInputEmail1" class="form-label">Tipo:</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="txttipo" value="{{ $dispositivo->tipo }}">
                                        
                                    </div>
                                    <div class="mb-3">

                                        <label for="exampleInputEmail1" class="form-label">Marca:</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="txtmarca" value="{{ $dispositivo->marca }}">
                                        
                                    </div>
                                    <div class="mb-3">

                                        <label for="exampleInputEmail1" class="form-label">Modelo:</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="txtmodelo" value="{{ $dispositivo->modelo }}">
                                        
                                    </div>
                                    <div class="mb-3">

                                        <label for="exampleInputEmail1" class="form-label">Serie:</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="txtserie" value="{{ $dispositivo->serie }}" >
                                        
                                    </div>
                                    <div class="mb-3">

                                        <label for="exampleInputEmail1" class="form-label">Detalle:</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="txtdetalle" value="{{ $dispositivo->detalle }}">
                                        
                                    </div>
                                    <div class="mb-3">

                                        <label for="exampleInputEmail1" class="form-label">Observaciones:</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="txtobservacion" value="{{ $dispositivo->observaciones }}">
                                        
                                    </div>
                                    <div class="mb-3">

                                        <label for="exampleInputEmail1" class="form-label">Nombre del Representante:</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="txtnombre" value="{{ $dispositivo->n_donante }}">
                                        
                                    </div>
                                    <div class="mb-3">

                                        <label for="exampleInputEmail1" class="form-label">Técnico/Ingeniero:</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="txtencargado" value="{{ $dispositivo->t_ingeniero }}">
                                        
                                    </div>
                               
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                        <button type="submit" class="btn btn-primary">Modificar</button>
                                    </div>
                                </form>
                            </div>
                            
                        </div>
                        
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
   
        </tr>
        @endforeach
    </tbody>
</table>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
    <script src="https://kit.fontawesome.com/b6b3c6b97d.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#donantes').DataTable({
                "lengthMenu": [[5,10,50,-1],[5,10,50,"ALL"]]
            });
        });
        $(document).ready(function () {
            $('#dispositivos').DataTable({
                "lengthMenu": [[5,10,50,-1],[5,10,50,"ALL"]]
            });
        });
    </script>
@stop