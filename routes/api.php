<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('obras/obra/{id}/favorite', [App\Http\Controllers\ObraFavoriteController::class, 'store']);
Route::delete('obras/obra/{id}/favorite/delete', [App\Http\Controllers\ObraFavoriteController::class, 'destroy']);

// Procesar la compra
Route::post('obras/obra/purchase/{id}', [App\Http\Controllers\ObraPurchaseController::class, 'purchase'])->name('obras.obra.purchase');
