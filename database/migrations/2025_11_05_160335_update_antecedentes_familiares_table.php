<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('antecedentes_familiares', function (Blueprint $table) {
            // Eliminamos las columnas que ya no se usarán


            // Agregamos las nuevas columnas
            $table->integer('numero_hijos_vivos')->nullable()->after('historia_clinica_id');
            $table->integer('numero_hijos_muertos')->nullable()->after('numero_hijos_vivos');

            $table->string('salud_padre')->nullable()->after('numero_hijos_muertos');
            $table->text('observacion_padre')->nullable()->after('salud_padre');

            $table->string('salud_madre')->nullable()->after('observacion_padre');
            $table->text('observacion_madre')->nullable()->after('salud_madre');

            $table->string('salud_esposo')->nullable()->after('observacion_madre');
            $table->text('observacion_esposo')->nullable()->after('salud_esposo');

            $table->string('salud_hijos')->nullable()->after('observacion_esposo');
            $table->text('observacion_hijos')->nullable()->after('salud_hijos');

            $table->integer('numero_dependientes')->nullable()->after('observacion_hijos');
        });
    }

    public function down(): void
    {
        Schema::table('antecedentes_familiares', function (Blueprint $table) {
            $table->dropColumn([
                'numero_hijos_vivos',
                'numero_hijos_muertos',
                'salud_padre',
                'observacion_padre',
                'salud_madre',
                'observacion_madre',
                'salud_esposo',
                'observacion_esposo',
                'salud_hijos',
                'observacion_hijos',
                'numero_dependientes',
            ]);

            
        });
    }
};
