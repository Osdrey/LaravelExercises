@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Editar Tarea</h1>
        <form action="{{ route('tasks.update', $task->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="task_name">Nombre de la Tarea:</label>
                <input type="text" name="task_name" id="task_name" class="input-field" value="{{ $task->task_name }}" required>
            </div>
            <div class="add-task-button-container">
                <button type="submit" class="add-task-button">Actualizar Tarea</button>
            </div>
        </form>
    </div>
@endsection
