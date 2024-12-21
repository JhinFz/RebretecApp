@extends('adminlte::page')

@section('title', 'ADMINISTRACION DE USUARIOS')

@section('content_header')
    <h1>Listado de Usuarios:</h1>
@stop

@section('content')

@livewire('admin.usuarios-index')

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop