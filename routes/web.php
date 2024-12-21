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

Route::get('contactanos', [ContactanosController::class, 'index'])->name('contactanos.index');
Route::post('contactanos', [ContactanosController::class, 'store'])->name('contactanos.store');

Route::middleware(['auth:sanctum', 'verified', 'check.approval'])->group(function () {
    Route::get('/dashboard', function (){return view('dashboard');})->name('dashboard');

    Route::get('/dispositivos', [DispositivoController::class, 'index'])->name('registros');

    Route::get('/registrar-equipo', [DispositivoController::class, 'form'])->name('registro.form');

    // Route::get('/editar-equipo', [DispositivoController::class, 'edit',$id])->name('editar');

    Route::post('/registrar-solicitud', [DispositivoController::class,'create'])->name("donacion.create");

    Route::get('/contactanos/pdf', [ContactanosController::class, 'pdf'])->name('contactanos.pdf');

    Route::get('/dispositivos/pdf', [DispositivoController::class, 'pdf'])->name('dispositivo.pdf');

    Route::post('/modificar-registro', [DispositivoController::class, 'update'])->name('donacion.modificar');

    Route::get('/eliminar-registro-{id}', [DispositivoController::class,'destroy'])->name("elim");
    
});