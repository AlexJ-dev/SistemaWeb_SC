<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('atenciones');
    }

    public function down(): void
    {
        Schema::create('atenciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paciente_id')->constrained()->onDelete('cascade');
            $table->string('tipo_evaluacion');
            $table->string('registrado_por');
            $table->timestamp('registrado_en')->useCurrent();
            $table->timestamps();
        });
    }
};
