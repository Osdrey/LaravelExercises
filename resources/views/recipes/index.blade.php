@extends('layouts.app')

@section('content')
    <h1>Plataforma de Recetas</h1>

    <form method="GET" action="{{ route('recipes.index') }}">
        <label for="ingredients">Ingredientes:</label>
        <input type="text" name="ingredients" id="ingredients" value="{{ request('ingredients') }}">

        <label for="meal_type">Tipo de Comida:</label>
        <select name="meal_type" id="meal_type">
            <option value="">-- Seleccionar --</option>
            <option value="desayuno" {{ request('meal_type') == 'desayuno' ? 'selected' : '' }}>Desayuno</option>
            <option value="almuerzo" {{ request('meal_type') == 'almuerzo' ? 'selected' : '' }}>Almuerzo</option>
            <option value="cena" {{ request('meal_type') == 'cena' ? 'selected' : '' }}>Cena</option>
        </select>

        <label for="diet_type">Tipo de Dieta:</label>
        <select name="diet_type" id="diet_type">
            <option value="">-- Seleccionar --</option>
            <option value="vegana" {{ request('diet_type') == 'vegana' ? 'selected' : '' }}>Vegana</option>
            <option value="sin gluten" {{ request('diet_type') == 'sin gluten' ? 'selected' : '' }}>Sin Gluten</option>
            <option value="baja en carbohidratos" {{ request('diet_type') == 'baja en carbohidratos' ? 'selected' : '' }}>Baja en Carbohidratos</option>
        </select>

        <label for="difficulty">Dificultad:</label>
        <select name="difficulty" id="difficulty">
            <option value="">-- Seleccionar --</option>
            <option value="fácil" {{ request('difficulty') == 'fácil' ? 'selected' : '' }}>Fácil</option>
            <option value="media" {{ request('difficulty') == 'media' ? 'selected' : '' }}>Media</option>
            <option value="difícil" {{ request('difficulty') == 'difícil' ? 'selected' : '' }}>Difícil</option>
        </select>

        <label for="cook_time">Tiempo de Cocción (minutos):</label>
        <input type="number" name="cook_time" id="cook_time" value="{{ request('cook_time') }}">

        <button type="submit">Buscar</button>
    </form>

    <h2>Recetas Encontradas</h2>
    @if($recipes->isEmpty())
        <p>No se encontraron recetas.</p>
    @else
        <ul>
            @foreach($recipes as $recipe)
                <li>
                    <strong>{{ $recipe->title }}</strong><br>
                    <em>{{ $recipe->meal_type }}</em><br>
                    <p><strong>Ingredientes:</strong> {{ $recipe->ingredients }}</p>
                    <p><strong>Tiempo de Preparación:</strong> {{ $recipe->prep_time }} minutos</p>
                    <p><strong>Tiempo de Cocción:</strong> {{ $recipe->cook_time }} minutos</p>
                    <p><strong>Dificultad:</strong> {{ $recipe->difficulty }}</p>
                    <p><strong>Tipo de Dieta:</strong> {{ $recipe->diet_type }}</p>
                </li>
            @endforeach
        </ul>
    @endif

    <a href="{{ route('recipes.create') }}" class="btn btn-primary">Crear Nueva Receta</a>
@endsection
