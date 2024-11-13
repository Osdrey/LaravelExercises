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
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\CategoryController;

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
Route::get('/', [ExpenseController::class, 'index']);
Route::resource('expenses', ExpenseController::class);
Route::resource('categories', CategoryController::class);
Route::get('expenses/{month}/{year}', [ExpenseController::class, 'showMonth'])->name('expenses.month'); // Mostrar los gastos de un mes específico
