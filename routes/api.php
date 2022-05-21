<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TodoListController;

Route::apiResource('todo-lists', TodoListController::class);
Route::apiResource('todo-lists.tasks', TaskController::class)
    ->names('tasks')
    ->except('show')
    ->shallow();

Route::post('register', RegisterController::class)->name('register');