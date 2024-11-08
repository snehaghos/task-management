<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\TodoController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\GalleryController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::apiResource('todos',TodoController::class);
Route::apiResource('images', GalleryController::class);
// Route::apiResource('login', LoginController::class);

Route::post('register', [AuthController::class, 'register']);
Route::post('login',[AuthController::class,'login']);

Route::post('logout', [AuthController::class, 'logout']);
