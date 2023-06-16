<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SampahController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('sampah')->group(function () {
    Route::get('/', [SampahController::class, 'index']);
    Route::post('/create', [SampahController::class, 'store']);
    Route::get('/{id}', [SampahController::class, 'show']);
    Route::post('/update/{id}', [SampahController::class, 'update']);
    Route::post('/delete/{id}', [SampahController::class, 'destroy']);
    
    // Route Trash
    Route::prefix('/trash')->group(function(){
        Route::get('/all', [SampahController::class, 'getTrash']);
        Route::get('/restore/{id}', [SampahController::class, 'restore']);
        Route::post('/permanent/{id}', [SampahController::class, 'deleteTrash']);
    });
});
