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
    <form action="{{ route('guardar-contenido') }}" method="POST" id="content-form" enctype="multipart/form-data">
        @csrf
        <!-- Título -->
        <label for="titulo">Título:</label>
        <input type="text" name="titulo" title="Ingresa el título aquí" placeholder="Escriba el título aquí..." required><br><br>

        <!-- Contenido -->
        <label for="contenido">Contenido:</label>
        <textarea id="contenido" name="contenido" cols="30" rows="10" title="Escribe el contenido aquí" required></textarea><br><br>

        <!-- Cargar Imagen -->
        <label for="imagen">Subir Imagen Portada:</label>
        <input type="file" name="imagen" accept="image/*" required><br><br>

        <!-- Botón Guardar -->
        <button type="submit" title="Guardar el contenido ingresado">Guardar Contenido</button>
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

