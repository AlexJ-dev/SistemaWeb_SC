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
    Schema::create('pacientes', function (Blueprint $table) {
        $table->id();
        $table->string('nombres');
        $table->string('apellidos');
        $table->string('cargo')->nullable();
        $table->string('empresa')->nullable();
        $table->date('fecha')->nullable();
        $table->string('documento');
        $table->string('tipo_documento');
        $table->string('tipo_evaluacion');
        $table->string('registrado_por'); // username del usuario logueado
        $table->timestamp('registrado_en')->useCurrent(); // hora automática
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pacientes');
    }
    
};
