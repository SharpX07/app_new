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
        Schema::create('pruebas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->unique();
            $table->foreignId('documento_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->string('codigo_ingreso')->unique();
            $table->datetime('inicio');
            $table->datetime('fin');
            $table->integer('duracion');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Eliminar la clave foránea primero
        Schema::table('pruebas', function (Blueprint $table) {
            $table->dropForeign(['user_id']);      // Elimina la clave foránea de user_id
            $table->dropForeign(['documento_id']); // Elimina la clave foránea
        });
        Schema::dropIfExists('pruebas');
    }
};
