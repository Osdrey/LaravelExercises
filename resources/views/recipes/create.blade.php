@extends('layouts.app')

@section('content')
    <h1>Crear Nueva Receta</h1>
    <form action="{{ route('recipes.store') }}" method="POST">
        @csrf
        <label for="title">Título:</label>
        <input type="text" name="title" required>

        <label for="ingredients">Ingredientes:</label>
        <textarea name="ingredients" required></textarea>

        <label for="prep_time">Tiempo de Preparación (minutos):</label>
        <input type="number" name="prep_time" required>

        <label for="cook_time">Tiempo de Cocción (minutos):</label>
        <input type="number" name="cook_time" required>

        <label for="difficulty">Dificultad:</label>
        <select name="difficulty" required>
            <option value="easy">Fácil</option>
            <option value="medium">Media</option>
            <option value="hard">Difícil</option>
        </select>

        <label for="meal_type">Tipo de Comida:</label>
        <select name="meal_type" required>
            <option value="breakfast">Desayuno</option>
            <option value="lunch">Almuerzo</option>
            <option value="dinner">Cena</option>
            <option value="snack">Merienda</option>
            <option value="dessert">Postre</option>
        </select>

        <label for="diet_type">Tipo de Dieta:</label>
        <select name="diet_type" required>
            <option value="vegan">Vegana</option>
            <option value="gluten_free">Sin Gluten</option>
            <option value="low_carb">Baja en Carbohidratos</option>
            <option value="none">Ninguna</option>
        </select>

        <label for="category">Categoría:</label>
        <input type="text" name="category" required>

        <button type="submit">Crear Receta</button>
    </form>
@endsection
