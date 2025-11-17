<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('fichas_ocupacionales', function (Blueprint $table) {
            $table->string('altitud')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('fichas_ocupacionales', function (Blueprint $table) {
            $table->string('altitud')->nullable(false)->change();
        });
    }
};
