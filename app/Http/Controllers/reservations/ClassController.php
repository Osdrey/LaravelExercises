<?php

namespace App\Http\Controllers\reservations;

use App\Http\Controllers\Controller;
use App\Models\reservations\Classes;
use App\Models\reservations\Topics;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    // Listar todas las clases
    public function index()
    {
        $classes = Classes::with('topics')->get();
        return view('reservations.classes.index', compact('classes'));
    }

    // Mostrar formulario para crear una nueva clase
    public function create()
    {
        return view('reservations.classes.create');
    }

    // Guardar una nueva clase
    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
        ]);

        Classes::create($request->all());

        return redirect()->route('classes.index')->with('success', 'Clase creada con éxito.');
    }

    // Mostrar formulario para editar una clase
    public function edit($id)
    {
        $class = Classes::findOrFail($id);
        return view('reservations.classes.edit', compact('class'));
    }

    // Actualizar una clase
    public function update(Request $request, $id)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
        ]);

        $class = Classes::findOrFail($id);
        $class->update($request->all());

        return redirect()->route('classes.index')->with('success', 'Clase actualizada con éxito.');
    }

    // Eliminar una clase
    public function destroy($id)
    {
        $class = Classes::findOrFail($id);
        $class->delete();

        return redirect()->route('classes.index')->with('success', 'Clase eliminada con éxito.');
    }

    // Agregar un tema a una clase
    public function addTopic(Request $request, $classId)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $class = Classes::findOrFail($classId);
        $class->topics()->create(['name' => $request->name]);

        return redirect()->route('classes.index')->with('success', 'Tema agregado con éxito.');
    }
}
