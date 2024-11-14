@extends('layouts.app')

@section('content')
    <h1>Mis Notas</h1>
    <a href="{{ route('notes.create') }}">Crear Nueva Nota</a>
    <!-- Formulario para filtrar por categoría -->
    <form id="filterForm" action="{{ route('notes.index') }}" method="GET">
        <label for="category_id">Selecciona una categoría:</label>
        <select name="category_id" id="category_id" onchange="document.getElementById('filterForm').submit()">
            <option value="">Todas las categorías</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}"
                        {{ request('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </form>
    <table>
        <thead>
            <tr>
                <th>Título</th>
                <th>Categoría</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($notes as $note)
                <tr>
                    <td>{{ $note->title }}</td>
                    <td>{{ $note->category->name }}</td>
                    <td>
                        <a href="{{ route('notes.edit', $note->id) }}">Editar</a>
                        <form action="{{ route('notes.destroy', $note->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('categories.index') }}" class="btn btn-secondary">Ver Categorías</a>
@endsection
