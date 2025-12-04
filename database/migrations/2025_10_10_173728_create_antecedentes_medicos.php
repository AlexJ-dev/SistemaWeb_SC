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
        Schema::create('antecedentes_medicos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('historia_clinica_id')->constrained('historias_clinicas')->onDelete('cascade');
            $table->text('patologicos_personales')->nullable();
            $table->text('cirugias')->nullable();
            $table->text('intoxicaciones')->nullable();
            $table->text('alergias')->nullable();
            $table->text('hospitalizaciones')->nullable();
            $table->text('medicamentos')->nullable();
            $table->text('observaciones')->nullable();
            $table->boolean('habito_tabaco')->default(false);
            $table->boolean('habito_alcohol')->default(false);
            $table->boolean('habito_drogas')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('antecedentes_medicos');
    }
};
