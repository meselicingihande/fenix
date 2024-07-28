<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\SubscriptionController;
use Illuminate\Support\Facades\Route;

Route::middleware('throttle:60,1')->group(function () {
    Route::post('/api/auth', [AuthController::class, 'authenticate']);
    Route::post('/subscription', [SubscriptionController::class, 'store']);
    Route::post('/chat', [ChatController::class, 'chat']);
});
