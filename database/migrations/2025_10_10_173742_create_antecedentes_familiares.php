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
        Schema::create('antecedentes_familiares', function (Blueprint $table) {
            $table->id();
            $table->foreignId('historia_clinica_id')->constrained('historias_clinicas')->onDelete('cascade');
            $table->integer('numero_hijos')->nullable();
            $table->string('salud_padre')->nullable();
            $table->string('salud_madre')->nullable();
            $table->string('salud_esposo')->nullable();
            $table->string('salud_hijos')->nullable();
            $table->text('observaciones')->nullable();
            $table->integer('numero_dependientes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('antecedentes_familiares');
    }
};
