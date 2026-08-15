<?php

use App\Http\Controllers\Frontend\ConfigController;
use App\Http\Controllers\Frontend\PageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::middleware(['cors'])->group(function () {
// Pages Routes
Route::prefix('pages')->group(function () {
    Route::get('/', [PageController::class, 'index']);
    Route::get('/home', [PageController::class, 'home']);
    Route::get('/about', [PageController::class, 'about']);
    Route::get('/services', [PageController::class, 'services']);
    Route::get('/contact', [PageController::class, 'contact']);
    Route::get('/{slug}', [PageController::class, 'show']);
});

// Configurations Routes
Route::prefix('configurations')->group(function () {
    Route::get('/', [ConfigController::class, 'index']);
    Route::get('/{key}', [ConfigController::class, 'show']);
});
});