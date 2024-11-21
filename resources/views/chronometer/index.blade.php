@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Cronómetro</h1>

        <div id="timer">
            <p id="current-time">{{ number_format($chronometer->total_time, 2) }} segundos</p>
        </div>

        <div class="buttons">
            @if($chronometer->status == 'paused')
                <!-- Si está pausado, mostramos el botón de iniciar -->
                <a href="{{ route('chronometer.start', $chronometer->id) }}" class="btn btn-success">Iniciar</a>
                @elseif($chronometer->status == 'running')
                    <!-- Si está corriendo, mostramos el botón de pausar y registrar vuelta -->
                    <a href="{{ route('chronometer.pause', $chronometer->id) }}" class="btn btn-warning">Pausar</a>
            @endif
            @if($elapsedTime > 0)
                <!-- Si tiene tiempo transcurrido, se muestra registrar vuelta -->
                <a href="{{ route('chronometer.registerLap', $chronometer->id) }}" class="btn btn-info">Registrar Vuelta</a>
                <!-- Siempre mostramos el botón de reiniciar -->
                <a href="{{ route('chronometer.reset', $chronometer->id) }}" class="btn btn-danger">Reiniciar</a>
            @endif
        </div>

        <h3>Vueltas Registradas</h3>
        <ul>
            @foreach($chronometer->laps as $lap)
                <li>Vuelta: {{ number_format($lap->lap_time, 2) }} segundos</li>
            @endforeach
        </ul>
    </div>

    <!-- JavaScript para actualizar el cronómetro -->
    @if($chronometer->status == 'running')
        <script>
            let totalTime = {{ $chronometer->total_time }};
            let timerElement = document.getElementById('current-time');

            function updateTime() {
                totalTime += 0.1;  // Incrementar el tiempo en 0.1 segundos
                timerElement.textContent = totalTime.toFixed(2) + ' segundos';
            }

            setInterval(updateTime, 100);  // Actualizar cada 100ms (0.1 segundos)
        </script>
    @endif
@endsection
