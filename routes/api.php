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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});


/**
 * Authentication
 */
Route::post('/v1/auth/register', [App\Http\Controllers\Api\V1\Auth\AuthController::class, 'register']);
Route::post('/v1/auth/login', [App\Http\Controllers\Api\V1\Auth\AuthController::class, 'login']);
Route::post('/v1/auth/logout', [App\Http\Controllers\Api\V1\Auth\AuthController::class, 'logout']);
Route::post('/v1/auth/profile', [App\Http\Controllers\Api\V1\Auth\AuthController::class, 'profile']);


/**
 * Products
 */
Route::get('/v1/products/', [App\Http\Controllers\Api\V1\Products\ProductController::class, 'index']);
Route::get('/v1/products/create/save', [App\Http\Controllers\Api\V1\Products\ProductController::class, 'create']);
Route::get('/v1/products/{productID}', [App\Http\Controllers\Api\V1\Products\ProductController::class, 'show']);
Route::get('/v1/products/{productID}/edit/update', [App\Http\Controllers\Api\V1\Products\ProductController::class, 'edit']);
