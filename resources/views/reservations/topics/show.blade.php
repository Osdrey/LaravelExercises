@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Detalles del Tema</h1>
        <p><strong>Clase:</strong> {{ $topic->class->subject }}</p>
        <p><strong>Tema:</strong> {{ Str::limit($topic->name, 50) }}</p>
    </div>
@endsection
