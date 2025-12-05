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
        Schema::create('evaluacion_audiometria', function (Blueprint $table) {
            $table->id();

            // Relación con Evaluacion general
            $table->foreignId('evaluacion_id')->constrained('evaluaciones')->onDelete('cascade');

            // Datos generales
            $table->integer('anios_trabajo')->nullable();
            $table->string('tep')->nullable(); // Tiempo de exposición total ponderado

            // Protectores auditivos
            $table->boolean('uso_tapones')->default(false);
            $table->boolean('uso_orejeras')->default(false);

            // Antecedentes y exposición
            $table->string('apreciacion_ruido')->nullable();
            $table->boolean('cambio_altitud')->default(false);
            $table->boolean('exposicion_ruidos')->default(false);
            $table->boolean('malestar_oido_garganta')->default(false);
            $table->boolean('problema_dormir')->default(false);
            $table->boolean('consume_alcohol')->default(false);
            $table->boolean('uso_medicamentos')->default(false);
            $table->boolean('consume_tabaco')->default(false);
            $table->boolean('servicio_militar')->default(false);
            $table->boolean('hobbi_exposicion_ruido')->default(false);
            $table->boolean('exposicion_laboral_quimicos')->default(false);
            $table->boolean('infecciones_oido')->default(false);
            $table->boolean('uso_ototoxicos')->default(false);

            // Síntomas
            $table->boolean('disminucion_audicion')->default(false);
            $table->boolean('otalgia')->default(false);
            $table->boolean('zumbido')->default(false);
            $table->boolean('mareos')->default(false);
            $table->boolean('secrecion_oido')->default(false);
            $table->text('otros')->nullable();

            // Otoscopia (3 resultados cada oído)
            $table->string('otoscopia_oido_der')->nullable();
            $table->string('otoscopia_oido_izq')->nullable();

            // Frecuencias oído derecho
            $table->string('fre_oido_der_500')->nullable();
            $table->string('fre_oido_der_1000')->nullable();
            $table->string('fre_oido_der_2000')->nullable();
            $table->string('fre_oido_der_3000')->nullable();
            $table->string('fre_oido_der_4000')->nullable();
            $table->string('fre_oido_der_6000')->nullable();
            $table->string('fre_oido_der_8000')->nullable();

            // Frecuencias oído izquierdo
            $table->string('fre_oido_izq_500')->nullable();
            $table->string('fre_oido_izq_1000')->nullable();
            $table->string('fre_oido_izq_2000')->nullable();
            $table->string('fre_oido_izq_3000')->nullable();
            $table->string('fre_oido_izq_4000')->nullable();
            $table->string('fre_oido_izq_6000')->nullable();
            $table->string('fre_oido_izq_8000')->nullable();

            // Otros factores
            $table->boolean('practica_tiro')->default(false);
            $table->boolean('usa_auriculares')->default(false);
            $table->boolean('sordera_familiar')->default(false);

            // Resultados finales
            $table->string('perdida_audio_der')->nullable();
            $table->string('perdida_audio_izq')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('evaluacion_audiometria');
    }
};
