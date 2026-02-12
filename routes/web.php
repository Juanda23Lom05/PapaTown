<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PapaController;

// Ruta para ver el CRUD
Route::get('/', [PapaController::class, 'index'])->name('crud.view.index');

// Ruta para CREAR (Esta es la que te está dando el error)
Route::post('/crearpapa', [PapaController::class, 'store'])->name('crud.view.store');

// Ruta para ACTUALIZAR
Route::put('/actualizarpapa/{id}', [PapaController::class, 'update'])->name('crud.view.update');

// Ruta para ELIMINAR
Route::delete('/eliminarpapa/{id}', [PapaController::class, 'destroy'])->name('crud.view.destroy');