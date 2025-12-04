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
        Schema::table('especialidades_ocupacionales', function (Blueprint $table) {
            $table->string('nombre')->unique()->after('id');
            $table->string('descripcion')->nullable()->after('nombre');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('especialidades_ocupacionales', function (Blueprint $table) {
            $table->dropColumn(['nombre', 'descripcion']);
        });
    }
};
