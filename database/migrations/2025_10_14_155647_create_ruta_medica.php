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
        Schema::create('ruta_medica', function (Blueprint $table) {
            $table->id();
            $table->string('documento');
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('tipo_documento');
            $table->string('empresa');
            $table->string('cargo');
            $table->string('tipo_evaluacion');
            $table->string('registrado_por'); // username del usuario
            $table->timestamp('registrado_en')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ruta_medica');
    }
};
