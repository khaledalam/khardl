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
            $table->integer('logo_border_radius')->default(25);
            $table->string('logo_border_color')->default('#fff');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

    }
};
