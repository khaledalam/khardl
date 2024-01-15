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
        Schema::create('central_tenant_settings', function (Blueprint $table) {
            $table->id();
            $table->string('global_id')->unique();
            $table->boolean('is_live')->default(false);
            $table->float('delivery_fee')->default(0);
            $table->float('loyalty_points')->unsigned()->default(0);
            $table->float('loyalty_point_price')->unsigned()->default(0);
            $table->float('cashback_threshold')->unsigned()->default(0);
            $table->float('cashback_percentage')->unsigned()->default(0);
            $table->string("restaurant_name");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('central_tenant_settings');
    }
};
