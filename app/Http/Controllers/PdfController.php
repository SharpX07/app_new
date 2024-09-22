<?php

// Para que esto funcione se debe realizar por consola:
// composer require barryvdh/laravel-dompdf

// El formato del pdf depende de un HTML, que en este caso es ejemplo
// Si se modifica este se puede obtener distintos formatos de pdf
// el nombre de dicho HTML es: ejemplo.blade.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;

class PdfController extends Controller
{
    public function descargarPDF()
    {
        $data = [
            'titulo' => 'Mi PDF de ejemplo',
            'contenido' => 'Este es el contenido de mi PDF generado con Laravel y dompdf.'
        ];
        
        $pdf = PDF::loadView('ejemplo', $data);
        
        return $pdf->download('ejemplo.pdf');
    }
}
