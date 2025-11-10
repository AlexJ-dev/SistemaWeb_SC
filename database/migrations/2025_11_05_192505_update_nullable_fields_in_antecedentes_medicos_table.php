<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Hacer que los campos de antecedentes_medicos sean nullable.
     */
    public function up(): void
    {
        Schema::table('antecedentes_medicos', function (Blueprint $table) {
            $table->text('patologicos_personales')->nullable()->change();
            $table->text('cirugias')->nullable()->change();
            $table->text('intoxicaciones')->nullable()->change();
            $table->text('alergias')->nullable()->change();
            $table->text('hospitalizaciones')->nullable()->change();
            $table->text('medicamentos')->nullable()->change();
            $table->text('inmunizaciones')->nullable()->change();
            $table->string('habito_tabaco')->nullable()->change();
            $table->string('habito_alcohol')->nullable()->change();
            $table->string('habito_drogas')->nullable()->change();
            $table->string('grupo_sanguineo')->nullable()->change();
            $table->text('observaciones')->nullable()->change();
        });
    }

    /**
     * Revertir los cambios (volver a NOT NULL).
     */
    public function down(): void
    {
        Schema::table('antecedentes_medicos', function (Blueprint $table) {
            $table->text('patologicos_personales')->nullable(false)->change();
            $table->text('cirugias')->nullable(false)->change();
            $table->text('intoxicaciones')->nullable(false)->change();
            $table->text('alergias')->nullable(false)->change();
            $table->text('hospitalizaciones')->nullable(false)->change();
            $table->text('medicamentos')->nullable(false)->change();
            $table->text('inmunizaciones')->nullable(false)->change();
            $table->string('habito_tabaco')->nullable(false)->change();
            $table->string('habito_alcohol')->nullable(false)->change();
            $table->string('habito_drogas')->nullable(false)->change();
            $table->string('grupo_sanguineo')->nullable(false)->change();
            $table->text('observaciones')->nullable(false)->change();
        });
    }
};
