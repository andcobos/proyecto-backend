<?php
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'v1'], function () {

    Route::post('/user', [UserController::class, 'store']);
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/{userId}', [UserController::class, 'show']);
    Route::patch('/users/{userId}', [UserController::class, 'update']);
    Route::delete('/users/{userId}', [UserController::class, 'destroy']);

    Route::get('/products', [ProductController::class, 'index']);
    Route::post('/products', [ProductController::class, 'store']);
    Route::get('/products/{productId}', [ProductController::class, 'show']);
    Route::put('/products/{productId}', [ProductController::class, 'update']);
    Route::delete('/products/{productId}', [ProductController::class, 'destroy']);

    Route::get('/orders', [OrderController::class, 'index']);
    Route::post('/orders', [OrderController::class, 'store']);
    Route::get('/orders/{orderId}', [OrderController::class, 'show']);
    Route::put('/orders/{orderId}', [OrderController::class, 'updateStatus']);
    Route::get('/orders/user/{userId}', [OrderController::class, 'getByUser']);
    Route::get('/orders/seller/{sellerId}', [OrderController::class, 'getBySeller']);

    Route::get('/sellers', [SellerController::class, 'index']); 
    Route::post('/sellers', [SellerController::class, 'store']); 
    Route::get('/sellers/{sellerId}', [SellerController::class, 'show']); 
    Route::put('/sellers/{sellerId}', [SellerController::class, 'update']); 

    Route::post('/auth/login', [AuthController::class, 'login']); 
    Route::post('/auth/register', [AuthController::class, 'register']); 
    Route::post('/auth/logout', [AuthController::class, 'logout']); 
});


Route::get('/users', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
