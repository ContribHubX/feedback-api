<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmailController;
// use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/health', function () { return "Healthy"; });

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
   Route::post('/logout', [AuthController::class, 'logout']);
   Route::get('/me', [AuthController::class, 'getMyDetails']);
});

Route::prefix('password')->group(function () {
    Route::post('/forgot', [AuthController::class, 'sendResetLink']);
    Route::post('/reset', [AuthController::class, 'resetPassword'])->name('password.update');
  });

Route::prefix("email")->group(function () {
    Route::post('/send-verification-link', [EmailController::class, 'sendVerificationLink']);
    Route::post('/verify-email', [EmailController::class, 'verifyEmail']);
  });

// Route::resource('/tasks', TaskController::class)->middleware('auth:sanctum');
