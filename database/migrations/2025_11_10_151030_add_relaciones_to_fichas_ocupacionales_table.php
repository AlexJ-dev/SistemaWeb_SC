<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up()
{
    Schema::table('fichas_ocupacionales', function (Blueprint $table) {
        $table->unsignedBigInteger('historia_clinica_id')->nullable()->after('paciente_id');
        $table->unsignedBigInteger('ruta_medica_id')->nullable()->after('historia_clinica_id');

        $table->foreign('historia_clinica_id')->references('id')->on('historias_clinicas')->onDelete('set null');
        $table->foreign('ruta_medica_id')->references('id')->on('ruta_medica')->onDelete('set null');
    });
}

public function down()
{
    Schema::table('fichas_ocupacionales', function (Blueprint $table) {
        $table->dropForeign(['historia_clinica_id']);
        $table->dropForeign(['ruta_medica_id']);
        $table->dropColumn(['historia_clinica_id', 'ruta_medica_id']);
    });
}

};
