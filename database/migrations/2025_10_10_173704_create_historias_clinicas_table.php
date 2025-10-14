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
        Schema::create('historias_clinicas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paciente_id')->constrained()->onDelete('cascade');
            $table->string('numero_historia')->unique();
            $table->string('lugar_nacimiento_pais')->nullable();
            $table->string('lugar_nacimiento_departamento')->nullable();
            $table->string('lugar_nacimiento_provincia')->nullable();
            $table->string('lugar_nacimiento_distrito')->nullable();
            $table->string('domicilio_direccion')->nullable();
            $table->string('domicilio_departamento')->nullable();
            $table->string('domicilio_provincia')->nullable();
            $table->string('domicilio_distrito')->nullable();
            $table->string('telefono')->nullable();
            $table->string('estado_civil')->nullable();
            $table->string('grado_institucional')->nullable();
            $table->string('ocupacion')->nullable();
            $table->string('religion')->nullable();
            $table->string('seguro')->nullable();
            $table->string('emergencia_direccion')->nullable();
            $table->string('emergencia_parentesco')->nullable();
            $table->string('emergencia_telefono')->nullable();
            $table->string('grupo_sanguineo')->nullable();
            $table->string('creado_por')->nullable();
            $table->timestamp('creado_en')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historias_clinicas');
    }
};
