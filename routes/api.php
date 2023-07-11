<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TaskController;

Route::post('/tasks', [TaskController::class, 'createTask']);
Route::get('/tasks', [TaskController::class, 'getAllTasks']);
Route::get('/tasks/{id}', [TaskController::class, 'getTaskById']);
Route::put('/tasks/{id}', [TaskController::class, 'updateTask']);
Route::delete('/tasks/{id}', [TaskController::class, 'deleteTask']);

Route::get('/tasks/completed', [TaskController::class, 'getCompletedTasks']);
Route::get('/tasks/incomplete', [TaskController::class, 'getIncompleteTasks']);
Route::put('/tasks/{id}/status', [TaskController::class, 'updateTaskStatus']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
