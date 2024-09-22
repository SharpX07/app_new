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
    <form action="{{ route('guardar-preguntas') }}" method="POST" id="content-form" enctype="multipart/form-data">
        @csrf
        <!-- Preguntas -->
        <div id="preguntas-container">
            <h3>Preguntas</h3>
            <div class="pregunta" id="pregunta_1_container">
                <label for="pregunta_1">Pregunta:</label>
                <textarea id="pregunta_1" name="preguntas[0][pregunta]" cols="30" rows="3" required></textarea><br><br>

                <div class="opciones-container" id="opciones_1_container">
                    <label for="opcion_1_1">Opción 1:</label>
                    <input type="text" id="opcion_1_1" name="preguntas[0][opciones][]" required>
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
        <!-- Campo oculto para las preguntas y respuestas -->
        <input type="hidden" name="preguntas_respuestas" id="preguntas_respuestas">

        <!-- Botón Guardar -->
        <button type="submit" title="Guardar el contenido ingresado">Guardar Contenido</button>
    </form>

    <script>
        $(document).ready(function() {
            let preguntaCount = 1;
            let opcionCount = { 1: 1 };

            // Función para agregar una nueva pregunta
            $('#agregar-pregunta').click(function() {
                preguntaCount++;
                opcionCount[preguntaCount] = 1;
                const nuevaPregunta = `
                    <div class="pregunta" id="pregunta_${preguntaCount}_container">
                        <label for="pregunta_${preguntaCount}">Pregunta:</label>
                        <textarea id="pregunta_${preguntaCount}" name="preguntas[${preguntaCount - 1}][pregunta]" cols="30" rows="3" required></textarea><br><br>

                        <div class="opciones-container" id="opciones_${preguntaCount}_container">
                            <label for="opcion_${preguntaCount}_1">Opción 1:</label>
                            <input type="text" id="opcion_${preguntaCount}_1" name="preguntas[${preguntaCount - 1}][opciones][]" required>
                        </div>
                        <button type="button" class="agregar-opcion" data-pregunta-id="${preguntaCount}">Agregar Opción</button><br><br>

                        <label for="respuesta_correcta_${preguntaCount}">Respuesta Correcta:</label>
                        <select id="respuesta_correcta_${preguntaCount}" name="preguntas[${preguntaCount - 1}][respuesta_correcta]" required>
                            <option value="0">Opción 1</option>
                        </select><br><br>
                    </div>
                `;
                $('#preguntas-container').append(nuevaPregunta);
            });

            // Función para agregar una nueva opción
            $(document).on('click', '.agregar-opcion', function() {
                const preguntaId = $(this).data('pregunta-id');
                opcionCount[preguntaId]++;
                const nuevaOpcionId = opcionCount[preguntaId];
                const nuevaOpcion = `
                    <label for="opcion_${preguntaId}_${nuevaOpcionId}">Opción ${nuevaOpcionId}:</label>
                    <input type="text" id="opcion_${preguntaId}_${nuevaOpcionId}" name="preguntas[${preguntaId - 1}][opciones][]" required>
                    <button type="button" class="eliminar-opcion" data-pregunta-id="${preguntaId}" data-opcion-id="${nuevaOpcionId}">Eliminar</button><br>
                `;
                $(`#opciones_${preguntaId}_container`).append(nuevaOpcion);

                // Agregar nueva opción al select de respuesta correcta
                const nuevaOpcionSelect = `<option value="${nuevaOpcionId - 1}" id="select_opcion_${preguntaId}_${nuevaOpcionId}">Opción ${nuevaOpcionId}</option>`;
                $(`#respuesta_correcta_${preguntaId}`).append(nuevaOpcionSelect);

                // Manejar cambios en el texto de la opción
                $(`#opcion_${preguntaId}_${nuevaOpcionId}`).on('input', function() {
                    const opcionTexto = $(this).val();
                    $(`#select_opcion_${preguntaId}_${nuevaOpcionId}`).text(opcionTexto);
                });
            });

            // Función para eliminar una opción
            $(document).on('click', '.eliminar-opcion', function() {
                const preguntaId = $(this).data('pregunta-id');
                const opcionId = $(this).data('opcion-id');
                $(this).prev('input').remove();
                $(this).prev('label').remove();
                $(this).next('br').remove();
                $(this).remove();
                $(`#select_opcion_${preguntaId}_${opcionId}`).remove();
            });

            // Al enviar el formulario, guardar las preguntas y opciones en el campo oculto
            $('#content-form').submit(function() {
                const preguntasRespuestas = [];
                $('.pregunta').each(function(index) {
                    const preguntaTexto = $(this).find('textarea').val();
                    const opciones = $(this).find('.opciones-container input').map(function() {
                        return $(this).val();
                    }).get();
                    const respuestaCorrecta = $(this).find('select').val();
                    const preguntaRespuesta = {
                        pregunta: preguntaTexto,
                        opciones: opciones,
                        correcta: opciones[respuestaCorrecta]
                    };
                    preguntasRespuestas.push(preguntaRespuesta);
                });
                $('#preguntas_respuestas').val(JSON.stringify(preguntasRespuestas));
            });

            // Inicializar el evento de cambio para las opciones existentes
            $(document).on('input', '.opciones-container input', function() {
                const preguntaId = $(this).closest('.pregunta').attr('id').split('_')[1];
                const opcionId = $(this).attr('id').split('_')[2];
                const opcionTexto = $(this).val();
                $(`#select_opcion_${preguntaId}_${opcionId}`).text(opcionTexto);
            });
        });
    </script>
</body>
</html>
