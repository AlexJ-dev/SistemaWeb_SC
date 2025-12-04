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
        Schema::table('historias_clinicas', function (Blueprint $table) {
            $table->string('emergencia_persona')->nullable()->after('emergencia_parentesco');
            $table->dropColumn('telefono');
            $table->dropColumn('grupo_sanguineo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('historias_clinicas', function (Blueprint $table) {
            $table->dropColumn('emergencia_persona');
            $table->string('telefono')->nullable()->after('domicilio_distrito');
            $table->string('grupo_sanguineo')->nullable()->after('emergencia_telefono');
        });
    }
};
