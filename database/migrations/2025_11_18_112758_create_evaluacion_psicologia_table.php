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
        Schema::create('evaluacion_psicologia', function (Blueprint $table) {
            $table->id();

            // Relación con Evaluacion general
            $table->foreignId('evaluacion_id')->constrained('evaluaciones')->onDelete('cascade');

            // Observaciones clínicas
            $table->text('presentacion')->nullable();
            $table->text('postura')->nullable();

            // Discurso
            $table->text('discurso_ritmo')->nullable();
            $table->text('discurso_tono')->nullable();
            $table->text('discurso_articulacion')->nullable();

            // Orientación
            $table->boolean('orientacion_tiempo')->default(false);
            $table->boolean('orientacion_espacio')->default(false);
            $table->boolean('orientacion_persona')->default(false);

            // Evaluación cognitiva
            $table->string('nivel_intelectual')->nullable();
            $table->string('coordinacion_visomotriz')->nullable();
            $table->string('nivel_memoria')->nullable();

            // Rasgos de personalidad
            $table->string('personalidad')->nullable();
            $table->string('medividad')->nullable();
            $table->string('altura')->nullable();

            // Estado emocional
            $table->boolean('estres')->default(false);
            $table->boolean('ansiedad')->default(false);
            $table->boolean('depresion')->default(false);
            $table->boolean('fatiga')->default(false);
            $table->boolean('somnolencia')->default(false);

            // Otros factores
            $table->boolean('espacios_confinados')->default(false);
            $table->boolean('fobias')->default(false);

            // Tests específicos
            $table->text('minisiquiatrico')->nullable();
            $table->text('audit')->nullable();

            // Conclusiones
            $table->text('conclusiones_area_congnitiva')->nullable();
            $table->text('conclusiones_area_emocional')->nullable();
            $table->text('recomendaciones')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('evaluacion_psicologia');
    }
};
