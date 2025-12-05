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


        Schema::create('evaluacion_oftalmologia', function (Blueprint $table) {
            $table->id();

            // Relación con Evaluacion general
            $table->foreignId('evaluacion_id')->constrained('evaluaciones')->onDelete('cascade');

            // Antecedentes y condiciones
            $table->boolean('hta')->default(false);
            $table->boolean('diabetes_mellitus')->default(false);
            $table->boolean('glaucoma')->default(false);
            $table->boolean('estrabismo')->default(false);
            $table->boolean('conjuntivitis')->default(false);
            $table->boolean('traumatismo')->default(false);
            $table->boolean('radiaciones')->default(false);
            $table->boolean('quimicos')->default(false);
            $table->boolean('exposicion_computadoras')->default(false);

            // Síntomas
            $table->boolean('prurito')->default(false);
            $table->boolean('vision_borrosa')->default(false);
            $table->boolean('cefalea')->default(false);
            $table->text('otros')->nullable();

            // Examen físico
            $table->boolean('lentes')->default(false);
            $table->text('parpados_anexos')->nullable();
            $table->text('polo_anterior')->nullable();
            $table->text('reflejo_pupilar')->nullable();

            // Pruebas específicas
            $table->boolean('test_ishihara')->default(false);
            $table->boolean('vision_nocturna')->default(false);
            $table->boolean('vision_colores')->default(false);
            $table->boolean('vision_profundidad')->default(false);

            // Agudeza visual izquierda
            $table->string('av_lejos_sin_corrector_izq')->nullable();
            $table->string('av_lejos_con_corrector_izq')->nullable();
            $table->string('av_cerca_sin_corrector_izq')->nullable();
            $table->string('av_cerca_con_corrector_izq')->nullable();

            // Agudeza visual derecha
            $table->string('av_lejos_sin_corrector_der')->nullable();
            $table->string('av_lejos_con_corrector_der')->nullable();
            $table->string('av_cerca_sin_corrector_der')->nullable();
            $table->string('av_cerca_con_corrector_der')->nullable();

            // Otros hallazgos
            $table->text('sensibilidad_mucosa')->nullable();

            // Diagnóstico y recomendaciones (pueden ser múltiples)
            $table->json('diagnostico')->nullable();
            $table->json('recomendaciones')->nullable();

            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluacion_oftalmologia');
    }
};
