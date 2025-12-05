<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('evaluacion_radiografia', function (Blueprint $table) {
        $table->id();

        // Relación con Evaluacion general
        $table->foreignId('evaluacion_id')->constrained('evaluaciones')->onDelete('cascade');

        // Campos que pueden tener múltiples valores
        $table->json('campos_pulmonares')->nullable();
        $table->json('senos')->nullable();
        $table->json('silueta_cardiovascular')->nullable();
        $table->json('incidencias_frontales_laterales')->nullable();
        $table->json('conclusiones')->nullable();

        // Campos únicos
        $table->string('vertices')->nullable();
        $table->string('hilo')->nullable();
        $table->string('mediastinos')->nullable();
        $table->integer('numero_rayosx')->nullable();
        $table->string('calidad')->nullable();
        $table->date('fecha')->nullable();
        $table->string('simbolos')->nullable();
        $table->text('evaluacion_radiologica')->nullable();

        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('evaluacion_radiografia');
}

};
