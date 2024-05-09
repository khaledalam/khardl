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
        Schema::table('ro_subscription_coupons', function (Blueprint $table) {
            $table->dropForeign('ro_subscription_coupons_promoter_id_foreign');
            $table->unsignedBigInteger('promoter_id')->unique(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ro_subscription_coupons', function (Blueprint $table) {
            $table->unsignedBigInteger('promoter_id')->unique()->change();
      });
    }
};
