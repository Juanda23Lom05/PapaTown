<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PapaController;

Route::get('/papas', [PapaController::class, 'index']);
Route::post('/papas', [PapaController::class, 'store']);
Route::get('/papas/{id}', [PapaController::class, 'show']);
Route::put('/papas/{id}', [PapaController::class, 'update']);
Route::patch('/papas/{id}', [PapaController::class, 'patch']);
Route::delete('/papas/{id}', [PapaController::class, 'destroy']);   



