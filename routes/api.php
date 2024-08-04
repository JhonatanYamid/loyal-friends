<?php

use App\Http\Controllers\Api\categoryController;
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
use App\Http\Controllers\Api\petController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/category', [categoryController::class, 'find']);

Route::get('/category/{CategoryId}', [categoryController::class, 'findById']);

Route::get('/pet/findByStatus', [petController::class, 'findByStatus']);

Route::get('/pet/{petId}', [petController::class, 'findById']);

Route::post('/pet', [petController::class, 'store']);

Route::put('/pet/{petId}', [petController::class, 'update']);

Route::post('/pet/{petId}', [petController::class, 'updatePartial']);

Route::delete('/pet/{petId}', [petController::class, 'destroy']);


