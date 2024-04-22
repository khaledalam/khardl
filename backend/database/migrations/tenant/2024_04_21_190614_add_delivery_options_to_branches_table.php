<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Drop columns if they exist in the settings table
        if (Schema::hasColumn('settings', 'drivers_option')) {
            Schema::table('settings', function (Blueprint $table) {
                $table->dropColumn('drivers_option');
            });
        }

        if (Schema::hasColumn('settings', 'delivery_companies_option')) {
            Schema::table('settings', function (Blueprint $table) {
                $table->dropColumn('delivery_companies_option');
            });
        }

        // Drop column from branches table if it exists
        if (Schema::hasColumn('branches', 'delivery_availability')) {
            Schema::table('branches', function (Blueprint $table) {
                $table->dropColumn('delivery_availability');
            });
        }

        // Add new columns to branches table
        Schema::table('branches', function (Blueprint $table) {
            $table->boolean('drivers_option')->default(false);
            $table->boolean('delivery_companies_option')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop columns added to branches table
        Schema::table('branches', function (Blueprint $table) {
            $table->dropColumn('drivers_option');
            $table->dropColumn('delivery_companies_option');
        });

        // Re-add columns to settings table
        Schema::table('settings', function (Blueprint $table) {
            $table->boolean('drivers_option')->default(false);
            $table->boolean('delivery_companies_option')->default(false);
        });

        // Re-add removed column to branches table
        Schema::table('branches', function (Blueprint $table) {
            $table->boolean('delivery_availability')->default(false);
        });
    }
};
