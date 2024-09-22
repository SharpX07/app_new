<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Documento;
use App\Models\Opcion;


class Pregunta extends Model
{
    use HasFactory;
     // Agrega los atributos que deseas permitir para asignación masiva
     protected $fillable = [
        'documento_id',
        'Pregunta_Respuestas',
    ];
    public function documento()
    {
        return $this->belongsTo(Documento::class);
    }
    
    public function opcions()
    {
        return $this->hasMany(Opcion::class);
    }
}
