<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('documentos', function (Blueprint $table) {
            $table->id();
            $table->string('titulo')->unique();
            $table->timestamps();
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Elimina la tabla dependiente (pruebas) antes de eliminar documentos
        Schema::dropIfExists('pruebas');
        Schema::dropIfExists('notas');
        Schema::dropIfExists('documentos');
    }
};
