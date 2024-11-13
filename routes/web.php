<?php

use Illuminate\Support\Facades\Route;
//Menu
use App\Http\Controllers\MenuController;
//Lista de tareas
use App\Http\Controllers\TaskController;
//Calculadora de propinas
use App\Http\Controllers\TipsController;
//Generador de contraseñas
use App\Http\Controllers\PasswordController;
//Gestor de gastos
use App\Http\Controllers\ExpensesController;

//Menu
Route::get('/', [MenuController::class, 'index']);
//Lista de tareas
Route::resource('/tasks', TaskController::class);
Route::post('/tasks/{task}/toggle', [TaskController::class, 'toggleComplete'])->name('tasks.toggleComplete');
//Calculadora de propinas
Route::resource('/tips', TipsController::class);
//Generador de contraseñas
Route::get('/password', [PasswordController::class, 'index']);
Route::post('/password', [PasswordController::class, 'generate'])->name('password.generate');
//Gestor de gastos
Route::resource('expenses', ExpensesController::class);
Route::get('expenses/{year}/{month}', [ExpensesController::class, 'show'])->name('expenses.show');
Route::get('categories/create', [ExpensesController::class, 'createCategory'])->name('categories.create');
Route::post('categories/store', [ExpensesController::class, 'storeCategory'])->name('categories.store');
