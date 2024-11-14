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
//Sistema de Reservas
use App\Http\Controllers\reservations\ClassController;
use App\Http\Controllers\reservations\TopicController;
use App\Http\Controllers\reservations\ReservationController;

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
//Sistema de reservas
Route::resource('classes', ClassController::class);
Route::resource('classes', TopicsController::class);
Route::prefix('reservations')->name('reservations.')->group(function () {
    Route::get('/', [ReservationController::class, 'index'])->name('reservations.index');
    Route::get('create', [ReservationController::class, 'create'])->name('reservations.create');
    Route::post('store', [ReservationController::class, 'store'])->name('reservations.store');
    Route::get('{id}/edit', [ReservationController::class, 'edit'])->name('reservations.edit');
    Route::put('{id}', [ReservationController::class, 'update'])->name('reservations.update');
    Route::delete('{id}', [ReservationController::class, 'destroy'])->name('reservations.destroy');
    Route::get('{id}', [ReservationController::class, 'show'])->name('reservations.show');
});
