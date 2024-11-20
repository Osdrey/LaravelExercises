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
use App\Http\Controllers\Reservations\ReservationController;
//Gestor de Notas
use App\Http\Controllers\Notes\NoteController;
use App\Http\Controllers\Notes\CategoryController;
//Calendario de Eventos
use App\Http\Controllers\Calendar\EventController;
//Plataforma de Recetas
use App\Http\Controllers\Recipes\RecipeController;



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
Route::prefix('reservations')->name('reservations.')->group(function () {
    Route::get('/', [ReservationController::class, 'index'])->name('index');
    Route::get('/create', [ReservationController::class, 'create'])->name('create');
    Route::post('/store', [ReservationController::class, 'store'])->name('store');
    Route::delete('/cancel/{id}', [ReservationController::class, 'cancel'])->name('cancel');
    Route::get('reservations/{id}', [ReservationController::class, 'show'])->name('show');
    Route::get('/topics/{course_id}', [ReservationController::class, 'getTopics'])->name('topics');
});
//Gestor de Notas
Route::resource('notes', NoteController::class);
Route::resource('categories', CategoryController::class);
//Calendario de Eventos
Route::resource('events', EventController::class);
//Plataforma de Recetas
Route::resource('recipes', RecipeController::class);
