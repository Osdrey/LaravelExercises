<?php

namespace App\Http\Controllers\chronometer;

use App\Http\Controllers\Controller;
use App\Models\chronometer\Chronometer;
use App\Models\chronometer\Lap;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ChronometerController extends Controller
{
    public function index()
    {
        // Buscar un cronómetro existente que esté pausado o corriendo
        $chronometer = Chronometer::whereIn('status', ['paused', 'running'])->first();

        // Si no hay cronómetro, no lo creamos de inmediato.
        if (!$chronometer) {
            $chronometer = null; // Aquí no estamos creando un nuevo cronómetro
        }

        $elapsedTime = $this->calculateElapsedTime($chronometer) + $chronometer->total_time;

        return view('chronometer.index', compact('chronometer', "elapsedTime"));
    }

    public function start()
    {
        // Solo creamos un cronómetro si no existe uno en estado 'running' o 'paused'
        $chronometer = Chronometer::whereIn('status', ['paused', 'running'])->first();

        if (!$chronometer) {
            // Crear un cronómetro nuevo
            $chronometer = new Chronometer();
            $chronometer->status = 'running';
            $chronometer->total_time = 0;
            $chronometer->started_at = Carbon::now();
            $chronometer->save();
        } else {
            // Si ya existe un cronómetro, cambiamos su estado a running
            $chronometer->status = 'running';
            $chronometer->started_at = Carbon::now();
            $chronometer->save();
        }

        return redirect()->route('chronometer.index');
    }

    public function pause($id)
    {
        $chronometer = Chronometer::find($id);

        // Solo pausamos si está corriendo
        if ($chronometer->status == 'running') {
            $chronometer->status = 'paused';
            $chronometer->total_time += $this->calculateElapsedTime($chronometer); // Guardamos el tiempo transcurrido
            $chronometer->save();
        }

        return redirect()->route('chronometer.index');
    }

    public function reset($id)
    {
        $chronometer = Chronometer::find($id);
        $chronometer->status = 'paused';
        $chronometer->total_time = 0; // Reiniciamos el tiempo
        $chronometer->started_at = null; // Limpiamos el tiempo de inicio
        $chronometer->save();

        // Eliminamos las vueltas registradas
        $chronometer->laps()->delete();

        return redirect()->route('chronometer.index');
    }

    public function registerLap($id)
    {
        $chronometer = Chronometer::find($id);
        $lapTime = $chronometer->total_time; // Tomamos el tiempo total para la vuelta

        // Guardamos la vuelta en la tabla 'laps'
        $chronometer->laps()->create(['lap_time' => $lapTime]);

        return redirect()->route('chronometer.index');
    }

    // Método para calcular el tiempo transcurrido desde el inicio
    private function calculateElapsedTime(Chronometer $chronometer)
    {
        if ($chronometer->started_at) {
            // Convertimos ambos a instancias de Carbon explícitas
            $startTime = Carbon::parse($chronometer->started_at);
            $currentTime = Carbon::now();

            // Calculamos la diferencia asegurando que el resultado sea positivo
            return $startTime->diffInSeconds($currentTime);
        }

        return 0;
    }
}
