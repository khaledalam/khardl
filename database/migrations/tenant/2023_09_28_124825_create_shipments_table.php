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
        Schema::create('shipments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('address_id');
            $table->enum('shipment_status', ['pending', 'shipped', 'delivered', 'returned']);
            $table->string('tracking_number')->unique()->nullable();
            $table->timestamp('shipping_date')->nullable();
            $table->timestamp('estimated_arrival_date')->nullable();
            $table->timestamp('actual_arrival_date')->nullable();
            $table->string('carrier')->nullable();
            $table->decimal('shipping_fee', 8, 2)->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('address_id')->references('id')->on('addresses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipments');
    }
};
