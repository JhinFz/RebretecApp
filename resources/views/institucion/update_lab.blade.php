@extends('adminlte::page')

@section('title', 'Editar Laboratorio')

@section('content_header')
    <h1>Editar Laboratorio</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Formulario de Edición</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('institucion.lab.update', $laboratorio->id_lab) }}" method="POST">
                @csrf
                @method('PUT') <!-- Método PUT para actualizar -->
                
                <div class="mb-3">
                    <label for="name_lab" class="form-label">Nombre del Laboratorio</label>
                    <input type="text" name="name_lab" id="name_lab" class="form-control" value="{{ old('name_lab', $laboratorio->name_lab) }}" required>
                </div>

                <div class="mb-3">
                    <label for="ubicacion_lab" class="form-label">Ubicación del Laboratorio</label>
                    <input type="text" name="ubicacion_lab" id="ubicacion_lab" class="form-control" value="{{ old('ubicacion_lab', $laboratorio->ubicacion_lab) }}" required>
                </div>

                <div class="mb-3">
                    <label for="cant_pc" class="form-label">Cantidad de Computadores</label>
                    <input type="number" name="cant_pc" id="cant_pc" class="form-control" value="{{ old('cant_pc', $laboratorio->cant_pc) }}" required>
                </div>

                <div class="mb-3">
                    <label for="d_internet" class="form-label">Disponibilidad de Internet</label>
                    <select name="d_internet" id="d_internet" class="form-control">
                        <option value="Sí" {{ $laboratorio->d_internet == 'Sí' ? 'selected' : '' }}>Sí</option>
                        <option value="No" {{ $laboratorio->d_internet == 'No' ? 'selected' : '' }}>No</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Detalles Adicionales</label>
                    <input type="text" name="detalles_lab" class="form-control" value="{{ old('detalles_lab', $laboratorio->detalles_lab) }}" required>
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-success">Actualizar Laboratorio</button>
                    <a href="{{ route('institucion.form.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop