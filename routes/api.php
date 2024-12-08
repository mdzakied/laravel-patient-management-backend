<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PatientController;
use App\Http\Middleware\RoleMiddleware;

// --- Authentication Route ---

Route::prefix('auth')->group(function () {
    Route::middleware(['auth:api', RoleMiddleware::class . ':admin'])->post('register-admin', [AuthController::class, 'registerAdmin']);
    Route::middleware(['auth:api', RoleMiddleware::class . ':admin'])->post('register-viewer', [AuthController::class, 'registerViewer']);
    Route::post('login', [AuthController::class, 'login']);
    Route::middleware(['auth:api'])->post('logout', [AuthController::class, 'logout']);
});

// --- Authentication Route ---

// --- Patient Route ---

Route::prefix('patients')->group(function () {
    Route::middleware(['auth:api', RoleMiddleware::class . ':admin'])->post('/', [PatientController::class, 'create']);
    Route::middleware(['auth:api'])->get('/', [PatientController::class, 'showAll']);       
    Route::middleware(['auth:api'])->get('{id}', [PatientController::class, 'show']);      
    Route::middleware(['auth:api', RoleMiddleware::class . ':admin'])->put('{id}', [PatientController::class, 'update']);     
    Route::middleware(['auth:api', RoleMiddleware::class . ':admin'])->delete('{id}', [PatientController::class, 'delete']); 
});

// --- Patient Route ---