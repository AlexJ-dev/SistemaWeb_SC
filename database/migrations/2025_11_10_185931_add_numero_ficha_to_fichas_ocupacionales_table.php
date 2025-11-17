<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('fichas_ocupacionales', function (Blueprint $table) {
            $table->string('numero_ficha')->nullable()->after('id');
        });
    }

    public function down(): void
    {
        Schema::table('fichas_ocupacionales', function (Blueprint $table) {
            $table->dropColumn('numero_ficha');
        });
    }
};
