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
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Clave primaria, llamada 'id' automáticamente
            $table->string('name'); // Nombre del usuario
            $table->string('apellido_paterno'); // Apellido paterno del usuario
            $table->string('apellido_materno'); // Apellido materno del usuario
            $table->string('ciclo')->nullable(); // Ciclo del usuario (opcional)
            $table->string('escuela')->nullable(); // Escuela del usuario
            $table->string('codigo_unt')->unique()->nullable(); // Código único del usuario
            $table->string('rol'); // Rol del usuario (por ejemplo: docente, alumno)
            $table->string('email')->unique(); // Correo electrónico único
            $table->timestamp('email_verified_at')->nullable(); // Verificación del correo
            $table->string('password'); // Contraseña (se almacenará como hash)
            $table->rememberToken(); // Token para recordar sesión
            $table->timestamps(); // created_at y updated_at
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
