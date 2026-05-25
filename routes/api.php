<?php

use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
//Users
Route::get('/users', [UserController::class, 'listOfUser']);
Route::put('/users/{id}', [UserController::class, 'updateUser']);
Route::delete('/users/{id}', [UserController::class, 'deleteUser']);
Route::put('/users/{id}/reset-password', [UserController::class, 'resetPassword']);
//Announcement Endpint
Route::get('/announcements', [AnnouncementController::class, 'index']);
Route::post('/announcements', [AnnouncementController::class, 'store']);
Route::get('/announcements/{id}', [AnnouncementController::class, 'show']);
Route::put('/announcements/{id}', [AnnouncementController::class, 'update']);
Route::delete('/announcements/{id}', [AnnouncementController::class, 'destroy']);
// Route::patch('/announcements/{id}/toggle', [AnnouncementController::class, 'toggleStatus']);

//Permission Endpoint
Route::get('/permissions', [PermissionController::class, 'index']);
Route::get('/permissions/{id}', [PermissionController::class, 'show']);
Route::post('/permissions', [PermissionController::class, 'store']);
Route::put('/permissions/{id}', [PermissionController::class, 'update']);
Route::delete('/permissions/{id}', [PermissionController::class, 'destroy']);

// ROLE Endpoints
Route::get('/roles', [RoleController::class, 'index']);
Route::get('/roles/{id}', [RoleController::class, 'show']);
Route::post('/roles', [RoleController::class, 'store']);
Route::put('/roles/{id}', [RoleController::class, 'update']);
Route::delete('/roles/{id}', [RoleController::class, 'destroy']);

//schdule
Route::get('/schedules', [ScheduleController::class, 'index']);
Route::post('/schedules', [ScheduleController::class, 'store']);
Route::get('/schedules/{id}', [ScheduleController::class, 'show']);
Route::put('/schedules/{id}', [ScheduleController::class, 'update']);
Route::delete('/schedules/{id}', [ScheduleController::class, 'destroy']);
Route::post('/schedules/{scheduleId}/time-in', [ScheduleController::class, 'timeIn']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/logout', [AuthController::class, 'logout']);
});
