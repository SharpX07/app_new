<?php

namespace App\Http\Controllers;

use App\Models\Prueba;
use App\Models\User;
use App\Models\Documento;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Faker\Factory as Faker;

class PruebaController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */

    // Guarda en la base de datos todo lo relacionado a la información
    // de una prueba.
    public function guardarPrueba(Request $request)
    {
        $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'documento_titulo' => ['required', 'string','exists:documentos,titulo'],
            'inicio' => ['required', 'date'],
            'fin' => ['required', 'date'],
            'duracion' => ['required', 'integer'],
        ]);

        // Obtener el documento por su título
        $documento = Documento::where('titulo', $request->documento_titulo)->first();

        // Verificar que el documento fue encontrado
        if (!$documento) {
            return response()->json(['error' => 'Documento no encontrado'], 404);
        }
        
        // Formatear fechas
        $inicio = Carbon::parse($request->inicio);
        $fin = Carbon::parse($request->fin);

        // Generar código
        $codigo = PruebaController::generarCodigo();
        
        $prueba = new Prueba();
        $prueba->nombre = $request->nombre;
        $prueba->documento_id = $documento->id;
        $prueba->user_id = Auth::id();
        $prueba->codigo_ingreso = $codigo;
        $prueba->inicio = $inicio;
        $prueba->fin = $fin;
        $prueba->duracion = $request->duracion;
        
        $prueba->save();

        return view('principal-view');
    }
    
    private function generarCodigo()
    {
        $faker = Faker::create();
        return $faker->regexify('[A-Z0-9]{6}');
    }

    /**
     * Display the specified resource.
     */
    public function mostrarPrueba(Prueba $prueba)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function eliminarPrueba($id)
    {
        $prueba = Prueba::find($id);
        $prueba->delete();
    }
}
