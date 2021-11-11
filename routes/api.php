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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

 
Route::get('get_products', [App\Http\Controllers\ProductApiController::class, 'index']);
Route::get('get_product/{id}', [App\Http\Controllers\ProductApiController::class, 'get']);
Route::get('delete_product/{id}', [App\Http\Controllers\ProductApiController::class, 'destroy']);
Route::get('export_csv', [App\Http\Controllers\ProductApiController::class, 'export_csv']);
Route::post('store', [App\Http\Controllers\ProductApiController::class, 'store']);
Route::put('update/{id}', [App\Http\Controllers\ProductApiController::class, 'update']);