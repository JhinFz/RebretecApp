<?php

use App\Http\Controllers\Admin\AdmSolicitController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;


Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::resource('usuarios', UserController::class)->names('admin.users');
    //aprobar usuario
    Route::post('/usuarios/aprobacion/{user}', [UserController::class, 'approve'])->name('admin.users.approve');

    Route::delete('/eliminar-solicitud/{id}', [AdmSolicitController::class, 'destroy'])->name('admin.solicitud.destroy');
    Route::get('/gestion-solicitud/{id}', [AdmSolicitController::class, 'edit'])->name('admin.solicitud.edit');
    Route::get('lista-solicitudes', [AdmSolicitController::class, 'index'])->name('admin.solicitud.index');
    Route::put('/asignar-tecnico/{id}', [AdmSolicitController::class, 'update'])->name('institucion.solicitud.update');

    Route::get('/buscar-tecnico', [AdmSolicitController::class, 'buscarTecnico'])->name('buscar.tecnico');
    
});

