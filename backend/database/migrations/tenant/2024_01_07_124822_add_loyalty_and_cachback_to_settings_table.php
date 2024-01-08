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
        Schema::table('settings', function (Blueprint $table) {
            $table->float('loyalty_points')->unsigned()->default(0);
            $table->float('loyalty_point_price')->unsigned()->default(0);
            $table->float('cashback_threshold')->unsigned()->default(0);
            $table->float('cashback_percentage')->unsigned()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn('loyalty_points');
            $table->dropColumn('loyalty_point_price');
            $table->dropColumn('cashback_threshold');
            $table->dropColumn('cashback_percentage');
        });
    }
};
