<?php

use App\Http\Controllers\Institucion\FormularioController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Institucion\LabController;
use App\Http\Controllers\Institucion\PerfilInstitucionController;
use App\Http\Controllers\Institucion\SolicitudController;
use App\Http\Controllers\ReporteController;

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    
    Route::get('/registro-solicitud/', [FormularioController::class, 'index'])->name('institucion.form.index');
    Route::post('/envio-solicitud/', [FormularioController::class, 'store'])->name('institucion.form.store');

    Route::resource('laboratorios', LabController::class)->names('institucion.lab');
    // Route::resource('estado-solicitudes/', SolicitudController::class)->names('institucion.solicitud');
    // Route::resource('perfil-institucion/', PerfilInstitucionController::class)->names('institucion.perfil');
    Route::get('/mis-solicitudes/{id}', [SolicitudController::class, 'show'])->name('institucion.solicitud.show');
    Route::get('/registro-form/', [SolicitudController::class, 'index'])->name('institucion.solicitud.index');

    Route::put('perfil/{id_perfil}', [PerfilInstitucionController::class, 'update'])->name('institucion.perfil.update');

    // Reportes

    Route::get('/reportes-institucion', function () {return view('reportes.institucion.parametrosInst');})->name('reportes.institucion');
    Route::get('/reporte-gen', [ReporteController::class, 'reporteInstitucion'])->name('genreport.institucion');
});