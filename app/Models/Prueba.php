<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prueba extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nombre',
        'documento_id',
        'user_id',
        'codigo_ingreso',
        'inicio',
        'fin',
        'duracion'];
    
    protected $dates = [
        'inicio',
        'fin'
    ];

    public $timestamps = false; // Desactiva timestamps
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function documento()
    {
        return $this->belongsTo(Documento::class);
    }
}
