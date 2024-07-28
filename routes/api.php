<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\SubscriptionController;
use Illuminate\Support\Facades\Route;


Route::post('/auth', [AuthController::class, 'auth']);
Route::middleware('auth:sanctum')->post('/subscription', [SubscriptionController::class, 'subscribe']);
Route::middleware('auth:sanctum')->post('/chat', [ChatController::class, 'chat']);

// Admin routes
Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index']);
    Route::get('/admin/subscriptions', [AdminController::class, 'getSubscriptions']);
});

Route::get('/docs', function () {
    return view('swagger.index');
});
