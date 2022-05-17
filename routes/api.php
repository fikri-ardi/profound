<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoListController;

Route::get('todo-lists', [TodoListController::class, 'index'])->name('todo-list.index');
Route::post('todo-lists', [TodoListController::class, 'store'])->name('todo-list.store');
Route::get('todo-lists/{todoList}', [TodoListController::class, 'show'])->name('todo-list.show');