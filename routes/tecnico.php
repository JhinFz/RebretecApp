<?php

use App\Http\Controllers\Tecnico\DiagnosticoController;
use App\Http\Controllers\Tecnico\DispositivoController;
use App\Http\Controllers\Tecnico\MantenimientoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Tecnico\TecnicoFormController;

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
});