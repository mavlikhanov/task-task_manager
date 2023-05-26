<?php

use App\Controllers\AuthorizationController;
use App\Controllers\CreateTaskController;
use App\Controllers\HomeController;
use App\Controllers\LogoutController;
use App\Controllers\TaskStatusUpdateController;
use App\Controllers\TaskUpdateController;
use bootstrap\Route;

Route::get('/', [HomeController::class, 'index']);
Route::get('/logout', [LogoutController::class, 'logout']);
Route::post('/task/create', [CreateTaskController::class, 'create']);
Route::post('/task/update', [TaskUpdateController::class, 'update']);
Route::post('/task/status/update', [TaskStatusUpdateController::class, 'update']);
Route::post('/authorization', [AuthorizationController::class, 'login']);
