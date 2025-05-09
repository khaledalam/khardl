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
            $table->text('terms_and_conditions_enText')->nullable();
            $table->text('terms_and_conditions_arText')->nullable();
            $table->text('privacy_policy_enText')->nullable();
            $table->text('privacy_policy_arText')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('restaurant_styles', function (Blueprint $table) {
            $table->dropColumn(['terms_and_conditions_enText', 'terms_and_conditions_arText', 'privacy_policy_enText', 'privacy_policy_arText']);
        });
    }
};
