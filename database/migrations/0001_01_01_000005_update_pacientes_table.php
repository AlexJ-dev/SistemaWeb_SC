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
        Schema::table('pacientes', function (Blueprint $table) {
            // Eliminar campos innecesarios
            $table->dropColumn([
                'cargo',
                'empresa',
                'tipo_evaluacion',
                'registrado_por',
                'registrado_en'
            ]);

            // Agregar nuevos campos
            $table->date('fecha_nacimiento')->nullable();
            $table->string('sexo')->nullable();
            $table->string('telefono')->nullable();
            $table->string('correo_electronico')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
     public function down()
    {
        Schema::table('pacientes', function (Blueprint $table) {
            // Restaurar campos eliminados
            $table->string('cargo')->nullable();
            $table->string('empresa')->nullable();
            $table->string('tipo_evaluacion')->nullable();
            $table->string('registrado_por')->nullable();
            $table->timestamp('registrado_en')->nullable();

            // Eliminar campos agregados
            $table->dropColumn([
                'fecha_nacimiento',
                'sexo',
                'telefono',
                'correo_electronico'
            ]);
        });
    }
};
