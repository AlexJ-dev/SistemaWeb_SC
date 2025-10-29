<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::table('personal', function (Blueprint $table) {
            $table->dropForeign(['especialidad_id']);
            $table->foreign('especialidad_id')
                ->references('id')
                ->on('especialidades_ocupacionales')
                ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('personal', function (Blueprint $table) {
            $table->dropForeign(['especialidad_id']);
            $table->foreign('especialidad_id')
                ->references('id')
                ->on('especialidades_ocupacionales')
                ->onDelete('set null');
        });
    }
};
