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
        //
        Schema::create('personal', function (Blueprint $table) {
            $table->id();
            $table->string('apellido');
            $table->string('nombre');
            $table->enum('sexo', ['M', 'F']);
            $table->string('direccion')->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->integer('edad')->nullable();
            $table->string('cmp')->nullable(); // Código Médico Profesional, opcional
            $table->string('dni')->unique();
            $table->string('telefono')->nullable();
            $table->foreignId('especialidad_id')->nullable()->constrained('especialidades_ocupacionales')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('personal');
    }
};
