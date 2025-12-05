<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('historia_ocupacional', function (Blueprint $table) {
            $table->id();

            // Relación con pacientes
            $table->unsignedBigInteger('paciente_id');
            $table->foreign('paciente_id')->references('id')->on('pacientes')->onDelete('cascade');

            // Información del trabajo anterior
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_fin')->nullable(); // opcional si lo deseas

            $table->string('empresa')->nullable();
            $table->string('actividad_realizada')->nullable();
            $table->string('ubicacion_departamento')->nullable();

            $table->decimal('altura_snm', 8, 2)->nullable(); // 4500.50 por ejemplo

            $table->string('area_trabajo')->nullable();
            $table->string('ocupacion')->nullable();

            // Tiempos de trabajo
            $table->decimal('tiempo_subsuelo', 5, 2)->nullable();   // en años o meses
            $table->decimal('tiempo_superficie', 5, 2)->nullable(); // en años o meses

            // Campos con múltiples valores → JSON
            $table->json('exposiciones_peligrosas')->nullable();
            $table->json('medidas_proteccion_ambiental')->nullable();
            $table->json('medidas_proteccion_personal')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('historia_ocupacional');
    }
};
