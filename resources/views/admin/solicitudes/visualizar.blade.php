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

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('scripts')

    <script>
            const tecnicoInput = document.getElementById('tecnico');
            const sugerenciasList = document.getElementById('sugerencias');

            tecnicoInput.addEventListener('input', function() {
                const valor = this.value;

                if (valor) {
                    // Usar la ruta nombrada para la búsqueda
                    fetch(`{{ route('buscar.tecnico') }}?query=${valor}`)
                        .then(response => response.json())
                        .then(tecnicos => {
                            sugerenciasList.innerHTML = '';
                            if (tecnicos.length) {
                                sugerenciasList.style.display = 'block';
                                tecnicos.forEach(tecnico => {
                                    const li = document.createElement('li');
                                    li.className = 'list-group-item list-group-item-action';
                                    li.textContent = tecnico.name;
                                    li.onclick = function() {
                                        tecnicoInput.value = tecnico.name;
                                        sugerenciasList.innerHTML = '';
                                        document.getElementById('id_tecnico').value = tecnico.id; // ID permanece igual
                                    };
                                    sugerenciasList.appendChild(li);
                                });
                            } else {
                                sugerenciasList.style.display = 'none';
                            }
                        });
                } else {
                    sugerenciasList.style.display = 'none';
                }
            });
    </script>

@endsection