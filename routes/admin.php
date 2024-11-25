<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DispositivoController;
use App\Http\Controllers\ContactanosController;

Route::middleware(['auth:sanctum', 'verified'])->get('/contactos', [ContactanosController::class, 'vista'])->name('contactos');
