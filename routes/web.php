<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DispositivoController;
use App\Http\Controllers\ContactanosController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('bienvenida');

Route::fallback(function () {
    return redirect()->route('bienvenida');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function (){
    return view('dashboard');
})->name('dashboard');

Route::get('contactanos', [ContactanosController::class, 'index'])->name('contactanos.index');

Route::post('contactanos', [ContactanosController::class, 'store'])->name('contactanos.store');


Route::middleware(['auth:sanctum', 'verified'])->get('/dispositivos', [DispositivoController::class, 'index'])->name('registros');

Route::middleware(['auth:sanctum', 'verified'])->get('/registrar-equipo', [DispositivoController::class, 'form'])->name('registro.form');

// Route::get('/editar-equipo', [DispositivoController::class, 'edit',$id])->name('editar');

Route::middleware(['auth:sanctum', 'verified'])->post('/registrar-donacion', [DispositivoController::class,'create'])->name("donacion.create");

Route::middleware(['auth:sanctum', 'verified'])->get('/contactanos/pdf', [ContactanosController::class, 'pdf'])->name('contactanos.pdf');

Route::middleware(['auth:sanctum', 'verified'])->get('/dispositivos/pdf', [DispositivoController::class, 'pdf'])->name('dispositivo.pdf');

Route::middleware(['auth:sanctum', 'verified'])->post('/modificar-registro', [DispositivoController::class, 'update'])->name('donacion.modificar');

Route::middleware(['auth:sanctum', 'verified'])->get('/eliminar-registro-{id}', [DispositivoController::class,'destroy'])->name("elim");