@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Reservar Clase</h1>
        <form method="POST" action="{{ route('reservations.store') }}">
            @csrf

            <!-- Campo de usuario -->
            <div class="form-group">
                <label for="user_id">Usuario</label>
                <input type="text" name="user_id" class="form-control" id="user_id" required>
            </div>

            <div class="form-group">
                <label for="course_id">Materia</label>
                <select name="course_id" id="course_id" class="form-control" required>
                    <option value="">Selecciona el curso</option>
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>
                            {{ $course->subject }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Mostrar los temas solo si hay cursos disponibles -->
            <div class="form-group">
                <label for="topic_id">Tema</label>
                <select name="topic_id" id="topic_id" class="form-control" required>
                    <option value="">Selecciona un curso primero</option>
                </select>
            </div>

            <div class="form-group">
                <label for="reservation_date">Fecha de Reserva</label>
                <input type="date" name="reservation_date" class="form-control" id="reservation_date" required>
            </div>

            <div class="form-group">
                <label for="reservation_time">Selecciona la hora de la reserva</label>
                <select id="reservation_time" name="reservation_time" class="form-control">
                    @php
                        // Generar la lista de horas de 6 AM a 6 PM
                        $times = [];
                        $currentTime = \Carbon\Carbon::createFromTime(6, 0);
                        while ($currentTime->hour <= 18) {
                            $times[] = $currentTime->format('H:i');
                            $currentTime->addHour();
                        }
                    @endphp
                    @foreach ($times as $time)
                        <option value="{{ $time }}">{{ $time }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-success">Confirmar Reserva</button>
        </form>
    </div>

    <script>
        // Evento para cargar los temas cuando se selecciona un curso
        document.getElementById('course_id').addEventListener('change', function() {
            const courseId = this.value;

            if (courseId) {
                fetch(`/reservations/topics/${courseId}`)
                    .then(response => response.json())
                    .then(data => {
                        const topicSelect = document.getElementById('topic_id');
                        topicSelect.innerHTML = ''; // Limpiar los temas previos
                        data.topics.forEach(function(topic) {
                            const option = document.createElement('option');
                            option.value = topic.id;
                            option.textContent = topic.name;
                            topicSelect.appendChild(option);
                        });
                    })
                    .catch(error => console.error('Error al cargar los temas:', error));
            } else {
                document.getElementById('topic_id').innerHTML = '<option value="">Selecciona un curso primero</option>';
            }
        });
    </script>
@endsection
