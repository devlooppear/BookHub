<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;

Route::middleware('auth:sanctum')->group(function () {

    // Books
    Route::prefix('books')->group(function () {
        Route::apiResource('books', BookController::class);
    });

    // Permissions
    Route::prefix('permissions')->group(function () {
        Route::apiResource('permissions', PermissionController::class);
    });

    // Reservations
    Route::prefix('reservations')->group(function () {
        Route::apiResource('reservations', ReservationController::class);
    });

    // Roles
    Route::prefix('roles')->group(function () {
        Route::apiResource('roles', RoleController::class);
    });

    // Users
    Route::prefix('users')->group(function () {
        Route::apiResource('users', UserController::class);
    });
});
