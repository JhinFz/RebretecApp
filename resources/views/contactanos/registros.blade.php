@extends('adminlte::page')

@section('title', 'CRUD de Dispositivos')

@section('content_header')
    <h1>Listado de Solicitudes:</h1>
@stop

@section('content')

<div align="right">
    <a href="{{route('contactanos.pdf')}}" class="btn btn-danger" target="_blank">Reporte PDF</a>
</div>
<br>    
@if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
<table id="solicitudes" class="table table-striped table-bordered shadow-lg mt-4" style="width:100%">
    <thead class=" text-white" style="background-color: #0ca32b;">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Nombre de la Institución</th>
            <th scope="col">Representante</th>
            <th scope="col">E-mail</th>
            <th scope="col">Teléfono</th>
            <th scope="col">Dirección</th>
            <th scope="col">Mensaje</th>
            <th scope="col">Fecha de envío</th>
            <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($contactos as $contacto)
        <tr>
            <td>{{$contacto->id}}</td>
            <td>{{$contacto->instname}}</td>
            <td>{{$contacto->name}}</td>
            <td>{{$contacto->correo}}</td>
            <td>{{$contacto->telefono}}</td>
            <td>{{$contacto->direccion}}</td>
            <td>{{$contacto->mensaje}}</td>
            <td>{{$contacto->fecha}}</td>
            <td>
                @csrf
                <a href="" data-bs-toggle="" data-bs-target="" class="btn btn-success btn-sm">Aprobar</a>
                <a href="{{ route('admin.solicitud.destroy', $contacto) }}" data-bs-toggle="" data-bs-target="" class="btn btn-danger btn-sm">Rechazar</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css">
@stop

<!-- Enlaces de paginación -->
@section('js')
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function () {
        $('#solicitudes').DataTable({
            "lengthMenu": [[5,10,50,-1],[5,10,50,"ALL"]]
        });
    });
</script>
@stop