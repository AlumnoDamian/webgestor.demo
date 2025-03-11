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
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // Código identificador del departamento
            $table->string('name')->unique(); // Nombre del departamento
            $table->text('description')->nullable(); // Descripción opcional
            $table->unsignedBigInteger('manager_id')->nullable(); // Jefe del departamento
            $table->decimal('budget', 10, 2)->default(0); // Presupuesto del departamento
            $table->string('phone')->nullable(); // Teléfono de contacto
            $table->string('email')->unique()->nullable(); // Correo electrónico del departamento
            $table->boolean('status')->default(true); // Estado activo/inactivo
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departments');
    }
};
