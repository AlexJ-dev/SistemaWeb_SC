<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('fichas_ocupacionales', function (Blueprint $table) {
            $table->string('altitud', 50)->change();
        });
    }

    public function down()
    {
        Schema::table('fichas_ocupacionales', function (Blueprint $table) {
            $table->integer('altitud')->change(); // o el tipo anterior
        });
    }
};
