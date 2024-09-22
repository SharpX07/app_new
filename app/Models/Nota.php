<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    protected $fillable = [
        'id',
        'prueba_id',
        'user_id',
        'valor',
    ];

    public $timestamps = false; // Desactiva timestamps
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function prueba()
    {
        return $this->belongsTo(Prueba::class);
    }
    use HasFactory;
}
