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
        Schema::table('domains', function (Blueprint $table) {
            //
            // $table->dropColumn('keyword');
            // $table->dropColumn('country_id');
            // $table->dropColumn('city_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('domains', function (Blueprint $table) {
            //
            // $table->string('keyword');
            // $table->foreignId('country_id');
            // $table->foreignId('city_id');
        });
    }
};
