<?php

use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/users', [UserController::class, 'listOfUser']);
Route::put('/users/{id}', [UserController::class, 'updateUser']);
Route::delete('/users/{id}', [UserController::class, 'deleteUser']);
Route::put('/users/{id}/reset-password', [UserController::class, 'resetPassword']);
Route::get('/announcements', [AnnouncementController::class, 'index']);
Route::post('/announcements', [AnnouncementController::class, 'store']);
Route::get('/announcements/{id}', [AnnouncementController::class, 'show']);
Route::put('/announcements/{id}', [AnnouncementController::class, 'update']);
Route::delete('/announcements/{id}', [AnnouncementController::class, 'destroy']);
// Route::patch('/announcements/{id}/toggle', [AnnouncementController::class, 'toggleStatus']);


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/logout', [AuthController::class, 'logout']);
});
