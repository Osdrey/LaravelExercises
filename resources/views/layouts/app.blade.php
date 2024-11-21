<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Proyects</title>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
</head>
    <body>
        <header>
            <h1><a href="{{ url('/') }}" class="restaurant-name">Laravel Proyects</a></h1>
        </header>
        <div class="container">
            @yield('content')
        </div>
        <footer>
            <p>&copy; Osdrey Proyects. "Si lo puedes imaginar, lo puedes crear."</p>
        </footer>
    </body>
</html>
