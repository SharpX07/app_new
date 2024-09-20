<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    use HasFactory;

    // Definir los atributos que son asignables en masa (fillable)
    protected $fillable = ['titulo', 'contenido'];

    // Si deseas evitar que Laravel maneje automáticamente los timestamps (creado_en y actualizado_en)
    public $timestamps = true;
}
