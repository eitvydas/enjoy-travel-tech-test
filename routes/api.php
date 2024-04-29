<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarHireController;

Route::get('/available-cars', [CarHireController::class, 'getAvailableCars']);
Route::post('/hire/{$id}/update', [CarHireController::class, 'updateCarHire']);
Route::delete('/hire/{$id}/delete', [CarHireController::class, 'deleteCarHire']);
