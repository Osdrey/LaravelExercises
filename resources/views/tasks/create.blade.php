@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Nueva Tarea</h1>
        <form action="{{ route('tasks.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="task_name">Nombre de la Tarea:</label>
                <input type="text" name="task_name" id="task_name" class="input-field" required>
            </div>
            <div class="add-task-button-container">
                <button type="submit" class="add-task-button">Agregar Tarea</button>
            </div>
        </form>
    </div>
@endsection
