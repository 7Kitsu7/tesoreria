<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PeriodoController;
use App\Http\Controllers\EscalaController;
use App\Http\Controllers\EscalaPeriodoController;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\MatriculaController;
use App\Http\Controllers\PensionController;
use App\Http\Controllers\PagoController;

Route::get('/matricula/{CodigoMatricula}/pdf', [MatriculaController::class, 'generarPDF'])->name('matricula.generarPDF');

Route::get('/', [UserController::class, 'showLogin']);
Route::post('/identificacion', [UserController::class, 'verificaLogin'])->name('identificacion');
Route::post('/logout', [UserController::class, 'salir'])->name('logout');

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/periodo', [PeriodoController::class, 'index'])->name('periodo.index');
Route::resource('/periodo', PeriodoController::class);
Route::post('/periodo/actualizar', [PeriodoController::class, 'actualizarEstado'])->name('periodo.actualizarEstado');
Route::get('cancelar', function () {
    return redirect()->route('periodo.index')->with('datos', 'Acción Cancelada ..!');
})->name('cancelar');

Route::get('/escala', [EscalaController::class, 'index'])->name('escala.index');
Route::resource('/escala', EscalaController::class);
Route::get('escala/{CodigoPeriodo}/{CodigoEscala}', [EscalaPeriodoController::class, 'edit'])->name('escala-periodo.edit');
Route::put('escala/{CodigoPeriodo}/{CodigoEscala}/update', [EscalaPeriodoController::class, 'update'])->name('escala-periodo.update');
Route::get('cancelar2', function () {
    return redirect()->route('escala.index')->with('datos', 'Acción Cancelada ..!');
})->name('cancelar2');

Route::get('/alumno', [AlumnoController::class, 'index'])->name('alumno.index');
Route::resource('/alumno', AlumnoController::class);
Route::get('cancelar3', function () {
    return redirect()->route('alumno.index')->with('datos', 'Acción Cancelada ..!');
})->name('cancelar3');

Route::get('/matricula', [MatriculaController::class, 'index'])->name('matricula.index');
Route::resource('/matricula', MatriculaController::class);
Route::get('cancelar4', function () {
    return redirect()->route('matricula.index')->with('datos', 'Acción Cancelada ..!');
})->name('cancelar4');

Route::get('/pension', [PensionController::class, 'index'])->name('pension.index');
Route::resource('/pension', PensionController::class);
Route::get('cancelar5', function () {
    return redirect()->route('pension.index')->with('datos', 'Acción Cancelada ..!');
})->name('cancelar5');

Route::get('/pago', [PagoController::class, 'index'])->name('pago.index');
Route::resource('/pago', PagoController::class);
