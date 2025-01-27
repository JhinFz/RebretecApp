<?php

use App\Http\Controllers\ReporteController;
use App\Http\Controllers\Tecnico\DiagnosticoController;
use App\Http\Controllers\Tecnico\DispositivoController;
use App\Http\Controllers\Tecnico\MantenimientoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Tecnico\TecnicoFormController;
use App\Http\Controllers\Tecnico\TecnSolicitController;

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    
    Route::get('/formulario-registro/', [TecnicoFormController::class, 'index'])->name('tecnico.form.index');

    Route::resource('dispositivo', DispositivoController::class)->names([
        'index' => 'tecnico.dispositivo.index',
        'create' => 'tecnico.dispositivo.create',
        'store' => 'tecnico.dispositivo.store',
        'show' => 'tecnico.dispositivo.show',
        'edit' => 'tecnico.dispositivo.edit',
        'update' => 'tecnico.dispositivo.update',
        'destroy' => 'tecnico.dispositivo.destroy',
    ]);
    Route::resource('diagnostico', DiagnosticoController::class)->names([
        'index' => 'tecnico.diagnostico.index',
        'create' => 'tecnico.diagnostico.create',
        'store' => 'tecnico.diagnostico.store',
        'show' => 'tecnico.diagnostico.show',
        'edit' => 'tecnico.diagnostico.edit',
        'update' => 'tecnico.diagnostico.update',
        'destroy' => 'tecnico.diagnostico.destroy',
    ]);
    Route::resource('mantenimiento', MantenimientoController::class)->names([
        'index' => 'tecnico.mantenimiento.index',
        'create' => 'tecnico.mantenimiento.create',
        'store' => 'tecnico.mantenimiento.store',
        'show' => 'tecnico.mantenimiento.show',
        'edit' => 'tecnico.mantenimiento.edit',
        'update' => 'tecnico.mantenimiento.update',
        'destroy' => 'tecnico.mantenimiento.destroy',
    ]);
    Route::resource('solicitudesAsignadas', TecnSolicitController::class)->names([
        'index' => 'tecnico.solicitud.index',
        'create' => 'tecnico.solicitud.create',
        'store' => 'tecnico.solicitud.store',
        'show' => 'tecnico.solicitud.show',
        'edit' => 'tecnico.solicitud.edit',
        'update' => 'tecnico.solicitud.update',
        'destroy' => 'tecnico.solicitud.destroy',
    ]);

    Route::post('/finalizar-mantenimiento', [TecnicoFormController::class, 'FinalizarMant'])->name('finalizar.mant.tecnico');

    // Reportes

    Route::get('/reportes-tecnico', function () {return view('reportes.parametrosTecnico');})->name('reportes.tecnico');
    Route::get('/reporte-gen-tecnico', [ReporteController::class, 'reporteTecnico'])->name('genreport.tecnico');
});