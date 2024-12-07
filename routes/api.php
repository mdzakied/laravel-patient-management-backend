<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\RoleMiddleware;

Route::prefix('auth')->group(function () {
    Route::middleware(['auth:api', RoleMiddleware::class . ':admin'])->post('register-admin', [AuthController::class, 'registerAdmin']);
    Route::middleware(['auth:api', RoleMiddleware::class . ':admin'])->post('register-viewer', [AuthController::class, 'registerViewer']);
    Route::post('login', [AuthController::class, 'login']);
    Route::middleware(['auth:api'])->post('logout', [AuthController::class, 'logout']);
});
