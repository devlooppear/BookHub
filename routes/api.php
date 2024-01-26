<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('users', [UserController::class, 'store']);

Route::middleware('auth:api')->group(function () {

    // Books
    Route::apiResource('books', BookController::class);

    // Permissions
    Route::apiResource('permissions', PermissionController::class);

    // Reservations
    Route::apiResource('reservations', ReservationController::class);

    // Roles
    Route::apiResource('roles', RoleController::class);

    // Users
    Route::apiResource('users', UserController::class)->only(['index', 'show', 'destroy']);
    Route::post('users/{user}', [UserController::class, 'update']);
});
