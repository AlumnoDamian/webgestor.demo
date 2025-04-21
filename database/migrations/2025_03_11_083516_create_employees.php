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
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('dni')->unique();
            $table->string('phone');
            $table->text('address');
            $table->foreignId('department_id')->constrained()->onDelete('cascade');
            $table->enum('role', ['jefe', 'empleado', 'supervisor', 'auxiliar', 'gerente', 'recepcionista', 'cocinero', 'camarero', 'conserje', 'limpiador', 'guardia de seguridad', 'auxiliar administrativo', 'analista']);
            $table->date('birth_date');
            $table->boolean('is_active')->default(true);
            $table->string('image')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
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
