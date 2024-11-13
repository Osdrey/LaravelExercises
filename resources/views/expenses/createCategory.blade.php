@extends('layouts.app')

@section('content')
    <h1>Crear Nueva Categoría</h1>

    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        <div>
            <label for="name">Nombre de la categoría:</label>
            <input type="text" name="name" id="name" required>
        </div>
        <button type="submit">Crear Categoría</button>
    </form>

    <a href="{{ route('expenses.index') }}">Volver al Resumen de Gastos</a>
@endsection
