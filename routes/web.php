<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PapaController;

/*
|--------------------------------------------------------------------------
| Web Routes - PapaTown
|--------------------------------------------------------------------------
*/

// Ruta para ver el CRUD (pública)
Route::get('/', [PapaController::class, 'index'])->name('crud.view.index');

/**
 * SEGURIDAD: Aplicamos el middleware 'throttle'.
 * throttle:5,1 significa que solo se permiten 5 peticiones por minuto.
 * Esto evita que saturen tu base de datos con registros basura.
 */

// Ruta para CREAR (Protegida)
Route::post('/crearpapa', [PapaController::class, 'store'])
    ->middleware('throttle:5,1') 
    ->name('crud.view.store');

// Ruta para ACTUALIZAR (Protegida)
Route::put('/actualizarpapa/{id}', [PapaController::class, 'update'])
    ->middleware('throttle:10,1')
    ->name('crud.view.update');

// Ruta para ELIMINAR (Protegida)
Route::delete('/eliminarpapa/{id}', [PapaController::class, 'destroy'])
    ->middleware('throttle:5,1')
    ->name('crud.view.destroy');