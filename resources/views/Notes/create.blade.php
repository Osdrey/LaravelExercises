@extends('layouts.app')

@section('content')
    <h1>Crear Nueva Nota</h1>
    <form action="{{ route('notes.store') }}" method="POST">
        @csrf
        <label for="title">Título</label>
        <input type="text" name="title" id="title" required>

        <label for="content">Contenido</label>
        <textarea name="content" id="content" required></textarea>

        <label for="category_id">Categoría</label>
        <select name="category_id" id="category_id" required>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>

        <button type="submit">Guardar Nota</button>
    </form>
@endsection
