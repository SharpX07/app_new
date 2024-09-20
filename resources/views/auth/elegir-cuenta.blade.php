<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/elegir.css') }}">
    <!-- Incluye Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <title>Elegir cuenta</title>
</head>
<body>
    <section class="inicio">
        <div class="botones">
            <h1>Registrarme como:</h1>
            <div class="elige-estudiante">
                <!-- Usar onclick para redirigir -->
                <button onclick="window.location.href='{{ route('register') }}'" class="btn-estudiante">Estudiante</button>            
            </div>
            <div class="elige-docente">
                <!-- Usar onclick para redirigir -->
                <button onclick="window.location.href='{{ route('register-docente') }}'" class="btn-docente">Docente</button>            
            </div>
        </div>
    </section>
</body>
</html>
