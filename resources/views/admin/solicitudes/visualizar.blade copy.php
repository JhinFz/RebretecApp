@extends('adminlte::page')

@section('title', 'Gestión de Solicitudes')

@section('content_header')
    <h1>Gestión de Solicitud</h1>
@stop

@section('content')

<div class="card">
    <div class="card-header">
        <p class="card-title"><strong>Código de Solicitud:</strong> {{ $solicitud->id_soli }} </p>
    </div>
    <div class="card-body">

        Datos de Contacto

        <p><strong>Nombre de la Institución Educativa:</strong> {{ $solicitud->perfilInstitucion->instname }} </p>
        <p><strong>Código AMIE:</strong> {{ $solicitud->perfilInstitucion->cod_amie }} </p>
        <p><strong>Dirección:</strong> {{ $solicitud->perfilInstitucion->direccion }}</p>
        <p><strong>Nombre del Representante:</strong> {{ $solicitud->perfilInstitucion->user->name }}</p>
        <p><strong>telefono:</strong> {{ $solicitud->perfilInstitucion->telefono }}</p>
        
    </div>
    <div class="card-body">

        Detalles de la solicitud

        <p><strong>Asunto:</strong> {{ $solicitud->asunto }} </p>
        <p><strong>Detalles:</strong> {{ $solicitud->detalles_soli }}</p>
        <p><strong>Fecha de Envío:</strong> {{ $solicitud->created_at }}</p>
    </div>
    <div class="card-body">

        Detalles de los laboratorios 

        <table class="table table-bordered" id="tablaRegistros">
            <thead>
                <tr>
                    <th>Nombre del Laboratorio</th>
                    <th>Ubicación</th>
                    <th>Cantidad de Computadores</th>
                    <th>Disponilidad de Internet</th>
                    <th>Detalles adicionales</th>
                </tr>
            </thead>
            <tbody>
                @foreach($laboratorios as $laboratorio)
                    <tr>
                        <td>{{ $laboratorio->name_lab }}</td>
                        <td>{{ $laboratorio->ubicacion_lab }}</td>
                        <td>{{ $laboratorio->cant_pc }}</td>
                        <td>{{ $laboratorio->d_internet }}</td>
                        <td>{{ $laboratorio->detalles_lab }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-body">

        <button class="btn btn-success" data-toggle="modal" data-target="#modalAprobar">Asignar Técnico</button>

        <a href="{{ route('institucion.solicitud.index') }}" class="btn btn-primary">Volver al Listado</a>

        @include('admin.solicitudes.modal_aprobar')
        
    </div>
</div>

<select id="mySelect" style="width: 200px;">
    <option value="1">Opción 1</option>
    <option value="2">Opción 2</option>
    <option value="3">Opción 3</option>
</select>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css"/>
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $(document).on('shown.bs.modal','#modalAprobar', function () {
                $('#searchTecnico').select2({
                    placeholder: "Selecciona un técnico", // Placeholder al inicializar
                });
            })
            $(document).on('hidden.bs.modal', '#modalAprobar', function () {
                $('#searchTecnico').select2('destroy'); // Destruir la instancia
            });
        });
        
        // $(document).ready(function() {
        //     $(#modalAprobar).on('show.bs.modal', function () {
        //         $('#tecnico').select2({
        //             placeholder: "Selecciona un técnico", // Placeholder al inicializar
        //         });
        //     });
        // });



            // const tecnicoInput = document.getElementById('tecnico');
            // const sugerenciasList = document.getElementById('sugerencias');

            // tecnicoInput.addEventListener('input', function() {
            //     const valor = this.value;

            //     if (valor) {
            //         // Usar la ruta nombrada para la búsqueda
            //         fetch(`{{ route('buscar.tecnico') }}?query=${valor}`)
            //             .then(response => response.json())
            //             .then(tecnicos => {
            //                 sugerenciasList.innerHTML = '';
            //                 if (tecnicos.length) {
            //                     sugerenciasList.style.display = 'block';
            //                     tecnicos.forEach(tecnico => {
            //                         const li = document.createElement('li');
            //                         li.className = 'list-group-item list-group-item-action';
            //                         li.textContent = tecnico.name;
            //                         li.onclick = function() {
            //                             tecnicoInput.value = tecnico.name;
            //                             sugerenciasList.innerHTML = '';
            //                             document.getElementById('id_tecnico').value = tecnico.id; // ID permanece igual
            //                         };
            //                         sugerenciasList.appendChild(li);
            //                     });
            //                 } else {
            //                     sugerenciasList.style.display = 'none';
            //                 }
            //             });
            //     } else {
            //         sugerenciasList.style.display = 'none';
            //     }
            // });
    </script>

@endsection