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
        Schema::table('evaluacion_oftalmologia', function (Blueprint $table) {
            $table->boolean('test_ishihara')->nullable()->change();
            $table->boolean('vision_nocturna')->nullable()->change();
            $table->boolean('vision_colores')->nullable()->change();
            $table->boolean('vision_profundidad')->nullable()->change();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('evaluacion_oftalmologia', function (Blueprint $table) {
            $table->boolean('test_ishihara')->nullable(false)->change();
            $table->boolean('vision_nocturna')->nullable(false)->change();
            $table->boolean('vision_colores')->nullable(false)->change();
            $table->boolean('vision_profundidad')->nullable(false)->change();

        });
    }
};
