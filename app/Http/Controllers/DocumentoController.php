<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use Illuminate\Http\Request;
use Illuminate\Support\Str; // Asegúrate de importar la clase Str

class DocumentoController extends Controller
{

    public function guardarContenido(Request $request)
    {
        // Validar el formulario
        $request->validate([
            'titulo' => ['required', 'string', 'max:255', 'unique:documentos,titulo'],
            'contenido' => ['required', 'string'],
            'imagen' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'], // Validar imagen
        ]);

        // Obtener el título y contenido
        $titulo = $request->input('titulo');
        $contenido = $request->input('contenido');

        // Convertir el título a un nombre de archivo amigable
        $filename = Str::slug($titulo, '-'); // Reemplaza espacios por guiones

        // Guardar la imagen en la carpeta 'public/images' usando el título como nombre
        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $nombreImagen = $filename . '.' . $imagen->getClientOriginalExtension(); // Usar la extensión original
            $imagen->move(public_path('images'), $nombreImagen); // Mover la imagen a 'public/images'
        }

        // Crear un nuevo registro en la base de datos
        $documento_creado = Documento::create([
            'titulo' => $titulo,
            'imagen' => isset($nombreImagen) ? $nombreImagen : null, // Guardar el nombre de la imagen si existe
        ]);

        // Guardar el contenido en el storage usando el título como nombre
        $path = "documentos/{$filename}.html";
        if (\Storage::disk('local')->put($path, $contenido)) {
            \Log::info("Archivo guardado exitosamente en {$path}");
        } else {
            \Log::error("Error al guardar el archivo en {$path}");
        }

        // Guardar el objeto documento_creado en la sesión
        session(['documento_creado_id' => $documento_creado->id]);

        return view('agregar-preguntas');
    }

    // Recibe un json con las preguntas y respuestas
    public function guardarPreguntas(Request $request)
    {
        // Recuperar el ID del documento desde la sesión
        $documentoId = session('documento_creado_id');
        $documento_creado = Documento::find($documentoId);

        if (!$documento_creado) {
            \Log::error("Documento no encontrado con ID {$documentoId}");
            return redirect()->route('textos')->withErrors(['error' => 'Documento no encontrado.']);
        }

        // Procesar las preguntas y respuestas
        $preguntasRespuestasJson = $request->input('preguntas_respuestas');
        $preguntasRespuestas = json_decode($preguntasRespuestasJson, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            \Log::error("Error al decodificar JSON: " . json_last_error_msg());
            return redirect()->route('textos')->withErrors(['error' => 'Error al procesar las preguntas y respuestas.']);
        }

        foreach ($preguntasRespuestas as $preguntaRespuesta) {
            // Validar que el JSON tenga el formato correcto
            if (!isset($preguntaRespuesta['pregunta'], $preguntaRespuesta['opciones'], $preguntaRespuesta['correcta'])) {
                throw new \Exception('Formato de pregunta inválido.');
            }
            $pregunta = $preguntaRespuesta['pregunta'];
            $opciones = $preguntaRespuesta['opciones'];
            $respuestaCorrecta = $preguntaRespuesta['correcta'];
            // Crear la pregunta
            $preguntaModel = $documento_creado->preguntas()->create(['Pregunta_Respuestas' => $pregunta]);
            // Guardar las opciones
            foreach ($opciones as $opcion) {
                $preguntaModel->opcions()->create([
                    'texto' => $opcion,
                    'correcta' => ($opcion === $respuestaCorrecta) ? 1 : 0
                ]);
            }
        }
        return redirect()->route('textos')->withErrors(['error' => 'Error al guardar las preguntas.']);
    }


    public function mostrarContenido()
    {
        // Obtener todos los documentos de la base de datos
        $documentos = Documento::all();

        // Crear un array para almacenar el contenido de cada documento
        $documentos_contenido = [];

        // Recorrer cada documento y obtener el contenido del archivo
        foreach ($documentos as $documento) {
            $filename = Str::slug($documento->titulo, '-') . '.html';

            // Verificar si el archivo existe en el almacenamiento
            if (\Storage::disk('local')->exists("documentos/{$filename}")) {
                // Obtener el contenido del archivo
                $contenido = \Storage::disk('local')->get("documentos/{$filename}");

                // Verificar si hay una imagen con el mismo nombre que el título
                $imagen = $documento->imagen ? 'images/' . $documento->imagen : null;

                // Agregar el contenido y la imagen (si existe) al array de documentos
                $documentos_contenido[] = [
                    'titulo' => $documento->titulo,
                    'contenido' => $contenido,
                    'imagen' => $imagen, // Puede ser null si no hay imagen
                ];
            }
        }
        // Pasar los documentos con su contenido y las imágenes a la vista
        return view('mostrar-texto', ['documentos' => $documentos_contenido]);
    }


    public function eliminar($titulo)
    {
        // Buscar el documento por el título
        $documento = Documento::where('titulo', $titulo)->first();

        if ($documento) {
            // Obtener el nombre del archivo HTML
            $filenameHtml = Str::slug($documento->titulo, '-') . '.html';
            $pathHtml = "documentos/{$filenameHtml}";

            // Eliminar el archivo HTML del almacenamiento
            if (\Storage::disk('local')->exists($pathHtml)) {
                \Storage::disk('local')->delete($pathHtml);
            }

            // Obtener el nombre de la imagen asociada
            $imagen = $documento->imagen;

            if ($imagen) {
                // Eliminar la imagen del almacenamiento
                $pathImagen = public_path("images/{$imagen}");
                if (file_exists($pathImagen)) {
                    unlink($pathImagen);
                }
            }

            // Eliminar el registro de la base de datos
            $documento->delete();

            return redirect()->route('textos')->with('success', 'Documento y su imagen eliminados exitosamente');
        }

        return redirect()->route('textos')->with('error', 'Documento no encontrado');
    }

    public function verTextos()
    {
        // Obtener todos los documentos de la base de datos
        $documentos = Documento::all();

        // Crear un array para almacenar los datos de cada documento
        $documentos_contenido = [];

        foreach ($documentos as $documento) {
            $filename = Str::slug($documento->titulo, '-') . '.html';
            $pathHtml = "documentos/{$filename}";

            // Verificar si el archivo HTML existe
            if (\Storage::disk('local')->exists($pathHtml)) {
                $contenido = \Storage::disk('local')->get($pathHtml);
                $imagen = $documento->imagen ? $documento->imagen : null;

                $documentos_contenido[] = [
                    'id' => $documento->id, // Agregar el ID del documento
                    'titulo' => $documento->titulo,
                    'contenido' => $contenido,
                    'imagen' => $imagen,
                ];
            }
        }
        return view('menu.menu_textos', ['documentos' => $documentos_contenido]);
    }



    public function mostrarTexto($id)
    {
        // Obtener el documento por su ID
        $documento = Documento::findOrFail($id);
        
        // Convertir el título a un nombre de archivo amigable
        $filename = Str::slug($documento->titulo, '-'); // Reemplaza espacios por guiones
        $pathImagen = "images/{$filename}.jpg"; // Asumiendo que la imagen es .jpg, cambia si es diferente

        // Verificar si el archivo de imagen existe en el directorio public
        $imagenPath = public_path($pathImagen);
        $imagenExiste = file_exists($imagenPath);

        // Obtener el contenido del documento
        $contenidoPath = "documentos/{$filename}.html";
        $contenido = file_exists(storage_path("app/{$contenidoPath}")) ? 
                    \Storage::disk('local')->get($contenidoPath) : null;

        // Pasar los datos a la vista
        return view('mostrar-texto', [
            'documentos' => [
                [
                    'titulo' => $documento->titulo,
                    'contenido' => $contenido,
                    'imagen' => $imagenExiste ? asset($pathImagen) : null,
                ]
            ]
        ]);
    }
}
