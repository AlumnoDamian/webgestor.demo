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
            $table->string('code')->unique();
            $table->string('name'); 
            $table->text('description')->nullable();
            $table->decimal('budget', 10, 2)->default(0)->nullable();
            $table->string('phone')->nullable(); 
            $table->string('email')->unique()->nullable(); 
            $table->boolean('status')->default(true); 
            $table->unsignedBigInteger('manager_id')->nullable();
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
