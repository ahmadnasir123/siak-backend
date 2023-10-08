<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RoleController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\KelasController;
use App\Http\Controllers\API\PositionController;
use App\Http\Controllers\API\ResponsibilityController;

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

// Auth API
Route::name('auth.')->group(function () {
    Route::post('login', [UserController::class, 'login'])->name('login');
    Route::post('register', [UserController::class, 'register'])->name('register');

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('logout', [UserController::class, 'logout'])->name('logout');
        Route::get('user', [UserController::class, 'fetch'])->name('fetch');
    });
});

// Position API
Route::prefix('position')->middleware('auth:sanctum')->name('position.')->group(function () {
    Route::get('', [PositionController::class, 'fetch'])->name('fetch');
    Route::post('', [PositionController::class, 'create'])->name('create');
    Route::post('update/{id}', [PositionController::class, 'update'])->name('update');
    Route::delete('{id}', [PositionController::class, 'destroy'])->name('delete');
});

// Kelas API
Route::prefix('kelas')->middleware('auth:sanctum')->name('kelas.')->group(function () {
    Route::get('', [KelasController::class, 'fetch'])->name('fetch');
    Route::post('', [KelasController::class, 'create'])->name('create');
    Route::post('update/{id}', [KelasController::class, 'update'])->name('update');
    Route::delete('{id}', [KelasController::class, 'destroy'])->name('delete');
});

// Role API
Route::prefix('role')->middleware('auth:sanctum')->name('role.')->group(function () {
    Route::get('', [RoleController::class, 'fetch'])->name('fetch');
    Route::post('', [RoleController::class, 'create'])->name('create');
    Route::post('update/{id}', [RoleController::class, 'update'])->name('update');
    Route::delete('{id}', [RoleController::class, 'destroy'])->name('delete');
});

// Responsibility API
Route::prefix('responsibility')->middleware('auth:sanctum')->name('responsibility.')->group(function () {
    Route::get('', [ResponsibilityController::class, 'fetch'])->name('fetch');
    Route::post('', [ResponsibilityController::class, 'create'])->name('create');
    Route::delete('{id}', [ResponsibilityController::class, 'destroy'])->name('delete');
});
