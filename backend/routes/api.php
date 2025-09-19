<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

// Authentication routes with throttling
Route::prefix('auth')->middleware('throttle:10,1')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    
    // Protected authentication routes
    Route::middleware('auth:api')->group(function () {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::get('user', [AuthController::class, 'user']);
        Route::post('refresh', [AuthController::class, 'refresh']);
    });
});

// Protected API routes with JWT authentication  
Route::middleware('auth:api')->group(function () {
    Route::get('dashboard', function () {
        return response()->json([
            'user' => auth()->user(),
            'message' => 'Welcome to the training management platform'
        ]);
    });
    
    // Role-based protected routes
    Route::middleware('role:ADMIN')->group(function () {
        Route::get('admin/dashboard', function () {
            return response()->json(['message' => 'Admin dashboard access granted']);
        });
    });
    
    Route::middleware('role:TRAINER')->group(function () {
        Route::get('trainer/dashboard', function () {
            return response()->json(['message' => 'Trainer dashboard access granted']);
        });
    });
});