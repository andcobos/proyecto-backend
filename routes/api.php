<?php
use App\Http\Controllers\Api\V1\ProductController;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\Api\V1\OrderController;
use App\Http\Controllers\Api\V1\SellerController;
use App\Http\Controllers\Api\V1\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'v1'], function () {
    // Public routes
    Route::post('/auth/register', [AuthController::class, 'register']);
    Route::post('/auth/login', [AuthController::class, 'login']);

    // Protected routes
    Route::middleware('auth:sanctum')->group(function () {
        // Auth routes
        Route::post('/auth/logout', [AuthController::class, 'logout']);

        // User routes
        Route::get('/users', [UserController::class, 'index']);
        Route::post('/user', [UserController::class, 'store']);
        Route::get('/users/{userId}', [UserController::class, 'show']);
        Route::patch('/users/{userId}', [UserController::class, 'update']);
        Route::delete('/users/{userId}', [UserController::class, 'destroy']);

        // Product routes
        Route::get('/products', [ProductController::class, 'index']);
        Route::post('/products', [ProductController::class, 'store']);
        Route::get('/products/{productId}', [ProductController::class, 'show']);
        Route::put('/products/{productId}', [ProductController::class, 'update']);
        Route::delete('/products/{productId}', [ProductController::class, 'destroy']);

        // Order routes
        Route::get('/orders', [OrderController::class, 'index']);
        Route::post('/orders', [OrderController::class, 'store']);
        Route::get('/orders/{orderId}', [OrderController::class, 'show']);
        Route::put('/orders/{orderId}', [OrderController::class, 'updateStatus']);
        Route::get('/orders/user/{userId}', [OrderController::class, 'getByUser']);
        Route::get('/orders/seller/{sellerId}', [OrderController::class, 'getBySeller']);

        // Seller routes
        Route::get('/sellers', [SellerController::class, 'index']);
        Route::post('/sellers', [SellerController::class, 'store']);
        Route::get('/sellers/{sellerId}', [SellerController::class, 'show']);
        Route::put('/sellers/{sellerId}', [SellerController::class, 'update']);
    });
});

// Current user info
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
