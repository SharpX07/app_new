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
        <!-- Preguntas -->
        <div id="preguntas-container">
            <!-- Añade este div para mostrar la lista de preguntas y opciones -->
            <div id="lista-preguntas-opciones" style="margin-top: 20px;"></div>


            <h3>Preguntas</h3>
            <div class="pregunta" id="pregunta_1_container">
                <label for="pregunta_1">Pregunta:</label>
                <textarea id="pregunta_1" name="preguntas[0][pregunta]" cols="30" rows="3" required></textarea><br><br>

                <div class="opciones-container" id="opciones_1_container">
                    <label for="opcion_1_1">Opción 1:</label>
                    <input type="text" name="preguntas[0][opciones][]" required>
                    <!-- <button type="button" class="eliminar-opcion" data-pregunta-id="1" data-opcion-id="1">Eliminar</button><br> -->
                </div>
                <button type="button" class="agregar-opcion" data-pregunta-id="1">Agregar Opción</button><br><br>

                <label for="respuesta_correcta_1">Respuesta Correcta:</label>
                <select id="respuesta_correcta_1" name="preguntas[0][respuesta_correcta]" required>
                    <option value="0">Opción 1</option>
                </select><br><br>
            </div>
        </div>

        <!-- Botón para agregar más preguntas -->
        <button type="button" id="agregar-pregunta" title="Agregar una nueva pregunta">Agregar Pregunta</button><br><br>
        
        <!-- Botón Guardar -->
        <button type="submit" title="Guardar el contenido ingresado">Guardar Contenido</button>
    </form>

    <script>
        $(document).ready(function() {
            // Inicializar Summernote para la primera pregunta
            $('#pregunta_1').summernote({
                placeholder: 'Ingrese la pregunta...',
                tabsize: 2,
                height: 100,
                lang: 'es-ES'  // Configuración del idioma a español
            });

            // Contador para nuevas preguntas y opciones
            let preguntaCount = 1;
            let opcionCount = { 1: 1 };

            // Lista de texto para preguntas y opcions en el formato: "{Pregunta}:opcion1;opcion2;opcion3"
            let preguntasOpciones = [];


            // Función para agregar una nueva pregunta
           // Función para agregar una nueva pregunta
           $('#agregar-pregunta').click(function() {
                const preguntaTexto = $(`#pregunta_${preguntaCount}`).val();
                const opcionesTexto = $(`#opciones_${preguntaCount}_container input`).map(function() {
                    return $(this).val();
                }).get().join(';');
            
                // Guardar pregunta y opciones en la lista
                preguntasOpciones.push(`${preguntaTexto}:${opcionesTexto}`);
            
                // Actualizar la visualización
                $('#lista-preguntas-opciones').html(preguntasOpciones.join('<br>'));
            
                // Limpiar el campo de la pregunta y las opciones
                $(`#pregunta_${preguntaCount}`).val('');
                $(`#opciones_${preguntaCount}_container input`).val('');
            });
        

            // Función para agregar una nueva opción
            $(document).on('click', '.agregar-opcion', function() {
                const preguntaId = $(this).data('pregunta-id');
                opcionCount[preguntaId]++;
                const nuevaOpcion = `
                    <label for="opcion_${preguntaId}_${opcionCount[preguntaId]}">Opción ${opcionCount[preguntaId]}:</label>
                    <input type="text" name="preguntas[${preguntaId - 1}][opciones][]" required>
                    <button type="button" class="eliminar-opcion" data-pregunta-id="${preguntaId}" data-opcion-id="${opcionCount[preguntaId]}">Eliminar</button><br>
                `;
                $(`#opciones_${preguntaId}_container`).append(nuevaOpcion);

                // Agregar nueva opción al select de respuesta correcta
                const nuevaOpcionSelect = `<option value="${opcionCount[preguntaId] - 1}">Opción ${opcionCount[preguntaId]}</option>`;
                $(`#respuesta_correcta_${preguntaId}`).append(nuevaOpcionSelect);
            });

            // Función para eliminar una opción
            $(document).on('click', '.eliminar-opcion', function() {
                const preguntaId = $(this).data('pregunta-id');
                const opcionId = $(this).data('opcion-id');
                $(this).prev('input').remove();  // Eliminar el input
                $(this).prev('label').remove();  // Eliminar el label
                $(this).next('br').remove();  // Eliminar el br
                $(this).remove();  // Eliminar el botón

                // Actualizar opciones en el select de respuesta correcta
                $(`#respuesta_correcta_${preguntaId} option[value="${opcionId - 1}"]`).remove();
                $(`#respuesta_correcta_${preguntaId} option`).each(function(index) {
                    $(this).text(`Opción ${index + 1}`).val(index);
                });

                // Actualizar contadores de opciones
                opcionCount[preguntaId]--;
            });
        });
    </script>
</body>
</html>
