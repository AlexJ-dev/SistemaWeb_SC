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
        Schema::create('antecedente_medico_enfermedad', function (Blueprint $table) {
            $table->id();
            $table->foreignId('antecedente_medico_id')->constrained('antecedentes_medicos')->onDelete('cascade');
            $table->foreignId('enfermedad_id')->constrained('enfermedades')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('antecedente_medico_enfermedad');
    }
};
