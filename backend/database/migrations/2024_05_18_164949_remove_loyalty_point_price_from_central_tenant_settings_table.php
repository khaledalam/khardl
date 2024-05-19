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
            $table->dropColumn(['loyalty_point_price']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('central_tenant_settings', function (Blueprint $table) {
            $table->string("loyalty_point_price");
        });
    }
};
