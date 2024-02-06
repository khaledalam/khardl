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
        Schema::table('central_tenant_settings', function (Blueprint $table) {
            $table->boolean('drivers_option')->default(0);
            $table->boolean('delivery_companies_option')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('central_tenant_settings', function (Blueprint $table) {
            $table->dropColumn(['drivers_option','delivery_companies_option']);
        });
    }
};
