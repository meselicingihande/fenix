<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum', 'admin')->group(function () {
    Route::get('/admin/purchases', [AdminController::class, 'index']);
});
