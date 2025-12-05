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
        Schema::create('evaluacion_espirometria', function (Blueprint $table) {
            $table->id();

            // Relación con Evaluacion general
            $table->foreignId('evaluacion_id')->constrained('evaluaciones')->onDelete('cascade');

            // Antecedentes y condiciones clínicas
            $table->boolean('deprendimiento_retina')->default(false);
            $table->boolean('infarto_corazon')->default(false);
            $table->boolean('hopitalizado_problema_corazon')->default(false);
            $table->boolean('medicamentos_tuberculosis')->default(false);
            $table->boolean('embarazo_actual')->default(false);
            $table->boolean('diagnostico_covid')->default(false);
            $table->boolean('hemoptisis')->default(false);
            $table->boolean('pneumotrorax')->default(false);
            $table->boolean('traqueostomia')->default(false);
            $table->boolean('sonda_pleurral')->default(false);
            $table->boolean('aneurisma_celebral_abdomen_torax')->default(false);
            $table->boolean('embolia_pulmonar')->default(false);
            $table->boolean('infarto_reciente')->default(false);
            $table->boolean('inestabilidad_cv')->default(false);
            $table->boolean('fiebre_nauseas_vomitos')->default(false);
            $table->boolean('embarazo_avanzado')->default(false);
            $table->boolean('embarazo_complicado')->default(false);
            $table->boolean('amenaza_aborto')->default(false);
            $table->boolean('infeccion_respiratoria')->default(false);
            $table->boolean('infeccion_oido')->default(false);

            // Medicación y hábitos
            $table->boolean('nebulizadores_broncodilatadores')->default(false);
            $table->boolean('medicamento_broncodilatador')->default(false);
            $table->boolean('fumo_cigarrillos')->default(false);
            $table->integer('cuantos_cigarrillos')->nullable();
            $table->boolean('ejercicio_fisico')->default(false);
            $table->boolean('comio')->default(false);

            // Especificaciones (pueden ser múltiples)
            $table->json('especificaciones')->nullable();

            // Resultados espirometría
            $table->decimal('fvc_pre', 8, 2)->nullable();
            $table->decimal('fvc_ref_porcentaje', 5, 2)->nullable();
            $table->decimal('fvc_ref', 8, 2)->nullable();

            $table->decimal('fev1_pre', 8, 2)->nullable();
            $table->decimal('fev1_ref_porcentaje', 5, 2)->nullable();
            $table->decimal('fev1_ref', 8, 2)->nullable();

            $table->decimal('fev_fvc_pre', 8, 2)->nullable();
            $table->decimal('fev_fvc_ref_porcentaje', 5, 2)->nullable();
            $table->decimal('fev_fvc_ref', 8, 2)->nullable();

            $table->decimal('fef_pre', 8, 2)->nullable();
            $table->decimal('fef_ref_porcentaje', 5, 2)->nullable();
            $table->decimal('fef_ref', 8, 2)->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('evaluacion_espirometria');
    }
};
