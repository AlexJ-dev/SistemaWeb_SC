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
       Schema::create('evaluacion_triaje', function (Blueprint $table) {
    $table->id();
    $table->foreignId('evaluacion_id')->constrained('evaluaciones')->onDelete('cascade');

    $table->decimal('talla', 5, 2)->nullable(); // cm
    $table->decimal('peso', 5, 2)->nullable(); // kg
    $table->decimal('indice_masa_corporal', 5, 2)->nullable();
    $table->integer('frecuencia_respiratoria')->nullable();
    $table->integer('frecuencia_cardiaca')->nullable();
    $table->integer('saturacion_oxigeno')->nullable();
    $table->string('presion_arterial')->nullable();
    $table->decimal('temperatura', 4, 1)->nullable();

    $table->decimal('perimetro_toracico', 5, 2)->nullable();
    $table->decimal('perimetro_abdominal', 5, 2)->nullable();
    $table->decimal('cintura', 5, 2)->nullable();
    $table->decimal('cadera', 5, 2)->nullable();
    $table->decimal('indice_cintura_cadera', 5, 2)->nullable();

    $table->text('anamnesis')->nullable();
    $table->text('ectoscopia')->nullable();
    $table->text('estado_mental')->nullable();

    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluacion_triaje');
    }
};
