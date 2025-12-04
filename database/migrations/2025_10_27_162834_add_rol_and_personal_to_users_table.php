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
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('rol_id')->nullable()->constrained('roles')->onDelete('set null');
            $table->foreignId('personal_id')->nullable()->constrained('personal')->onDelete('cascade');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['rol_id']);
            $table->dropColumn('rol_id');

            $table->dropForeign(['personal_id']);
            $table->dropColumn('personal_id');
        });
    }
};
