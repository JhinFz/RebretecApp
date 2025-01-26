@extends('adminlte::page')

@section('title', 'ADMINISTRACION DE USUARIOS')

@section('content_header')
    <h1>Generar Reportes</h1>
@stop

@section('content')

    <form action="{{ route('genreport.usuarios.admin') }}" method="GET" target="_blank" class="p-4 border rounded shadow">
        @csrf
        <h3 class="mb-3">Seleccione el conjunto de datos que desea visualizar:</h3>

        <div class="mb-3">
            <label for="data_set" class="form-label">Conjunto de Datos:</label>
            <select name="data_set" id="data_set" class="form-select" required>
                <option value="">Seleccione...</option>
                @foreach($datasets as $dataset => $value)
                    <option value="{{ $dataset }}">{{ $value }}</option>
                @endforeach
            </select>
        </div>

        <h3 class="mb-3">Establecer el rango de fechas:</h3>

        <div class="mb-3">
            <label for="start_date" class="form-label">Desde:</label>
            <input type="date" name="start_date" class="form-control" required>
        </div>
        
        <div class="mb-3">
            <label for="end_date" class="form-label">Hasta:</label>
            <input type="date" name="end_date" class="form-control" required>
        </div>
        
        <button type="submit" class="btn btn-primary">Generar Reporte</button>
    </form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop