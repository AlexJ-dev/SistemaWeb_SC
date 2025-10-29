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
        Schema::table('users', function (Blueprint $table) {
            // Eliminar la restricción de clave foránea
            $table->dropForeign(['especialidad_id']);

            // Luego eliminar las columnas
            $table->dropColumn([
                'username',
                'dni',
                'direccion',
                'fecha_nacimiento',
                'sexo',
                'cargo',
                'especialidad_id'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->nullable(); // Nombre de usuario para login
            $table->string('dni')->unique();     
            $table->string('direccion')->nullable();
            $table->date('fecha_nacimiento')->nullable(); 
            $table->enum('sexo', ['M', 'F'])->nullable(); // Sexo: M/F/Otro
            $table->string('cargo')->nullable(); // Rol institucional: médico, recepcionista, etc.
            $table->foreignId('especialidad_id')->nullable()->constrained('especialidades_ocupacionales')->onDelete('set null');
        });
    }
};
