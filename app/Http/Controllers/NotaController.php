<?php

namespace App\Http\Controllers;

use App\Models\Nota;
use Illuminate\Http\Request;

class NotaController extends Controller
{
    // Guarda en la base de datos todo lo relacionado a la información
    // de una nota.
    public function guardarPrueba(Request $request)
    {
        $request->validate([
            'prueba_id' => ['required', 'exists:pruebas,id'],
            'user_id' => ['required', 'exists:user, id'],
            'valor' => ['required', 'integer'],
        ]);
        
        $prueba = new Nota();
        $prueba->prueba_id = $request->prueba_id;
        $prueba->user_id = $request->user_id;
        $prueba->valor = $request->valor;

        $prueba->save();

        return view('principal-view');
    }
}
