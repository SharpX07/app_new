<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingresar texto</title>
    
    <!-- Enlace a tu archivo CSS -->
    <link rel="stylesheet" href="{{ asset('css/agregar-texto.css') }}">
    <!-- Librerías de jQuery y Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <!-- CSS y JS de Summernote -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

    <!-- Archivo de idioma en español para Summernote -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/lang/summernote-es-ES.min.js"></script>
</head>

<body>
    <form action="{{ route('guardar-prueba') }}" method="POST" id="content-form" enctype="multipart/form-data">
        @csrf
        <!-- Título -->
        <label for="nombre">Nombre de la prueba:</label>
        <input type="text" name="nombre" title="Ingresa el nombre aquí" placeholder="Escriba el nombre de tu prueba..." required><br><br>

        <label for="documento_titulo">Texto:</label>
        <input type="text" name="documento_titulo" title="Ingresa el título del texto aquí" placeholder="Escriba el título aquí..." required><br><br>

        <label for="inicio">Fecha y hora de inicio:</label>
        <input type="datetime-local" name="inicio" title="Selecciona la fecha y hora de inicio" required><br><br>

        <label for="fin">Fecha y hora de termino:</label>
        <input type="datetime-local" name="fin" title="Selecciona la fecha y hora de termino" required><br><br>

        <label for="duracion">Duracion de la prueba (minutos):</label>
        <input type="text" name="duracion" title="Ingresa la duracion de la prueba" placeholder="Escriba la duración en minutos aquí..." required><br><br>

        <!-- Botón Guardar -->
        <button type="submit" title="Guardar Prueba">Guardar Prueba</button>
    </form>

    <script>
        
        $('#contenido').summernote({
            placeholder: 'Ingrese el texto...',
            tabsize: 2,
            height: 300,
            lang: 'es-ES'  // Configuración del idioma a español
        });
    </script>
</body>
</html>

