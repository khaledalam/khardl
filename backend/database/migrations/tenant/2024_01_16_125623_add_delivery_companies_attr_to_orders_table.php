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
        Schema::table('orders', function (Blueprint $table) {
            $table->string('deliver_by')->nullable();
            $table->string('cervo_ref')->nullable();
            $table->string('yeswa_ref')->nullable();
            $table->string('streetline_ref')->nullable();
            $table->string('tracking_url')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['deliver_by', 'cervo_ref', 'yeswa_ref', 'streetline_ref', 'tracking_url']);
        });
    }
};
