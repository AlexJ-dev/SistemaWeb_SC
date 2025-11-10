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
        Schema::table('antecedentes_medicos', function (Blueprint $table) {
            $table->json('cirugias')->nullable()->change();
            $table->json('intoxicaciones')->nullable()->change();
            $table->json('alergias')->nullable()->change();
            $table->json('hospitalizaciones')->nullable()->change();
            $table->json('medicamentos')->nullable()->change();
            $table->json('inmunizaciones')->nullable()->change();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('antecedentes_medicos', function (Blueprint $table) {
            $table->text('cirugias')->nullable()->change();
            $table->text('intoxicaciones')->nullable()->change();
            $table->text('alergias')->nullable()->change();
            $table->text('hospitalizaciones')->nullable()->change();
            $table->text('medicamentos')->nullable()->change();
            $table->text('inmunizaciones')->nullable()->change();
        });
    }
};
