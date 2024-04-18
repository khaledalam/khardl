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
        Schema::table('restaurant_styles', function (Blueprint $table) {
            $table->integer('logo_border_radius')->default(0);
            $table->string('logo_border_color')->default('white');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('restaurant_styles', function (Blueprint $table) {
            $table->dropColumn(['logo_border_radius', 'logo_border_color']);
        });
    }
};
