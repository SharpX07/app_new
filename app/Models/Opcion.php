<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pregunta;

class Opcion extends Model
{
    use HasFactory;

    // Agrega los atributos que deseas permitir para asignación masiva
    protected $fillable = [
        'pregunta_id',
        'texto',
        'correcta'
    ];

    public function pregunta()
    {
        return $this->belongsTo(Pregunta::class);
    }
}
