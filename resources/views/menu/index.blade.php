@extends('layouts.app')

@section('content')
    <body>
        <h1>Menú de Proyectos</h1>
        <ul>
            <li>
                <a href="/tasks">Lista de Tareas</a>
            </li>
            <li>
                <a href="/tips">Calculadora de Propinas</a>
            </li>
            <li>
                <a href="/password">Generador de Contraseñas Seguras</a>
            </li>
            <li>
                <a href="/expenses">Gestor de Gastos</a>
            </li>
            <li>
                <a href="/reservations">Sistema de Reservas</a>
            </li>
            <li>
                <a href="/notes">Gestor de Notas</a>
            </li>
            <li>
                <a href="/events">Calendario de Eventos</a>
            </li>
        </ul>
    </body>
@endsection
