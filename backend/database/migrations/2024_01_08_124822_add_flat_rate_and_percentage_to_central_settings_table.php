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
        Schema::table('central_settings', function (Blueprint $table) {
            $table->float('fee_flat_rate')->unsigned()->default(0);
            $table->float('fee_percentage')->unsigned()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('central_settings', function (Blueprint $table) {
            $table->dropColumn(['fee_flat_rate', 'fee_percentage']);
        });
    }
};
