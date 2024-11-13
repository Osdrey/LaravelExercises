@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Lista de Tareas</h1>
        <!-- Botón verde para agregar nueva tarea alineado a la izquierda -->
        <div class="add-task-button-container">
            <a href="{{ route('tasks.create') }}" class="btn add-task-button">Nueva Tarea</a>
        </div>
        <div class="task-table">
            <div class="task-table-header">
                <div class="task-table-column">Nombre</div>
                <div class="task-table-column">Estado</div>
                <div class="task-table-column">Acciones</div>
            </div>
            @foreach ($tasks as $task)
                <div class="task-row">
                    <!-- Nombre de la tarea -->
                    <div class="task-column task-name">
                        <a href="{{ route('tasks.edit', $task->id) }}">{{ $task->task_name }}</a>
                    </div>
                    <!-- Estado de la tarea -->
                    <div class="task-column task-status">
                        <form action="{{ route('tasks.toggleComplete', $task->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <input type="checkbox" name="is_completed" {{ $task->is_completed ? 'checked' : '' }}
                                onchange="this.form.submit()" id="is_completed_{{ $task->id }}">
                            <label for="is_completed_{{ $task->id }}">
                                {{ $task->is_completed ? 'Completada' : 'Pendiente' }}
                            </label>
                        </form>
                    </div>
                    <!-- Botón de eliminar centrado -->
                    <div class="task-column task-actions">
                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-btn">Eliminar</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
