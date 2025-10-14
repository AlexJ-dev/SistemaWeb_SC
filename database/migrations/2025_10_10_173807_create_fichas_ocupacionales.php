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
        Schema::create('fichas_ocupacionales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paciente_id')->constrained()->onDelete('cascade');
            $table->string('tipo_evaluacion');
            $table->string('empresa');
            $table->string('contratista')->nullable();
            $table->string('puesto_postula')->nullable();
            $table->string('puesto_actual')->nullable();
            $table->string('tiempo_puesto_actual')->nullable();
            $table->boolean('explora_superficie')->default(false);
            $table->boolean('explora_concentradora')->default(false);
            $table->boolean('explora_subsuelo')->default(false);
            $table->integer('altitud')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fichas_ocupacionales');
    }
};
