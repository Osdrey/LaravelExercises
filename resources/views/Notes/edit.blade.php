@extends('layouts.app')

@section('content')
    <h1>Editar Nota</h1>
    <form action="{{ route('notes.update', $note->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="title">Título</label>
        <input type="text" name="title" id="title" value="{{ $note->title }}" required>

        <label for="content">Contenido</label>
        <textarea name="content" id="content" required>{{ $note->content }}</textarea>

        <label for="category_id">Categoría</label>
        <select name="category_id" id="category_id" required>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ $category->id == $note->category_id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>

        <button type="submit">Actualizar Nota</button>
    </form>
@endsection
