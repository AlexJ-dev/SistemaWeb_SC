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
        Schema::table('ruta_medica', function (Blueprint $table) {
            $table->string('estado')->default('pendiente'); // pendiente, en_proceso, finalizado
            $table->timestamp('fecha_salida')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ruta_medica', function (Blueprint $table) {
            //
            $table->dropColumn('estado');
            $table->dropColumn('fecha_salida');
        });
    }
};
