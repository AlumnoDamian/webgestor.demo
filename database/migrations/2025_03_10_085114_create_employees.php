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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relación con users
            $table->string('dni')->unique(); // DNI único para evitar duplicados
            $table->string('name'); // Nombre completo del empleado
            $table->string('email')->unique(); // Email único
            $table->string('password'); // Contraseña
            $table->date('birth_date')->nullable(); // Fecha de nacimiento
            $table->text('address')->nullable(); // Dirección
            $table->string('phone')->nullable(); // Teléfono
            $table->boolean('is_active')->default(true); // Estado del empleado
            $table->string('image')->nullable(); // Imagen opcional
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
