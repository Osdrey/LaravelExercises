<?php

namespace App\Http\Controllers\Calendar;

use App\Http\Controllers\Controller;
use App\Models\Calendar\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    // Mostrar la lista de eventos
    public function index()
    {
        $events = Event::all();
        return view('calendar.index', compact('events'));
    }

    // Mostrar el formulario de creación de evento
    public function create()
    {
        return view('calendar.create');
    }

    // Guardar el nuevo evento
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_time' => 'required|date',
            'end_time' => 'required|date',
            'reminder' => 'nullable|boolean',
        ]);

        // Convertir 'reminder' a un valor 1 o 0
        $data['reminder'] = $request->has('reminder') ? 1 : 0;

        Event::create($data);

        return redirect()->route('events.index');
    }

    // Mostrar el formulario de edición de evento
    public function edit($id)
    {
        $event = Event::findOrFail($id);
        return view('calendar.edit', compact('event'));
    }

    // Actualizar el evento
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after_or_equal:start_time',
        ]);

        $event = Event::findOrFail($id);
        $event->update($request->all());
        return redirect()->route('events.index');
    }

    // Eliminar un evento
    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();
        return redirect()->route('events.index');
    }
}
