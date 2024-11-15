@extends('layouts.app')

@section('content')
    <h1>Editar Receta</h1>
    <form action="{{ route('recipes.update', $recipe->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="title">Título:</label>
        <input type="text" name="title" value="{{ $recipe->title }}" required>

        <label for="ingredients">Ingredientes:</label>
        <textarea name="ingredients" required>{{ $recipe->ingredients }}</textarea>

        <label for="prep_time">Tiempo de Preparación (minutos):</label>
        <input type="number" name="prep_time" value="{{ $recipe->prep_time }}" required>

        <label for="cook_time">Tiempo de Cocción (minutos):</label>
        <input type="number" name="cook_time" value="{{ $recipe->cook_time }}" required>

        <label for="difficulty">Dificultad:</label>
        <select name="difficulty" required>
            <option value="easy" {{ $recipe->difficulty == 'easy' ? 'selected' : '' }}>Fácil</option>
            <option value="medium" {{ $recipe->difficulty == 'medium' ? 'selected' : '' }}>Media</option>
            <option value="hard" {{ $recipe->difficulty == 'hard' ? 'selected' : '' }}>Difícil</option>
        </select>

        <label for="meal_type">Tipo de Comida:</label>
        <select name="meal_type" required>
            <option value="breakfast" {{ $recipe->meal_type == 'breakfast' ? 'selected' : '' }}>Desayuno</option>
            <option value="lunch" {{ $recipe->meal_type == 'lunch' ? 'selected' : '' }}>Almuerzo</option>
            <option value="dinner" {{ $recipe->meal_type == 'dinner' ? 'selected' : '' }}>Cena</option>
            <option value="snack" {{ $recipe->meal_type == 'snack' ? 'selected' : '' }}>Merienda</option>
            <option value="dessert" {{ $recipe->meal_type == 'dessert' ? 'selected' : '' }}>Postre</option>
        </select>

        <label for="diet_type">Tipo de Dieta:</label>
        <select name="diet_type" required>
            <option value="vegan" {{ $recipe->diet_type == 'vegan' ? 'selected' : '' }}>Vegana</option>
            <option value="gluten_free" {{ $recipe->diet_type == 'gluten_free' ? 'selected' : '' }}>Sin Gluten</option>
            <option value="low_carb" {{ $recipe->diet_type == 'low_carb' ? 'selected' : '' }}>Baja en Carbohidratos</option>
            <option value="none" {{ $recipe->diet_type == 'none' ? 'selected' : '' }}>Ninguna</option>
        </select>

        <label for="category">Categoría:</label>
        <input type="text" name="category" value="{{ $recipe->category }}" required>

        <button type="submit">Actualizar</button>
    </form>
@endsection
