<?php
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1'], function () {
    Route::get('/users/{userId}', [UserController::class, '']);
    Route::patch('/users/{userId}', [UserController::class, '']);
    Route::post('/user', [UserController::class, '']);
    Route::get('/products', [ProductController::class, '']);
    Route::get('/products/{productId}', [ProductController::class, '']);
    Route::put('/products/{productId}', [ProductController::class, '']);
    Route::delete('/products/{productId}', [ProductController::class, '']);
});


Route::get('/users', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
