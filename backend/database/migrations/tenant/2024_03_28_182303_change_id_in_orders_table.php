<?php

use App\Models\Tenant\Coupon;
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

        Schema::disableForeignKeyConstraints();

        Schema::table('order_items', function (Blueprint $table) {
            $table->dropForeign('order_items_order_id_foreign');
        });

        Schema::table('order_status_logs', function (Blueprint $table) {
            $table->dropForeign('order_status_logs_order_id_foreign');
        });


        Schema::table('orders', function (Blueprint $table) {
            $table->string('id')->unique()->change();
        });

        Schema::table('order_items', function (Blueprint $table) {
            $table->string('order_id')->change();
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
        });

        Schema::table('order_status_logs', function (Blueprint $table) {
            $table->string('order_id')->change();
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
        });

        Schema::enableForeignKeyConstraints();

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->id();
        });
    }
};
