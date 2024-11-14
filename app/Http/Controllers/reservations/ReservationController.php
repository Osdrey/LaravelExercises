<?php

namespace App\Http\Controllers\reservations;

use App\Http\Controllers\Controller;
use App\Models\reservations\Reservations;
use App\Models\reservations\Classes;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    // Listar todas las reservas
    public function index(Request $request)
    {
        // Recupera todas las clases
        $classes = Classes::all();

        // Crear la consulta para las reservas
        $query = Reservations::with('class');

        // Filtro opcional por clase (class_id)
        if ($request->has('class_id') && $request->class_id != '') {
            $query->where('class_id', $request->class_id);
        }

        // Obtener todas las reservas
        $reservations = $query->orderBy('reservation_date', 'desc')->get();

        // Pasar las reservas y las clases a la vista
        return view('reservations.reservations.index', compact('reservations', 'classes'));
    }

    // Mostrar formulario para crear una nueva reserva
    public function create()
    {
        $classes = Classes::all();
        return view('reservations.reservations.create', compact('classes'));
    }

    // Guardar una nueva reserva
    public function store(Request $request)
    {
        // Validación de los campos del formulario
        $validated = $request->validate([
            'class_id' => 'required|exists:classes,id',
            'reservation_date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'user_name' => 'required|string|max:255',
            'age' => 'required|integer',
            'phone' => 'required|string|max:255',
            'education_level' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        // Crear la reserva
        $reservation = Reservations::create([
            'class_id' => $request->class_id,
            'user_name' => $request->user_name,
            'age' => $request->age,
            'phone' => $request->phone,
            'education_level' => $request->education_level,
            'email' => $request->email,
            'reservation_date' => $request->reservation_date,
            'start_time' => $request->start_time,
            'status' => 'pending', // O cualquier estado predeterminado
        ]);

        // Verificar si la reserva se guardó correctamente
        if ($reservation) {
            return redirect()->route('reservations.index')->with('success', 'Reserva creada con éxito.');
        } else {
            return back()->with('error', 'Hubo un problema al guardar la reserva.');
        }
    }

    // Mostrar formulario para editar una reserva
    public function edit($id)
    {
        $reservation = Reservations::findOrFail($id);

        // Verificar si se puede editar
        if (in_array($reservation->status, ['completed', 'cancelled'])) {
            return redirect()->route('reservations.index')->with('error', 'No se puede editar una reserva completada o cancelada.');
        }

        $classes = Classes::all();  // Obtener todas las clases
        return view('reservations.reservations.edit', compact('reservation', 'classes'));  // Pasar tanto la reserva como las clases
    }

    // Método para mostrar una reserva específica
    public function show($id)
    {
        // Obtener la reserva por ID
        $reservation = Reservations::findOrFail($id);

        // Retornar la vista con la reserva
        return view('reservations.reservations.show', compact('reservation'));
    }

    // Actualizar una reserva
    public function update(Request $request, $id)
    {
        $request->validate([
            'class_id' => 'required|exists:classes,id',
            'user_name' => 'required|string|max:255',
            'age' => 'required|integer',
            'phone' => 'required|string|max:20',
            'education_level' => 'required|string|max:255',
            'email' => 'required|email',
            'reservation_date' => 'required|date|after_or_equal:today',
        ]);

        $reservation = Reservations::findOrFail($id);

        // Verificar si se puede actualizar
        if (in_array($reservation->status, ['completed', 'cancelled'])) {
            return redirect()->route('reservations.index')->with('error', 'No se puede actualizar una reserva completada o cancelada.');
        }

        $reservation->update($request->all());

        return redirect()->route('reservations.index')->with('success', 'Reserva actualizada con éxito.');
    }

    // Eliminar una reserva
    public function destroy($id)
    {
        $reservation = Reservations::findOrFail($id);

        // Permitir eliminar solo si no está completada o cancelada
        if (!in_array($reservation->status, ['completed', 'cancelled'])) {
            $reservation->delete();
            return redirect()->route('reservations.index')->with('success', 'Reserva eliminada con éxito.');
        }

        return redirect()->route('reservations.index')->with('error', 'No se puede eliminar una reserva completada o cancelada.');
    }
}
