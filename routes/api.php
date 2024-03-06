<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthenticationController;

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

Route::middleware('auth:sanctum')->group(function () {
    Route::post('posts', [PostController::class, 'store']);
    Route::patch('posts/update/{id}', [PostController::class, 'update'])->middleware('pemilikPost');
    Route::delete('posts/delete/{id}', [PostController::class, 'destroy'])->middleware('pemilikPost');
    Route::get('logout', [AuthenticationController::class, 'logout']);
});

// // Route::apiResource('posts', PostController::class);
Route::get('posts/', [PostController::class, 'index']);
Route::get('posts/search/{id}', [PostController::class, 'show']);

Route::post('login', [AuthenticationController::class, 'login']);
