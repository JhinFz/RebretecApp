<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactanosController;
use App\Http\Controllers\Admin\UserController;

Route::middleware(['auth:sanctum', 'verified', 'check.approval'])->group(function () {
    Route::get('/contactos', [ContactanosController::class, 'vista'])->name('contactos');
    Route::resource('usuarios', UserController::class)->names('admin.users');
    //aprobar usuario
    Route::post('/usuarios/aprobacion/{user}', [UserController::class, 'approve'])->name('admin.users.approve');
    Route::get('/eliminar-solicitud/{contacto}', [ContactanosController::class, 'destroy'])->name('admin.solicitud.destroy');
});

