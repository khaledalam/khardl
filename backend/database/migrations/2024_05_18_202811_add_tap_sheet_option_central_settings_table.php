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
            $table->boolean('auto_update_tap_sheet')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('central_settings', function (Blueprint $table) {
            $table->dropColumn(['auto_update_tap_sheet']);
        });
    }
};
