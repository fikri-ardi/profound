<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TodoListController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

Route::apiResource('todo-lists', TodoListController::class);
Route::apiResource('todo-lists.tasks', TaskController::class)
    ->names('tasks')
    ->except('show')
    ->shallow();

Route::post('register', RegisterController::class)->name('register');
Route::post('login', LoginController::class)->name('login');