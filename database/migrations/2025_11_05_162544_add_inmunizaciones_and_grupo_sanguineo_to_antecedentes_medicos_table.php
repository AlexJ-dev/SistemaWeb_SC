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
        Schema::table('antecedentes_medicos', function (Blueprint $table) {
            $table->text('inmunizaciones')->nullable()->after('medicamentos');
            $table->string('grupo_sanguineo', 5)->nullable()->after('habito_drogas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('antecedentes_medicos', function (Blueprint $table) {
            $table->dropColumn(['inmunizaciones', 'grupo_sanguineo']);
        });
    }
};
