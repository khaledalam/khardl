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
        Schema::table('permissions_worker', function (Blueprint $table) {
            $table->boolean('can_access_summary')->default(0);
            $table->boolean('can_access_site_editor')->default(0);
            $table->boolean('can_access_coupons')->default(0);
            $table->boolean('can_access_qr')->default(0);
            $table->boolean('can_access_service_page')->default(0);
            $table->boolean('can_access_delivery_companies')->default(0);
            $table->boolean('can_access_customers_data')->default(0);
            $table->boolean('can_access_settings')->default(0);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('permissions_worker', function (Blueprint $table) {
            $table->dropColumn([
                'can_access_summary',
                'can_access_site_editor',
                'can_access_coupons',
                'can_access_qr',
                'can_access_service_page',
                'can_access_delivery_companies',
                'can_access_customers_data',
                'can_access_settings'
            ]);
        });
    }
};
