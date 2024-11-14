@extends('layouts.app')

@section('content')
    <h1>Lista de Categorías</h1>

    <!-- Botón para crear una nueva categoría -->
    <a href="{{ route('categories.create') }}" class="btn btn-primary">Crear Nueva Categoría</a>

    <ul>
        @foreach($categories as $category)
            <li>
                {{ $category->name }}
                <!-- Formulario para eliminar una categoría -->
                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE') <!-- Esto especifica que la solicitud es un DELETE -->
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que quieres eliminar esta categoría?')">Eliminar</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection
