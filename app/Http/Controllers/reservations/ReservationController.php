<?php

namespace App\Http\Controllers\Reservations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservations\Course;
use App\Models\Reservations\Reservation;
use App\Models\Reservations\Topic;
use Carbon\Carbon;

class ReservationController extends Controller
{
    public function index(Request $request)
    {
        // Obtener todas las clases para el filtro
        $classes = Course::all();

        // Filtrar las reservas si se pasa un 'class_id'
        $reservations = Reservation::with('course', 'topics') // Asegúrate de cargar la relación 'topic'
            ->when($request->course_id, function ($query) use ($request) {
                return $query->where('course_id', $request->course_id);
            })
            ->get();

        return view('reservations.index', compact('reservations', 'classes'));
    }

    public function create()
    {
        $courses = Course::all();  // Obtener todos los cursos
        return view('reservations.create', compact('courses'));
    }

    public function store(Request $request)
    {
        // Validación de la entrada
        $validated = $request->validate([
            'user_id' => 'required|string|max:255',
            'course_id' => 'required|exists:courses,id',
            'topic_id' => 'required|exists:topics,id',
            'reservation_date' => 'required|date',
            'reservation_time' => 'required|date_format:H:i',
        ]);

        // Crear un objeto de fecha y hora combinados
        $date = Carbon::parse($validated['reservation_date'])->setTimeFromTimeString($validated['reservation_time']);

        // Verificar disponibilidad de la reserva
        if (!Reservation::available($validated['course_id'], $date->toDateString(), $date->format('H:i'))) {
            return back()->withErrors('El horario no está disponible.');
        }

        // Crear la reserva
        $reservation = Reservation::create([
            'user_id' => $validated['user_id'],
            'course_id' => $validated['course_id'],
            'topic_id' => $validated['topic_id'],
            'reservation_date' => $date, // Guarda la fecha y hora combinadas
            'status' => 'pending', // Estado de la reserva
        ]);

        // Redirigir con un mensaje de éxito
        return redirect()->route('reservations.index')->with('success', 'Reserva creada con éxito.');
    }

    public function cancel($id)
    {
        $reservation = Reservation::findOrFail($id);
        if ($reservation->status === 'pending') {
            $reservation->update(['status' => 'cancelled']);
            return redirect()->route('reservations.index')->with('success', 'Reserva cancelada.');
        }
        return back()->withErrors('Solo se pueden cancelar reservas pendientes.');
    }

    public function show($id)
    {
        // Cargar la reserva con las relaciones 'course' y 'topic'
        $reservation = Reservation::with('course', 'topics')->findOrFail($id);

        return view('reservations.show', compact('reservation'));
    }

    public function getTopics($course_id)
    {
        // Buscar el curso
        $course = Course::findOrFail($course_id);

        // Obtener los temas asociados al curso
        $topics = $course->topics; // Asumiendo que hay una relación 'topics' en el modelo 'Course'

        return response()->json(['topics' => $topics]);
    }
}
