<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('fichas_ocupacionales', function (Blueprint $table) {
        // Agregamos la nueva columna
        $table->string('exploracion_procesados')->nullable();

        // Eliminamos las antiguas si existen
        $table->dropColumn(['explora_superficie', 'explora_concentradora', 'explora_subsuelo']);
    });
}

public function down()
{
    Schema::table('fichas_ocupacionales', function (Blueprint $table) {
        $table->dropColumn('exploracion_procesados');
        $table->string('explora_superficie')->nullable();
        $table->string('explora_concentradora')->nullable();
        $table->string('explora_subsuelo')->nullable();
    });
}

};
